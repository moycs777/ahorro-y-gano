<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Support\Facades\Mail;
use App\Model\user\User;
use App\Reffer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    

    use AuthenticatesUsers;

    protected $redirectTo = '/';

    protected function validator(array $data)
    {
        $messages = [
            'email.exists' => 'usuario o clave incorrecto',
        ];

        return Validator::make($data, [
            
            'email' => 'required|string|email|max:255|exists:users,email',
            'password' => 'required|string|min:6',

            /*'reffer_id' => 'exists:users,email'*/
        ], $messages);
    }

    public function login(Request $request)
    {
        //dd($request->all());
        $this->validateLogin($request);

        // Validamos si el usuario verifico su email
        //dd($request->all()); 
        $user = User::where('email', $request->email)
            ->first();
        if (!$user) {
            return redirect()->back();
        }
        if ($user->confirmed != 1  || $user->confirmed == 0 || $user->confirmed == false  ) {
            return view ('user.messagges.confirmacion');
        }      

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);


    }


    /* fin de espacio de pruebas
    */

    /* Login de redes sociales */

    public function redirectToProvider($provider)
    {
        //dd($provider);
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        //dd( $user = Socialite::driver($provider)->user() );
        try{
            $user = Socialite::driver($provider)->user();
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            abort(403, 'Unauthorized action.');
            return redirect()->to('/');
        }

        if ( $user->getEmail() == null) {
            $attributes = [
                'provider' => $provider,
                'provider_id' => $user->getId(),
                'name' => $user->getName(),            
                'email' => $user->getId(),
                'password' => isset($attributes['password']) ? $attributes['password'] : bcrypt(str_random(16))
     
            ];
        }
        if ($user->getEmail() ) {
            $attributes = [
                'provider' => $provider,
                'provider_id' => $user->getId(),
                'name' => $user->getName(), 
                //email nulo para prbar
                           
                'email' => $user->getId(),
                'password' => $user->getId()
            ];       
        }

        //Revisar si el correo
        //Revisar si el usuario existe
        $clien = Cliente::where('provider_id', $attributes['provider_id'] )->first();
        if ( !$clien ) {
            /*f (Auth::guard('cliente')->attempt(['email' => $attributes['email'], 'password' => $user->getId() ], false)) {
                //dd( $request->all());
                return redirect('/home');
            } */
            
            //dd($attributes['name']);
            $cliente = new Cliente ();
            $cliente->name = $attributes['name'];
            $cliente->lastname = $attributes['name'];
            $cliente->email = $attributes['email'];
            $cliente->provider = $provider;
            $cliente->provider_id = $attributes['provider_id'];
            $cliente->password = Hash::make( $attributes['password'] );
            //$cliente->estado = 'A'/*$request->get ( 'estado' )*/;
            $cliente->remember_token = true;

            $cliente->save ();
        
        }

        //dd($cliente);
        if (Auth::guard('cliente')->attempt(['email' => $attributes['email'], 'password' => $user->getId() ], false)) {
            //dd( $request->all());
            return redirect('/home');
        }        

    }


    /* Fin de Login de redes sociales */

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}

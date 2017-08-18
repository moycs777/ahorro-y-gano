<?php

namespace App\Http\Controllers\Mobile;

use App\User;
use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use Auth;
use Redirect;
use Session;
use Validator;
use Illuminate\Support\Facades\Input;    
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\RegistersUsers;

class IndexController extends Controller
{
    public function __construct() {
       $this->middleware('cors');
    }

    public function index()
    {


        //return "este es el index";
        /*return response('{Hello World: 1}', 200)
                  ->header('Content-Type', 'text/plain');*/
        try {
            $usuarios = Admin::all();
            
            if (!$usuarios) {
                return response()->json(['no hay usuarios'], 404);
            }

            return response()->json($usuarios, 200);

        } catch (Exception $e) {
            return response()->json('Hay un error', 500);
        }
    }

    public function login( Request $request)
    {
      dd($request);
      $messages = [
          'email.exists' => 'Email o clave incorrectos.',
          'password.min' => 'La clave debe contener al menos 6 caracteres',
      ];
      $validator = Validator::make($request->all(), [
            'email' => 'exists:users',
            'password' => 'required|min:6',
            ], $messages);
      /*if ($validator->fails()) {
          return redirect('ruta')
            ->withErrors($validator)
            ->withInput();
      }*/   
      if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
        //dd( $request->all());
        //return "exito " . Auth::user()->id;
        // return response('exito' . Auth::user()->id, 200)
                  /*->header('Content-Type');*/
          return response()->json([
              'name' => 'Bien',
              'state' => 'OK de bien'
          ]);
      }
      
      //dd($request->all());
      return response()->json($request->all(),[
                      'name' => 'Error',
                      'state' => 'Not ,'
                  ]);
      
    }

    public function register(Request $request) {
        //dd($request->all());
        
        $usuario = User::where('email',  $request->email)->first();
        if ( isset($usuario) ) {
            //dd($usuario);
            $messages = [
                'email.exists' => 'Email o clave incorrectos.',
                'password.min' => 'La clave debe contener al menos 6 caracteres',
            ];
            //dd($messages);
           /* return redirect('api/login')
                ->with('messages', $messages)
                ->withErrors($messages)
                ->withInput();*/
        }
      
        $cliente = new User ();
        $cliente->name = $request->get ( 'name' );
        $cliente->lastname = $request->get ( 'lastname' );
        $cliente->email = $request->get ( 'email' );
        $cliente->password = Hash::make ( $request->get ( 'password' ) );
        //$cliente->estado = 'A'/*$request->get ( 'estado' )*/;

        $cliente->save ();
        
        if (Auth::guard('web')->attempt(['email' => $cliente->email, 'password' => $request->password])) {
          //dd( $request->all());
          //return redirect('home');
            return response('exito' . Auth::user()->id, 200);

        }      
        
    }

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
 
   public function logout() {
      $asd =12;
      //dd($asd);
      Session::flush ();
      Auth::logout ();
      // Auth::guard('cliente')->logout ();
      return redirect('/clientelogin');
    }
}

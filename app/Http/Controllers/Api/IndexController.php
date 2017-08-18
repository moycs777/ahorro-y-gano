<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\user\User;
use App\Promotion;
use DB;
use Hash;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;


class IndexController extends Controller
{
    use RegistersUsers;

    public function __construct() {
       $this->middleware('cors');
    }

    public function index()
    {

        //return "este es el index";
        /*return response('{Hello World: 1}', 200)
                  ->header('Content-Type', 'text/plain');*/
        /*try {
            $promotions = Promotion::where('id', '>=', 1)->orderBy('created_at','DESC')->paginate(5);
            //return ['r' => 'y', 'promotions' => $promotions];
            return response()->json($promotions, 200);
            
            if (!$promotions) {
                return response()->json(['r' =>'n','mensaje' => 'no hay ofertas']);
            }

            return response()->json($promotions, 200);

        } catch (Exception $e) {
            return response()->json('Hay un error', 500);
        }*/
        $promotions = Promotion::all();
        return ['r' => 'y', 'datos' => $promotions];
    }

    public function login( Request $request)
    {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        
        $user = DB::table('users')
            ->where('email', $request->email)
            ->first();

        if ($user && password_verify($request->password, $user->password)) {
            return ['r' => 'y', 'datos' => $user];
        }
        
        return ['r' => 'n', 
                'msj' => 'La combinacion de Usuario y Clave no Concuerdan.', 
                'email' => $request
                ];
             
    }

    public function register(Request $request) 
    {

        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        $usuario = User::where('email',  $request->email)->first();
        if ( isset($usuario) ) {
            return ['r' => 'n', 'msj' => 'El Usuario '.$request->email.' existe '];
        }

        $cliente = new User ();
        $cliente->name = $request->name;
        $cliente->email = $request->email;
        $cliente->password = Hash::make ( $request->password );
        
        $cliente->save ();
        return ['r' => 'y', 'msj' => 'creado'.$request->email];
          
        
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
 
   public function logout() 
   {

      $asd =12;
      //dd($asd);
      Session::flush ();
      Auth::logout ();
      // Auth::guard('cliente')->logout ();
      return redirect('/clientelogin');
    }

}
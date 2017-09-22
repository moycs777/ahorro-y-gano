<?php

namespace App\Http\Controllers\Auth;

//use Mail;
use View;
use Illuminate\Support\Facades\Mail;
use App\Model\user\User;
use App\Reffer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;


class RegisterController extends Controller
{
   
    use RegistersUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest');
    }
    
    protected function validator(array $data)
    {
        //dd($data);
        $messages = [
            'email.exists' => 'clave incorrecto',
        ];
        return Validator::make($data, [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'reffer_id' => 'required|exists:users,id',            
        ], $messages);
    }  
   /* 
        registre estado de confirmado en la db para la creacion de los usaurio(function create) y permiti el logueo automatico (function register)
   */    
    protected function create(array $data)
    {
        $data['confirmation_code'] = str_random(25);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'reffer_id' => $data['reffer_id'],
            'confirmed' => 0,
            'confirmation_code' => $data['confirmation_code'],
        ]);

        $reffered = new Reffer();
        $reffered->user_id = $data['reffer_id'];
        $reffered->reffered_id = $user->id;
        $reffered->save();

        Mail::send('emails.confirmation_code', $data, function($message) use ($data) {
                $message->to($data['email'], $data['name'])->subject('Por favor confirma tu correo en Ahorro y Gano');
            });

        return $user;
        
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        // evitamos el logueo automatico
        return view('user.messagges.confirmacion');

        $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    public function verify($code)
    {
        //esta funcion se implementa en GUessController
        $user = User::where('confirmation_code', $code)->first();
        //dd($code);
        if (! $user)
            return redirect('/');

        $user->confirmed = true;
        $user->confirmation_code = null;
        $user->save();

        return redirect('/home')->with('notification', 'Has confirmado correctamente tu correo!');
    }

}

<?php

namespace App\Http\Controllers\Auth;

use App\Model\user\User;
use App\Reffer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

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
            'reffer_id.exists' => 'Codigo de referido incorrecto',
        ];
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'reffer_id' => 'exists:users,id'
        ], $messages);
    }
    
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'reffer_id' => $data['reffer_id'],
        ]);

        $reffered = new Reffer();
        $reffered->user_id = $data['reffer_id'];
        $reffered->reffered_id = $user->id;
        $reffered->save();

        return $user;

        //funcion original
        /*return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'reffer_id' => $data['reffer_id'],
        ]);*/
    }

}

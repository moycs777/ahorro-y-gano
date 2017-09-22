<?php

namespace App\Http\Controllers;

use App\Model\user\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class GuessController extends Controller
{
    

    public function verify($code)
    {
        
        $user = User::where('confirmation_code', '=', $code)->first();
        if (! $user){
            return redirect('/');
        }

        $user->confirmed = true;
        $user->confirmation_code = null;
        $user->save();

        //Logueamos al usuario recien confirmado
        Auth::login($user);
        return redirect('/pagenotfound');
        
    }

    public function confirmacion ()
    {
        return view('user.messagges.confirmacion');
    }
}

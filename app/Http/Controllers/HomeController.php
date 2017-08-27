<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\user\category;
use App\Promotion;
use App\Model\user\tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $ofertas = Promotion::where('id', '>=', 1)->orderBy('created_at','DESC')->paginate(5);
        return view('user.index',compact('ofertas'));
    }

    public function pagenotfound()
    {
        return view('errors.pagenotfound');
    }
}

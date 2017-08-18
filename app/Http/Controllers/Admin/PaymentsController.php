<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Promotion;
use App\Store;
use App\Coupon;

class PaymentsController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        
        return view('admin.payments.index');
        
    }

  
    public function tiendas()
    {
        $stores = Store::all();
        //dd($stores);
        
        return view('admin.payments.stores', compact('stores'));
    }

    public function delegados()
    {
        $delegates = Admin::where('admin_id', '=', Auth::user()->id)->get();
        //dd($delegates);
        
        return view('admin.payments.delegates', compact('delegates'));
    }

    
}

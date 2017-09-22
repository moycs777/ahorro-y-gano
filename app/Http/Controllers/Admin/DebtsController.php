<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Promotion;
use App\Store;
use App\Coupon;

class DebtsController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        ///$debts = Coupon::where('payed', '=', 1)->get();
        $store = Store::where('auth_id', '=', Auth::user()->id)
            ->get();
        $debts = Coupon::whereMonth('created_at', '>=', 1)
            ->where('store_id', '=', $store[0]->id )
            ->where('consolidated', '=', 1)
            ->where('payed', '=', 0)
            //->where('invoice', '=', 0)
            ->get();
        //dd($debts);
        return view('admin.debt.index', compact('debts'));
    }

    public function invoiceGenerate(Request $request)
    {
        //return $id;
        if (empty($request->cupones_id)) {
            return redirect()->back();
        }
        foreach ($request->cupones_id as $key => $value){

            $coupon =  Coupon::find($key);
            $coupon->invoice =  1;
            $coupon->save();
        } 
        return redirect()->back();
        //return $request->cupones_id;
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }

    
}

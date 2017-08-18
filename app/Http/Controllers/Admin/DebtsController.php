<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
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
        //$debts = Coupon::where('payed', '=', 1)->get();
        $debts = Coupon::whereMonth('created_at', '>=', 1)
            ->whereMonth('created_at', '<=', 8)
            ->where('consolidated', '=', 1)
            ->where('payed', '=', 0)
            //->where('invoice', '=', 0)
            ->whereNull('invoice')
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

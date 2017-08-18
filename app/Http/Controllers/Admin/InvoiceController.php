<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Promotion;
use App\Store;
use App\Coupon;

class InvoiceController extends Controller
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
            ->where('invoice', '=', 1)
            ->get();
        //dd($debts);
        return view('admin.invoice.index', compact('debts'));
        
    }

    public function invoiceGenerate(Request $request)
    {
        //return $id;
        if (empty($request->cupones_id)) {
            return redirect()->back();
        }
       /* foreach ($request->cupones_id as $key => $value){

            $producto_venta_galeria = new producto_venta_galeria();
            $producto_venta_galeria->id_multimedia =  $request->id_image[$key];
            $producto_venta_galeria->id_producto_venta = $id_producto_venta;
            $producto_venta_galeria->save();
        } */
        return $request->cupones_id;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return "pagar";
        dd($request->all());

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

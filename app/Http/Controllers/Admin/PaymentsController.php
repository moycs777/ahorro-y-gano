<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use App\Promotion;
use App\Store;
use App\Coupon;
use App\Commision;
use App\Model\admin\admin;

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
        //return "pagos delegados";
        $delegados = admin::where('level', '=', 2)
            ->where('admin_id', '=', Auth::user()->id )
            ->get();
        //dd($delegados);
        return view('admin.payments.delegates', compact('delegados'));
    }

    public function agentes()
    {
        //return "pagos agentes";
        $agentes = admin::where('level', '=', 3)
            ->where('admin_id', '=', Auth::user()->id )
            ->get();
        //dd($agentes);
        return view('admin.payments.agents', compact('agentes'));
    }

    public function listartienda($id)
    {
        $store = Store::find($id);
        $debts = Coupon::whereMonth('created_at', '>=', 1)
            ->where('store_id', '=', $store->id)
            ->where('consolidated', '=', 1)
            ->orderby('payed', 'desc')
            //->where('invoice', '=', 0)
            ->get();
        //dd($store);
        if ($debts->isEmpty() ) {
            $message = "esta tienda no tiene deudas";
            return view('admin.messages.message', compact('message'));
        }
        return view('admin.payments.listartienda', compact('debts'));
    }

    public function betatiendas()
    {
        //return "beta tiendas";
        $store = Store::all();
        $debts = Coupon::whereMonth('created_at', '>=', 1)
            ->where('consolidated', '=', 1)
            ->orderby('payed', 'desc')
            //->where('invoice', '=', 0)
            ->get();
        //dd($store);
        if ($debts->isEmpty() ) {
            $message = "no hay ningun cobro pendiente";
            return view('admin.messages.message', compact('message'));
        }
        return view('admin.payments.betatiendas', compact('debts'));
    }

    public function listardelegado($id)
    {
        $admin = admin::find($id);
        $commision = Commision::where('admin_id', '=', $id)
            ->orderby('payed', 'desc')
            //->where('invoice', '=', 0)
            ->get();
        //dd($admin);
        if ($commision->isEmpty() ) {

            return view('admin.payments.listardelegado', compact('commision', 'admin'));
            
        }
        return view('admin.payments.listardelegado', compact('commision', 'admin'));
    }
    
    public function listaragente($id)
    {
        $admin = admin::find($id);
        $commision = Commision::where('admin_id', '=', $id)
            ->orderby('payed', 'desc')
            //->where('invoice', '=', 0)
            ->get();
        //dd($commision);
        if ($commision->isEmpty() ) {
            $message = "este agente no posee carga";
            return view('admin.messages.message', compact('message'));
        }
        return view('admin.payments.listaragente', compact('commision', 'admin'));
    }

    public function registrarPagoTienda(Request $request){
        if (empty($request->cupones_id)) {
            return redirect()->back();
        }
        //Registrar el pago de la tienda
        foreach ($request->cupones_id as $key => $value){

            $coupon =  Coupon::find($key);
            $coupon->invoice =  1;
            $coupon->payed =  1;
            $coupon->payed_at = new \DateTime();
            //$coupon->payed_at = Carbon::now()->format('Y-m-d H:i:s');
            $coupon->save();
            //dd($coupon);
            
            //Registrar la comision para el vendedor
            $admin = admin::find($coupon->store->admin_id);
            // Determinar si el vendedor no es administrador
            if ( $admin->level != 1) {

                // Determinar si el vendedor tiene un padre y darle su comision al padre
                $father = admin::where('id', '=', $admin->admin_id )
                    ->get();
                //dd($father);

                if ( $father[0]->id != $admin->id ) {
                    if ($father[0]->level == 2) {
                        # code...
                        $comision = new Commision();  
                        $comision->admin_id = $father[0]->id;
                        $comision->coupon_id = $key;
                        $comision->payed = 0;
                        $comision->price = ($coupon->points * 0.01) * 0.05;
                        $comision->age = 100;
                        $comision->save();
                    }
                }
                /*fin de la comision al padre*/

                /*funcion para aclcular el tiempo*/
                function tiempoTranscurridoFechas($fechaInicio,$fechaFin)
                {
                    $fecha1 = new \DateTime($fechaInicio);
                    $fecha2 = new \DateTime($fechaFin);
                    return $fecha = $fecha1->diff($fecha2);                
                }
                $tiempo = tiempoTranscurridoFechas($admin->created_at,Carbon::now()->format('Y-m-d'));
                $calculo = $tiempo->y;
                //dd($calculo);
               
                if ($calculo < 1)
                    { 
                      // entre 0 y 1 anio 
                      $comision = new Commision();  
                      $comision->admin_id = $admin->id;
                      $comision->coupon_id = $key;
                      $comision->payed = 0;
                      $comision->price = ($coupon->points * 0.01) * 0.2;
                      $comision->age = $calculo;
                      $comision->save();
                      //dd($comision) ;
                    } 
                    elseif (($calculo >= 1) && ($calculo < 2))
                    {
                      //dd($key);
                      //entre 1 y 2
                      $comision = new Commision();  
                      $comision->admin_id = $admin->id;
                      $comision->coupon_id = $key;
                      $comision->payed = 0;
                      $comision->price = ($coupon->points * 0.01) * 0.15;
                      $comision->age = $calculo;
                      $comision->save();
                    } 
                    elseif (($calculo >= 2) && ($calculo < 3))
                    {
                      $comision = new Commision();  
                      $comision->admin_id = $admin->id;
                      $comision->coupon_id = $key;
                      $comision->payed = 0;
                      $comision->price = ($coupon->points * 0.01) * 0.10;
                      $comision->age = $calculo;
                      $comision->save();
                    } 
                    elseif ($calculo >= 3)
                    {
                      $comision = new Commision();  
                      $comision->admin_id = $admin->id;
                      $comision->coupon_id = $key;
                      $comision->payed = 0;
                      $comision->price = ($coupon->points * 0.01) * 0.05;
                      $comision->age = $calculo;
                      $comision->save();
                    }
            // end if Determinar si el vendedor no es administrador 
            }

        // end if
        } 

        return redirect()->back();
        //return $request->cupones_id;
    }

    public function registrarPagoDelegado(Request $request){
        //dd($request->all());
        if (empty($request->cupones_id)) {
            return redirect()->back();
        }
        //Registrar el pago de la tienda
        foreach ($request->cupones_id as $key => $value){

            $comission =  Commision::find($key);
            $comission->payed =  1;
            $comission->updated_at = new \DateTime();
            //$coupon->payed_at = Carbon::now()->format('Y-m-d H:i:s');
            $comission->save();
            
            
        } 

        return redirect()->back();
        //return $request->cupones_id;
    }

    public function registrarPagoAgente(Request $request){
        if (empty($request->cupones_id)) {
            return redirect()->back();
        }
        //Registrar el pago de la tienda
        foreach ($request->cupones_id as $key => $value){

            $comission =  Commision::find($key);
            $comission->payed =  1;
            $comission->updated_at = new \DateTime();
            //$coupon->payed_at = Carbon::now()->format('Y-m-d H:i:s');
            $comission->save();
            
            
        } 

        return redirect()->back();
        //return $request->cupones_id;
    }


    
}

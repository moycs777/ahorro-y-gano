<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\model\admin\admin;
use App\Coupon;
use App\Commision;
use App\Promotion;
use App\Store;

class CommissionsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {

        $commision_sons = [];
        $son = [];
        $admin = admin::find(Auth::user()->id);
        $commision = Commision::where('admin_id', '=', $admin->id)
            ->orderby('payed', 'desc')
            //->where('invoice', '=', 0)
            ->get();
        //dd($admin);
        if ($commision->isEmpty() ) {
            $commision = 0;

            //Determinar si es agente y buscar sus hijo
            if (Auth::user()->level == 2) {
                $hijos = admin::where('admin_id', '=', $admin->id )
                    ->whereNotIn('level',  [5])
                    ->get();
                //dd($hijos);
                if ( $hijos->isEmpty() ) {
                    $commision_sons = 0;
                    //return "no tiene hijos";
                    return view('admin.commission.index', compact('commision', 'admin', 'commision_sons'));
                }

                // buscar las comisiones de sus hijos
                for ($i=0; $i < count( $hijos); $i++) { 
                    
                    $commision_sons[$i] = Commision::where('admin_id', '=', $hijos[$i]->id)
                        ->orderby('payed', 'desc')
                        ->get();
                    $commision_sons[$i]->hijos = $hijos[$i];
                }
                //dd($commision_sons);
                return view('admin.commission.index', compact('commision', 'admin', 'commision_sons'));
            }

            return view('admin.commission.index', compact('commision', 'admin', 'commision_sons'));
            return "este usuario no posee deuda";
            dd($commision);
        }

        if (Auth::user()->level == 3) {
            $commision_sons = 0;
            return view('admin.commission.index', compact('commision', 'admin', 'commision_sons'));
        }

        //Determinar si es agente y buscar sus hijo
        if (Auth::user()->level == 2) {
            $hijos = admin::where('admin_id', '=', $admin->id )
                ->whereNotIn('level',  [5])
                ->get();

            if ( $hijos->isEmpty() ) {
                $commision_sons = 0;
                return view('admin.commission.index', compact('commision', 'admin', 'commision_sons'));
            }

            // buscar las comisiones de sus hijos
            for ($i=0; $i < count( $hijos); $i++) { 
                
                $commision_sons[$i] = Commision::where('admin_id', '=', $hijos[$i]->id)
                    ->orderby('payed', 'desc')
                    ->get();
                $commision_sons[$i]->hijos = $hijos[$i];
            }
                dd($commision_sons);
            
            return view('admin.commission.index', compact('commision', 'admin', 'commision_sons'));
        }

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

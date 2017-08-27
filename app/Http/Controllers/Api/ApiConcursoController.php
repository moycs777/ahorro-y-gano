<?php

namespace App\Http\Controllers\Api;

use App\Competition;
use App\Ranking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ApiConcursoController extends Controller
{
    public function index() {
    	$competition = Competition::where('active', '=', 1)->first();
    	
    	if (!$competition == null) {
    	    $goal = $competition->goal;
    	    $inicio = $competition->created_at;
    	    
    	    $cupones = DB::table('coupons')
    	        ->where('consolidated', 1)
    	        ->where('created_at', '>=', $inicio)
    	        ->get();
    	    $maxi = 0;            
    	    foreach ($cupones as $item) {
    	        $maxi += $item->points;
    	    }
    	    $ganadores = DB::select('select user_id,count(*),sum(points)
    	             from coupons where created_at >= "' .$inicio. '" 
    	             and consolidated = 1 
    	             group by user_id' ); 
    	    
            return ['r' => 'y', 'datos' => $competition];
        }
        
    }

    public function ranking(){
        $concurso = Competition::where('active', '=', 1)->first();
        if ( empty($concurso) ) {
            return "no hay concurso activo";
            # code...
        }
        $concurso->puntos = DB::select('select sum(points) as sum from ayg.coupons where created_at >= 2017-08-07 and ayg.coupons.consolidated = 1');

        $ganadores = Ranking::where('competition_id', '=', $concurso->id)
            ->orderBy('sum', 'desc')
            ->take(10)
            ->get();

        $datos = array('concurso' => $concurso,
                  'ganadores' => $ganadores); 
        
        return ['r' => 'y', 'datos' => $datos ];
       
        
        
    }

    public function mostrarBeneficiaro(){
        return view('user.concurso.beneficiario');
    }

    public function busquedaBeneficiaro( Request $request ){
            return $request->all();
            /*$categoriasAll = CategoriasProductos::all();
            $buscar = \Request::get('buscar');
            //  dd($buscar);
            $alerta = false;
            $calificacion = 0;
            $productos = ProductoVenta::where('titulo','like','%'.$buscar.'%')->orderBy('id')->paginate(10);
            if ($productos->isEmpty()) {
                $alerta = true;
            }
            foreach ($productos as $producto) {
                //print_r($producto->id);
                $producto->imagen = DB::select('select a.id_producto_venta, b.ruta,
                    (select c.titulo from producto_venta c where c.id = a.id_producto_venta limit 1 )
                    from producto_venta_galeria a, multimedia b 
                    where a.id_multimedia = b.id 
                    and a.id_producto_venta = ' . $producto->id  );
                $productos_calificacion = DB::select('select coalesce(round( avg(estrellas),0)) promedio from calificacion where id_producto_venta = '  . $producto->id );
                $producto->calificacion = intval($productos_calificacion[0]->promedio);  
            }
            //dd($productos);
            $sub_cat = [];
            $categorias_index = DB::select('select * from categoria_producto where id_categoria_padre = 0');
            $sub_cat = DB::select('select * from categoria_producto where id_categoria_padre != 0');
            return view ('pages.resultado')
                ->with('alerta', $alerta)
                ->with('categoriasAll',$categoriasAll)
                ->with('categorias_index',$categorias_index)
                ->with('sub_cat', $sub_cat)
                ->with('productos', $productos);                  
            
        
    */
    }
}

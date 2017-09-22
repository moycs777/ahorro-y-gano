<?php

namespace App\Http\Controllers\Api;

use App\Competition;
use App\Ranking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ApiConcursoController extends Controller
{
    public function concurso() {
    	$competition = Competition::where('active', '=', 1)->get();
    	
    	if (!$competition == null) {
    	    
    	    
            return ['r' => 'y',  'datos' => $competition];
        }else{
            return ['r' => 'n'];

        }
        
    }

    public function ranking(){
       
        $concurso = Competition::where('active', '=', 1)->first();
        if ( empty($concurso) ) {
            return ['r' => 'n'];
            # code...
        }
        $concurso->puntos = DB::select('select sum(points) as sum from ayg.coupons where created_at >= 2017-08-07 and ayg.coupons.consolidated = 1');

        $ganadores = Ranking::where('competition_id', '=', $concurso->id)
            ->orderBy('sum', 'desc')
            ->take(10)
            ->get();
        foreach ($ganadores as $ganador) {
           $ganador->user->name;
        }

        /*$datos = array('concurso' => $concurso,
                  'ganadores' => $ganadores); */
        
        return ['r' => 'y', 'datos' => $ganadores ];

        
    }

    public function busquedaBeneficiaro( Request $request ){
        return $request->all();
        $buscar = $request->buscar;
        $alerta = false;
        $calificacion = 0;
        $usuarios = User::where('email','like','%'.$buscar.'%')
            ->orderBy('id')
            ->paginate(10);
        //sin encontramos buscamos datos de esos usuarios
        if (!$usuarios->isEmpty()) {
            $alerta = true;
            
            foreach ($usuarios as $item) {
                $item->points = 10;
            }
        }

        $sum = Ranking::where('user_id', '=',  Auth::user()->id)
                ->first();
        //si el regalador no tiene puntos no podra realizar la busqueda
        if (!$sum or $sum->sum <=0) {
           return "no tienes puntos q regalar";
        }
        //dd($sum);
        return view ('user.concurso.resultado', compact('alerta', 'usuarios', 'sum'));
    }

    public function regalar( Request $request ){
        //dd($request->all());
        //buscamos cual es el concurso activo
        $competition = Competition::where('active', '=', 1)->first();
        if (!$competition) {
            return "no hay concurso activo para regalar puntos";
        }

        //verificamos la cantidad de puntos maxima q dispone en q regala
        $sum = Ranking::where('user_id', '=',  Auth::user()->id)
                    ->first();
        if ($request->points <= $sum->sum) {
            //registramos la suma en la tabla ranking en el registro correspondiente al receptor
            //verificamos si tiene cupones ya activados
            $ranking = Ranking::where('user_id', '=', $request->receptor_id)
                    ->where('competition_id', '=', $competition->id)
                    ->first();

            if ($ranking) {
                $ranking->sum += $request->points;
                $ranking->save();
                
            }elseif (!$ranking) {
                return "aun no le puedes regalar porq el beneficiario no a descargado cupones";
                $ranking = new Ranking();
                $ranking->user_id = $coupon->user_id;
                $ranking->competition_id = $competition->id;
                $ranking->sum = $coupon->points;
                $ranking->save();
            }

            
            //registramos que usuario le raglo a quien y en que concurso, en la tabla tradings
            $trading = Trading::where('receptor_id', '=', $request->receptor_id)
                    ->where('competition_id', '=', $competition->id)
                    ->first();

            if ($trading) {
                return "el beneficiario ya ha recibido ayuda de alguien mas";
            }elseif (!$trading) {
                $trading = new Trading();
                $trading->user_id = Auth::user()->id;
                $trading->competition_id = $competition->id;
                $trading->receptor_id = $request->receptor_id;
                $trading->points = $request->points;
                $trading->save();
            }

            //restamos los puntos al que regala
            $regalador = Ranking::where('user_id', '=',  Auth::user()->id)
                        ->first();
            $regalador->sum -= $request->points;
            $regalador->save();

            //mostramos la tabla de puntuacion
            //return $trading;
            $this->ranking();
        }else{
            return "error";
        }
        
    }

}

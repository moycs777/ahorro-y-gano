<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Coupon;
use App\Competition;
use App\Ranking;
use App\Trading;
use App\Model\user\User;

use Carbon\Carbon;
use DateTime;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserConcursoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth' , ['except' =>
            [
                'index',
                'ranking'                
            ]
        ]);
    }

    public function index() {
    	$competition = Competition::where('active', '=', 1)->first();
    	
    	if (!$competition == null) {
    	    $goal = $competition->goal;
    	    $inicio = $competition->created_at;
    	    //dd($goal);
    	    //dd($inicio);
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
    	        
    	    //dd($competition);
    	    //return redirect()->back();
    		return view('user.concurso.index', compact('competition'));
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
            ->take(100)
            ->get();
        return view( 'user.concurso.ranking', compact('concurso', 'ganadores') );
    }

    public function mostrarBeneficiaro(){
        return view('user.concurso.beneficiario');
    }

    public function busquedaBeneficiaro( Request $request ){
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

<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Coupon;
use App\Competition;
use App\Ranking;
use App\RankingHijo;
use App\Trading;
use App\State;
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
                'ranking',
                'buscarCiudades'                
            ]
        ]);
    }

    public function buscarCiudades($id)
    {   
        
        $states = State::all();
        $categoria_hijo = "asd";
        return $id;
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

            $puntos_normales = Ranking::where('competition_id', '=', $competition->id)
                ->get();
            $puntos_referidos = [];

            //dd($puntos_normales);

            /*for ($i=0; $i < count($puntos_normales); $i++) { 
                $puntos_referidos[$i] = RankingHijo::where('user_id', '=', $puntos_normales[$i]->user_id)
                    ->where('active', '=', 1)
                    ->get();
                # code...
            }*/
            for ($i=0; $i < count($puntos_normales); $i++) { 
                $puntos_referidos[$i] = DB::select('select user_id,count(*),sum(points) as points
                     from ranking_hijos where user_id = "' .$puntos_normales[$i]->user_id. '" 
                     and active = 1 
                     group by user_id' );
                
            }
            //dd($puntos_referidos);
            
            for ($i=0; $i < count($puntos_normales); $i++) { 
                
                for ($x=0; $x < count($puntos_referidos[$i]) ; $x++) { 
                    if (isset($puntos_referidos[$i][$x])) {
                        //dd($puntos_normales);
                        if ($puntos_normales[$i]->user_id == $puntos_referidos[$i][$x]->user_id) {
                            $puntos_normales[$i]->sum += $puntos_referidos[$i][$x]->points;
                        }
                    }
                }    


            }

            //dd($puntos_normales);

    		return view('user.concurso.index', compact('competition', 'puntos_normales'));
        }
        $mensaje = "no hay concurso creado aun";
        return view('user.messagges.message', compact('mensaje'));
        
    }

    public function ranking(){
        $concurso = Competition::where('active', '=', 1)->first();
        if ( empty($concurso) ) {
            $mensaje = "no hay concurso activo";
            return view('user.messagges.message', compact('mensaje'));
            # code...
        }
        //dd($concurso->created_at);
        $concurso->puntos = DB::select('select sum(points) as sum from ayg.coupons where created_at >= "' .$concurso->created_at. '" 
            and ayg.coupons.consolidated = 1');

        $ganadores = Ranking::where('competition_id', '=', $concurso->id)
            ->orderBy('sum', 'desc')
            ->take(100)
            ->get();

        $puntos_normales = Ranking::where('competition_id', '=', $concurso->id)
            ->get();
        $puntos_referidos = [];

        for ($i=0; $i < count($puntos_normales); $i++) { 
            $puntos_referidos[$i] = DB::select('select user_id,count(*),sum(points) as points
                 from ranking_hijos where user_id = "' .$puntos_normales[$i]->user_id. '" 
                 and active = 1 
                 group by user_id' );
            
        }
        //dd($puntos_referidos);
        
        for ($i=0; $i < count($puntos_normales); $i++) { 
            
            for ($x=0; $x < count($puntos_referidos[$i]) ; $x++) { 
                if (isset($puntos_referidos[$i][$x])) {
                    //dd($puntos_normales);
                    if ($puntos_normales[$i]->user_id == $puntos_referidos[$i][$x]->user_id) {
                        $puntos_normales[$i]->sum += $puntos_referidos[$i][$x]->points;
                    }
                }
            }    


        }
        return view( 'user.concurso.ranking', compact('concurso', 'ganadores', 'puntos_normales') );
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
            //->whereNotIn('email', 'like', '%'. Auth::user()->email . '%')
            ->paginate(10);
        //si encontramos buscamos datos de esos usuarios
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
            $mensaje = "no tienes puntos q regalar";
            return view('user.messagges.message', compact('mensaje'));
        }
        //dd($sum);
        return view ('user.concurso.resultado', compact('alerta', 'usuarios', 'sum'));
    }

    public function regalar( Request $request ){
        //dd($request->all());
        //buscamos cual es el concurso activo
        $competition = Competition::where('active', '=', 1)->first();
        if (!$competition) {
            $mensaje = "no hay concurso activo para regalar puntos";
            return view('user.messagges.message', compact('mensaje'));
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
                $mensaje = "aun no le puedes regalar porq el beneficiario no a descargado cupones";
                return view('user.messagges.message', compact('mensaje'));
                
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
                $mensaje = "el beneficiario ya ha recibido ayuda de alguien mas";
                return view('user.messagges.message', compact('mensaje'));
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

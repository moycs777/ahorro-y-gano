<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Coupon;
use App\Store;
use App\Competition;
use App\Gift;
use App\Ranking;
use App\RankingHijo;
use App\Reffer;
use App\Winner;
use App\Model\user\User;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CouponController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    
    public function index()
    {
        $store = Store::where('auth_id', '=', Auth::user()->id )->get();    
        //dd($store[0]);
        $coupon = Coupon::where('store_id', '=', $store[0]->id)->get();
        return view('admin.coupon.index', compact('coupon'));
    }

    // La funcion original esta en CouponControllerOLD.php
    public function reclaim(Request $request )
    {
        // asignacion del cupon actual
        $coupon = Coupon::find($request->coupon_id);
        $coupon->consolidated = 1;
        $coupon->points = $request->points;
        $coupon->save();
        
        // verificar si hay competicion, ver en la tabla coupon si ya se alcanzo el goal de la competicion
        $competition = Competition::where('active', '=', 1)->first();
        
        // Inicio del condifcional IF  --  hay concurso activo
        if (!$competition == null) {
            $goal = $competition->goal;
            $dead_line = $competition->dead_line;
            $inicio = $competition->created_at;
            //$puntos_hijo = 0;

            // Verificar y activar mis puntos de referidos en caso q esta sea mi primera compra
            $usuario_actual = Ranking::where('user_id', '=', $coupon->user_id )
                ->where('competition_id', '=', $competition->id)
                ->first();
            
            if ($usuario_actual == null) {
                
                RankingHijo::where('user_id', '=', $coupon->user_id)
                    ->where('competition_id', '=', $competition->id)
                    ->update(array('active' => 1));
            }

            //Aqui registramos y actualizamos la tabla de ranking
            $ranking = Ranking::where('user_id', '=', $coupon->user_id)
                ->where('competition_id', '=', $competition->id)
                ->first();

            if ($ranking) {
                $ranking->user_id = $coupon->user_id;
                $ranking->competition_id = $competition->id;
                $ranking->sum += $coupon->points;
                $ranking->save();
                //$puntos_hijo = $ranking->sum;
            }elseif (!$ranking) {
                $ranking = new Ranking();
                $ranking->user_id = $coupon->user_id;
                $ranking->competition_id = $competition->id;
                $ranking->sum = $coupon->points;
                $ranking->save();
                //$puntos_hijo = $ranking->sum;                
            }
            
            //1. verificamos cuantos referidos tiene el padre 
            $father = Reffer::where('reffered_id', '=', $coupon->user_id)->first();
            $reffers = Reffer::where('user_id', '=', $father->user_id)->count();
            //si el padre tiene cupon activo en el concurso actual para darle los puntos que le correspondan
            $is_in_competition = Ranking::where('user_id', '=', $father->user_id)
                ->where('competition_id', '=', $competition->id)
                ->first();
            $estatus_padre = 0;
            // si el Padre tiene compras lo activamos 
            if (! $is_in_competition == null) {
                $estatus_padre = 1; 
            }
            // Determinar los puntos del padre
            //determinar el numero de referidos q tiene el padre
            if ($reffers < 10)
                {    
                  $points = $coupon->points * 0.60;
                } 
                elseif (($reffers >= 10) && ($reffers < 20))
                {
                  $points = $coupon->points * 0.70;
                } 
                elseif (($reffers >= 20) && ($reffers < 30))
                {
                  $points = $coupon->points * 0.80;
                } 
                elseif ($reffers >= 30)
                {
                   $points = $coupon->points * 0.90;
                }
            
            //Aqui registramos y actualizamos la tabla de ranking
            $ranking_hijo = RankingHijo::where('user_id', '=', $father->user_id )
                ->where('son_id', '=', $coupon->user_id)
                ->where('competition_id', '=', $competition->id)
                ->first();
            

            if ($ranking_hijo) {
                $ranking_hijo->points += $points;
                $ranking_hijo->active = $estatus_padre;
                $ranking_hijo->save();
            }elseif (!$ranking_hijo) {
                $ranking_hijo = new RankingHijo();
                $ranking_hijo->user_id = $father->user_id;
                $ranking_hijo->son_id = $coupon->user_id;
                $ranking_hijo->competition_id = $competition->id;
                $ranking_hijo->points = $points;
                $ranking_hijo->active = $estatus_padre;
                $ranking_hijo->save();
            }

            //dd($ranking_hijo);
            /*$gift = Gift::where('user_id', '=',  $father->user_id) 
                ->where('competition_id', '=', $competition->id)
                ->first();

            if ($gift) {                   
                $gift->sum += $points;
                $gift->save();
            }elseif (!$gift){
                $gift = new Gift();
                $gift->user_id = $father->user_id;
                $gift->competition_id = $competition->id;
                $gift->sum += $points;
                $gift->save();

            }*/

            //terminar el concurso por fecha limite
            $dt =Carbon::now()->format('Y-m-d');
            if ( $dt >= $dead_line) {
                //return "termino el cocnurso por limite de fecha";
            }
            
            //Buscamos los cupones activados y que pertenescan a el cocnurso actual

            $cupones = DB::table('coupons')
                ->where('consolidated', 1)
                ->where('created_at', '>=', $inicio)
                ->get();
            $maxi = 0;            
            foreach ($cupones as $item) {
                $maxi += $item->points;
            }
            if ($maxi <= intval( $goal ) ) {
                 return redirect()->back();
            }

            //Cuando ya hay ganador
            if ($maxi >= intval( $goal ) ) {
                //return "ganador";
                $ganadores = DB::select('select user_id,count(*),sum(points) as sum
                     from coupons where created_at >= "' .$inicio. '" 
                     and consolidated = 1 
                     group by user_id' ); 
                //damos por finalizado el concurso
                $competition->active = 0;
                $competition->ended = 1;
                $competition->save();

                // Buscamos el que sera el proximo concurso
                $next_competition = Competition::where('active', '=', 0)
                    ->where('ended', '=', 0)
                    ->first();
                    //dd($next_competition);
                    if (!$next_competition == null) {
                        $next_competition->active = 1;
                        $next_competition->ended = 0;
                        $next_competition->save();
                    }
                
                foreach ($ganadores as $ganador) {
                    $winners = new Winner();
                    $winners->user_id = $ganadores[0]->user_id;
                    $winners->competition_id = $competition->id;
                    $winners->score = $ganadores[0]->sum;
                    $winners->save();                    
                }
            }    
                   
            return redirect()->route('competition.index');

        
        }//fin del conicional
        
        return redirect()->back();

    }

    
    public function create()
    {
        return view('admin.coupon.create');
    }

    
    public function store(Request $request)
    {
        $this->validate($request, ['store_id' => 'required', 'promotion_id' => 'required', 'user_id' => 'required', 'consolidated' => 'required', 'payed' => 'required', ]);

        Coupon::create($request->all());

        Session::flash('message', 'Coupon added!');
        Session::flash('status', 'success');

        return redirect('admin/coupon');
    }

    
    public function show($id)
    {
        $coupon = Coupon::findOrFail($id);

        return view('admin.coupon.show', compact('coupon'));
    }

    
    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);

        return view('admin.coupon.edit', compact('coupon'));
    }

   
    public function update($id, Request $request)
    {
        $this->validate($request, ['store_id' => 'required', 'promotion_id' => 'required', 'user_id' => 'required', 'consolidated' => 'required', 'payed' => 'required', ]);

        $coupon = Coupon::findOrFail($id);
        $coupon->update($request->all());

        Session::flash('message', 'Coupon updated!');
        Session::flash('status', 'success');

        return redirect('admin/coupon');
    }

    
    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);

        $coupon->delete();

        Session::flash('message', 'Coupon deleted!');
        Session::flash('status', 'success');

        return redirect('admin/coupon');
    }

}

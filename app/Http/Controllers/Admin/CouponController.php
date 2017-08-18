<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Coupon;
use App\Competition;
use App\Ranking;
use App\Winner;
use App\Model\user;

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
        
        $coupon = Coupon::all();
        return view('admin.coupon.index', compact('coupon'));
    }

    public function reclaim(Request $request )
    {
        //dd($request->all());
        $coupon = Coupon::find($request->coupon_id);
        $coupon->consolidated = 1;
        $coupon->points = $request->points;
        $coupon->save();
        
        // verificar si hay competicion, ver en la tabla coupon si ya se alcanzo el goal de la competicion
        $competition = Competition::where('active', '=', 1)->first();
        
        if (!$competition == null) {
            $goal = $competition->goal;
            $inicio = $competition->created_at;
            //dd($goal);
            //dd($inicio);

            //Aqui registramos y actualizamos la tabla de ranking
            $ranking = Ranking::where('user_id', '=', $coupon->user_id)
                ->where('competition_id', '=', $competition->id)
                ->first();

            if ($ranking) {
                $ranking->user_id = $coupon->user_id;
                $ranking->competition_id = $competition->id;
                $ranking->sum += $coupon->points;
                $ranking->save();
            }elseif (!$ranking) {
                $ranking = new Ranking();
                $ranking->user_id = $coupon->user_id;
                $ranking->competition_id = $competition->id;
                $ranking->sum = $coupon->points;
                $ranking->save();
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
                 //return "no " . $maxi . " meta: " . $goal;
            }


            if ($maxi >= intval( $goal ) ) {
                //return "ganador";
                $ganadores = DB::select('select user_id,count(*),sum(points) as sum
                     from coupons where created_at >= "' .$inicio. '" 
                     and consolidated = 1 
                     group by user_id' ); 
                //damos por finalizado el concurso
                $competition->active = 0;
                $competition->save();
                
                foreach ($ganadores as $ganador) {
                    $winners = new Winner();
                    $winners->user_id = $ganadores[0]->user_id;
                    $winners->competition_id = $competition->id;
                    $winners->score = $ganadores[0]->sum;
                    $winners->save();
                    
                }

            }           
            return redirect()->route('competition.index');

        //fin del conicional
        }
        
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

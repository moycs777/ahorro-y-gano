<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Competition;
use App\Coupon;
use App\Ranking;
use App\Winner;

use Carbon\Carbon;
use DateTime;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CompetitionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        //$debts = Coupon::where('payed', '=', 1)->get();
        $competitions = Competition::all();
        //dd($competitions);
        /* $puntos = db::raw('');*/
        $activa = Competition::where('active', '=', 1)->first();
        if ( empty($activa) ) {
            //return view('admin.competition.index');
            $activa = 0;
            return view('admin.competition.index', compact('competitions', 'activa'));
        }
        $activa->puntos = DB::select('select sum(points) as sum from ayg.coupons where created_at >= "' .$activa->created_at. '" and ayg.coupons.consolidated = 1');
        //dd($activa);
        return view('admin.competition.index', compact('competitions', 'activa'));

    }

    public function create()
    {
        return view('admin.competition.create');

    }

    public function ranking()
    {

        $concurso = Competition::where('active', '=', 1)->first();
        if ( empty($concurso) ) {
            return "no hay concurso activo";
            # code...
        }
        $concurso->puntos = DB::select('select sum(points) as sum from ayg.coupons where created_at >= 2017-08-07 and ayg.coupons.consolidated = 1');

        $ganadores = Ranking::where('competition_id', '=', $concurso->id)
            ->orderBy('sum', 'asc')
            ->get();
        //dd($ganadores);
        return view( 'admin.competition.ranking', compact('concurso', 'ganadores') );

    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'goal' => 'required',
            'reward' => 'required',
            
            ]);
        $competitions = Competition::all();
        /* $puntos = db::raw('');*/
        $activa = Competition::where('active', '=', 1)->first();
        if (empty($activa)) {

            $concurso = new Competition;
            $concurso->name = $request->name;
            $concurso->goal = $request->goal;
            $concurso->reward = $request->reward;
            $concurso->active = 1;
            $concurso->save();

            Session::flash('message', 'Coupon added!');
            Session::flash('status', 'success');

            return redirect('admin/competition');
        }else{
            return redirect('admin/competition');
        }

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

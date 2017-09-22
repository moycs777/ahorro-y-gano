<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Model\user\category;
use App\Promotion;
use App\Policie;
use App\Model\user\tag;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Coupon;
use App\Competition;
use App\Ranking;
use App\RankingHijo;
use App\Trading;
use App\State;
use App\Model\user\User;

use DateTime;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /*public function index()
    {
        $posts = post::where('status',1)->orderBy('created_at','DESC')->paginate(5);
        return view('user.blog',compact('posts'));
    }*/
    public function index()
    {
        $dt = Carbon::now()->format('Y-m-d');
        $ofertas = Promotion::where('id', '>=', 1)
            ->where('expires', '<=', $dt )
            ->orderBy('created_at','DESC')
            ->paginate(5);
        return view('user.index',compact('ofertas'));
    }

    public function politicas()
    {
        $policies = Policie::where('use', 'like', 'politicas')->get();
        return view('user.politicas', compact('policies'));
    }

    public function perfil()
    {
        $concurso = Competition::where('active', '=', 1)->first();
        if ( empty($concurso) ) {
            $mensaje = "no hay concurso activo";
            
        }
        //dd($concurso->created_at);
        $concurso->puntos = DB::select('select sum(points) as sum from ayg.coupons where created_at >= "' .$concurso->created_at. '" 
            and ayg.coupons.consolidated = 1');


        $puntos_normales = Ranking::where('competition_id', '=', $concurso->id)
            ->where('user_id', '=', Auth::user()->id)
            ->get();
        if ($puntos_normales->count() < 1) {
            //return "nada";
            $puntos_normales = 0;
            return view( 'user.profile.profile', compact('concurso', 'puntos_normales', 'puntos_referidos') );
            //logica para ver puntos pendientes de sus referidos
        }
        //dd( $puntos_normales->count());
        $puntos_referidos = DB::select('select user_id,count(*),sum(points) as points
             from ranking_hijos where user_id = "' .$puntos_normales[0]->user_id. '" 
             and active = 1 
             group by user_id' );               
        
            
        return view( 'user.profile.profile', compact('concurso', 'puntos_normales', 'puntos_referidos') );
    }
    /*public function tag(tag $tag)
    {
        $posts = $tag->posts();
        return view('user.blog',compact('posts'));
    }

    public function category(category $category)
    {
        $posts = $category->posts();
        return view('user.blog',compact('posts'));
    }*/
}

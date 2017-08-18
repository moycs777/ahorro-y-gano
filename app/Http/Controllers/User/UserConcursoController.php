<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Coupon;
use App\Competition;
use App\Model\user;

use Carbon\Carbon;
use DateTime;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserConcursoController extends Controller
{
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
}

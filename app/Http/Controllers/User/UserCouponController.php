<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Coupon;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Auth;

class UserCouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $coupons = Coupon::where('user_id', '=', Auth::user()->id )->get();
        //dd($coupons);
        return view('user.coupon.index',compact('coupons'));
        
    }
   
    public function create()
    {

    }

    public function store(Request $request)
    {
        $data = (json_decode($request->promotion, true));
        $coupon = new Coupon();
        $coupon->store_id = $data['store_id']; 
        $coupon->promotion_id = $data['id']; 
        $coupon->user_id = Auth::user()->id; 
        $coupon->consolidated = 0; 
        $coupon->payed = 0; 
        $coupon->points = $data['points']; 
        $coupon->save();
        //return $data;
        //return redirect()->route('usercoupon.index ');
        return redirect('user/usercoupon');
    }

    
    public function show($id)
    {
        //
    }

    
}

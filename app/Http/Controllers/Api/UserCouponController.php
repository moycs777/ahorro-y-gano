<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Coupon;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Auth;

class UserCouponController extends Controller
{
    
    public function index()
    {
        $coupons = Coupon::all();
        //$coupons = Coupon::where('user_id', '=', Auth::user()->id )->get();
        //dd($coupons);
        return ['r' => 'y', 'datos' => $coupons];
    }
    
    public function lista($id)
    {
        $coupons = Coupon::where('user_id', '=', $id)->get();
        foreach ($coupons as $coupon) {
            $coupon->imagen = $coupon->promotion->picture;
            $coupon->tienda = $coupon->store->name;
            $coupon->promocion = $coupon->promotion->name;
        }
        return ['r' => 'y', 'datos' => $coupons];
    }
    
    public function create()
    {
        
    }
    
    public function store($item)
    {

        $data = (json_decode($item, true));
        $coupon = new Coupon();

        $coupon->store_id = $data['store_id']; 
        $coupon->promotion_id = $data['id']; 
        $coupon->user_id = 1; 
        $coupon->consolidated = 0; 
        $coupon->payed = 0; 
        $coupon->points = $data['points']; 
        $coupon->save();

        return ['r' => 'y', 'datos' => $coupon];
    }

    public function storeCoupon()
    {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        //dd($postdata);
        //return $postdata;
        
        $coupon = new Coupon();

        $coupon->store_id = $request->store_id; 
        $coupon->promotion_id = $request->id; 
        $coupon->user_id =  $request->user_id; 
        $coupon->consolidated = 0; 
        $coupon->payed = 0; 
        $coupon->points = $request->points; 
        $coupon->save();

        return ['r' => 'y', 'datos' => $coupon];
    }
   
    public function show($id)
    {
        
    }

    public function edit($id)
    {
        
    }

    public function update(Request $request, $id)
    {
        
    }

   
    public function destroy($id)
    {
        
    }
}

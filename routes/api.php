<?php

use Illuminate\Http\Request;

// Api routes for mobile app


Route::group(['middleware' => 'cors'], function(){
	
	// rutas para autenticacion
	Route::get('/home', 'Api\IndexController@index');
	
	Route::post('login', 'Api\IndexController@login');

	Route::post('register', 'Api\IndexController@register');

	//Route::resource('coupon','Api\UserCouponController');
	Route::get('coupons/{id}','Api\UserCouponController@lista');
	Route::post('couponStore','Api\UserCouponController@storeCoupon');

	Route::group(['prefix' => 'promotion'], function(){
		Route::resource('', 'Api\PromotionController', ['only' => [
		    'index', 'create', 'show', 'update', 'store'
		]]);
	});

});



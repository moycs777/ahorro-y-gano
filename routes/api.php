<?php

use Illuminate\Http\Request;

// Api routes for mobile app


Route::group(['middleware' => 'cors'], function(){
	
	// rutas para autenticacion
	Route::get('/home', 'Api\IndexController@index');
	
	Route::post('login', 'Api\IndexController@login');

	Route::post('register', 'Api\IndexController@register');

	//CUpones
	Route::get('coupons/{id}','Api\ApiCouponController@lista');
	Route::post('couponStore','Api\ApiCouponController@storeCoupon');
	
	//COncurso, ranking y busqueda
	
	Route::get('concurso','Api\ApiConcursoController@index');
	Route::get('ranking','Api\ApiConcursoController@ranking');
	Route::get('beneficiario','ApiConcursoController@mostrarBeneficiaro');
	Route::get('busqueda', 'ApiConcursoController@busquedaBeneficiaro');

	
});



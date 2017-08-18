<?php

// Store, Promotion Routes, Clasification
Route::group(['middleware' => ['web']], function () {
	Route::resource('admin/store', 'Admin\StoreController');	
	
	Route::resource('admin/clasification', 'Admin\ClasificationController');
	
	Route::resource('admin/coupon', 'Admin\CouponController');
	
	Route::resource('admin/commission', 'Admin\CommissionsController');
	
	Route::resource('admin/competition', 'Admin\CompetitionController');
	Route::get('admin/ranking', 'Admin\CompetitionController@ranking')->name('ranking');
	
	Route::post('admin/cupon/reclaim', 'Admin\CouponController@reclaim')->name('cupon.reclaim');
	
	Route::resource('admin/debt', 'Admin\DebtsController');
	
	Route::resource('admin/store', 'Admin\StoreController');
	
	Route::post('admin/invoice/generate', 'Admin\DebtsController@invoiceGenerate')->name('invoice.generate');
	
	Route::resource('admin/invoice', 'Admin\InvoiceController');
	
	Route::get('admin/pagos/delegados', 'Admin\PaymentsController@delegados')->name('pagos.delegados');
	
	Route::resource('admin/payment', 'Admin\PaymentsController');
	
	Route::resource('admin/promotion', 'Admin\PromotionController');
	
	Route::get('admin/pagos/tiendas', 'Admin\PaymentsController@tiendas')->name('pagos.tiendas');
});

//Admin Routes
Route::group(['namespace' => 'Admin'],function(){
	Route::get('admin/home','HomeController@index')->name('admin.home');
	// Users Routes
	Route::resource('admin/user','UserController');
	// Post Routes
	Route::resource('admin/post','PostController');
	// Tag Routes
	Route::resource('admin/tag','TagController');
	// Category Routes
	Route::resource('admin/category','CategoryController');
	// Admin Auth Routes
	Route::get('admin-login', 'Auth\LoginController@showLoginForm')->name('admin.login');
	Route::post('admin-login', 'Auth\LoginController@login');
	
	
	// Stores controller
});

// User Routes
Route::group(['namespace' => 'User'],function(){
	Route::get('/','HomeController@index')->name('raiz');
	Route::resource('user/usercoupon','UserCouponController');
	Route::get('user/concurso','UserConcursoController@index')->name('user.concurso');

	Route::get('post/{post}','PostController@post')->name('post');
	Route::get('post/tag/{tag}','HomeController@tag')->name('tag');
	Route::get('post/category/{category}','HomeController@category')->name('category');
});

Route::get('/home', 'HomeController@index')->name('home');

// 404
Route::get('pagenotfound', ['as' => 'notfound', 'uses' => 'HomeController@pagenotfound']);

Auth::routes();
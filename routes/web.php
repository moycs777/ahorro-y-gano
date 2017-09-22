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
	
	Route::resource('admin/promotion', 'Admin\PromotionController');
	
	Route::resource('admin/policies', 'Admin\PoliciesController');
	
	Route::resource('admin/payment', 'Admin\PaymentsController');
	
	Route::get('admin/pagos/betatiendas', 'Admin\PaymentsController@betatiendas')->name('beta.pagos.tiendas');
	
	Route::get('admin/pagos/tiendas', 'Admin\PaymentsController@tiendas')->name('pagos.tiendas');
	Route::get('admin/pagos/delegados', 'Admin\PaymentsController@delegados')->name('pagos.delegados');
	Route::get('admin/pagos/agentes', 'Admin\PaymentsController@agentes')->name('pagos.agentes');
	
	Route::get('admin/pagos/tiendas{id}', 'Admin\PaymentsController@listartienda')->name('listar.tienda');
	Route::get('admin/pagos/delegado{id}', 'Admin\PaymentsController@listardelegado')->name('listar.delegado');
	Route::get('admin/pagos/agente{id}', 'Admin\PaymentsController@listaragente')->name('listar.agente');
	
	Route::post('admin/pagos/tiendas', 'Admin\PaymentsController@registrarPagoTienda')->name('registrar.pago.tienda');
	Route::post('admin/pagos/delegados', 'Admin\PaymentsController@registrarPagoDelegado')->name('registrar.pago.delegado');
	Route::post('admin/pagos/agente', 'Admin\PaymentsController@registrarPagoAgente')->name('registrar.pago.agente');

	Route::get('admin/pagos/comerciales', 'Admin\PaymentsController@comerciales')->name('pagos.comerciales');

	Route::get('admin/clientes/index', 'Admin\UserController@clientes')->name('clientes.index');
});

//Admin Routes
Route::group(['namespace' => 'Admin'],function(){
	Route::get('admin/home','HomeController@index')->name('admin.home');
	// Users Routes
	Route::resource('admin/user','UserController');
	// Post Routes
	//Route::resource('admin/post','PostController');
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
	Route::get('user/ranking','UserConcursoController@ranking')->name('user.ranking');
	Route::get('user/beneficiario','UserConcursoController@mostrarBeneficiaro')->name('user.beneficiario');
	Route::get('user/busqueda', 'UserConcursoController@busquedaBeneficiaro')->name('busqueda');
	Route::post('user/regalar', 'UserConcursoController@regalar')->name('regalar');
	Route::get('user/perfil', 'HomeController@perfil')->name('user.profile');

	//Route::get('post/{post}','PostController@post')->name('post');
	Route::get('post/tag/{tag}','HomeController@tag')->name('tag');
	Route::get('post/category/{category}','HomeController@category')->name('category');
	
	Route::get('buscarCiudades/{id}', 'UserConcursoController@buscarCiudades');
	
	Route::get('user/politicas', 'HomeController@politicas')->name('politicas');
});

Route::get('/home', 'HomeController@index')->name('home');
// 404
Route::get('pagenotfound', ['as' => 'notfound', 'uses' => 'HomeController@index']);
Auth::routes();

//ajax
Route::get('ajax', 'Ajax@buscarCiudades')->name('ciudades');
Route::get('ajax/{id}', 'Ajax@buscarCiudades')->name('ciudadesVariable');

// E-mail verification
Route::get('/register/verify/{code}', 'GuessController@verify');
Route::get('/confirmacion', 'GuessController@confirmacion');

 Route::get('/sociallogin/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('/sociallogin/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
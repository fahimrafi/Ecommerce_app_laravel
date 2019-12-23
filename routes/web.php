	<?php
	//For Problem
	//count(): parameter must be an array or an object that implements countable
	if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
	error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
	}
	


	Route::GET('/','Frontend\PagesController@index')->name('index');
	Route::GET('/contact','Frontend\PagesController@contact')->name('contact');


	//Product Routes
	Route::GET('/products','Frontend\ProductsController@index')->name('products.index');
	Route::GET('/products/{slug}','Frontend\ProductsController@show')->name('products.show');
	Route::GET('/search','Frontend\PagesController@search')->name('search');


	//categorywise display
	Route::GET('products/categories','Frontend\CategoriesController@index')->name('categories.index');
	Route::GET('products/category/{id}','Frontend\CategoriesController@show')->name('categories.show');


	//brand wise display
	Route::GET('products/brands','Frontend\brandsController@index')->name('brands.index');
	Route::GET('products/brand/{id}','Frontend\brandsController@show')->name('brands.show');


	//product routes
	Route::group(['prefix'=>'/product'],function(){
	Route::GET('/','Backend\ProductsController@index')->name('admin.products');
	Route::GET('/create','Backend\ProductsController@create')->name('admin.product.create');
	Route::GET('/edit/{id}','Backend\ProductsController@edit')->name('admin.product.edit');
	Route::POST('/create','Backend\ProductsController@store')->name('admin.product.store');
	Route::POST('/update/{id}','Backend\ProductsController@update')->name('admin.product.update');
	Route::get('/delete/{id}','Backend\ProductsController@delete')->name('admin.product.delete');
	});


	//user Route
	Route::GET('user/dashboard','Frontend\UsersController@dashboard')->name('user.dashboard')->middleware('verified');
	Route::GET('user/profile','Frontend\UsersController@profile')->name('user.profile')->middleware('verified');
	Route::POST('user/profile/update','Frontend\UsersController@update')->name('user.UpdateProfile')->middleware('verified');


	//cart route
	 Route::group(['prefix'=>'carts'],function(){
	 	Route::get('/','Frontend\CartsController@index')->name('carts');
	 	Route::POST('/store','Frontend\CartsController@store')->name('carts.store');
	 	Route::POST('/update/{id}','Frontend\CartsController@update')->name('carts.update');
	 	Route::POST('/delete/{id}','Frontend\CartsController@destroy')->name('carts.delete');
	 });

	 //checkout
	 Route::group(['prefix'=>'checkout'],function(){
	 	Route::get('/','Frontend\CheckoutsController@index')->name('checkouts');
	 	Route::POST('/store','Frontend\CheckoutsController@store')->name('checkouts.store');
	 	
	 });


	//admin routes
	Route::group(['prefix'=>'admin'],function(){

	Route::GET('/','Backend\PagesController@index')->name('admin');
	


	//Category routes
	Route::group(['prefix'=>'/category'],function(){
	Route::GET('/','Backend\CategoriesController@index')->name('admin.categories');
	Route::GET('/create','Backend\CategoriesController@create')->name('admin.category.create');
	Route::GET('/edit/{id}','Backend\CategoriesController@edit')->name('admin.category.edit');
	Route::POST('/create','Backend\CategoriesController@store')->name('admin.category.store');
	Route::POST('/update/{id}','Backend\CategoriesController@update')->name('admin.category.update');
	Route::get('/delete/{id}','Backend\CategoriesController@delete')->name('admin.category.delete');
	});

	//Order routes
	Route::group(['prefix'=>'/order'],function(){
	Route::GET('/','Backend\OrdersController@index')->name('admin.orders');
	Route::GET('/show/{id}','Backend\OrdersController@show')->name('admin.order.show');	
	Route::get('/delete/{id}','Backend\OrdersController@delete')->name('admin.order.delete');
	Route::post('/completed/{id}', 'Backend\OrdersController@completed')->name('admin.order.completed');
    Route::post('/paid/{id}', 'Backend\OrdersController@paid')->name('admin.order.paid');
    Route::post('/charge-update/{id}', 'Backend\OrdersController@chargeUpdate')->name('admin.order.charge');
    Route::get('/invoice/{id}', 'Backend\OrdersController@generateInvoice')->name('admin.order.invoice');
	});
	//Brand routes
	Route::group(['prefix'=>'/brand'],function(){
	Route::GET('/','Backend\BrandsController@index')->name('admin.brands');
	Route::GET('/create','Backend\BrandsController@create')->name('admin.brand.create');
	Route::GET('/edit/{id}','Backend\BrandsController@edit')->name('admin.brand.edit');
	Route::POST('/create','Backend\BrandsController@store')->name('admin.brand.store');
	Route::POST('/update/{id}','Backend\BrandsController@update')->name('admin.brand.update');
	Route::get('/delete/{id}','Backend\BrandsController@delete')->name('admin.brand.delete');
	});
	//Division routes
	Route::group(['prefix'=>'/divisions'],function(){
	Route::GET('/','Backend\DivisionsController@index')->name('admin.divisions');
	Route::GET('/create','Backend\DivisionsController@create')->name('admin.division.create');
	Route::GET('/edit/{id}','Backend\DivisionsController@edit')->name('admin.division.edit');
	Route::POST('/create','Backend\DivisionsController@store')->name('admin.division.store');
	Route::POST('/update/{id}','Backend\DivisionsController@update')->name('admin.division.update');
	Route::get('/delete/{id}','Backend\DivisionsController@delete')->name('admin.division.delete');
	});
	//Division routes
	Route::group(['prefix'=>'/districts'],function(){
	Route::GET('/','Backend\DistrictsController@index')->name('admin.districts');
	Route::GET('/create','Backend\DistrictsController@create')->name('admin.district.create');
	Route::GET('/edit/{id}','Backend\DistrictsController@edit')->name('admin.district.edit');
	Route::POST('/create','Backend\DistrictsController@store')->name('admin.district.store');
	Route::POST('/update/{id}','Backend\DistrictsController@update')->name('admin.district.update');
	Route::get('/delete/{id}','Backend\DistrictsController@delete')->name('admin.district.delete');
	});

	// Slider Routes
  Route::group(['prefix' => '/sliders'], function(){
    Route::get('/', 'Backend\SlidersController@index')->name('admin.sliders');
    Route::post('/store', 'Backend\SlidersController@store')->name('admin.slider.store');
    Route::post('/slider/edit/{id}', 'Backend\SlidersController@update')->name('admin.slider.update');
    Route::post('/slider/delete/{id}', 'Backend\SlidersController@delete')->name('admin.slider.delete');
  });




	
	});
	//php artisan config:cache
	//php artisan view:clear
	//composer dump-autoload
	Auth::routes(['verify'=>true]);
	Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');


	//API Routes

	Route::get('get-districts/{id}', function($id){
  		return json_encode(App\Models\District::where('division_id', $id)->get());
	});
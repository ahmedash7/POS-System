<?php





Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){

    Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function() {


        Route::get('/home','DashboardController@home')->name('dashboard');


        //user route

        Route::resource('users','UserController')->except(['show']);

        //category route

        Route::resource('categories','CategoryController')->except(['show']);

        //Product route

        Route::resource('products','ProductController')->except(['show']);

        //client route

        Route::resource('clients','ClientController')->except(['show']);
        Route::resource('clients.orders','client\OrderController')->except(['show']);

        //order route

        Route::resource('orders','OrderController')->except(['show']);
        Route::get('/orders/{order}/products','OrderController@products')->name('orders.products');



    });

});






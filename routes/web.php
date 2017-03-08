<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', [
	'uses' => 'ProductController@index',
	'as' => 'index'
]);

Auth::routes();

Route::get('/account', [
	'uses' => 'UserController@edit',
	'as' => 'users.edit',
	'middleware' => 'auth'
]);

Route::put('/update-account', [
	'uses' => 'UserController@update',
	'as' => 'users.update',
	'middleware' => 'auth'
]);

Route::get('/categories/{id}', [
	'uses' => 'CategoryController@show',
	'as' => 'categories.show'
]);

Route::get('/products/{id}', [
	'uses' => 'ProductController@show',
	'as' => 'products.show'
]);

Route::group(['prefix' => 'cart'], function() {
	Route::get('/', [
		'uses' => 'CartController@getCart',
		'as' => 'cart.show'
	]);

	Route::post('/add-item/{id}', [
		'uses' => 'CartController@postAddItem',
		'as' => 'cart.addItem'
	]);

	Route::get('/increase-qty/{id}', [
		'uses' => 'CartController@getIncreaseByOne',
		'as' => 'cart.increaseByOne'
	]);

	Route::get('/reduce-qty/{id}', [
		'uses' => 'CartController@getReduceByOne',
		'as' => 'cart.reduceByOne'
	]);

	Route::post('/update-qty/{id}', [
		'uses' => 'CartController@postUpdateQty',
		'as' => 'cart.updateQty'
	]);

	Route::get('/remove-item/{id}', [
		'uses' => 'CartController@getRemoveItem',
		'as' => 'cart.removeItem'
	]);
});

Route::group(['prefix' => 'checkout'], function() {
	Route::get('/onepage', [
		'uses' => 'OrderController@create',
		'as' => 'orders.create'
	]);

	Route::post('/place-order', [
		'uses' => 'OrderController@store',
		'as' => 'orders.store',
		'middleware' => 'auth'
	]);

	Route::post('/register', [
		'uses' => 'CheckoutController@postRegister',
		'as' => 'checkout.register',
		'middleware' => 'guest'
	]);

	Route::post('/login', [
		'uses' => 'CheckoutController@postLogin',
		'as' => 'checkout.login',
		'middleware' => 'guest'
	]);

	Route::post('/delivery', [
		'uses' => 'CheckoutController@postDelivery',
		'as' => 'checkout.delivery',
		'middleware' => 'auth'
	]);
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
	Route::group(['prefix' => 'orders'], function() {
		Route::get('/', [
			'uses' => 'OrderController@index',
			'as' => 'orders.index'
		]);

		Route::get('/{id}', [
			'uses' => 'OrderController@show',
			'as' => 'orders.show'
		]);

		Route::put('/{id}', [
			'uses' => 'OrderController@update',
			'as' => 'orders.update'
		]);

		Route::delete('/{id}', [
			'uses' => 'OrderController@destroy',
			'as' => 'orders.destroy'
		]);

		Route::put('/update-status/{id}', [
			'uses' => 'OrderController@updateStatus',
			'as' => 'orders.updateStatus'
		]);
	});

	Route::group(['prefix' => 'users'], function() {
		Route::get('/', [
			'uses' => 'UserController@index',
			'as' => 'users.index'
		]);

		Route::get('/{id}', [
			'uses' => 'UserController@show',
			'as' => 'users.show'
		]);

		Route::delete('/{id}', [
			'uses' => 'UserController@destroy',
			'as' => 'users.destroy'
		]);
	});

	Route::group(['prefix' => 'products'], function() {
		Route::get('/{id}/edit', [
			'uses' => 'ProductController@edit',
			'as' => 'products.edit'
		]);

		Route::put('/{id}', [
			'uses' => 'ProductController@update',
			'as' => 'products.update'
		]);
		
		Route::delete('/{id}', [
			'uses' => 'ProductController@destroy',
			'as' => 'products.destroy'
		]);
	});

	Route::resource('categories', 'CategoryController', [
		'except' => ['create', 'show']
	]);
});
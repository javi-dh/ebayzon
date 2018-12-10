<?php
use App\Brand;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/brands', function () {
	$brands = \App\Brand::all();
   return view('brands')->with(compact('brands'));
});

Route::get('/colors', function () {
	$colors = \App\Color::all();
   return view('colors')->with(compact('colors'));
});

Route::get('/products/api', 'ProductsController@api');

// Route::get('/productos', 'ProductsController@index');
// Route::get('/productos/crear', 'ProductsController@create')->name('products.create');

Route::resource('/products', 'ProductsController');
// Route::get('/products', 'ProductsController@index');
// Route::post('/products', 'ProductsController@store');
// Route::get('/products/create', 'ProductsController@create');
// Route::get('/products/{id}', 'ProductsController@show');
// Route::put('/products/{id}', 'ProductsController@update');
// Route::delete('/products/{id}', 'ProductsController@destroy');
// Route::get('/products/{id}/edit', 'ProductsController@edit');

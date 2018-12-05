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

Route::get('/products', function () {
	$products = \App\Product::all();
   return view('products')->with(compact('products'));
});

Route::get('/brands', function () {
	$brands = \App\Brand::all();
   return view('brands')->with(compact('brands'));
});

Route::get('/colors', function () {
	$colors = \App\Color::all();
   return view('colors')->with(compact('colors'));
});

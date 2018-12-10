<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductsController extends Controller
{
	/**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function index()
	{
		$products = Product::all();
		return view('products.index')->with(compact('products'));
	}

	/**
	* Show the form for creating a new resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function create()
	{
		$brands = \App\Brand::all();
		$categories = \App\Category::all();

		return view('products.create')->with(compact('brands', 'categories'));
	}

	/**
	* Store a newly created resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function store(Request $request)
	{
		$request->validate([
			'name' => 'required | string',
			'price' => 'required | numeric | min:10 | max:999.99',
			'category_id' => 'required | integer',
			'brand_id' => 'required | integer'
		], [
			'required' => 'El campo es obligatorio',
			'name.string' => 'El campo nombre solo admite letras',
			'price.numeric' => 'El campo precio solo admite números',
			'price.min' => 'El precio mínimo es 10',
			'price.max' => 'El precio máximo es 999.99',
		]);

		Product::create($request->all());

		return redirect('/products');
	}

	/**
	* Display the specified resource.
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function show($id)
	{
		$product = Product::find($id);

		return view('products.show')->with(compact('product'));
	}

	/**
	* Show the form for editing the specified resource.
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function edit($id)
	{
		$product = Product::find($id);
		$brands = \App\Brand::all();
		$categories = \App\Category::all();

		return view('products.edit')->with(compact('product', 'brands', 'categories'));
	}

	/**
	* Update the specified resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function update(Request $request, $id)
	{
		$request->validate([
			'name' => 'required | string',
			'price' => 'required | numeric | min:10 | max:999.999.99',
			'category_id' => 'required | integer',
			'brand_id' => 'required | integer'
		], [
			'required' => 'El campo es obligatorio',
			'name.string' => 'El campo nombre solo admite letras',
			'price.numeric' => 'El campo precio solo admite números',
			'price.min' => 'El precio mínimo es 10',
			'price.max' => 'El precio máximo es 999.999.99',
		]);

		$product = Product::find($id);

		$product->name = $request->input('name');
		$product->price = $request->input('price');
		$product->brand_id = $request->input('brand_id');
		$product->category_id = $request->input('category_id');
		$product->save();

		return redirect()->route('products.index');
	}

	/**
	* Remove the specified resource from storage.
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function destroy($id)
	{
		$product = Product::find($id);
		$product->delete();
		return redirect('/products');
	}

  public function api()
  {
    $products = Product::all();
    return $products;
  }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductRequest;
use App\Product;

class ProductsController extends Controller
{
	public function storeAndUpdate($request, $product)
	{
		$product->name = $request->input('name');
		$product->price = $request->input('price');
		$product->category_id = $request->input('category_id');
		$product->brand_id = $request->input('brand_id');

		// Traemos todo el objeto de imagen
		$productImage = $request->file('image');

		// Armo un nombre único para este archivo
		$imageName = uniqid("product_img_") . "." . $productImage->extension();

		// Subo el archivo de imagen
		$productImage->storePubliclyAs("public/products", $imageName);

		// Lo guardamos en base de datos
		$product->image = $imageName;
		$product->user_id = Auth::user()->id;
		$product->save();
	}

	/**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function index(Request $request)
	{
		switch ($request->orderBy) {
			case 'categories':
				$order = 'category_id';
				break;
			case 'brands':
				$order = 'brand_id';
				break;
			default:
				$order = 'price';
				break;
		}
		$products = Product::orderBy($order)->paginate(5);

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
	public function store(ProductRequest $request)
	{
		$product = new Product;

		$this->storeAndUpdate($request, $product);

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
		$user_id = Auth::user()->id;
		$product = Product::find($id);
		$brands = \App\Brand::all();
		$categories = \App\Category::all();

		if ($user_id == $product->user_id) {
			return view('products.edit')->with(compact('product', 'brands', 'categories'));
		}
		return redirect('/products/' . $id)->with('alert', 'No podés editar un producto que no es tuyo');
	}

	/**
	* Update the specified resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function update(ProductRequest $request, $id)
	{
		$product = Product::find($id);

		$this->storeAndUpdate($request, $product);

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

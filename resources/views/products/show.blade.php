@extends('template.base')

@section('title', 'Detalle del Producto')

@section('content')
	<h2>{{ $product->name }}</h2>
	<table class="table">
		<tr>
			<td>Price</td>
			<td>Image</td>
			<td>Colors</td>
			<td>Category</td>
			<td>Brand</td>
		</tr>
		<tr>
			<td><b>$</b>{{ $product->price }}</td>
			<td><img src="{{ $product->image }}" width="100"></td>
			<td>
				<ul>
				@forelse ($product->colors as $color)
					<li>{{ $color->name }}</li>
				@empty
					<li>Sin colores relaciondos</li>
				@endforelse
				</ul>
			</td>
			<td>{{ $product->category->name ?? 'No tiene categoría' }}</td>
			<td>{{ $product->brand->name ?? 'No tiene marca' }}</td>
		</tr>
	</table>
	<a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
	{{-- <a href="/products/{{ $product->id }}/edit" class="btn btn-warning">Edit</a> --}}

	<form action="/products/{{ $product->id }}" method="post" style="display: inline-block;">
		@csrf
		{{ method_field('DELETE') }}
		<button type="submit" class="btn btn-danger">Delete</button>
	</form>
@endsection

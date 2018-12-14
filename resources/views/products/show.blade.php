@extends('template.base')

@section('title', 'Detalle del Producto')

@section('content')
	@if ( session('alert') )
		<div class="alert alert-danger">
			{{ session('alert') }}
		</div>
	@endif
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
			<td><img src="{{ Storage::url('products/' . $product->image) }}" width="100"></td>
			<td>
				<ul>
				@forelse ($product->colors as $color)
					<li>{{ $color->name }}</li>
				@empty
					<li>Sin colores relacionados</li>
				@endforelse
				</ul>
			</td>
			<td>{{ $product->category->name ?? 'No tiene categoría' }}</td>
			<td>{{ $product->brand->name ?? 'No tiene marca' }}</td>
		</tr>
	</table>

	@auth
		@if ($product->user_id == Auth::user()->id )
			<a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>

			<form action="/products/{{ $product->id }}" method="post" style="display: inline-block;">
				@csrf
				{{ method_field('DELETE') }}
				<button id="delete" type="submit" class="btn btn-danger">Delete</button>
			</form>
		@endif
	@endauth


	<script>
		let btn = document.querySelector('#delete');
		btn.addEventListener('click', function () {
			window.alert('¿Seguro querés borrar el producto {{ $product->name }}?');
		});
	</script>
@endsection

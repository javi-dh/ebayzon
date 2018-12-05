@extends('base')

@section('title', 'Listado de Productos')

@section('content')
	<h2>Listado de productos</h2>
	<table class="table">
		<tr>
			<td>Name</td>
			<td>Price</td>
			<td>Image</td>
			<td>Colors</td>
			<td>Category</td>
			<td>Brand</td>
		</tr>
		@forelse ($products as $oneProduct)
			<tr>
				<td>{{ $oneProduct->name }}</td>
				<td><b>$</b>{{ $oneProduct->price }}</td>
				<td><img src="{{ $oneProduct->image }}" width="100"></td>
				<td>
					<ul>
					@forelse ($oneProduct->colors as $color)
						<li>{{ $color->name }}</li>
					@empty
						<li>Sin colores relaciondos</li>
					@endforelse
					</ul>
				</td>
				<td>{{ $oneProduct->category->name }}</td>
				<td>{{ $oneProduct->brand->name }}</td>
			</tr>
		@empty

		@endforelse
	</table>
@endsection

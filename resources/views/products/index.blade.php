@extends('template.base')

@section('title', 'Listado de Productos')

@section('content')
	<h2>Listado de productos</h2>
	<table class="table">
		<tr>
			<td>Name</td>
			<td>Price</td>
			<td>Image</td>
			<td>Colors</td>
			<td><a href="/products?orderBy=categories">Category</a></td>
			<td><a href="/products?orderBy=brands">Brand</a></td>
		</tr>
		@forelse ($products as $oneProduct)
			<tr>
				<td>
					<a href="{{ route('products.show', $oneProduct->id) }}">
						{{ $oneProduct->name }}
					</a>
				</td>
				<td><b>$</b>{{ $oneProduct->price }}</td>
				<td><img src="{{ Storage::url('products/' . $oneProduct->image) }}" width="100"></td>
				<td>
					<ul>
					@forelse ($oneProduct->colors as $color)
						<li>{{ $color->name }}</li>
					@empty
						<li>Sin colores relaciondos</li>
					@endforelse
					</ul>
				</td>
				<td>{{ $oneProduct->category->name ?? 'No tiene categoría' }}</td>
				<td>{{ $oneProduct->brand->name ?? 'No tiene marca' }}</td>
			</tr>
		@empty

		@endforelse
	</table>

	{{ $products->links() }}
@endsection

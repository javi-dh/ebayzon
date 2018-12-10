@extends('template.base')

@section('title', 'Listado de colores')

@section('content')
	<h2>Listado de colores</h2>
	<table class="table">
		<tr>
			<td>Name</td>
			<td>Products</td>
		</tr>
		@forelse ($colors as $oneColor)
			<tr>
				<td>{{ $oneColor->name }}</td>
				<td>
					<ul>
					@forelse ($oneColor->products as $product)
						<li>{{ $product->name }}</li>
					@empty
						<li>Sin productos relacionados</li>
					@endforelse
					</ul>
				</td>
			</tr>
		@empty

		@endforelse
	</table>
@endsection

@extends('template.base')

@section('title', 'Listado de marcas')

@section('content')
	<h2>Listado de marcas</h2>
	<table class="table">
		<tr>
			<td>Name</td>
			<td>Products</td>
		</tr>
		@forelse ($brands as $oneBrand)
			<tr>
				<td>{{ $oneBrand->name }}</td>
				<td>
					<ul>
					@forelse ($oneBrand->products as $product)
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

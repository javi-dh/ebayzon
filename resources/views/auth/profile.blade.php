@extends('template.base')

@section('title', 'Tu profile')

@section('content')
<div class="container">
    <h2>Hola {{ Auth::user()->name }}</h2>

    <form action="/logout" method="post">
      @csrf
      <button class="btn btn-success" type="submit">Salir</button>
    </form>
    <br>
    <br>
    <h2>Mis productos</h2>
    <table class="table">
  		<tr>
  			<td>Name</td>
  			<td>Price</td>
  			<td>Image</td>
  			<td>Colors</td>
  			<td>Category</td>
  			<td>Brand</td>
  		</tr>
  		@forelse (Auth::user()->products as $oneProduct)
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
</div>
@endsection

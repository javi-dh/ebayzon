@extends('template.base')

@section('title', 'Crear un producto')

@section('content')
	<br>
	{{-- <ul>
		@forelse ($errors->all() as $error)
			<li class="alert alert-danger"> {{ $error }}</li>
		@empty

		@endforelse
	</ul> --}}

	<form action="/products" method="post" enctype="multipart/form-data">
	{{-- <form action="{{ route('products.store') }}" method="post"> --}}
		@csrf
		<div class="row">
			<div class="col-6">
				<div class="form-group">
					<label for="name">Name:</label>
					<input type="text" name="name" id="name"
						class="form-control {{ $errors->has('name') ? 'is-invalid' : null }}"
						value="{{ old('name') }}"
					>
					<span class="invalid-feedback">
						@if ($errors->has('name'))
							{{ $errors->first('name') }}
						@endif
					</span>
				</div>
			</div>
			<div class="col-6">
				<div class="form-group">
					<label for="price">Price:</label>
					<input type="text" name="price" id="price"
						class="form-control {{ $errors->has('price') ? 'is-invalid' : null }}"
						value="{{ old('price') }}"
					>
					<span class="invalid-feedback">
						{{ $errors->has('price') ? $errors->first('price') : null}}
					</span>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-6">
				<div class="form-group">
					<label for="brand_id">Brand:</label>
					<select name="brand_id"  id="brand_id"
						class="form-control {{ $errors->has('brand_id') ? 'is-invalid' : null }}"
					>
						<option value="">Seleccioná</option>
						@foreach ($brands as $oneBrand)
							<option value="{{ $oneBrand->id }}"
								{{ old('brand_id') == $oneBrand->id ? 'selected' : null }}
							>
								{{ $oneBrand->name }}
							</option>
						@endforeach
					</select>
					<span class="invalid-feedback">
						{{ $errors->has('brand_id') ? $errors->first('brand_id') : null}}
					</span>
				</div>
			</div>
			<div class="col-6">
				<div class="form-group">
					<label for="category_id">Category:</label>
					<select name="category_id" id="category_id"
						class="form-control {{ $errors->has('category_id') ? 'is-invalid' : null }}"
					>
						<option value="">Seleccioná</option>
						@foreach ($categories as $oneCategory)
							<option value="{{ $oneCategory->id }}"
								{{ old('category_id') == $oneCategory->id ? 'selected' : null }}
							>
								{{ $oneCategory->name }}
							</option>
						@endforeach
					</select>
					<span class="invalid-feedback">
						{{ $errors->has('category_id') ? $errors->first('category_id') : null}}
					</span>
				</div>
			</div>

			<div class="col-6">
				<div class="form-group">
					<label for="category_id">Subí una imagen:</label>
					<div class="custom-file">
					   <input type="file"  id="image" name="image"
							class="custom-file-input {{ $errors->has('image') ? 'is-invalid' : null }}"
						>
					   <label class="custom-file-label" for="image">Elegí una imagen</label>

						<span class="invalid-feedback">
							{{ $errors->has('image') ? $errors->first('image') : null}}
						</span>
					 </div>
				</div>
			</div>
		</div>

		<button type="submit" class="btn btn-success">Save product</button>
	</form>

	<script>
		let campoName = document.querySelector('#name');
		campoName.addEventListener('blur', function () {
			if (this.value.trim() === '') {
				this.classList.add('is-invalid');
				this.parentElement.querySelector('span').innerText = 'Campo obligatorio';
			} else {
				this.classList.remove('is-invalid');
				this.parentElement.querySelector('span').innerText = '';
			}
		});
	</script>
@endsection

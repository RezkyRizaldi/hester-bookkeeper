@extends('layouts.main')
@section('title', 'Tambah Data Produk - ' . config('app.name'))
@section('content')
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Tambah Data Produk</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item active">Produk</li>
				</ol>
			</div>
		</div>
	</div>
</section>
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card card-info">
					<form method="POST" action="{{ route('products.store') }}" class="form-horizontal">
						@csrf
						<div class="card-body">
							<div class="form-group row">
								<label for="brand_id" class="col-sm-2 col-form-label">Merek</label>
								<div class="col-sm-10">
									<select name="brand_id" id="brand_id" class="form-control is_select2 @error('brand_id') is-invalid @enderror">
										<option selected disabled value="">Pilih Merek</option>
										@foreach ($brands as $brand)
											<option value="{{ $brand->id }}" @selected(old('brand_id') == $brand->id)>{{ $brand->name }}</option>
										@endforeach
									</select>
									@error('brand_id')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror
								</div>
							</div>
							<div class="form-group row">
								<div class="col-10">
									<label for="name">Nama</label>
									<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Nama Produk" value="{{ old('name') }}" />
									@error('name')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror
								</div>
								<div class="col">
									<label for="color_id">Warna</label>
									<select name="color_id" id="color_id" class="form-control is_select2 @error('color_id') is-invalid @enderror">
										<option selected disabled value="">Pilih Warna</option>
										@foreach ($colors as $color)
											<option value="{{ $color->id }}" @selected(old('color_id') == $color->id)>{{ $color->name }}</option>
										@endforeach
									</select>
									@error('color_id')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror
								</div>
							</div>
							<div class="form-group row">
								<label for="capital" class="col-sm-2 col-form-label">Modal</label>
								<div class="col-sm-10">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text">Rp</span>
										</div>
										<input type="text" name="capital" class="form-control format-currency @error('capital') is-invalid @enderror" id="capital" placeholder="Modal Produk" value="{{ old('capital') }}" maxlength="10" />
										@error('capital')
											<div class="invalid-feedback">
												{{ $message }}
											</div>
										@enderror
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label for="price" class="col-sm-2 col-form-label">Harga</label>
								<div class="col-sm-10">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text">Rp</span>
										</div>
										<input type="text" name="price" class="form-control format-currency @error('price') is-invalid @enderror" id="price" placeholder="Harga Produk" value="{{ old('price') }}" maxlength="10" />
										@error('price')
											<div class="invalid-feedback">
												{{ $message }}
											</div>
										@enderror
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label for="size" class="col-sm-2 col-form-label">Ukuran</label>
								<div class="col-sm-10">
									<select name="size" id="size" class="form-control is_select2 @error('size') is-invalid @enderror">
										<option selected disabled value="">Pilih Ukuran</option>
										<option @selected(old('size') === "S") value="S">S</option>
										<option @selected(old('size') === "M") value="M">M</option>
										<option @selected(old('size') === "L") value="L">L</option>
										<option @selected(old('size') === "XL") value="XL">XL</option>
									</select>
									@error('size')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror
								</div>
							</div>
						</div>
						<div class="card-footer">
							<button type="submit" class="btn btn-success float-right">Simpan</button>
							<a href="{{ route('products.index') }}" class="btn btn-default">Kembali</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection

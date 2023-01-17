@extends('layouts.main')
@section('title', 'Ubah Data Pemasukan - ' . config('app.name'))
@section('content')
<section class="content-header">
	<div class="container-fluid">
		<h1>Ubah Data Pemasukan</h1>
	</div>
</section>
<section class="content">
	<div class="container-fluid">
		<div class="card">
			<form method="POST" action="{{ route('incomes.update', $income->id) }}">
				@csrf
				@method('PUT')
				<div class="card-body">
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="store_id">Toko</label>
							<select name="store_id" id="store_id" class="form-control is_select2 @error('store_id') is-invalid @enderror">
								<option disabled value="">Pilih Toko</option>
								@foreach ($stores as $store)
									<option value="{{ $store->id }}" @selected($store->id === $income->store_id)>{{ $store->name }}</option>
								@endforeach
							</select>
							@error('store_id')
								<div class="invalid-feedback">
									{{ $message }}
								</div>
							@enderror
						</div>
						<div class="form-group col-md-6">
							<label for="product_id">Produk</label>
							<select name="product_id" id="product_id" class="form-control is_select2 @error('product_id') is-invalid @enderror">
								<option disabled value="">Pilih Produk</option>
								@foreach ($products as $product)
									<option value="{{ $product->id }}" @selected($product->id === $income->product_id)>{{ $product->name }}</option>
								@endforeach
							</select>
							@error('product_id')
								<div class="invalid-feedback">
									{{ $message }}
								</div>
							@enderror
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="amount">Uang Masuk</label>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text">Rp</span>
								</div>
								<input type="text" name="amount" class="form-control format-currency @error('amount') is-invalid @enderror" id="amount" placeholder="Uang Masuk" value="{{ $income->amount }}" maxlength="10" />
								@error('amount')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
						</div>
						<div class="form-group col-md-6">
							<label for="date">Tanggal</label>
							<input type="date" name="date" class="form-control @error('date') is-invalid @enderror" id="date" placeholder="Tanggal" value="{{ $income->formatted_date }}" />
							@error('date')
								<div class="invalid-feedback">
									{{ $message }}
								</div>
							@enderror
						</div>
					</div>
				</div>
				<div class="card-footer">
					<button type="submit" class="btn btn-success float-right">Simpan</button>
					<a href="{{ route('incomes.index') }}" class="btn btn-default">Kembali</a>
				</div>
			</form>
		</div>
	</div>
</section>
@endsection

@push('styles')
	<style>
		.is-invalid + .select2-container--default .select2-selection--single,
		.is-invalid + .select2-container--default .select2-selection--multiple {
			border: 1px solid #dc3545;
			padding-right: 2.25rem !important;
    	background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='none' stroke='%23dc3545' viewBox='0 0 12 12'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
    	background-repeat: no-repeat;
    	background-position: right calc(0.375em + 0.1875rem) center;
    	background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
		}
	</style>
@endpush

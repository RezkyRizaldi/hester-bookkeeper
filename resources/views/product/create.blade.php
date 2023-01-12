@extends('layouts.main')
@section('title', 'Tambah Data Produk - ' . config('app.name'))
@section('content')
<section class="content-header">
	<div class="container-fluid">
		<h1>Tambah Data Produk</h1>
	</div>
</section>
<section class="content">
	<div class="container-fluid">
		<div class="card">
			<form method="POST" action="{{ route('products.store') }}">
				@csrf
				<div class="card-body">
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="brand_id">Merek</label>
							<select name="brand_id" id="brand_id" class="form-control is_select2 @error('brand_id') is-invalid @enderror">
								<option selected disabled value="">Pilih Merek</option>
								@foreach ($brands as $brand)
									<option value="{{ $brand->id }}" @selected(old('brand_id') === $brand->id)>{{ $brand->name }}</option>
								@endforeach
							</select>
							@error('brand_id')
								<div class="invalid-feedback">
									{{ $message }}
								</div>
							@enderror
						</div>
						<div class="form-group col-md-6">
							<div class="row">
								<div class="col-md-8">
									<label for="name">Nama</label>
									<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Nama Produk" value="{{ old('name') }}" />
									@error('name')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror
								</div>
								<div class="col-md-4">
									<label for="color_id">Warna</label>
									<select name="color_id" id="color_id" class="form-control is_select2 @error('color_id') is-invalid @enderror">
										<option selected disabled value="">Pilih Warna</option>
										@foreach ($colors as $color)
											<option value="{{ $color->id }}" @selected(old('color_id') === $color->id)>{{ $color->name }}</option>
										@endforeach
									</select>
									@error('color_id')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror
								</div>
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-4">
							<label for="capital">Modal</label>
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
						<div class="form-group col-md-4">
							<label for="price">Harga</label>
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
						<div class="form-group col-md-4">
							<label for="size">Ukuran</label>
							<select name="size[]" id="size" class="is_select2 w-100 @error('size') is-invalid @enderror" multiple data-placeholder="Ukuran">
								@foreach ($sizes as $size)
									<option @selected(old('size') === $size) value="{{ $size }}">{{ $size }}</option>
								@endforeach
							</select>
							@error('size')
								<div class="invalid-feedback">
									{{ $message }}
								</div>
							@enderror
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-4">
							<label for="incoming">Barang Masuk</label>
							<div class="d-flex flex-column" style="{{ $errors->has('incoming.*') ? 'row-gap: 0.25rem;' : 'row-gap: 0.5rem;' }}">
								<input type="number" name="incoming[]" class="form-control @error('incoming.0') is-invalid @enderror" id="incoming1" placeholder="Barang Masuk" aria-labelledby="incoming" value="{{ old('incoming.0') }}" min="1" />
								@error('incoming.0')
									<div class="invalid-feedback mt-0">
										{{ $message }}
									</div>
								@enderror
							</div>
						</div>
						<div class="form-group col-md-4">
							<label for="outgoing">Barang Keluar</label>
							<div id="outgoingWrapper" class="d-flex flex-column" style="{{ $errors->has('outgoing.*') ? 'row-gap: 0.25rem;' : 'row-gap: 0.5rem;' }}">
								<input type="number" name="outgoing[]" class="form-control @error('outgoing.0') is-invalid @enderror" id="outgoing1" placeholder="Barang Keluar" aria-labelledby="outgoing" value="{{ old('outgoing.0') ?? 0 }}" min="0" />
								@error('outgoing.0')
									<div class="invalid-feedback mt-0">
										{{ $message }}
									</div>
								@enderror
							</div>
						</div>
						<div class="form-group col-md-2">
							<div class="d-flex" style="column-gap: 0.5rem; margin-top: 2rem">
								<input type="hidden" value="1" id="totalInput" />
								<button class="btn btn-success" type="button" id="addInputBtn" title="Tambah Input">
									<i class="fa fa-plus"></i>
								</button>
								<button class="btn btn-danger" type="button" id="removeInputBtn" title="Hapus Input">
									<i class="fa fa-minus"></i>
								</button>
							</div>
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

@push('scripts')
	<script type="text/javascript">
		function init() {
			$(`#outgoingWrapper input`).each(function (i) {
				$(this).on('keyup', function () {
					if (parseInt($(this).val()) > parseInt($(`#incoming${i + 1}`).val())) {
						$(this).val(parseInt($(`#incoming${i + 1}`).val()));
					}
				});
			});
		}

		init();

		$('#addInputBtn').on('click', () => {
			let totalInput = parseInt($('#totalInput').val());
			const incomingInput = `<input type="number" name="incoming[]" class="form-control @error('incoming.${totalInput}') is-invalid @enderror" id="incoming${totalInput + 1}" aria-labelledby="incoming" placeholder="Barang Keluar" value="{{ old('incoming.${totalInput}') }}" min="1" />`;
			const outgoingInput = `<input type="number" name="outgoing[]" class="form-control @error('outgoing.${totalInput}') is-invalid @enderror" id="outgoing${totalInput + 1}" aria-labelledby="outgoing" placeholder="Barang Keluar" value="{{ old('outgoing.${totalInput}') ?? 0 }}" min="0" />`;

			$(incomingInput).insertAfter(`#incoming${totalInput}`);
			$(outgoingInput).insertAfter(`#outgoing${totalInput}`);
			$('#totalInput').val(totalInput + 1);
			init();
		});

		$('#removeInputBtn').on('click', () => {
			let totalInput = parseInt($('#totalInput').val());

			if (totalInput > 1) {
				$(`#incoming${totalInput}`).remove();
				$(`#outgoing${totalInput}`).remove();
				$('#totalInput').val(totalInput - 1);
			}

			init();
		});
	</script>
@endpush

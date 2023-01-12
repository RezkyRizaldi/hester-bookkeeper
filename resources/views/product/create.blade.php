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
									<option value="{{ $brand->id }}" @selected(old('brand_id') == $brand->id)>{{ $brand->name }}</option>
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
							<select name="size[]" id="size" class="is_select2 w-100 @error('size') is-invalid @enderror" multiple placeholder="Ukuran">
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
							<div class="d-flex flex-column" style="row-gap: 0.5rem;">
								<input type="number" name="incoming[]" class="form-control @error('incoming.0') is-invalid @enderror" id="incoming1" placeholder="Barang Masuk" />
							</div>
							@error('incoming.0')
								<div class="invalid-feedback">
									{{ $message }}
								</div>
							@enderror
						</div>
						<div class="form-group col-md-4">
							<label for="outgoing">Barang Keluar</label>
							<div id="outgoingWrapper" class="d-flex flex-column" style="row-gap: 0.5rem;">
								<input type="number" name="outgoing[]" class="form-control @error('outgoing.0') is-invalid @enderror" id="outgoing1" placeholder="Barang Keluar" />
							</div>
							@error('outgoing.0')
								<div class="invalid-feedback">
									{{ $message }}
								</div>
							@enderror
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

@push('scripts')
	<script type="text/javascript">
		function init() {
			$(`#outgoingWrapper input`).each(function (i) {
				$(this).on('keyup', function () {
					if (parseInt($(this).val()) > parseInt($(`#incoming${i + 1}`).val())) {
						$(this).val(0);
					}
				});
			});
		}

		init();

		$('#addInputBtn').on('click', () => {
			let totalInput = parseInt($('#totalInput').val());
			const incomingInput = `<input type="number" name="incoming[]" class="form-control @error('incoming.${totalInput}') is-invalid @enderror" id="incoming${totalInput + 1}" aria-labeledby="incoming" placeholder="Barang Keluar" value="{{ old('incoming.${totalInput}') }}" />`;
			const outgoingInput = `<input type="number" name="outgoing[]" class="form-control @error('outgoing.${totalInput}') is-invalid @enderror" id="outgoing${totalInput + 1}" aria-labeledby="outgoing" placeholder="Barang Keluar" value="{{ old('outgoing.${totalInput}') }}" />`;

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

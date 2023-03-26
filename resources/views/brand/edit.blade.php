@extends('layouts.main')
@section('title', 'Ubah Data Merek - ' . config('app.name'))
@section('content')
<section class="content-header">
	<div class="container-fluid">
		<h1>Ubah Data Merek</h1>
	</div>
</section>
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card card-info">
					<form method="POST" action="{{ route('brands.update', $brand->id) }}" class="form-horizontal">
						@csrf
						@method('PUT')
						<div class="card-body">
							<div class="form-group row">
								<div class="col">
									<label for="name" class="col-sm-2 col-form-label">Nama</label>
									<div class="col-sm-10">
										<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Nama Merek" value="{{ $brand->name }}" />
										@error('name')
											<div class="invalid-feedback">
												{{ $message }}
											</div>
										@enderror
									</div>
								</div>
							</div>
						</div>
						<div class="card-footer">
							<button type="submit" class="btn btn-success float-right">Simpan</button>
							<a href="{{ route('brands.index') }}" class="btn btn-default">Kembali</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection

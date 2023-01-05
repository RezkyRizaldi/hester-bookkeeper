@extends('layouts.main')
@section('title', config('app.name'))
@section('content')
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm">
					<h1>Dashboard</h1>
				</div>
			</div>
		</div>
	</section>
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="row">
								@foreach ($brands as $brand)
									<div class="col-6">
										<div class="card">
											<div class="card-body">
												<h5 class="card-title">{{ $brand->name }}</h5>
												<p class="card-text">Jumlah Produk: {{ $brand->products_count }}</p>
											</div>
										</div>
									</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection

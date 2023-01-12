@extends('layouts.main')
@section('title', 'Detail Produk - ' . config('app.name'))
@section('content')
	<section class="content-header">
		<div class="container-fluid">
			<h1>Detail Produk</h1>
		</div>
	</section>
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<table class="table text-center table-bordered table-hover">
								@foreach ($goods as $key => $items)
									<thead>
										<tr>
											@if ($loop->first)
												<th class="bg-secondary" scope="col"></th>
												<th scope="col">No.</th>
												<th scope="col">Barang Masuk</th>
												<th scope="col">Barang Keluar</th>
												<th scope="col">Stok</th>
												<th scope="col">Tanggal</th>
											@endif
										</tr>
									</thead>
									<tbody>
										@foreach ($items as $item)
											<tr>
												@if ($loop->first)
													<th scope="row" rowspan="{{ count($items) }}">{{ $key }}</th>
												@endif
												<td>{{ $loop->iteration }}.</td>
												<td>{{ $item->incoming }}</td>
												<td>{{ $item->outgoing }}</td>
												<td>{{ $item->stock }}</td>
												<td>{{ $item->created_at }}</td>
											</tr>
										@endforeach
									</tbody>
								@endforeach
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection

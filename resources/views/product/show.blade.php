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
								@foreach ($goods as $month => $items)
									<thead class="thead-dark">
										<tr>
											@if ($loop->first)
												<th></th>
												<th>No.</th>
												<th>Tanggal</th>
												<th>Barang Masuk</th>
												<th>Barang Keluar</th>
												<th>Stok</th>
											@endif
										</tr>
									</thead>
									<tbody>
										@foreach ($items as $item)
											<tr>
												@if ($loop->first)
													<th scope="row" rowspan="{{ count($items) }}">{{ $month }}</th>
												@endif
												<td>{{ $loop->iteration }}.</td>
												<td>{{ $item->date }}</td>
												<td>{{ $item->incoming }}</td>
												<td>{{ $item->outgoing }}</td>
												<td>{{ $item->stock }}</td>
											</tr>
										@endforeach
										<tr>
											<th colspan="5">Jumlah Stok {{ $month }}</th>
											<td style="font-weight: 600;">{{ $items->sum('stock') }}</td>
										</tr>
									</tbody>
								@endforeach
								<tfoot>
									<tr class="bg-secondary">
										<th colspan="5">Jumlah Stok</th>
										<td style="font-weight: 600;">{{ $goods->sum(fn ($items) => $items->sum('stock')) }}</td>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection

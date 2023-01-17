@extends('layouts.main')
@section('title', 'Pengeluaran - ' . config('app.name'))
@section('content')
	<section class="content-header">
		<div class="container-fluid">
			<h1>Data Pengeluaran</h1>
		</div>
	</section>
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<div class="row">
								<div class="col-md-4">
									<form action="{{ route('expenditures.index') }}" class="input-group">
										<input type="search" name="search" class="form-control" placeholder="Cari..." aria-label="Cari" aria-describedby="searchBtn" value="{{ request('search') }}" />
										<div class="input-group-append">
											<button class="btn btn-primary" type="submit" id="searchBtn">
												<i class="fa fa-search"></i>
											</button>
										</div>
									</form>
								</div>
								<div class="col-md-8">
									<a href="{{ route('expenditures.create') }}" class="btn btn-primary float-right"><i class="nav-icon fa fa-plus"></i>  Tambah Data Pengeluaran</a>
								</div>
							</div>
						</div>
						<div class="card-body">
							<table class="table text-center table-bordered table-hover">
								<thead class="thead-dark">
									<tr>
										@if ($expenditures->isNotEmpty())
											<th></th>
										@endif
										<th>No.</th>
										<th>Tanggal</th>
										<th>Kode Produk</th>
										<th>Nama Produk</th>
										<th>Tipe</th>
										<th>Jumlah</th>
										<th>Harga Satuan</th>
										<th>Total</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									@forelse ($expenditures as $month => $items)
										@foreach ($items as $item)
											<tr>
												@if ($loop->first)
													<th rowspan="{{ count($items) }}">{{ $month }}</th>
												@endif
												<td>{{ $loop->iteration }}.</td>
												<td>{{ $item->translated_date }}</td>
												<td>{{ $item->product->code }}</td>
												<td>{{ $item->product->name }}</td>
												<td>{{ $item->type }}</td>
												<td>{{ $item->amount }}</td>
												<td>Rp {{ number_format($item->price) }}</td>
												<td>Rp {{ number_format($item->total) }}</td>
												<td>
													<div class="dropdown">
														<button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
															Menu
														</button>
														<div class="dropdown-menu">
															<a class="dropdown-item" href="{{ route('expenditures.edit', $item->id) }}">
																Ubah
															</a>
															<form class="d-inline" action="{{ route('expenditures.destroy', $item->id) }}" method="POST">
																@csrf
																@method('DELETE')
																<button class="dropdown-item" type="submit" onclick="return confirm('Yakin menghapus data?')">
																	Hapus
																</button>
															</form>
														</div>
													</div>
												</td>
											</tr>
										@endforeach
										<tr>
											<th colspan="8">Jumlah Harga {{ $month }}</th>
											<td colspan="2" style="font-weight: 600;">Rp {{ number_format($items->sum('total')) }}</td>
										</tr>
									@empty
										<tr>
											<td colspan="10">Tidak ada data.</td>
										</tr>
									@endforelse
								</tbody>
								@if (!empty($expenditures))
									<tfoot>
										<tr class="bg-secondary">
											<th colspan="8">Jumlah Harga</th>
											<td colspan="2" style="font-weight: 600;">Rp {{ number_format($expenditures->sum(fn ($items) => $items->sum('total'))) }}</td>
										</tr>
									</tfoot>
								@endif
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection

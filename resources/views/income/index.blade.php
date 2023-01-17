@extends('layouts.main')
@section('title', 'Pemasukan - ' . config('app.name'))
@section('content')
	<section class="content-header">
		<div class="container-fluid">
			<h1>Data Pemasukan</h1>
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
									<form action="{{ route('incomes.index') }}" class="input-group">
										<input type="search" name="search" class="form-control" placeholder="Cari..." aria-label="Cari" aria-describedby="searchBtn" value="{{ request('search') }}" />
										<div class="input-group-append">
											<button class="btn btn-primary" type="submit" id="searchBtn">
												<i class="fa fa-search"></i>
											</button>
										</div>
									</form>
								</div>
								<div class="col-md-8">
									<a href="{{ route('incomes.create') }}" class="btn btn-primary float-right"><i class="nav-icon fa fa-plus"></i>  Tambah Data Pemasukan</a>
								</div>
							</div>
						</div>
						<div class="card-body">
							<table class="table text-center table-bordered table-hover">
								<thead class="thead-dark">
									<tr>
										@if ($incomes->isNotEmpty())
											<th></th>
										@endif
										<th>No.</th>
										<th>Tanggal</th>
										<th>Toko</th>
										<th>Kode Produk</th>
										<th>Nama Produk</th>
										<th>Uang Masuk</th>
										<th>Keuntungan</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									@forelse ($incomes as $month => $items)
										@foreach ($items as $item)
											<tr>
												@if ($loop->first)
													<th rowspan="{{ count($items) }}">{{ $month }}</th>
												@endif
												<td>{{ $loop->iteration }}.</td>
												<td>{{ $item->translated_date }}</td>
												<td>{{ $item->store->name }}</td>
												<td>{{ $item->product->code }}</td>
												<td>{{ $item->product->name }}</td>
												<td>Rp {{ number_format($item->amount) }}</td>
												<td>Rp {{ number_format($item->profit) }}</td>
												<td>
													<div class="dropdown">
														<button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
															Menu
														</button>
														<div class="dropdown-menu">
															<a class="dropdown-item" href="{{ route('incomes.edit', $item->id) }}">
																Ubah
															</a>
															<form class="d-inline" action="{{ route('incomes.destroy', $item->id) }}" method="POST">
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
											<th colspan="7">Jumlah Keuntungan {{ $month }}</th>
											<td colspan="2" style="font-weight: 600;">Rp {{ number_format($items->sum('profit')) }}</td>
										</tr>
									@empty
										<tr>
											<td colspan="9">Tidak ada data.</td>
										</tr>
									@endforelse
								</tbody>
								<tfoot>
									<tr class="bg-secondary">
										<th colspan="7">Jumlah Keuntungan</th>
										<td colspan="2" style="font-weight: 600;">Rp {{ number_format($incomes->sum(fn ($items) => $items->sum('profit'))) }}</td>
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

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
							<a href="{{ route('incomes.create') }}" class="btn btn-primary float-right"><i class="nav-icon fa fa-plus"></i>  Tambah Data Pemasukan</a>
						</div>
						<div class="card-body">
							<table class="table text-center table-bordered table-hover">
								@forelse ($incomes as $month => $items)
									<thead class="thead-dark">
										<tr>
											@if ($loop->first)
												<th></th>
												<th>No.</th>
												<th>Tanggal</th>
												<th>Toko</th>
												<th>Kode Produk</th>
												<th>Nama Produk</th>
												<th>Uang Masuk</th>
												<th>Keuntungan</th>
												<th>Aksi</th>
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
									</tbody>
								@empty
									<tbody>
										<tr>
											<th>No.</th>
											<th>Tanggal</th>
											<th>Toko</th>
											<th>Kode Produk</th>
											<th>Nama Produk</th>
											<th>Uang Masuk</th>
											<th>Keuntungan</th>
											<th>Aksi</th>
										</tr>
										<tr>
											<td colspan="8">Tidak ada data.</td>
										</tr>
									</tbody>
								@endforelse
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

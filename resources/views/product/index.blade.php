@extends('layouts.main')
@section('title', 'Produk - ' . config('app.name'))
@section('content')
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm">
					<h1>Data Produk</h1>
				</div>
			</div>
		</div>
	</section>
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<a href="{{ route('products.create') }}" class="btn btn-primary float-right"><i class="nav-icon fa fa-plus"></i>  Tambah Produk</a>
						</div>
						<div class="card-body">
							<table class="table text-center table-responsive table-bordered table-hover">
								<thead>
									<tr>
										<th>No.</th>
										<th>Brand</th>
										<th>Kode Produk</th>
										<th>Nama Produk</th>
										<th>Modal</th>
										<th>Harga</th>
										<th>Size</th>
										<th>Warna</th>
										<th>Stok Awal</th>
										<th>Barang Masuk</th>
										<th>Barang Keluar</th>
										<th>Jumlah Stok</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									@forelse ($products as $product)
										<tr>
											<td>{{ $loop->iteration }}</td>
											<td>{{ $product->brand->name }}</td>
											<td>{{ $product->code }}</td>
											<td>{{ $product->name }}</td>
											<td>Rp {{ number_format($product->capital) }}</td>
											<td>Rp {{ number_format($product->price) }}</td>
											<td>{{ $product->size }}</td>
											<td>{{ $product->color }}</td>
											<td>-</td>
											<td>-</td>
											<td>-</td>
											<td>-</td>
											<td>
												<div class="dropdown">
													<button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
														Menu
													</button>
													<div class="dropdown-menu">
														<a class="dropdown-item" href="{{ route('products.edit', $product->id) }}">
															Ubah
														</a>
														<form class="d-inline" action="{{ route('products.destroy', $product->id) }}" method="POST">
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
                  @empty
										<tr>
											<td colspan="13" class="text-center">Data Tidak Ada</td>
										</tr>
									@endforelse
								</tbody>
							</table>
              {{ $products->links() }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection

@extends('layouts.main')
@section('title', 'Produk - ' . config('app.name'))
@section('content')
	<section class="content-header">
		<div class="container-fluid">
			<h1>Data Produk</h1>
		</div>
	</section>
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<a href="{{ route('products.create') }}" class="btn btn-primary float-right"><i class="nav-icon fa fa-plus"></i>  Tambah Data Produk</a>
						</div>
						<div class="card-body">
							<table class="table text-center table-bordered table-hover">
								<thead class="thead-dark">
									<tr>
										<th>No.</th>
										<th>Merek</th>
										<th>Kode Produk</th>
										<th>Nama Produk</th>
										<th>Modal</th>
										<th>Harga</th>
										<th>Ukuran</th>
										<th>Warna</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									@forelse ($products as $product)
										<tr>
											<td>{{ $loop->iteration }}.</td>
											<td>{{ $product->brand->name }}</td>
											<td>{{ $product->code }}</td>
											<td>{{ $product->name }}</td>
											<td>Rp {{ number_format($product->capital) }}</td>
											<td>Rp {{ number_format($product->price) }}</td>
											<td class="align-middle">
												@foreach ($product->sizes as $key => $size)
													<div class="d-flex justify-content-around">
														<span class="w-100" style="border-right: 1px solid #000; font-size: 14px">{{ $size->size }}</span>
														<span class="w-100" style="border-left: 1px solid #000; font-size: 14px">{{ $product->sizes[$key]->amount }}</span>
													</div>
												@endforeach
											</td>
											<td>{{ $product->color->name }}</td>
											<td>
												<div class="dropdown">
													<button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
														Menu
													</button>
													<div class="dropdown-menu">
														<a class="dropdown-item" href="{{ route('products.show', $product->id) }}">
															Detail
														</a>
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
											<td colspan="9">Tidak ada data.</td>
										</tr>
									@endforelse
								</tbody>
							</table>
							<div class="mt-3">
								{{ $products->links() }}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection

@extends('layouts.main')
@section('title', 'Merek - ' . config('app.name'))
@section('content')
	<section class="content-header">
		<div class="container-fluid">
			<h1>Data Merek</h1>
		</div>
	</section>
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<table id="table" class="table text-center table-bordered table-hover">
								<thead>
									<tr>
										<th>No.</th>
										<th>Kode</th>
										<th>Nama</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($brands as $brand)
										<tr>
											<td>{{ $loop->iteration }}.</td>
											<td>{{ $brand->code }}</td>
											<td>{{ $brand->name }}</td>
										</tr>
									@endforeach
								</tbody>
							</table>
							<div class="mt-3">
								{{ $brands->links() }}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
@push('styles')
	<link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css"></link>
@endpush
@push('scripts')
	<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
	<script>
		$(document).ready(() => {
			$('#table').DataTable({
				autoWidth: false,
				responsive: true,
				paging: false,
			});
		});
	</script>
@endpush

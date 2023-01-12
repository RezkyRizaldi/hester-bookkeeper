@extends('layouts.main')
@section('title', 'Toko - ' . config('app.name'))
@section('content')
	<section class="content-header">
		<div class="container-fluid">
			<h1>Data Toko</h1>
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
										<th>Nama</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($stores as $store)
										<tr>
											<td>{{ $loop->iteration }}.</td>
											<td>{{ $store->name }}</td>
										</tr>
									@endforeach
								</tbody>
							</table>
							<div class="mt-3">
								{{ $stores->links() }}
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

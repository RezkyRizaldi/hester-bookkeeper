<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>
<script src="{{ asset('assets/dist/js/pages/dashboard2.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
	$(document).ready(function () {
		$(".is_select2").select2();
		$(".format-currency").keyup(function (event) {
			if (event.which >= 37 && event.which <= 40) return;

			$(this).val((index, value) => value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
		});

		var Toast = Swal.mixin({
			toast: true,
			position: "top-end",
			showConfirmButton: false,
			timer: 3000,
		});

		@if (Session::has('success'))
			Toast.fire({
				icon: 'success',
				title: '{{ Session::get('success') }}'
			});
		@endif

		@if (Session::has('error'))
			Toast.fire({
				icon: 'error',
				title: '{{ Session::get('error') }}'
			});
		@endif
	});
</script>
@stack('scripts')


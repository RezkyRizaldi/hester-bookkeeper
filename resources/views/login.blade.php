<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=ed=ge">
	<link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}" />
	<title>Login - {{ config('app.name') }}</title>
</head>
<body class="d-flex text-center bg-dark text-light flex-column justify-content-center align-items-center h-100">
	@if (session()->has('error'))
		<div class="alert alert-dismissible alert-danger fade show mb-3" role="alert">
			{{ session('error') }}
			<button type="button" class="text-light close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	@endif
	<form action="{{ route('authenticate') }}" method="POST" class="w-100" style="max-width: 340px; padding: 15px;">
		@csrf
		<h1 class="h3 mb-3 font-weight-normal">{{ config('app.name') }}</h1>
		<label for="inputEmail" class="sr-only">Email</label>
		<input type="email" id="inputEmail" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" required autofocus value="{{ old('email') }}" />
		@error('email')
			<div class="invalid-feedback mb-3">{{ $message }}</div>
		@enderror
		<label for="inputPassword" class="sr-only">Password</label>
		<input type="password" id="inputPassword" name="password" class="form-control mb-3" placeholder="Password" required />
		<button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
	</form>
	<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>
</body>
</html>


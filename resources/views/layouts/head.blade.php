<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title')</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
  <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}" />
	@stack('styles')
  <link rel="stylesheet" href="{{ asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
  <style>
    .select2-container .select2-selection--single {
      height: 36px !important;
    }
		.select2-container--default .select2-selection--multiple .select2-selection__choice {
			background-color: #007bff;
			border-color: #006fe6;
			color: #fff;
			padding: 0 10px;
			margin-top: 0.31rem;
		}
		.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
				color: rgba(255,255,255,.7);
				float: right;
				margin-left: 5px;
				margin-right: -2px;
		}
    .hidden {
      display: none;
    }
  </style>
</head>

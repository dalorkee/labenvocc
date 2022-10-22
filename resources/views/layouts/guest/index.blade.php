<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="utf-8">
@yield('meta-token')
<meta name="description" content="Login">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
<title>{{ config('app.name', 'talek-team') }}</title>
<link rel="icon" type="image/png" href="{{ URL::asset('assets/img/favicon/favicon-32x32.png') }}" sizes="32x32">
<link rel="mask-icon" href="{{ URL::asset('assets/img/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
<link rel="apple-touch-icon" href="{{ URL::asset('assets/img/favicon/apple-touch-icon.png') }}" sizes="180x180">
<link rel="apple-touch-icon" sizes="50x50" href="{{ URL::asset('images/small-moph-logo.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ URL::asset('images/small-moph-logo-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('images/small-moph-logo-16x16.png') }}">
<link rel="shortcut icon" href="{{ URL::asset('images/favicon.ico') }}">
@include('layouts.guest.style')
@yield('style')
<style type="text/css">
.swal2-popup {font-size: 1rem !important; font-family: "Prompt"}
.hoverable	{
	color: #CAF7E3;
	font-weight: 400;
	display:inline-block;
	backface-visibility: hidden;
	vertical-align: middle;
	position:relative;
	box-shadow: 0 0 1px rgba(0,0,0,0);
	tranform: translateZ(0);
	transition-duration: .3s;
	transition-property:transform;
}
.hoverable:before {
	position:absolute;
	pointer-events: none;
	z-index:-1;
	content: '';
	top: 100%;
	left: 5%;
	height:10px;
	width:90%;
	opacity:0;
	background: -webkit-radial-gradient(center, ellipse, rgba(255, 255, 255, 0.35) 0%, rgba(255, 255, 255, 0) 80%);
	background: radial-gradient(ellipse at center, rgba(255, 255, 255, 0.35) 0%, rgba(255, 255, 255, 0) 80%);
	transition-duration: 0.3s;
	transition-property: transform, opacity;
}
.hoverable:hover, .hoverable:active, .hoverable:focus {
	transform: translateY(-5px);
}
.hoverable:hover:before, .hoverable:active:before, .hoverable:focus:before {
	opacity: 1;
	transform: translateY(-5px);
}
.navbar-nav > li {
	margin: 0 20px;
}
.swal2-popup {
	font-size: 1rem !important;
	font-family: "Prompt", Georgia, serif;
}
</style>
</head>
<body>
<div class="page-wrapper">
	<div class="page-inner">
		<div class="page-content-wrapper bg-white">
			@include('layouts.guest.header')
			@include('layouts.guest.nav')
			<main class="page-content">
				<div class="container">
					@if (Session::has('success'))
					<div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true"><i class="fal fa-times"></i></span>
						</button>
						<div class="d-flex align-items-center">
							<div class="alert-icon width-3">
								<span class="icon-stack icon-stack-md">
									<i class="base-7 icon-stack-3x color-success-600"></i>
									<i class="fal fa-check icon-stack-1x text-white"></i>
								</span>
							</div>
							<div class="flex-1">
								<span class="h5 m-0 fw-700">Success</span>
								{{ Session::get('success') }}
							</div>
						</div>
					</div>
					@endif
					@yield('content')
				</div>
			</main>
			@include('layouts.guest.footer')
		</div>
	</div>
</div>
@include('layouts.guest.script')
@yield('script')
<script>
$(document).ready(function() {
	var options = {
		"closeButton": true,
		"debug": false,
		"newestOnTop": true,
		"progressBar": true,
		"positionClass": "toast-top-right",
		"preventDuplicates": false,
		"onclick": null,
		"showDuration": 300,
		"hideDuration": 100,
		"timeOut": 5000,
		"extendedTimeOut": 1000,
		"showEasing": "swing",
		"hideEasing": "linear",
		"showMethod": "fadeIn",
		"hideMethod": "fadeOut"
	};
	@if ($errors->any())
		@foreach ($errors->all() as $error)
			toastr.error("{{ $error }}", "Error", options);
		@endforeach
		@php Session::forget("errors"); @endphp
	@endif
	@if (Session::has('success'))
		toastr.success("{{ Session::get('success') }}", "Success", options);
		Swal.fire({
			type: "success",
			title: "Success",
			text: "{{ Session::get('success') }}",
			confirmButtonText: "ตกลง",
			footer: "LAB ENV-OCC DDC",
			allowOutsideClick: false,
		});
		@php Session::forget("success"); @endphp
	@endif
	@if (Session::has('error'))
		toastr.error("{{ Session::get('error') }}", "Error", options);
		Swal.fire({
			type: "error",
			title: "<span class='text-danger'>เกิดข้อผิดพลาด</span>",
			text: "{{ Session::get('error') }}",
			confirmButtonText: "ตกลง",
			footer: "LAB ENV-OCC DDC",
			allowOutsideClick: false
		});
		@php Session::forget("error"); @endphp
	@endif
});
</script>
</body>
</html>

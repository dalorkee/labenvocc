<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="utf-8">
@yield('token')
<meta name="description" content="Introduction">
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
@include('layouts.style')
@yield('style')
<style type="text/css">.swal2-popup {font-size: 1rem !important; font-family: "Prompt", Georgia, serif;}</style>
</head>
<body class="mod-bg-1 ">
<div class="page-wrapper">
	<div class="page-inner">
		<aside class="page-sidebar">
			@include('layouts.aside')
		</aside>
		<div class="page-content-wrapper">
			<header class="page-header" role="banner">
				@include('layouts.header')
			</header>
			<main id="js-page-content" role="main" class="page-content">
				@yield('content')
			</main>
			<div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div>
			<footer class="page-footer" role="contentinfo">
				@include('layouts.footer')
			</footer>
			@include('components.modal-shortcut')
		</div>
	</div>
</div>
@include('components.quick-menu')
@include('components.messenger')
@include('components.page-settings')
@include('layouts.script')
@yield('script')
<script type="text/javascript">
$(document).ready(function() {
	let options = {
		"closeButton": true,
		"debug": false,
		"newestOnTop": true,
		"progressBar": false,
		"positionClass": "toast-top-right",
		"preventDuplicates": false,
		"onclick": null,
		"showDuration": 300,
		"hideDuration": 100,
		"timeOut": 5000,
		"extendedTimeOut": 0,
		"showEasing": "swing",
		"hideEasing": "linear",
		"showMethod": "fadeIn",
		"hideMethod": "fadeOut"
	};
	let options2 = {
		"closeButton": true,
		"debug": false,
		"newestOnTop": true,
		"progressBar": true,
		"positionClass": "toast-bottom-left",
		"preventDuplicates": true,
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
	let options3 = {
		"closeButton": true,
		"debug": false,
		"newestOnTop": true,
		"progressBar": true,
		"positionClass": "toast-top-right",
		"preventDuplicates": true,
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
		@php
			Session::forget("$errors");
		@endphp
	@endif
	@if (Session::has('success'))
		toastr.success("{{ Session::get('success') }}", "Success", options);
		Swal.fire({
			type: "success",
			title: "Success",
			html: "{{ Session::get('success') }}",
			confirmButtonText: "ตกลง",
			footer: "Lab Env-Occ",
			allowOutsideClick: false
		});
		@php
			Session::forget("success");
		@endphp
	@endif
	@if (Session::has('warning'))
		toastr.warning("{{ Session::get('warning') }}", "Warning", options);
		Swal.fire({
			type: "warning",
			title: "Warning",
			text: "{{ Session::get('warning') }}",
			confirmButtonText: "ตกลง",
			footer: "Lab Env-Occ",
			allowOutsideClick: false
		});
		@php
			Session::forget("warning");
		@endphp
	@endif
	@if (Session::has('error'))
		toastr.error("{{ Session::get('error') }}", "Lab Env-Occ", options);
		Swal.fire({
			type: "error",
			title: "Error",
			text: "{{ Session::get('error') }}",
			confirmButtonText: "ตกลง",
			footer: "Lab Env-Occ",
			allowOutsideClick: false
		});
		@php
			Session::forget("error");
		@endphp
	@endif
	@if (Session::has('action_notic'))
		toastr.info("{{ Session::get('action_notic') }}", "Lab Env-Occ", options2);
		@php
			Session::forget("action_notic");
		@endphp
	@endif
	@if (Session::has('destroy'))
		toastr.error("{{ Session::get('destroy') }}", "Lab Env-Occ", options3);
		@php
			Session::forget("destroy");
		@endphp
	@endif
});
</script>
@stack('scripts')
</body>
</html>

<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="utf-8">
<title>{{ config('app.name', 'PJX') }}</title>
<meta name="description" content="Introduction">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
<link rel="apple-touch-icon" sizes="50x50" href="{{ URL::asset('images/small-moph-logo.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ URL::asset('images/small-moph-logo-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('images/small-moph-logo-16x16.png') }}">
<link rel="shortcut icon" href="{{ URL::asset('images/favicon.ico') }}">
@yield('token')
@include('layouts.style')
@yield('style')
<style type="text/css">
.swal2-popup {font-size: 1rem !important; font-family: "Prompt", Georgia, serif;}
</style>
</head>
<body class="mod-bg-1 ">
<script>
'use strict';
var classHolder = document.getElementsByTagName("BODY")[0],
themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) :
{},
themeURL = themeSettings.themeURL || '',
themeOptions = themeSettings.themeOptions || '';
if (themeSettings.themeOptions) {
	classHolder.className = themeSettings.themeOptions;
	console.log("%c✔ Theme settings loaded", "color: #148f32");
} else {
	console.log("Heads up! Theme settings is empty or does not exist, loading default settings...");
}
if (themeSettings.themeURL && !document.getElementById('mytheme')) {
	var cssfile = document.createElement('link');
	cssfile.id = 'mytheme';
	cssfile.rel = 'stylesheet';
	cssfile.href = themeURL;
	document.getElementsByTagName('head')[0].appendChild(cssfile);
}
var saveSettings = function() {
	themeSettings.themeOptions = String(classHolder.className).split(/[^\w-]+/).filter(function(item) {
	return /^(nav|header|mod|display)-/i.test(item);
	}).join(' ');
	if (document.getElementById('mytheme')) {
		themeSettings.themeURL = document.getElementById('mytheme').getAttribute("href");
	};
	localStorage.setItem('themeSettings', JSON.stringify(themeSettings));
}
var resetSettings = function() {
	localStorage.setItem("themeSettings", "");
}
</script>
<!-- BEGIN Page Wrapper -->
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
<!-- END Page Wrapper -->
@include('components.quick-menu')
@include('components.messenger')
@include('components.page-settings')
@include('layouts.script')
@yield('script')
<script>
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
			Session::flush();
		@endphp
	@endif
	@if (Session::has('success'))
		toastr.success("{{ Session::get('success') }}", "Success", options);
		Swal.fire({
			type: "success",
			title: "<span class='text-success'>บันทึกข้อมูลสำเร็จแล้ว</span>",
			html: "{{ Session::get('success') }}",
			confirmButtonText: "ตกลง",
			footer: "LAB ENV-OCC DDC",
			allowOutsideClick: false
		});
		@php
			Session::forget("success");
			Session::flush();
		@endphp
	@endif
	@if (Session::has('warning'))
		toastr.warning("{{ Session::get('warning') }}", "Warning", options);
		Swal.fire({
			type: "warning",
			title: "เกิดข้อผิดพลาด",
			text: "{{ Session::get('warning') }}",
			confirmButtonText: "ตกลง",
			footer: "LAB ENV-OCC DDC",
			allowOutsideClick: false
		});
		@php
			Session::forget("warning");
			Session::flush();
		@endphp
	@endif
	@if (Session::has('error'))
		toastr.error("{{ Session::get('error') }}", "LabEnvOcc", options);
		@php
			Session::forget("error");
			Session::flush();
		@endphp
	@endif
	@if (Session::has('action_notic'))
		toastr.info("{{ Session::get('action_notic') }}", "LabEnvOcc", options2);
		@php
			Session::forget("action_notic");
			Session::flush();
		@endphp
	@endif
	@if (Session::has('destroy'))
		toastr.error("{{ Session::get('destroy') }}", "LabEnvOcc", options3);
		@php
			Session::forget("destroy");
			Session::flush();
		@endphp
	@endif
});
</script>
</body>
</html>

<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="utf-8">
<title>LAB ENV-OCC</title>
<meta name="description" content="Login">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="msapplication-tap-highlight" content="no">
@yield('meta-token')
<link rel="icon" type="image/png" sizes="32x32" href="{{ URL::asset('assets/img/favicon/favicon-32x32.png') }}">
<link rel="mask-icon" href="{{ URL::asset('assets/img/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
<link rel="apple-touch-icon" sizes="180x180" href="{{ URL::asset('assets/img/favicon/apple-touch-icon.png') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/vendors.bundle.css') }}" media="screen, print" >
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/app.bundle.css') }}" media="screen, print">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/app.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/fa-brands.css') }}" media="screen, print">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/fonts.css') }}" media="screen, print">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/notifications/toastr/toastr.css') }}" media="screen, print">
@yield('style')
<style type="text/css">
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
</style>
</head>
<body>
<div class="page-wrapper">
	<div class="page-inner bg-brand-gradient">
		<div class="page-content-wrapper bg-transparent m-0">
			<div class="h-40 w-100 shadow-lg px-4 bg-brand-gradient">
				<div class="d-flex align-items-center container p-0">
					<div>
						<a href="javascript:void(0)" class="page-logo-link press-scale-down d-flex align-items-center">
							<img src="{{ URL::asset('assets/img/moph-logo-160x154.png') }}" alt="logo" aria-roledescription="logo">
							<div class="page-logo-text mr-1 text-4xl font-kanitextralight">ระบบห้องปฏิบัติการกองโรคจากการประกอบอาชีพและสิ่งแวดล้อม</div>
						</a>
					</div>
				</div>
			</div>
			<nav class="navbar navbar-expand-lg bg-green-900 font-sarabun-medium">
				<div class="d-flex align-items-center container p-0">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
					<span><i class="fal fa-bars text-green-100 text-2xl"></i></span>
				</button>
				<div class="collapse navbar-collapse text-2xl font-kanitextralight" id="navbarColor01">
					<ul class="navbar-nav m-auto">
						<li class="nav-item active">
							<a class="nav-link hoverable" href="{{ route('login') }}"><i class="fal fa-home"></i> หน้าแรก <span class="sr-only">(current)</span></a>
						</li>
						<li class="nav-item">
							<a class="nav-link hoverable" href="#">เกี่ยวกับหน่วยงาน</a>
						</li>
						<li class="nav-item">
							<a class="nav-link hoverable" href="#">ดาวน์โหลด</a>
						</li>
						<li class="nav-item">
							<a class="nav-link hoverable" href="#">คำถามที่พบบ่อย</a>
						</li>
						<li class="nav-item">
							<a class="nav-link hoverable" href="#">ติดต่อหน่วยงาน</a>
						</li>
					</ul>
				</div>
				</div>
			</nav>
			<div class="flex-1 bg-white">
				<div class="container">
					{{-- @if ($errors->any())
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true"><i class="fal fa-times"></i></span>
						</button>
						<div class="d-flex align-items-center">
							<div class="alert-icon width-2">
								<span class="icon-stack" style="font-size: 22px;">
									<i class="base-2 icon-stack-3x color-primary-400"></i>
									<i class="base-10 text-white icon-stack-1x"></i>
									<i class="ni md-profile color-primary-800 icon-stack-2x"></i>
								</span>
							</div>
							<div class="flex-1">
								<ul>
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						</div>
					</div>
					@endif --}}
					@yield('content')
				</div>
				@include('layouts.guest.footer')
			</div>
		</div>
	</div>
</div>
<script src="{{ URL::asset('assets/js/vendors.bundle.js') }}"></script>
<script src="{{ URL::asset('assets/js/app.bundle.js') }}"></script>
<script src="{{ URL::asset('assets/js/notifications/toastr/toastr.js') }}"></script>
@yield('script')
<script>
$(document).ready(function() {
	var options = {
		"closeButton": true,
		"debug": false,
		"newestOnTop": true,
		"progressBar": false,
		"positionClass": "toast-top-right",
		"preventDuplicates": false,
		"onclick": null,
		"showDuration": 300,
		"hideDuration": 100,
		"timeOut": 0,
		"extendedTimeOut": 0,
		"showEasing": "swing",
		"hideEasing": "linear",
		"showMethod": "fadeIn",
		"hideMethod": "fadeOut"
	};
	@if ($errors->any())
		@foreach ($errors->all() as $error)
			toastr.error('{{ $error }}', 'Lab EnvOcc', options)
		@endforeach
		@php Session::forget('errors'); @endphp
	@endif

});
</script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>LAB ENV-OCC</title>
	<meta name="description" content="Login">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="msapplication-tap-highlight" content="no">
	<link rel="icon" type="image/png" sizes="32x32" href="{{ URL::asset('assets/img/favicon/favicon-32x32.png') }}">
	<link rel="mask-icon" href="{{ URL::asset('assets/img/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
	<link rel="apple-touch-icon" sizes="180x180" href="{{ URL::asset('assets/img/favicon/apple-touch-icon.png') }}">
	<link rel="stylesheet" href="{{ URL::asset('assets/css/vendors.bundle.css') }}" media="screen, print" >
	<link rel="stylesheet" href="{{ URL::asset('assets/css/app.bundle.css') }}" media="screen, print">
	<link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('assets/css/fa-brands.css') }}" media="screen, print">
	<link rel="stylesheet" href="{{ URL::asset('css/fonts.css') }}" media="screen, print">
	<style>
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
	.hoverable:hover, .hoverable:active, .hoverable:focus{
		transform: translateY(-5px);
	}
	.hoverable:hover:before, .hoverable:active:before, .hoverable:focus:before{
		opacity: 1;
		transform: translateY(-5px);
	}
	.navbar-nav > li {
		margin: 0 20px;
	}
	</style>
	@yield('style')
</head>
<body>
<div class="page-wrapper">
	<div class="page-inner bg-brand-gradient">
		<div class="page-content-wrapper bg-transparent m-0">
			<div class="h-40 w-100 shadow-lg px-4 bg-brand-gradient">
				<div class="d-flex align-items-center container p-0">
					<div class="">
						<a href="javascript:void(0)" class="page-logo-link press-scale-down d-flex align-items-center">
							<img src="{{ URL::asset('assets/img/moph-logo-120x120.png') }}" alt="logo" aria-roledescription="logo">
							<div class="page-logo-text mr-1 text-4xl">ระบบห้องปฏิบัติการกองโรคจากการประกอบอาชีพและสิ่งแวดล้อม</div>
						</a>
					</div>
				</div>
			</div>
			<nav class="navbar navbar-expand-lg bg-green-900">
				<div class="d-flex align-items-center container p-0">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
					<span><i class="fal fa-bars text-green-100 text-2xl"></i></span>
				</button>
				<div class="collapse navbar-collapse text-2xl" id="navbarColor01">
					<ul class="navbar-nav m-auto">
						<li class="nav-item active">
							<a class="nav-link hoverable" href="#"><i class="fal fa-home"></i> หน้าแรก <span class="sr-only">(current)</span></a>
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
				<div class="container ">
					@yield('content')
				</div>
				@include('layouts.guest.footer')
			</div>
		</div>
	</div>
</div>
<script src="{{ URL::asset('assets/js/vendors.bundle.js') }}"></script>
<script src="{{ URL::asset('assets/js/app.bundle.js') }}"></script>
@yield('script')
</body>
</html>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="utf-8">
<title>LAB ENV-OCC</title>
<meta name="description" content="Login">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="msapplication-tap-highlight" content="no">
@yield('meta-token')
@include('layouts.guest.style')
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
					{{-- @yield('content') --}}

                        <!-- notice the utilities added to the wrapper below -->
                        <div class="d-flex flex-grow-1 p-0 shadow-1">
                            <!-- left slider panel : must have unique ID-->
                            <div id="js-slide-left" class="flex-wrap flex-shrink-0 position-relative slide-on-mobile slide-on-mobile-left bg-primary-200 pattern-0 p-3">
                                <div class="alert alert-primary">
                                    aaa These side panels slide out on mobile view port and can be activated by a button as an "slide in/out" mode.
                                </div>
                            </div>
                            <!-- left slider panel backdrop : activated on mobile, must be place immideately after left slider closing tag -->
                            <div class="slide-backdrop" data-action="toggle" data-class="slide-on-mobile-left-show" data-target="#js-slide-left"></div>
                            <!-- middle content area -->
                            <div class="d-flex flex-column flex-grow-1 bg-white">
                                <div class="p-3">
                                    <div class="row hidden-lg-up mb-g">
                                        <div class="col-6">
                                            <!-- this button is activated on mobile view and activates the left panel -->
                                            <a href="javascript:void(0);" class="btn btn-primary btn-block btn-lg" data-action="toggle" data-class="slide-on-mobile-left-show" data-target="#js-slide-left">
                                                open left panel
                                            </a>
                                        </div>
                                    </div>
                                    <div class="panel-tag">
                                        <p>These side panels slide out on mobile view port and can be activated by a button as an "slide in/out" mode. We use the classes <code>.slide-on-mobile</code> and <code>.slide-on-mobile-{left,right}</code> on the panels, which are then activated on mobile viewport by toggling the class <code>.slide-on-mobile-{left,right}-show</code></p>
                                        <p>
                                            The backdrop is inserted right after the closing tag of the <code>.slider-on-mobile</code> container. Generally this slide panel is pared with <code>.layout-composed</code> to give it a nice clean look.
                                        </p>
                                        <a href="#" class="btn btn-secondary" data-action="toggle" data-class="layout-composed">Try with Composed Layout</a>
                                    </div>
                                    <div class="d-flex hidden-lg-down">
                                        <img src="img/demo/side-panel-demo.gif" alt="" class="m-auto shadow">
                                    </div>
                                </div>
                            </div>
                            <!-- right slider panel backdrop : activated on mobile, must be place immideately after right slider closing tag -->
                            <div class="slide-backdrop" data-action="toggle" data-class="slide-on-mobile-right-show" data-target="#js-slide-right"></div>
                        </div>


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
			toastr.error("{{ $error }}", "Error", options);
		@endforeach
		@php Session::forget("errors"); @endphp
	@endif
	@if (Session::has('success'))
		toastr.success("{{ Session::get('success') }}", "Success", options);
		Swal.fire({
			type: "success",
			title: "บันทึกข้อมูลสำเร็จแล้ว",
			text: "เราได้รับข้อมูลของท่านแล้ว โปรดรอการติดต่อกลับจากเจ้าหน้าที่",
			confirmButtonText: "ตกลง",
			footer: "LAB ENV-OCC DDC",
			allowOutsideClick: false
		});
		@php Session::forget("success"); @endphp
	@endif
});
</script>
</body>
</html>

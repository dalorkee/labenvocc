@extends('layouts.guest.index')
@section('meta-token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('style')
<link href="{{ URL::asset('css/step.css') }}" rel="stylesheet">
<style type="text/css">
.text-primary-1 {color: #1877F2 !important}
.panel-hdr h2{font-size: 1.275em;}
::-webkit-input-placeholder{ /* Edge */font-size: 1em;}
:-ms-input-placeholder{ /* IE 10-11 */font-size: 1em;}
::placeholder{font-size: 1em;}
.field-icon {
	float: right;
	margin-left: -25px;
	margin-top: -30px;
	padding-right: 6px;
	font-size: 1.275em;
	position: relative;
	z-index: 2;
	color: #F57C00
}
</style>
@endsection
@section('content')
<div class="row font-prompt mt-4 mb-6">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
		<h2 class="fw-600 mt-4 text-xl text-center">ลงทะเบียน : <span class="text-primary-1">บุคคลทั่วไป</span></h2>
	</div>
</div>
<div class="row font-prompt mt-6 mb-6">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
		<ul class="list-unstyled multi-steps">
			<li>บุคคลทั่วไป</li>
			<li>ข้อมูลผู้รับบริการ</li>
			<li>ข้อมูลติดต่อ</li>
			<li class="is-active">บัญชีผู้ใช้</li>
			<li>ตรวจสอบข้อมูล</li>
		</ul>
	</div>
</div>
<div class="row font-prompt">
	<div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12">
		<div class="alert alert-danger font-prompt text-sm">
			<section>
				<h2 class="text-red-900">เงื่อนไขในการกำหนด ชื่อผู้ใช้</h2>
				<ol class="pl-2 text-red-500">
					<li>1. มีความยาว 6-10 ตัวอักษร</li>
					<li>2. ใช้ตัวอักษร A-Z, a-z, 0-9</li>
				</ol>
			</section>
			<section class="mt-4">
				<h2 class="text-red-900">เงื่อนไขในการกำหนด รหัสผ่าน</h2>
				<ol class="pl-2 text-red-500">
					<li>1. มีความยาว 8-12 ตัวอักษร</li>
					<li>2. รหัสผ่านต้องสามารถใช้เป็น A-Z, a-z, 0-9</li>
				</ol>
			</section>
		</div>
	</div>
</div>
<div class="row font-prompt">
	<div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12">
		<section>
			<form name="step4" action="{{ route('register.personal.step4.post') }}" method="POST" class="needs-validation" novalidate>
				@csrf
				<fieldset>
					<div class="panel">
						<div class="panel-hdr">
							<h2 class="text-primary-1"><i class="fal fa-clipboard"></i>&nbsp;&nbsp;บัญชีผู้ใช้</h2>
							<div class="panel-toolbar">
								<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"><i class="fal fa-expand"></i></button>
							</div>
						</div>
						<div class="panel-container show">
							<div class="panel-content">
								<div class="mt-0 sm:mt-0">
									<div class="md:grid md:grid-cols-1">
										<div class="mt-2 md:mt-0 md:col-span-2">
											<div class="overflow-hidden">
												<div class="px-6 pt-5 pb-16">
													<div class="grid grid-cols-6 gap-6">
														<div class="col-span-6 sm:col-span-3">
															<label for="user_name" class="block text-base font-medium text-gray-700">ชื่อผู้ใช้ <span class="text-red-600">*</span></label>
															<input type="text" name="username" value="{{ (isset($userLoginData->username)) ? $userLoginData->username : old('username') }}" class="form-control @error('username') is-invalid @enderror mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300" maxlength="60" size="60" required>
															<div class="invalid-feedback" role="alert">@if ($errors->any()) @error('username') {{ $message }} @enderror @else {{ 'โปรดกรอกชื่อผู้ใช้' }} @endif</div>
														</div>
														<div class="col-span-6 sm:col-span-3">
															<label for="user_email" class="block text-base font-medium text-gray-700">อีเมล์ <span class="text-red-600">*</span></label>
															<input type="email" name="email" value="{{ (isset($userLoginData->email)) ? $userLoginData->email : old('email') }}" id="user_email" class="form-control @error('email') is-invalid @enderror mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300" maxlength="60" size="60" required>
															<div class="invalid-feedback" role="alert">@if ($errors->any()) @error('email') {{ $message }} @enderror @else {{ 'โปรดกรอกอีเมล์' }} @endif</div>
														</div>
														<div class="col-span-6 sm:col-span-3">
															<label for="user_password" class="block text-base font-medium text-gray-700">รหัสผ่าน (อย่างน้อย 6 ตัว) <span class="text-red-600">*</span></label>
															<input type="password" name="password" value="{{ (isset($userLoginData->password)) ? $userLoginData->password : old('password') }}" id="user_password" class="form-control @error('password') is-invalid @enderror mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300" maxlength="60" size="60" required>
															<span toggle="#user_password" class="fal fa-eye field-icon toggle-password"></span>
															<div class="invalid-feedback" role="alert">@if ($errors->any()) @error('password') {{ $message }} @enderror @else {{ 'โปรดกรอกรหัสผ่าน' }} @endif</div>
														</div>
														<div class="col-span-6 sm:col-span-3">
															<label for="user_confirm_password" class="is-invalid block text-base font-medium text-gray-700">ยืนยันรหัสผ่าน <span class="text-red-600">*</span></label>
															<input type="password" name="password_confirmation" value="{{ (isset($userLoginData->password_confirmation)) ? $userLoginData->password_confirmation : old('password_confirmation') }}" id="user_confirm_password" class="form-control @error('password_confirmation') is-invalid @enderror mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300" maxlength="60" size="60" required>
															<span toggle="#user_confirm_password" class="fal fa-eye field-icon toggle-confirm-password"></span>
															<div class="invalid-feedback" role="alert">@if ($errors->any()) @error('password_confirmation') {{ $message }} @enderror @else {{ 'โปรดกรอกยืนยันรหัสผ่าน' }} @endif</div>
															<div style="margin-top: 7px;" id="CheckPasswordMatch"></div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="text-center">
						<a href="{{ route('register.personal.step3.get') }}" type="button" class="btn btn-warning btn-pills" style="width: 110px;"><i class="fal fa-arrow-left"></i> ก่อนหน้า</a>
						<button type="submit" class="btn btn-success btn-pills" style="width: 110px;">ถัดไป <i class="fal fa-arrow-right"></i></button>
					</div>
				</fieldset>
			</form>
		</section>
	</div>
</div>
@endsection
@section('script')
<script src="{{ URL::asset('assets/js/formplugins/select2/select2.bundle.js') }}"></script>
<script>
$(document).ready(function() {
	$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
	$(".toggle-password").click(function() {
		$(this).toggleClass("fa-eye fa-eye-slash");
		var type = $($(this).attr("toggle"));
		if (type.attr("type") == "password") {
			type.attr("type", "text");
		} else {
			type.attr("type", "password");
		}
	});
	$(".toggle-confirm-password").click(function() {
		$(this).toggleClass("fa-eye fa-eye-slash");
		var type = $($(this).attr("toggle"));
		if (type.attr("type") == "password") {
			type.attr("type", "text");
		} else {
			type.attr("type", "password");
		}
	});
	$("#user_confirm_password").on('keyup', function() {
		var password = $("#user_password").val();
		var confirmPassword = $("#user_confirm_password").val();
		if (password != confirmPassword)
			$("#CheckPasswordMatch").html("Password does not match !").css("color","red");
		else
			$("#CheckPasswordMatch").html("Password match !").css("color","green");
	});
});
</script>
<script>
(function() {
	'use strict';
	window.addEventListener('load', function() {
		var forms = document.getElementsByClassName('needs-validation');
		// Loop over them and prevent submission
		var validation = Array.prototype.filter.call(forms, function(form) {
			form.addEventListener('submit', function(event) {
				if (form.checkValidity() === false) {
					event.preventDefault();
					event.stopPropagation();
				}
				form.classList.add('was-validated');
			}, false);
		});
	}, false);
})();
</script>
@endsection


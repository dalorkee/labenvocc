@extends('layouts.guest.index')
@section('meta-token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('style')
<link href="{{ URL::asset('css/step.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/css/ionicons.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/css/formplugins/select2/select2.bundle.css') }}" rel="stylesheet">
<style type="text/css">
.select2{width:100%!important;}
.select2-selection{overflow:hidden;}
.select2-selection__rendered{white-space:normal;word-break:break-all;}
.select2-selection__rendered{line-height:39px!important;}
.select2-container .select2-selection--single{height:38px!important;border:1px solid #cccccc;border-radius:0;}
.select2-selection__arrow{height:37px!important;}
.custom-control-label{font-size: 1.175em;}
.title {text-align: center;padding-bottom: 10px;}
.title h1, .form-title-label{font: 400 24px/28px "cs_chatthaiuiregular";color: #01937C;padding-bottom: 5px;}
.title p{font: 400 18px/24px "cs_chatthaiuiregular";color: #01937C;}
.panel-hdr h2{font-size: 1.275em;color: #1abc9c;}
fieldset h2{font-size: 1em;font-weight: 400;}
.form-label, .custom-control-label{font-size: 1em;font-weight: 400;}
::-webkit-input-placeholder{ /* Edge */font-size: 1em;}
:-ms-input-placeholder{ /* IE 10-11 */font-size: 1em;}
::placeholder{font-size: 1em;}
.captcha img{border: 1px solid blue;}
input[type="text"]:disabled{background: #eeeeee !important;}
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
		<h2 class="fw-600 mt-4 text-xl text-center">ลงทะเบียน : <span class="text-primary">บุคคลทั่วไป</span></h2>
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
					<li>1. มีความยาว 8-12 ตัวอักษร</li>
					<li>2. ชื่อผู้ใช้สามารถเป็น A-Z a-z อักษรพิเศษ(#,?,!,@,$,%,^,&,*,-) หรือตัวเลข(0-9) อย่างใดอย่างหนึ่ง</li>
				</ol>
			</section>
			<section class="mt-4">
				<h2 class="text-red-900">เงื่อนไขในการกำหนด รหัสผ่าน</h2>
				<ol class="pl-2 text-red-500">
					<li>1. มีความยาว 8-12 ตัวอักษร</li>
					<li>2. ตัวอักษรตัวแรกเป็นตัวพิมพ์ใหญ่ (A-Z)</li>
					<li>3. ตัวอักษรถัดไปสามารถเป็น a-z อย่างน้อย 1 ตัวอักษร อักษรพิเศษ(#,?,!,@,$,%,^,&,*,-) อย่างน้อย 1 ตัวอักษร และตัวเลข(0-9) อย่างน้อย 1 ตัวอักษร</li>
				</ol>
			</section>
		</div>
	</div>
</div>
<div class="row font-prompt">
	<div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12">
		<section>
			<form action="{{ route('register.personal.step4.post') }}" method="POST" class="needs-validation" novalidate>
				@csrf
				<fieldset>
					<div class="panel">
						<div class="panel-hdr">
							<h2><i class="fal fa-clipboard"></i>&nbsp;&nbsp;บัญชีผู้ใช้</h2>
							<div class="panel-toolbar">
								<button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
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
															<input type="text" name="username" value="{{ $userLoginData->username ?? "" }}" class="form-control mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300" maxlength="60" size="60" required>
															<div class="invalid-feedback">โปรดกรอกชื่อผู้ใช้</div>
														</div>
														<div class="col-span-6 sm:col-span-3">
															<label for="user_email" class="block text-base font-medium text-gray-700">อีเมล์ <span class="text-red-600">*</span></label>
															<input type="email" name="email" value="{{ $userLoginData->email ?? "" }}" id="user_email" class="form-control mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300" maxlength="60" size="60" required>
															<div class="invalid-feedback">โปรดกรอกอีเมล์</div>
														</div>
														<div class="col-span-6 sm:col-span-3">
															<label for="user_password" class="block text-base font-medium text-gray-700">รหัสผ่าน (อย่างน้อย 6 ตัว) <span class="text-red-600">*</span></label>
															<input type="password" name="password" value="{{ $userLoginData->password ?? "" }}" id="user_password" class="form-control mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300" maxlength="60" size="60" required>
															<span toggle="#user_password" class="fal fa-eye field-icon toggle-password"></span>
															<div class="invalid-feedback">โปรดกรอกรหัสผ่าน</div>
														</div>
														<div class="col-span-6 sm:col-span-3">
															<label for="user_confirm_password" class="is-invalid block text-base font-medium text-gray-700">ยืนยันรหัสผ่าน <span class="text-red-600">*</span></label>
															<input type="password" name="password_confirmation" value="{{ $userLoginData->password_confirmation ?? "" }}" id="user_confirm_password" class="form-control mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300" maxlength="60" size="60" required>
															<span toggle="#user_confirm_password" class="fal fa-eye field-icon toggle-confirm-password"></span>
															<div class="invalid-feedback">โปรดกรอกยืนยันรหัสผ่าน</div>
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
});
</script>
<script>
$(document).ready(function() {
	$(function() {
		$('.select2').select2();
		$(".select2-placeholder-multiple").select2({placeholder: "-- โปรดระบุ --"});
		$(".js-hide-search").select2({minimumResultsForSearch: 1 / 0});
		$(".js-max-length").select2({maximumSelectionLength: 2, placeholder: "Select maximum 2 items"});
		$(".select2-placeholder").select2({placeholder: "-- โปรดระบุ --", allowClear: true});
		$(".js-select2-icons").select2({
			minimumResultsForSearch: 1 / 0,
			templateResult: icon,
			templateSelection: icon,
			escapeMarkup: function(elm){
				return elm
			}
		});
		function icon(elm){
			elm.element;
			return elm.id ? "<i class='" + $(elm.element).data("icon") + " mr-2'></i>" + elm.text : elm.text
		}
	});
	function formatRepo (repo) {
		if (repo.loading) return repo.text;
		var markup = "<div class='select2-result-repository clearfix'>" +
			"<div class='select2-result-repository__meta'>" +
			"<div class='select2-result-repository__title'>" + repo.value + "</div></div></div>";
			return markup;
	}
	function formatRepoSelection (repo) {
		return repo.value || repo.text;
	}
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
<script>
$(document).ready(function () {
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
@endsection


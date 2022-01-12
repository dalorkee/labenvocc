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
.panel-hdr h2{font-size: 1.275em;color: #1abc9c;}
fieldset h2{font-size: 1em;font-weight: 400;}
.form-label, .custom-control-label{font-size: 1em;font-weight: 400;}
::-webkit-input-placeholder{ /* Edge */font-size: 1em;}
:-ms-input-placeholder{ /* IE 10-11 */font-size: 1em;}
::placeholder{font-size: 1em;}
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
			<li class="is-active">ข้อมูลผู้รับบริการ</li>
			<li>ข้อมูลติดต่อ</li>
			<li>บัญชีผู้ใช้</li>
		</ul>
	</div>
</div>
{{-- <div class="row mt-10">
	<div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12">
		<div class="alert alert-danger font-prompt">
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
</div> --}}
<div class="row font-prompt">
	<div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12">
		<section>
			<form action="{{ route('register.personal.step2.post') }}" method="POST" class="needs-validation" novalidate>
				@csrf
				<fieldset>
					<div class="panel">
						<div class="panel-hdr">
							<h2><i class="fal fa-clipboard"></i>&nbsp;&nbsp;ข้อมูลผู้รับบริการ</h2>
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
												<div class="px-6 pt-2 pb-16">
													<div class="grid grid-cols-6 gap-6">
														<div class="col-span-6 sm:col-span-6">
															<label for="title_name" class="block text-base font-medium text-gray-800">คำนำหน้าชื่อ <span class="text-red-600">*</span></label>
															<div class="frame-wrap">
																<div class="custom-control custom-switch custom-control-inline">
																	<input type="radio" name="title_name" value="mr" id="mister" class="custom-control-input" {{{ (isset($userData->title_name) && $userData->title_name  == 'mr') ? "checked" : "" }}} required="">
																	<label class="custom-control-label" for="mister">นาย</label>
																</div>
																<div class="custom-control custom-switch custom-control-inline">
																	<input type="radio" name="title_name" value="mrs" id="mistress" class="custom-control-input" {{{ (isset($userData->title_name) && $userData->title_name  == 'mrs') ? "checked" : "" }}} required="">
																	<label class="custom-control-label" for="mistress">นาง</label>
																</div>
																<div class="custom-control custom-switch custom-control-inline">
																	<input type="radio" name="title_name" value="miss" id="miss" class="custom-control-input" {{{ (isset($userData->title_name) && $userData->title_name  == 'miss') ? "checked" : "" }}} required="">
																	<label class="custom-control-label" for="miss">นางสาว</label>
																	<div class="invalid-feedback">โปรดเลือกคำนำหน้าชื่อ</div>
																</div>
															</div>
														</div>
														<div class="col-span-6 sm:col-span-3">
															<label for="first_name" class="block text-base font-medium text-gray-800">ชื่อ <span class="text-red-600">*</span></label>
															<input type="text" name="first_name" value="{{ $userData->first_name ?? '' }}" class="form-control mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300" maxlength="100" size="100" required>
															<div class="invalid-feedback">โปรดกรอกชื่อ</div>
														</div>
														<div class="col-span-6 sm:col-span-3">
															<label for="last_name" class="block text-base font-medium text-gray-800">นามสกุล <span class="text-red-600">*</span></label>
															<input type="text" name="last_name" value="{{ $userData->last_name ?? '' }}" class="form-control mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300" maxlength="100" size="100" required>
															<div class="invalid-feedback">โปรดกรอกนามสกุล</div>
														</div>
														<div class="col-span-6 sm:col-span-3">
															<label for="id_card" class="block text-base font-medium text-gray-800">เลขบัตรประชาชน <span class="text-red-600">*</span></label>
															<input type="text" name="id_card" value="{{ (Session::has('id_card')) ? Session::get('id_card') : '' }}" class="form-control mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300" maxlength="13" size="13" pattern="^\d{13}$" required>
															<div class="invalid-feedback">โปรดกรอกเลขบัตรประชาชน</div>
														</div>
														<div class="col-span-6 sm:col-span-3">
															<label for="taxpayer_no" class="block text-base font-medium text-gray-800">เลขผู้เสียภาษี</label>
															<input type="text" name="taxpayer_no" value="{{ (Session::has('taxpayer_no')) ? Session::get('taxpayer_no') : '' }}" class="form-control mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300" maxlength="100" size="100">
														</div>
														<div class="col-span-6 sm:col-span-3">
															<label for="email" class="block text-base font-medium text-gray-800">อีเมล์ <span class="text-red-600">*</span></label>
															<input type="text" name="email" value="{{ (Session::has('email')) ? Session::get('email') : '' }}" class="form-control mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
															<div class="invalid-feedback">โปรดกรอกอีเมล์</div>
														</div>
														<div class="col-span-6 sm:col-span-3">
															<label for="mobile" class="block text-base font-medium text-gray-800">โทรศัพท์เคลื่อนที่ <span class="text-red-600">*</span></label>
															<input type="tel" name="mobile" value="{{ (Session::has('mobile')) ? Session::get('mobile') : '' }}" class="form-control mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300" maxlength="10" size="10" pattern="^\d{10}$" required>
															<div class="invalid-feedback">โปรดกรอกโทรศัพท์เคลื่อนที่ 10 หลัก</div>
														</div>
													</div>
													<div class="grid grid-cols-6 gap-6 mt-4">
														<div class="col-span-6 sm:col-span-6">
															<label for="address" class="block text-base font-medium text-gray-800">ที่อยู่ (เลขที่ หมู่ที่ หมู่บ้าน/อาคาร ถนน) <span class="text-red-600">*</span></label>
															<input type="text" name="address" value="{{ (Session::has('address')) ? Session::get('address') : '' }}" class="form-control mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300" maxlength="200" size="200" required>
															<div class="invalid-feedback">โปรดกรอกโทรศัพท์เคลื่อนที่</div>
														</div>
														<div class="col-span-6 sm:col-span-3 form-group">
															<label for="province" class="form-label block text-base font-medium text-gray-800">จังหวัด <span class="text-red-600">*</span></label>
															<select name="province" id="province" class="custom-select" required="">
																@if (Session::has('province')) <option value="{{ Session::get('province') }}">{{ $provinces[Session::get('province')] }}</option> @endif
																<option value="">-- โปรดเลือก --</option>
																@foreach ($provinces as $key => $val)
																	<option value="{{ $key }}">{{ $val }}</option>
																@endforeach
															</select>
															<div class="invalid-feedback">โปรดเลือกจังหวัด</div>
														</div>
														<div class="col-span-6 sm:col-span-3">
															<label for="district" class="block text-base font-medium text-gray-800">เขต/อำเภอ <span class="text-red-600">*</span></label>
															<select name="district" id="district" class="form-control" required="">
																@if (Session::has('district')) <option value="{{ Session::get('district') }}">{{ Session::get('district') }}</option> @endif
																<option value="">-- โปรดเลือก --</option>
															</select>
															<div class="invalid-feedback">โปรดเลือกอำเภอ</div>
														</div>
														<div class="col-span-6 sm:col-span-3">
															<label for="sub_district" class="block text-base font-medium text-gray-800">แขวง/ตำบล <span class="text-red-600">*</span></label>
															<select name="sub_district" id="sub_district" class="form-control" required="">
																@if (Session::has('sub_district')) <option value="{{ Session::get('sub_district') }}">{{ Session::get('sub_district') }}</option> @endif
																<option value="">-- โปรดเลือก --</option>
															</select>
															<div class="invalid-feedback">โปรดเลือกตำบล</div>
														</div>
														<div class="col-span-6 sm:col-span-3">
															<label for="zip_code" class="block text-base font-medium text-gray-800">รหัสไปรษณีย์ <span class="text-red-600">*</span></label>
															<input type="text" name="postal" value="{{ (Session::has('postal')) ? Session::get('postal') : '' }}" id="postcode" class="form-control mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300" maxlength="10" size="10" required>
															<div class="invalid-feedback">โปรดกรอกรหัสไปรษณีย์</div>
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
						<a href="{{ route('register.index') }}" type="button" class="btn btn-warning btn-pills" style="width: 110px;"><i class="fal fa-arrow-left"></i> ก่อนหน้า</a>
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
	$('input[name="title_name"]').on('change', function() {
		$('input[name="' + this.name + '"]').not(this).prop('checked', false);
	});
	$('#province').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('register.district') }}",
				dataType: "html",
				data: {id:id},
				success: function(response) {
					$('#district').html(response);
				},
				error: function(jqXhr, textStatus, errorMessage) {
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});
	$('#district').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('register.subDistrict') }}",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#sub_district').html(response);
				},
				error: function(jqXhr, textStatus, errorMessage) {
					alert('Sub district error: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});
	$('#sub_district').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('register.postcode') }}",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#postcode').val(response);
				},
				error: function(jqXhr, textStatus, errorMessage) {
					alert('Postcode error: ' + jqXhr.status + errorMessage);
				}
			});
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
(function($) {
	"use strict";
	function verificationForm() {
		var current_fs, next_fs, previous_fs;
		var left, opacity, scale;
		var animating;
		$(".next").click(function () {
			if (animating) return false;
			animating = true;
			current_fs = $(this).parent();
			next_fs = $(this).parent().next();
			$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
			next_fs.show();
			current_fs.animate({
				opacity: 0
			}, {
				step: function (now, mx) {
					scale = 1 - (1 - now) * 0.2;
					left = (now * 50) + "%";
					opacity = 1 - now;
					current_fs.css({
						'transform': 'scale(' + scale + ')',
						'position': 'absolute'
					});
					next_fs.css({
						'left': left,
						'opacity': opacity
					});
				},
				duration: 800,
				complete: function () {
					current_fs.hide();
					animating = false;
				},
				easing: 'easeInOutBack'
			});
			$("html, body").animate({ scrollTop: $("#regis-title").offset().top}, 2000);
		});
		$(".previous").click(function () {
			if (animating) return false;
			animating = true;
			current_fs = $(this).parent();
			previous_fs = $(this).parent().prev();
			$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
			previous_fs.show();
			current_fs.animate({
				opacity: 0
			}, {
				step: function (now, mx) {
					scale = 0.8 + (1 - now) * 0.2;
					left = ((1 - now) * 50) + "%";
					opacity = 1 - now;
					current_fs.css({
						'left': left
					});
					previous_fs.css({
						'transform': 'scale(' + scale + ')',
						'opacity': opacity
					});
				},
				duration: 800,
				complete: function () {
					current_fs.hide();
					animating = false;
				},
				easing: 'easeInOutBack'
			});
			$("html, body").animate({ scrollTop: $("#regis-title").offset().top}, 2000);
		});
	};
	verificationForm ();
})(jQuery);
</script>
<script>
(function() {
	'use strict';
	window.addEventListener('load', function() {
		var forms = document.getElementsByClassName('needs-validation');
		// Loop over them and prevent submission
		var validation = Array.prototype.filter.call(forms, function(form) {
			form.addEventListener('submit', function(event) {
			// document.getElementById("pj").addEventListener("click", function(event) {
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


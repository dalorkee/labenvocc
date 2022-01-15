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
.panel-hdr h2{font-size: 1.10em;color: #d05d1f;}
.form-label, .custom-control-label{font-size: 1em;font-weight: 400;}
::-webkit-input-placeholder{ /* Edge */font-size: 1em;}
:-ms-input-placeholder{ /* IE 10-11 */font-size: 1em;}
::placeholder{font-size: 1em;}
.captcha img{border: 1px solid blue;}
input[type="text"]:disabled{background: #eeeeee !important;}
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
			<li class="is-active">ข้อมูลติดต่อ</li>
			<li>บัญชีผู้ใช้</li>
			<li>ตรวจสอบข้อมูล</li>
		</ul>
	</div>
</div>
<div class="row font-prompt">
	<div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12">
		<section>
			<form action="{{ route('register.personal.step3.post') }}" method="POST" class="needs-validation" novalidate>
				@csrf
				<fieldset>
					<div class="panel">
						<div class="panel-hdr">
							<h2><i class="fal fa-clipboard"></i>&nbsp;&nbsp;ข้อมูลติดต่อ</h2>
							<div class="panel-toolbar">
								<button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
							</div>
						</div>
						<div class="panel-container show">
							<div class="panel-content">
								<div class="mt-0 sm:mt-0">
									<div class="md:grid md:grid-cols-1">
										<div class="mt-0 md:mt-0 md:col-span-2">
											<div class="overflow-hidden">
												<div class="px-6 pt-5 pb-16">
													<div class="grid grid-cols-6 gap-6">
														<div class="col-span-6 sm:col-span-3">
															<label for="send_address" class="block text-base font-medium text-gray-800">ที่อยู่สำหรับส่งรายงานผลการตรวจ <span class="text-red-600">*</span></label>
															<div class="frame-wrap">
																<div class="custom-control custom-switch custom-control-inline">
																	<input type="radio" name="contact_addr_opt" value="1" id="old_addr" class="custom-control-input" {{ (isset($userData->contact_addr_opt) && $userData->contact_addr_opt == '1') ? "checked" : "" }} required="">
																	<label class="custom-control-label" for="old_addr">ที่อยู่เดียวกับผู้รับบริการ</label>
																</div>
																<div class="custom-control custom-switch custom-control-inline">
																	<input type="radio" name="contact_addr_opt" value="2" id="new_addr" class="custom-control-input" {{ (isset($userData->contact_addr_opt) && $userData->contact_addr_opt == '2') ? "checked" : "" }} required="">
																	<label class="custom-control-label" for="new_addr">กำหนดใหม่</label>
																	<div class="invalid-feedback">โปรดเลือกคำนำหน้าชื่อ</div>
																</div>
															</div>
														</div>
													</div>
													<div class="grid grid-cols-6 gap-6 mt-4">
														<div class="col-span-6 sm:col-span-6">
															<label for="simpleinput" class="block text-base font-medium text-gray-800">คำนำหน้าชื่อ <span class="text-red-600">*</span></label>
															<div class="frame-wrap">
																<div class="custom-control custom-switch custom-control-inline">
																	<input type="radio" name="contact_title_name" value="mr" id="contact_title_name_mr" class="contact_title_name custom-control-input" {{ (isset($userData->contact_addr_opt) && $userData->contact_addr_opt == '2' && isset($userData->contact_title_name) && $userData->contact_title_name == 'mr') ? "checked" : "disabled" }} required="">
																	<label class="custom-control-label" for="contact_title_name_mr">นาย</label>
																</div>
																<div class="custom-control custom-switch custom-control-inline">
																	<input type="radio" name="contact_title_name" value="mrs" id="contact_title_name_mrs" class="contact_title_name custom-control-input" {{ (isset($userData->contact_addr_opt) && $userData->contact_addr_opt == '2' && isset($userData->contact_title_name) && $userData->contact_title_name == 'mrs') ? "checked" : "disabled" }} required="">
																	<label class="custom-control-label" for="contact_title_name_mrs">นาง</label>
																</div>
																<div class="custom-control custom-switch custom-control-inline">
																	<input type="radio" name="contact_title_name" value="miss" id="contact_title_name_ms" class="contact_title_name custom-control-input" {{ (isset($userData->contact_addr_opt) && $userData->contact_addr_opt == '2' && isset($userData->contact_title_name) && $userData->contact_title_name == 'miss') ? "checked" : "disabled" }} required="">
																	<label class="custom-control-label" for="contact_title_name_ms">นางสาว</label>
																	<div class="invalid-feedback">โปรดเลือกคำนำหน้าชื่อ</div>
																</div>
															</div>
														</div>
														<div class="col-span-6 sm:col-span-3">
															<label for="contact_first_name" class="block text-base font-medium text-gray-800">ชื่อ <span class="text-red-600">*</span></label>
															<input type="text" name="contact_first_name" value="{{ $userData->contact_first_name ?? '' }}" class="form-control contact_field mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300" maxlength="100" size="100" {{ (isset($userData->contact_addr_opt) && $userData->contact_addr_opt == '2') ? "" : "disabled" }} required>
															<div class="invalid-feedback">โปรดกรอกชื่อ</div>
														</div>
														<div class="col-span-6 sm:col-span-3">
															<label for="contact_last_name" class="block text-base font-medium text-gray-800">นามสกุล <span class="text-red-600">*</span></label>
															<input type="text" name="contact_last_name" value="{{ $userData->contact_last_name ?? '' }}" class="form-control contact_field mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300" maxlength="100" size="100" {{ (isset($userData->contact_addr_opt) && $userData->contact_addr_opt == '2') ? "" : "disabled" }} required>
														</div>
														<div class="invalid-feedback">โปรดกรอกนามสกุล</div>
														<div class="col-span-6 sm:col-span-3">
															<label for="contact_mobile" class="block text-base font-medium text-gray-800">โทรศัพท์เคลื่อนที่ <span class="text-red-600">*</span></label>
															<input type="text" name="contact_mobile" value="{{ $userData->contact_mobile ?? '' }}" class="form-control contact_field mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300" maxlength="10" size="10" pattern="^\d{10}$" {{ (isset($userData->contact_addr_opt) && $userData->contact_addr_opt == '2' ) ? "" : "disabled" }} required>
														</div>
														<div class="invalid-feedback">โปรดกรอกหมายเลขโทรศัพท์</div>
														<div class="col-span-6 sm:col-span-3">
															<label for="contact_email" class="block text-base font-medium text-gray-800">อีเมล์ <span class="text-red-600">*</span></label>
															<input type="text" name="contact_email" value="{{ $userData->contact_email ?? '' }}" class="form-control contact_field mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300" maxlength="90" size="90" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" {{ (isset($userData->contact_addr_opt) && $userData->contact_addr_opt == '2') ? "" : "disabled" }} required>
														</div>
														<div class="invalid-feedback">โปรดกรอกอีเมล์</div>
														<div class="col-span-6 sm:col-span-6">
															<label for="contact_addr" class="block text-base font-medium text-gray-800">ที่อยู่ (เลขที่ หมู่ที่ หมู่บ้าน/อาคาร ถนน) <span class="text-red-600">*</span></label>
															<input type="text" name="contact_addr" value="{{ $userData->contact_addr ?? '' }}" class="form-control contact_field mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300" {{ (isset($userData->contact_addr_opt) && $userData->contact_addr_opt == '2') ? "" : "disabled" }} required>
														</div>
														<div class="invalid-feedback">โปรดกรอกที่อยู่</div>
														<div class="col-span-6 sm:col-span-3">
															<label for="contact_province" class="block text-base font-medium text-gray-800">จังหวัด <span class="text-red-600">*</span></label>
															<select name="contact_province" id="contact_province" class="form-control" {{ (isset($userData->contact_addr_opt) && $userData->contact_addr_opt == '2') ? "" : "disabled" }} required="">
																<option value="">-- โปรดเลือก --</option>
																{!! (isset($userData->contact_province)) ? "<option value=\"".$userData->contact_province."\" selected>".$provinces[$userData->contact_province]."</option>" : "" !!}
																@foreach ($provinces as $key => $val)
																	<option value="{{ $key }}">{{ $val }}</option>
																@endforeach
															</select>
															<div class="invalid-feedback">โปรดเลือกจังหวัด</div>
														</div>
														<div class="col-span-6 sm:col-span-3">
															<label for="contact_district" class="block text-base font-medium text-gray-800">เขต/อำเภอ <span class="text-red-600">*</span></label>
															<select name="contact_district" id="contact_district" class="form-control" {{ (isset($userData->contact_addr_opt) && $userData->contact_addr_opt == '2') ? "" : "disabled" }} required="">
																<option value="">-- โปรดเลือก --</option>
																{!! (isset($userData->contact_district)) ? "<option value=\"".$userData->contact_district."\" selected>".$userData->contact_district."</option>" : "" !!}
															</select>
															<div class="invalid-feedback">โปรดเลือกอำเภอ</div>
														</div>
														<div class="col-span-6 sm:col-span-3">
															<label for="contact_sub_district" class="block text-base font-medium text-gray-800">แขวง/ตำบล <span class="text-red-600">*</span></label>
															<select name="contact_sub_district" id="contact_sub_district" class="form-control" {{ (isset($userData->contact_addr_opt) && $userData->contact_addr_opt == '2') ? "" : "disabled" }} required="">
																<option value="">-- โปรดเลือก --</option>
																{!! (isset($userData->contact_sub_district)) ? "<option value=\"".$userData->contact_sub_district."\" selected>".$userData->contact_sub_district."</option>" : "" !!}
															</select>
															<div class="invalid-feedback">โปรดเลือกตำบล</div>
														</div>
														<div class="col-span-6 sm:col-span-3">
															<label for="contact_postcode" class="block text-base font-medium text-gray-800">รหัสไปรษณีย์ <span class="text-red-600">*</span></label>
															<input type="text" name="contact_postcode" value="{{ $userData->contact_postcode ?? '' }}" id="contact_postcode" class="form-control mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300" maxlength="10" size="10" {{ (isset($userData->contact_addr_opt) && $userData->contact_addr_opt == '2') ? "" : "disabled" }} required>
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
						<a href="{{ route('register.personal.step2.get') }}" type="button" class="btn btn-warning btn-pills" style="width: 110px;"><i class="fal fa-arrow-left"></i> ก่อนหน้า</a>
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

	$('input[name="contact_addr_opt"]').on('change', function() {
		$('input[name="' + this.name + '"]').not(this).prop('checked', false);
	});
	$('input[name="contact_title_name"]').on('change', function() {
		$('input[name="' + this.name + '"]').not(this).prop('checked', false);
	});

	$("#new_addr").on('change', function() {
		if ($(this).prop("checked") == true) {
			$('#old_addr').prop('checked', false);
			$('.contact_title_name').prop('checked', false);
			$('.contact_title_name').prop('disabled', false);
			$('.contact_field').val('');
			$('.contact_field').prop('disabled', false);
			$('#contact_province').prop('disabled', false);
			$('#contact_district').prop('disabled', false);
			$('#contact_district').empty().trigger('change');
			$('#contact_sub_district').prop('disabled', false);
			$('#contact_sub_district').empty().trigger('change');
			$('#contact_postcode').prop('disabled', false);
			$('#contact_postcode').val('');
		} else {
			$('#old_addr').prop('checked', true);
			$('.contact_title_name').prop('checked', false);
			$('.contact_title_name').prop('disabled', true);
			$('.contact_field').val('');
			$('.contact_field').prop('disabled', true);
			$('#contact_province').prop('disabled', true);
			$('#contact_district').empty().trigger('change');
			$('#contact_district').prop('disabled', true);
			$('#contact_sub_district').empty().trigger('change');
			$('#contact_sub_district').prop('disabled', true);
			$('#contact_postcode').val('');
			$('#contact_postcode').prop('disabled', true);
		 }
	});
	$("#old_addr").on('change', function() {
		if ($(this).prop("checked") == true) {

			$('.contact_title_name').prop('checked', false);
			$('.contact_title_name').prop('disabled', true);

			$('.contact_field').val('');
			$('.contact_field').prop('disabled', true);

			$('#contact_province').prop('disabled', true);
			$('#contact_district').empty().trigger('change');
			$('#contact_district').prop('disabled', true);
			$('#contact_sub_district').empty().trigger('change');
			$('#contact_sub_district').prop('disabled', true);
			$('#contact_postcode').val('');
			$('#contact_postcode').prop('disabled', true);
		}
	});

	$('#contact_province').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('register.district') }}",
				dataType: "html",
				data: {id:id},
				success: function(response) {
					$('#contact_district').html(response);
				},
				error: function(jqXhr, textStatus, errorMessage) {
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});
	$('#contact_district').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('register.subDistrict') }}",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#contact_sub_district').html(response);
				},
				error: function(jqXhr, textStatus, errorMessage) {
					alert('Sub district error: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});
	$('#contact_sub_district').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('register.postcode') }}",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#contact_postcode').val(response);
				},
				error: function(jqXhr, textStatus, errorMessage) {
					alert('Postcode error: ' + jqXhr.status + errorMessage);
				}
			});
		} else {
			return false;
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


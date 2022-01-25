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
</style>
@endsection
@section('content')
<div class="row font-prompt mt-4 mb-6">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
		<h2 class="fw-600 mt-4 text-xl text-center">ลงทะเบียน : <span class="text-primary-1">หน่วยงานเอกชน</span></h2>
	</div>
</div>
<div class="row font-prompt mt-6 mb-6">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
		<ul class="list-unstyled multi-steps">
			<li>หน่วยงานเอกชน</li>
			<li class="is-active">ข้อมูลผู้รับบริการ</li>
			<li>ข้อมูลติดต่อ</li>
			<li>บัญชีผู้ใช้</li>
			<li>ตรวจสอบข้อมูล</li>
		</ul>
	</div>
</div>
<div class="row font-prompt">
	<div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12">
		<section>
			<form name="step2" action="{{ route('register.private.step2.post') }}" method="POST" class="needs-validation" novalidate>
				@csrf
				<fieldset>
					<div class="panel">
						<div class="panel-hdr">
							<h2 class="text-primary-1"><i class="fal fa-clipboard"></i>&nbsp;&nbsp;ข้อมูลผู้รับบริการ</h2>
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
												<div class="px-6 pt-2 pb-16">
													<div class="grid grid-cols-6 gap-6">
														<div class="col-span-6 sm:col-span-6">
															<label for="agency_name" class="block text-base font-medium text-gray-800">ชื่อสถานประกอบการ <span class="text-red-600">*</span></label>
															<input type="text" name="agency_name" value="{{ (isset($userData->agency_name)) ? $userData->agency_name : old('agency_name') }}" class="form-control @error('agency_name') is-invalid @enderror mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300" maxlength="100" size="100" required>
															<span class="invalid-feedback" role="alert">@if ($errors->any()) @error('agency_name') {{ $message }} @enderror @else {{ 'โปรดกรอกชื่อสถานประกอบการ' }} @endif</span>
														</div>
														<div class="col-span-6 sm:col-span-3">
															<label for="agency_code" class="block text-base font-medium text-gray-800">รหัสสถานประกอบการ <span class="text-red-600">*</span></label>
															<input type="text" name="agency_code" value="{{ (isset($userData->agency_code)) ? $userData->agency_code : old('agency_code') }}" class="form-control @error('agency_code') is-invalid @enderror mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300" maxlength="30" size="30" required>
															<span class="invalid-feedback" role="alert">@if ($errors->any()) @error('agency_code') {{ $message }} @enderror @else {{ 'โปรดกรอกรหัสสถานประกอบการ' }} @endif</span>
														</div>
														<div class="col-span-6 sm:col-span-3">
															<label for="taxpayer_no" class="block text-base font-medium text-gray-800">เลขผู้เสียภาษี <span class="text-red-600">*</span></label>
															<input type="text" name="taxpayer_no" value="{{ (isset($userData->taxpayer_no)) ? $userData->taxpayer_no : old('taxpayer_no') }}" class="form-control @error('taxpayer_no') is-invalid @enderror mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300" maxlength="30" size="30">
															<span class="invalid-feedback" role="alert">@if ($errors->any()) @error('taxpayer_no') {{ $message }} @enderror @else {{ 'โปรดกรอกรหัสเลขผู้เสียภาษี' }} @endif</span>
														</div>
														<div class="col-span-6 sm:col-span-3">
															<label for="mobile" class="block text-base font-medium text-gray-800">หมายเลขโทรศัพท์ <span class="text-red-600">*</span></label>
															<input type="tel" name="mobile" value="{{ (isset($userData->mobile)) ? $userData->mobile : old('mobile') }}" class="form-control @error('mobile') is-invalid @enderror mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300" maxlength="10" size="10" pattern="^\d{10}$" required>
															<span class="invalid-feedback" role="alert">@if ($errors->any()) @error('mobile') {{ $message }} @enderror @else {{ 'โปรดกรอกโทรศัพท์เคลื่อนที่' }} @endif</span>
														</div>
														<div class="col-span-6 sm:col-span-3">
															<label for="email" class="block text-base font-medium text-gray-800">อีเมล์ <span class="text-red-600">*</span></label>
															<input type="text" name="email" value="{{ (isset($userData->email)) ? $userData->email : old('email') }}" class="form-control @error('email') is-invalid @enderror mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300" maxlength="90" size="90" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
															<span class="invalid-feedback" role="alert">@if ($errors->any()) @error('email') {{ $message }} @enderror @else {{ 'โปรดกรอกอีเมล์' }} @endif</span>
														</div>
													</div>
													<div class="grid grid-cols-6 gap-6 mt-4">
														<div class="col-span-6 sm:col-span-6">
															<label for="address" class="block text-base font-medium text-gray-800">ที่อยู่หน่วยงาน (เลขที่ หมู่ที่ หมู่บ้าน/อาคาร ถนน) <span class="text-red-600">*</span></label>
															<input type="text" name="address" value="{{ (isset($userData->address)) ? $userData->address : old('address') }}" class="form-control @error('address') is-invalid @enderror mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300" maxlength="200" size="200" required>
															<span class="invalid-feedback" role="alert">@if ($errors->any()) @error('address') {{ $message }} @enderror @else {{ 'โปรดกรอกที่อยู่' }} @endif</span>
														</div>
														<div class="col-span-6 sm:col-span-3 form-group">
															<label for="province" class="form-label block text-base font-medium text-gray-800">จังหวัด <span class="text-red-600">*</span></label>
															<select name="province" id="province" class="form-control @error('province') is-invalid @enderror custom-select" required="">
																<option value="">-- โปรดเลือก --</option>
																@if (isset($userData->province))
																	<option value="{{ $userData->province }}" selected>{{ $provinces[$userData->province] }}</option>
																@elseif (old('province') > 0)
																	<option value="{{ old('province') }}" selected>{{ $provinces[old('province')] }}</option>
																@endif
																@foreach ($provinces as $key => $val)
																	<option value="{{ $key }}">{{ $val }}</option>
																@endforeach
															</select>
															<span class="invalid-feedback" role="alert">@if ($errors->any()) @error('province') {{ $message }} @enderror @else {{ 'โปรดเลือกจังหวัด' }} @endif</span>
														</div>
														<div class="col-span-6 sm:col-span-3">
															<label for="district" class="block text-base font-medium text-gray-800">เขต/อำเภอ <span class="text-red-600">*</span></label>
															<select name="district" id="district" class="form-control @error('district') is-invalid @enderror" required="">
																<option value="">-- โปรดเลือก --</option>
																@if (isset($userData->district))
																	<option value="{{ $userData->district }}" selected>{{ $districts[$userData->district] }}</option>
																@elseif (old('district') > 0)
																	<option value="{{ old('district') }}" selected>{{ $districts[old('district')] }}</option>
																@endif
															</select>
															<span class="invalid-feedback" role="alert">@if ($errors->any()) @error('district') {{ $message }} @enderror @else {{ 'โปรดเลือกอำเภอ' }} @endif</span>
														</div>
														<div class="col-span-6 sm:col-span-3">
															<label for="sub_district" class="block text-base font-medium text-gray-800">แขวง/ตำบล <span class="text-red-600">*</span></label>
															<select name="sub_district" id="sub_district" class="form-control @error('sub_district') is-invalid @enderror" required="">
																<option value="">-- โปรดเลือก --</option>
																@if (isset($userData->sub_district))
																	<option value="{{ $userData->sub_district }}" selected>{{ $sub_districts[$userData->sub_district] }}</option>
																@elseif (old('sub_district'))
																	<option value="{{ old('sub_district') }}" selected>{{ $sub_districts[old('sub_district')] }}</option>
																@endif
															</select>
															<span class="invalid-feedback" role="alert">@if ($errors->any()) @error('sub_district') {{ $message }} @enderror @else {{ 'โปรดเลือกตำบล' }} @endif</span>
														</div>
														<div class="col-span-6 sm:col-span-3">
															<label for="zip_code" class="block text-base font-medium text-gray-800">รหัสไปรษณีย์ <span class="text-red-600">*</span></label>
															<input type="text" name="postcode" value="{{ (isset($userData->postcode)) ? $userData->postcode : old('postcode') }}" id="postcode" class="form-control @error('postcode') is-invalid @enderror mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300" maxlength="10" size="10" required>
															<span class="invalid-feedback" role="alert">@if ($errors->any()) @error('postcode') {{ $message }} @enderror @else {{ 'โปรดกรอกรหัสไปรษณีย์' }} @endif</span>
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


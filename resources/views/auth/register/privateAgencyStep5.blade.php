@extends('layouts.guest.index')
@section('meta-token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('style')
<link rel="stylesheet" href="{{ URL::asset('css/step.css') }}">
<style type="text/css">
.text-primary-1 {color: #1877F2 !important}
.panel-hdr h2{font-size: 1.175em;}
::-webkit-input-placeholder{ /* Edge */font-size: 1em;}
:-ms-input-placeholder{ /* IE 10-11 */font-size: 1em;}
::placeholder{font-size: 1em;}
.captcha img{border: 1px solid blue;}
input.border-dashed {
	border-top: none !important;
	border-right: none !important;
	border-bottom: 1px dashed #cccccc !important;
	border-left: none !important;
	background: none !important;
	font-size: 1em !important;
	color: #1483D6 !important;
}
input:disabled {background: none !important;}
.panel-tag-primary {border-left: 3px solid #0C83E2;}
.panel-tag-danger {border-left: 3px solid #FD1381;}
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
			<li>ข้อมูลผู้รับบริการ</li>
			<li>ข้อมูลติดต่อ</li>
			<li>บัญชีผู้ใช้</li>
			<li class="is-active">ตรวจสอบข้อมูล</li>
		</ul>
	</div>
</div>
<div class="row font-prompt">
	<div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12">
		<section>
			<form name="step5" action="{{ route('register.private.step5.post') }}" method="POST" class="needs-validation" novalidate>
				{{ csrf_field() }}
				<fieldset>
					<div class="panel">
						<div class="panel-hdr">
							<h2 class="text-primary-1"><i class="fal fa-clipboard"></i>&nbsp;&nbsp;ตรวจสอบข้อมูล</h2>
							<div class="panel-toolbar">
								<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"><i class="fal fa-expand"></i></button>
							</div>
						</div>
						<div class="panel-container show">
							<div class="panel-content">
								<section class="pt-2 pl-4 pr-4">
									<h3 class="fw-500 m-0">ข้อมูลผู้รับบริการ</h3>
									<div class="panel-tag panel-tag-primary mt-2 bg-white">
										<div class="form-group row">
											<div class="col-md-4 mb-3">
												<label class="form-label">ชื่อหน่วยงาน <span class="text-danger">*</span> </label>
												<input type="text" class="form-control form-control-sm border-dashed" value="{{ $userData->agency_name ?? "" }}" readonly>
											</div>
											<div class="col-md-4 mb-3">
												<label class="form-label">รหัสสถานประกอบการ <span class="text-danger">*</span> </label>
												<input type="text" class="form-control form-control-sm border-dashed" value="{{ $userData->agency_code ?? "" }}" readonly>
											</div>
											<div class="col-md-4 mb-3">
												<label class="form-label">เลขผู้เสียภาษี <span class="text-danger">*</span> </label>
												<input type="text" class="form-control form-control-sm border-dashed" value="{{ $userData->taxpayer_no ?? "" }}" readonly>
											</div>
										</div>
										<div class="form-row">
											<div class="col-md-4 mb-3">
												<label class="form-label">โทรศัพท์เคลื่อนที่ <span class="text-danger">*</span> </label>
												<input type="text" class="form-control form-control-sm border-dashed" value="{{ $userData->mobile ?? "" }}" readonly>
											</div>
											<div class="col-md-8 mb-3">
												<label class="form-label">อีเมล์ <span class="text-danger">*</span> </label>
												<input type="text" class="form-control form-control-sm border-dashed" value="{{ $userData->email ?? "" }}" readonly>
											</div>
										</div>
										<div class="form-row">
											<div class="col-md-12 mb-3">
												<label class="form-label">ที่อยู่ <span class="text-danger">*</span> </label>
												<input type="text" class="form-control form-control-sm border-dashed" value="{{ $userData->address ?? "" }} {{ " ต. ".$sub_districts[$userData->sub_district] ?? "" }} {{ " อ. ".$districts[$userData->district] ?? "" }} {{ " จ. ".$provinces[$userData->province] ?? "" }} {{ $userData->postcode ?? "" }}" readonly>
											</div>
										</div>
									</div>
								</section>
								<section class="pt-2 pl-4 pr-4">
									<h3 class="fw-500 m-0">ข้อมูลติดต่อสำหรับส่งรายงานผลการตรวจ</h3>
									<div class="panel-tag panel-tag-danger mt-2 bg-white">
										<div class="form-row">
											<div class="col-md-4 mb-3">
												<label class="form-label">ที่อยู่สำหรับส่งรายงานผลการตรวจ <span class="text-danger">*</span> </label>
												<input type="text" class="form-control form-control-sm border-dashed" value="{{ ($userData->contact_addr_opt == 1) ? "ที่อยู่เดียวกับผู้รับบริการ" : "กำหนดใหม่" }}" readonly>
											</div>
											<div class="col-md-4 mb-3">
												<label class="form-label">ชื่อ-นามสกุล <span class="text-danger">*</span> </label>
												<input type="text" class="form-control form-control-sm border-dashed" value="{{ $titleName[$userData->contact_title_name] ?? "" }}{{ $userData->contact_first_name ?? "" }} {{ $userData->contact_last_name ?? "" }}" readonly>
											</div>
											<div class="col-md-4 mb-3">
												<label class="form-label">โทรศัพท์เคลื่อนที่ <span class="text-danger">*</span> </label>
												<input type="text" class="form-control form-control-sm border-dashed" value="{{ $userData->contact_mobile ?? "" }}" readonly>
											</div>
										</div>
										<div class="form-row">
											<div class="col-md-4 mb-3">
												<label class="form-label">อีเมล์ <span class="text-danger">*</span> </label>
												<input type="text" class="form-control form-control-sm border-dashed" value="{{ $userData->contact_email ?? "" }}" readonly>
											</div>
											<div class="col-md-8 mb-3">
												<label class="form-label">ที่อยู่ <span class="text-danger">*</span> </label>
												<input type="text" class="form-control form-control-sm border-dashed" value="{{ $userData->contact_addr ?? "" }} {{ " ต. ".$sub_districts[$userData->contact_sub_district] ?? "" }} {{ " อ. ".$districts[$userData->contact_district] ?? "" }} {{ " จ. ".$provinces[$userData->contact_province] ?? "" }} {{ $userData->contact_postcode ?? "" }}" readonly>
											</div>
										</div>
									</div>
								</section>
								<section class="pt-2 pl-4 pr-4">
									<h3 class="fw-500 m-0">บัญชีผู้ใช้</h3>
									<div class="panel-tag mt-2 bg-white">
										<div class="form-row">
											<div class="col-md-4 mb-3">
												<label class="form-label">ชื่อผู้ใช้ <span class="text-danger">*</span> </label>
												<input type="text" class="form-control form-control-sm border-dashed" value="{{ $userLoginData->username ?? "" }}" readonly>
											</div>
											<div class="col-md-4 mb-3">
												<label class="form-label">อีเมล์ <span class="text-danger">*</span> </label>
												<input type="text" class="form-control form-control-sm border-dashed" value="{{ $userLoginData->email ?? "" }}" readonly>
											</div>
											<div class="col-md-4 mb-3">
												<label class="form-label">รหัสผ่าน <span class="text-danger">*</span> </label>
												<input type="text" class="form-control form-control-sm border-dashed" value="{{ $userLoginData->password ?? "" }}" readonly>
											</div>
										</div>
									</div>
								</section>
								<div class="mt-0 sm:mt-0">
									<div class="md:grid md:grid-cols-1">
										<div class="mt-0 md:mt-0 md:col-span-2">
											<div class="px-6 pt-5 pb-16">
												<div class="grid grid-cols-6 gap-6">
													<div class="col-span-6 sm:col-span-6">
														<div class="captcha inline-block">{!! captcha_img('flat') !!}</div>
														<button type="button" class="btn btn-sm btn-dark" id="refresh-captcha" style="margin-bottom:24px;">
															<span>&#x21bb;</span>
														</button>
													</div>
													<div class="col-span-6 sm:col-span-6 mt-0">
														<input type="text" name="captcha" id="captcha" class="form-control" placeholder="ป้อนรหัสที่ท่านเห็น" required>
														<div class="invalid-feedback">รหัสไม่ถูกต้อง โปรดตรวจสอบ</div>
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
						<a href="{{ route('register.personal.step4.get') }}" type="button" class="btn btn-warning btn-pills" style="width: 116px;"><i class="fal fa-arrow-left"></i> ก่อนหน้า</a>
						<button type="submit" class="btn btn-danger btn-pills" style="width: 116px;"><i class="fal fa-arrow-right"></i> ลงทะเบียน</button>
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
	$('#refresh-captcha').click(function () {
		$.ajax({
			type: "POST",
			url: "{{ route('register.refresh-captcha') }}",
			success: function (data) {
				$(".captcha").html(data.captcha);
			}
		});
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


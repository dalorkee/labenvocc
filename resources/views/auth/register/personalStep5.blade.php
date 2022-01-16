@extends('layouts.guest.index')
@section('meta-token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('style')
<link href="{{ URL::asset('css/step.css') }}" rel="stylesheet">
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
ul.verify-data li {
    line-height: 24px;
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
			<li>บัญชีผู้ใช้</li>
			<li class="is-active">ตรวจสอบข้อมูล</li>
		</ul>
	</div>
</div>
<div class="row font-prompt">
	<div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12">
		<section>
			<form action="{{ route('register.store') }}" method="POST" id="msform">
				@csrf
				<fieldset>
					<div class="panel">
						<div class="panel-hdr">
							<h2><i class="fal fa-clipboard"></i>&nbsp;&nbsp;ตรวจสอบข้อมูล</h2>
							<div class="panel-toolbar">
								<button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
							</div>
						</div>
						<div class="panel-container show">
							<div class="panel-content">

								<div class="card mb-g">
									<div class="card-body">
										<section>
											<h3 class="fw-500 m-0"><i class="fal fa-info"></i> ข้อมูลผู้รับบริการ</h3>
											<div class="panel-tag mt-2">
                                                <div class="form-row">
                                                    <div class="col-md-4 mb-3">
                                                        <label class="form-label">คำนำหน้าชื่อ <span class="text-danger">*</span> </label>
                                                        <input type="text" class="form-control" value="{{ $userData->title_name ?? "" }}" disabled>
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label class="form-label">ชื่อ <span class="text-danger">*</span> </label>
                                                        <input type="text" class="form-control" value="{{ $userData->first_name ?? "" }}" disabled>
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label class="form-label">นามสกุล <span class="text-danger">*</span> </label>
                                                        <input type="text" class="form-control" value="{{ $userData->last_name ?? "" }}" disabled>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-4 mb-3">
                                                        <label class="form-label">เลขบัตรประชาชน <span class="text-danger">*</span> </label>
                                                        <input type="text" class="form-control" value="{{ $userData->id_card ?? "" }}" disabled>
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label class="form-label">เลขผู้เสียภาษี <span class="text-danger">*</span> </label>
                                                        <input type="text" class="form-control" value="{{ $userData->taxpayer_no ?? "" }}" disabled>
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label class="form-label">อีเมล์ <span class="text-danger">*</span> </label>
                                                        <input type="text" class="form-control" value="{{ $userData->email ?? "" }}" disabled>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-4 mb-3">
                                                        <label class="form-label">โทรศัพท์เคลื่อนที่ <span class="text-danger">*</span> </label>
                                                        <input type="text" class="form-control" value="{{ $userData->mobile ?? "" }}" disabled>
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label class="form-label">ที่อยู่ <span class="text-danger">*</span> </label>
                                                        <input type="text" class="form-control" value="{{ $userData->address ?? "" }}" disabled>
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label class="form-label">จังหวัด <span class="text-danger">*</span> </label>
                                                        <input type="text" class="form-control" value="{{ $userData->province ?? "" }}" disabled>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-4 mb-3">
                                                        <label class="form-label">อำเภอ <span class="text-danger">*</span> </label>
                                                        <input type="text" class="form-control" value="{{ $userData->district ?? "" }}" disabled>
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label class="form-label">ตำบล <span class="text-danger">*</span> </label>
                                                        <input type="text" class="form-control" value="{{ $userData->sub_district ?? "" }}" disabled>
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label class="form-label">รหัสไปรษณีย์ <span class="text-danger">*</span> </label>
                                                        <input type="text" class="form-control" value="{{ $userData->postcode ?? "" }}" disabled>
                                                    </div>
                                                </div>
											</div>
										</section>
										<section>
											<h3 class="fw-500 m-0"><i class="fal fa-address"></i> ข้อมูลติดต่อ</h3>
											<div class="panel-tag mt-2">
                                                <div class="form-row">
                                                    <div class="col-md-4 mb-3">
                                                        <label class="form-label" for="validationCustom01">First name <span class="text-danger">*</span> </label>
                                                        <input type="text" class="form-control" id="validationCustom01" placeholder="First name" value="Codex" disabled>
                                                        <div class="valid-feedback">
                                                            Looks good!
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label class="form-label" for="validationCustom02">Last name <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="validationCustom02" placeholder="Last name" value="Lantern" required>
                                                        <div class="valid-feedback">
                                                            Looks good!
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label class="form-label" for="validationCustomUsername">Username <span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                            </div>
                                                            <input type="text" class="form-control" id="validationCustomUsername" placeholder="Username" aria-describedby="inputGroupPrepend" required>
                                                            <div class="invalid-feedback">
                                                                Please choose a username.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
											</div>
										</section>
										<section>
											<h3 class="fw-500 m-0"><i class="fal fa-address"></i> บัญชีผู้ใช้</h3>
											<div class="panel-tag mt-2">
												<ul>
													<li>คำนำหน้าชื่อ: {{ $userData->title_name ?? "" }}</li>
													<li>ชื่อ: {{ $userData->first_name ?? "" }}</li>
													<li>นามสกุล: {{ $userLoginData->username ?? "" }}</li>

												</ul>
											</div>
										</section>
									</div>
								</div>









								<div class="mt-0 sm:mt-0">
									<div class="md:grid md:grid-cols-1">
										<div class="mt-2 md:mt-0 md:col-span-2">
											<div class="px-6 pt-5 pb-16">
												<div class="grid grid-cols-6 gap-6">
													<div class="col-span-6 sm:col-span-6">
														<div class="captcha inline-block">{!! captcha_img('flat') !!}</div>
														<button type="button" class="btn btn-sm btn-dark" id="refresh-captcha" style="margin-bottom:24px;">
															<span>&#x21bb;</span>
														</button>
													</div>
													<div class="col-span-6 sm:col-span-6 mt-0">
														<input name="captcha" id="captcha" type="text" class="pt-3 pb-3 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-md border-blue-200" placeholder="ป้อนรหัสที่ท่านเห็น">
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
						<button type="submit" class="btn btn-success btn-pills" style="width: 116px;">ลงทะเบียน <i class="fal fa-arrow-right"></i></button>
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


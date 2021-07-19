@extends('layouts.guest.index')
@section('meta-token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('style')
<link href="{{ URL::asset('assets/css/ionicons.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/multi_step_form.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/css/formplugins/select2/select2.bundle.css') }}" rel="stylesheet">
<style type="text/css">
.select2{width:100%!important;}
.select2-selection{overflow:hidden;}
.select2-selection__rendered{white-space:normal;word-break:break-all;}
.select2-selection__rendered{line-height:39px!important;}
.select2-container .select2-selection--single{height:38px!important;border:1px solid #cccccc;border-radius:0;}
.select2-selection__arrow{height:37px!important;}
.custom-control-label{font-size: 1.175em;}
</style>
@endsection
@section('content')
<article>
	<section class="multi_step_form">
		<form action="{{ route('register.store') }}" method="POST" id="msform">
			@csrf
			<div class="tittle">
				<h2>ลงทะเบียนใช้งาน</h2>
				<p>โปรดกรอกข้อมูลและตรวจสอบให้ถูกต้องทุกขั้นตอน</p>
			</div>
			<ul id="progressbar">
				<li class="active">ข้อมูลหน่วยงาน</li>
				<li>ข้อมูลผู้รับบริการ</li>
				<li>ข้อมูลติดต่อ</li>
				<li>บัญชีผู้ใช้</li>
			</ul>
			<fieldset>
				<h3>ข้อมูลหน่วยงาน</h3>
				<h4>1. ข้อมูลทั่วไปของผู้รับบริการ</h4>
				<div class="mt-0 sm:mt-0">
					<div class="md:grid md:grid-cols-1">
						<div class="mt-2 md:mt-0 md:col-span-2">
							<div class="overflow-hidden">
								<div class="px-6 pt-5 pb-16" style="border:1px solid #ccc">
									<div class="grid grid-cols-6 gap-6">
										<div class="col-span-6 sm:col-span-3 mb-4">
											<label for="agency_type" class="block form-label">ประเภทหน่วยงาน <span class="text-red-600">*</span></label>
											<div class="frame-wrap">
												@foreach ($agency_type as $key => $value)
												<div class="custom-control custom-checkbox custom-control-inline">
													<input type="checkbox" name="agency" value="{{ $key }}" id="{{ $key }}" class="custom-control-input">
													<label class="custom-control-label" for="{{ $key }}">{{ $value }}</label>
												</div>
												@endforeach
											</div>
										</div>
									</div>
									<div class="grid grid-cols-6 gap-6 mt-4">
										<div class="col-span-6 sm:col-span-6">
											<label for="simpleinput" class="block form-label">ชนิดหน่วยงาน <span class="text-red-600">*</span></label>
											<div class="frame-wrap">
												<div class="custom-control custom-switch custom-control-inline">
													<input type="checkbox" name="agency_type" value="1" id="agency_type_establishment" class="custom-control-input agency_type">
													<label class="custom-control-label" for="agency_type_establishment">สถานประกอบการ</label>
												</div>
											</div>
										</div>
										<div class="col-span-6 sm:col-span-3 md:ml-4">
											<label for="first_name" class="block text-base font-medium text-gray-700">ชื่อหน่วยงาน</label>
											<input type="text" name="office_name_establishment" id="office_name_establishment" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300">
										</div>
										<div class="col-span-6 sm:col-span-3 md:mr-4">
											<label for="last_name" class="block text-base font-medium text-gray-700">รหัสหน่วยงาน</label>
											<input type="text" name="office_code_establishment" id="office_code_establishment" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300">
										</div>
										<div class="col-span-6 sm:col-span-6">
											<div class="frame-wrap">
												<div class="custom-control custom-switch custom-control-inline">
													<input type="checkbox" name="agency_type" id="agency_type_hospital" class="custom-control-input agency_type">
													<label class="custom-control-label" for="agency_type_hospital">สถานพยาบาล</label>
												</div>
											</div>
										</div>
										<div class="col-span-6 sm:col-span-6 md:mx-4">
											<label for="health_place_id" class="block text-base font-medium text-gray-700">เลือกสถานพยาบาล</label>
											<select name="health_place_id" data-placeholder="โปรดกรอกข้อความค้นหา" id="hosp_search" class="mt-1 block w-full py-2 px-3 border border-gray-400 bg-white shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
											</select>
										</div>
										<div class="col-span-6 sm:col-span-6">
											<div class="frame-wrap">
												<div class="custom-control custom-switch custom-control-inline">
													<input type="checkbox" name="agency_type" id="agency_type_border_check_point" class="custom-control-input agency_type">
													<label class="custom-control-label" for="agency_type_border_check_point">ด่านควบคุมโรค</label>
												</div>
											</div>
										</div>
										<div class="col-span-6 sm:col-span-6 md:mx-4">
											<label for="border_check_point_id" class="block text-base font-medium text-gray-700">เลือกด่านควบคุมโรค</label>
											<select name="border_check_point_id" data-placeholder="โปรดกรอกข้อความค้นหา" id="disease_border_search" class="mt-1 block w-full py-2 px-3 border border-gray-800 bg-white shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
											</select>
										</div>
										<div class="col-span-6 sm:col-span-6">
											<div class="frame-wrap">
												<div class="custom-control custom-switch custom-control-inline">
													<input type="checkbox" name="agency_type" id="agency_type_other" class="custom-control-input agency_type">
													<label class="custom-control-label" for="agency_type_other">อื่นๆ โปรดระบุ</label>
												</div>
											</div>
										</div>
										<div class="col-span-6 sm:col-span-6 md:mx-4">
											<label for="agency_type_other_text" class="block text-base font-medium text-gray-700">อื่นๆ ระบุ</label>
											<input type="text" name="agency_type_other_text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-200">
										</div>
									</div>
									<div class="grid grid-cols-6 gap-6 mt-6">
										<div class="col-span-6 sm:col-span-3">
											<label for="taxpayer_no" class="block form-label">หมายเลขผู้เสียภาษี</label>
											<input type="text" name="taxpayer_no" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-200">
										</div>


										<div class="col-span-6 sm:col-span-3">
											<label for="address" class="block form-label">ที่อยู่</label>
											<input type="text" name="address" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-200">
										</div>

										<div class="col-span-6 sm:col-span-3">
											<label for="province" class="block form-label">จังหวัด</label>
											<select id="province" name="province" id="province" class="select2-placeholder mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
												<option value="">-- โปรดเลือก --</option>
												@foreach ($provinces as $key => $val)
													<option value="{{ $key }}">{{ $val }}</option>
												@endforeach
											</select>
										</div>
										<div class="col-span-6 sm:col-span-3">
											<label for="district" class="block form-label">เขต/อำเภอ</label>
											<select name="district" id="district" class="select2-placeholder mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
												<option value="">-- โปรดเลือก --</option>
											</select>
										</div>
										<div class="col-span-6 sm:col-span-3">
											<label for="sub_district" class="block form-label">แขวง/ตำบล</label>
											<select name="sub_district" id="sub_district" class="select2-placeholder form-control mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
												<option>-- โปรดเลือก --</option>
											</select>
										</div>
										<div class="col-span-6 sm:col-span-3">
											<label for="zip_code" class="block form-label">รหัสไปรษณีย์</label>
											<input type="text" name="postcode" id="postcode" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-200">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<button type="button" class="action-button previous_button">ก่อนหน้า</button>
				<button type="button" class="next action-button">ถัดไป</button>
			</fieldset>

			<fieldset>
				<h3>ข้อมูลผู้รับบริการ</h3>
				<h4>2. ข้อมูลผู้รับบริการ</h4>
				<div class="mt-0 sm:mt-0">
					<div class="md:grid md:grid-cols-1">
						<div class="mt-2 md:mt-0 md:col-span-2">
							<div class="overflow-hidden">
								<div class="px-6 pt-5 pb-16" style="border:1px solid #ccc">
									<div class="grid grid-cols-6 gap-6">
										<div class="col-span-6 sm:col-span-6">
											<label for="title_name" class="block form-label">คำนำหน้าชื่อ <span class="text-red-600">*</span></label>
											<div class="frame-wrap">
												<div class="custom-control custom-checkbox custom-control-inline">
													<input type="checkbox" name="title_name" value="mr" id="mister" class="custom-control-input">
													<label class="custom-control-label" for="mister">นาย</label>
												</div>
												<div class="custom-control custom-checkbox custom-control-inline">
													<input type="checkbox" name="title_name" value="mrs" id="mistress" class="custom-control-input">
													<label class="custom-control-label" for="mistress">นาง</label>
												</div>
												<div class="custom-control custom-checkbox custom-control-inline">
													<input type="checkbox" name="title_name" value="miss" id="miss" class="custom-control-input">
													<label class="custom-control-label" for="miss">นางสาว</label>
												</div>
											</div>
										</div>
										<div class="col-span-6 sm:col-span-3">
											<label for="first_name" class="block text-base font-medium text-gray-700">ชื่อ <span class="text-red-600">*</span></label>
											<input type="text" name="first_name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-200">
										</div>
										<div class="col-span-6 sm:col-span-3">
											<label for="last_name" class="block text-base font-medium text-gray-700">นามสกุล <span class="text-red-600">*</span></label>
											<input type="text" name="last_name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-200">
										</div>
										<div class="col-span-6 sm:col-span-3">
											<label for="position" class="block text-base font-medium text-gray-700">ตำแหน่ง <span class="text-red-600">*</span></label>
											<input type="text" name="position" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-200">
										</div>
										<div class="col-span-6 sm:col-span-3">
											<label for="mobile" class="block text-base font-medium text-gray-700">เบอร์โทรศัพท์มือถือ <span class="text-red-600">*</span></label>
											<input type="text" name="mobile" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-200">
										</div>
										<div class="col-span-6 sm:col-span-6">
											<label for="email" class="block text-base font-medium text-gray-700">อีเมล์ <span class="text-red-600">*</span></label>
											<input type="text" name="email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-200">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<button type="button" class="action-button previous previous_button">ก่อนหน้า</button>
				<button type="button" class="next action-button">ถัดไป</button>
			</fieldset>

			<fieldset>
				<h3>ข้อมูลติดต่อ</h3>
				<h4>3. ข้อมูลติดต่อ</h4>
				<div class="mt-0 sm:mt-0">
					<div class="md:grid md:grid-cols-1">
						<div class="mt-2 md:mt-0 md:col-span-2">
							<div class="overflow-hidden">
								<div class="px-6 pt-5 pb-16" style="border:1px solid #ccc">
									<div class="grid grid-cols-6 gap-6">
										<div class="col-span-6 sm:col-span-3">
											<label for="send_address" class="block form-label">ที่อยู่สำหรับส่งรายงานผลการตรวจ <span class="text-red-600">*</span></label>
											<div class="frame-wrap">
												<div class="custom-control custom-switch custom-control-inline">
													<input type="checkbox" name="send_result_addr" id="old_addr" class="custom-control-input">
													<label class="custom-control-label" for="old_addr">ที่อยู่เดียวกับผู้รับบริการ</label>
												</div>
												<div class="custom-control custom-switch custom-control-inline">
													<input type="checkbox" name="send_result_addr" id="new_addr" class="custom-control-input">
													<label class="custom-control-label" for="new_addr">ที่อยู่ใหม่</label>
												</div>
											</div>
										</div>
										<div class="col-span-6 sm:col-span-6 md:mx-4">
											<label for="simpleinput" class="block text-base font-medium text-gray-700">คำนำหน้าชื่อ <span class="text-red-600">*</span></label>
											<div class="frame-wrap">
												<div class="custom-control custom-checkbox custom-control-inline">
													<input type="checkbox" name="send_title_name" id="send_title_name_mr" class="custom-control-input">
													<label class="custom-control-label" for="send_title_name_mr">นาย</label>
												</div>
												<div class="custom-control custom-checkbox custom-control-inline">
													<input type="checkbox" name="send_title_name" id="send_title_name_mrs" class="custom-control-input">
													<label class="custom-control-label" for="send_title_name_mrs">นาง</label>
												</div>
												<div class="custom-control custom-checkbox custom-control-inline">
													<input type="checkbox" name="send_title_name" id="send_title_name_ms" class="custom-control-input">
													<label class="custom-control-label" for="send_title_name_ms">นางสาว</label>
												</div>
											</div>
										</div>

										<div class="col-span-6 sm:col-span-3 md:mx-4">
											<label for="send_first_name" class="block text-base font-medium text-gray-700">ชื่อ</label>
											<input type="text" name="send_first_name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-200">
										</div>
										<div class="col-span-6 sm:col-span-3 md:mx-4">
											<label for="send_last_name" class="block text-base font-medium text-gray-700">นามสกุล</label>
											<input type="text" name="send_last_name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-200">
										</div>

										<div class="col-span-6 sm:col-span-3 md:mx-4">
											<label for="send_position" class="block text-base font-medium text-gray-700">ตำแหน่ง</label>
											<input type="text" name="send_position" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-200">
										</div>
										<div class="col-span-6 sm:col-span-3 md:mx-4">
											<label for="send_mobile" class="block text-base font-medium text-gray-700">เบอร์โทรศัพท์มือถือ</label>
											<input type="text" name="send_mobile" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-200">
										</div>
										<div class="col-span-6 sm:col-span-6 md:mx-4">
											<label for="send_email" class="block text-base font-medium text-gray-700">อีเมล์</label>
											<input type="text" name="send_email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-200">
										</div>
										<div class="col-span-6 sm:col-span-6 md:mx-4">
											<label for="send_new_addr" class="block text-sm font-medium text-gray-700">ที่อยู่ใหม่</label>
											<input type="text" name="send_new_addr" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-200">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<button type="button" class="action-button previous previous_button">ก่อนหน้า</button>
				<button type="button" class="next action-button">ถัดไป</button>
			</fieldset>

			<fieldset>
				<h3>บัญชีผู้ใช้</h3>
				<h4>4. บัญชีผู้ใช้</h4>
				<div class="mt-0 sm:mt-0">
					<div class="md:grid md:grid-cols-1">
						<div class="mt-2 md:mt-0 md:col-span-2">
							<div class="overflow-hidden">
								<div class="px-6 pt-5 pb-16" style="border:1px solid #ccc">
									<div class="grid grid-cols-6 gap-6">
										<div class="col-span-6 sm:col-span-6">
											<label for="user_email" class="block text-base font-medium text-gray-700">อีเมล์ (Email)</label>
											<input type="text" name="user_email" id="user_email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-200">
										</div>

										<div class="col-span-6 sm:col-span-6">
											<label for="user_password" class="block text-base font-medium text-gray-700">รหัสผ่าน (Password)</label>
											<input type="text" name="user_password" id="user_password" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-200">
										</div>
										<div class="col-span-6 sm:col-span-6">
											<label for="user_confirm_password" class="block text-base font-medium text-gray-700">ยืนยันรหัสผ่าน (Confirm password)</label>
											<input type="text" name="user_confirm_password" id="user_confirm_password" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-200">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<button type="button" class="action-button previous previous_button">ก่อนหน้า</button>
				<button type="button" id="sad" class="btn btn-default"data-toggle="modal" data-target="#example-modal-backdrop-transparent">ตรวจสอบข้อมูล</button>
				{{-- <button type="submit" class="action-button">ตรวจสอบข้อมูล</button> --}}
			</fieldset>
		</form>
	</section>
</article>
<!-- Modal Verify Data -->
<div class="modal fade modal-backdrop-transparent" id="example-modal-backdrop-transparent" tabindex="1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">ตรวจสอบข้อมูล</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true"><i class="fal fa-times"></i></span>
				</button>
			</div>
			<div class="modal-body">
				<div id="meawdal">abc</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary action-button" data-dismiss="modal" >กลับไปแก้ไข</button>
				<button type="button" class="btn btn-primary" style="z-index:">ตกลง</button>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script src="{{ URL::asset('assets/js/formplugins/select2/select2.bundle.js') }}"></script>
<script>
$(document).ready(function() {
	$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
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

	$('#sad').click(function() {
		var data = {};
		$.each($('#msform').serializeArray(), function() {
			data[this.name] = this.value;
		});
		$.ajax({
			method: "POST",
			url: "{{ route('register.verify') }}",
			dataType: "HTML",
			data: {data:data},
			success: function(response) {
				$('#meawdal').html(response);
			},
			error: function(jqXhr, textStatus, errorMessage) {
				alert('Modal error: ' + jqXhr.status + errorMessage);
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
		/* hospital search by name */
		$("#hosp_search").select2({
			ajax: {
				method: "POST",
				url: "{{ route('register.hospital') }}",
				dataType: 'json',
				delay: 250,
				data: function (params) {
					return {
						q: params.term,
						page: params.page
					};
				},
				processResults: function (data, params) {
					params.page = params.page || 1;
					return {
						results: data.items,
						pagination: {
							more: (params.page * 30) < data.total_count
						}
					};
				},
				cache: true
			},
			escapeMarkup: function (markup) { return markup; },
			placeholder: "โปรดกรอกข้อมูล",
			minimumInputLength: 3,
			maximumInputLength: 20,
			templateResult: formatRepo,
			templateSelection: formatRepoSelection
		});

		/* disease border search by name */
		$("#disease_border_search").select2({
			ajax: {
				method: "POST",
				url: "{{ route('register.hospital') }}",
				dataType: 'json',
				delay: 250,
				data: function (params) {
					return {
						q: params.term,
						page: params.page
					};
				},
				processResults: function (data, params) {
					params.page = params.page || 1;
					return {
						results: data.items,
						pagination: {
							more: (params.page * 30) < data.total_count
						}
					};
				},
				cache: true
			},
			escapeMarkup: function (markup) { return markup; },
			placeholder: "โปรดกรอกข้อมูล",
			minimumInputLength: 3,
			maximumInputLength: 20,
			templateResult: formatRepo,
			templateSelection: formatRepoSelection
		});

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
	/* check box pj pj pj */
	$('input[type="checkbox"]').on('change', function() {
		$('input[name="' + this.name + '"]').not(this).prop('checked', false);
	});
});
</script>
<script>
(function($) {
	"use strict";
	function verificationForm() {
	//jQuery time
		var current_fs, next_fs, previous_fs; //fieldsets
		var left, opacity, scale; //fieldset properties which we will animate
		var animating; //flag to prevent quick multi-click glitches

		$(".next").click(function () {
			if (animating) return false;
			animating = true;

			current_fs = $(this).parent();
			next_fs = $(this).parent().next();

			//activate next step on progressbar using the index of next_fs
			$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

			//show the next fieldset
			next_fs.show();
			//hide the current fieldset with style
			current_fs.animate({
				opacity: 0
			}, {
				step: function (now, mx) {
					//as the opacity of current_fs reduces to 0 - stored in "now"
					//1. scale current_fs down to 80%
					scale = 1 - (1 - now) * 0.2;
					//2. bring next_fs from the right(50%)
					left = (now * 50) + "%";
					//3. increase opacity of next_fs to 1 as it moves in
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
				//this comes from the custom easing plugin
				easing: 'easeInOutBack'
			});
			$("html, body").animate({ scrollTop: 0 }, "slow");
		});
		$(".previous").click(function () {
			if (animating) return false;
			animating = true;
			current_fs = $(this).parent();
			previous_fs = $(this).parent().prev();
			//de-activate current step on progressbar
			$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
			//show the previous fieldset
			previous_fs.show();
			//hide the current fieldset with style
			current_fs.animate({
				opacity: 0
			}, {
				step: function (now, mx) {
					//as the opacity of current_fs reduces to 0 - stored in "now"
					//1. scale previous_fs from 80% to 100%
					scale = 0.8 + (1 - now) * 0.2;
					//2. take current_fs to the right(50%) - from 0%
					left = ((1 - now) * 50) + "%";
					//3. increase opacity of previous_fs to 1 as it moves in
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
		});
		// $(".submit").click(function () {
		// 		return false;
		// })
	};
	verificationForm ();
})(jQuery);
</script>

@endsection

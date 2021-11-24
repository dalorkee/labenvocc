@extends('layouts.index')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/pj-step.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/datagrid/datatables/datatables.bundle.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/formplugins/select2/select2.bundle.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/notifications/sweetalert2/sweetalert2.bundle.css') }}" media="screen">
<style>
.select2{width:100%!important;z-index:99999}
.select2-selection{overflow:hidden;}
.select2-selection__rendered{white-space:normal;word-break:break-all;}
.select2-selection__rendered{line-height:39px!important;}
.select2-container .select2-selection--single{height:38px!important;border:1px solid #cccccc;border-radius:0;}
.select2-selection__arrow{height:37px!important;}
.js-data-example-ajax {z-index:1000;background:red;}
.btn-group {margin:0 0 5px 0;padding:0;}
.dataTables_filter label {margin-top: 8px;}
.dataTables_filter input:first-child {margin-top: -8px;}
.buttons-create {float:left;margin-left:12px;}
.buttons-create:after {content:'';clear:both;}
.dt-btn {margin:0;padding:0;}
#order-table thead {background-color:#297FB0;color: white;}
</style>
@endsection
@section('content')
<ol class="breadcrumb page-breadcrumb text-sm font-prompt">
	<li class="breadcrumb-item"><a href="javascript:void(0);">LabEnvOcc</a></li>
	<li class="breadcrumb-item">สร้างคำขอส่งตัวอย่างชีวภาพ</li>
	<li class="breadcrumb-item">ข้อมูลตัวอย่าง</li>
</ol>
<div class="row text-sm font-prompt">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
		<div id="panel-customer" class="panel">
			<div class="panel-hdr">
				<h2 class="text-gray-600"><i class="fal fa-clipboard"></i>&nbsp;คำขอส่งตัวอย่างชีวภาพ</h2>
				<div class="panel-toolbar">
					<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"><i class="fal fa-window-minimize"></i></button>
					<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"><i class="fal fa-expand"></i></button>
					<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"><i class="fal fa-times"></i></button>
				</div>
			</div>
			<div class="panel-container relative">
				<form>
					<div class="panel-content">
						<ul class="steps mb-3">
							<li class="undone"><a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="ข้อมูลทั่วไป"><i class="fal fa-user"></i> <span class="d-none d-sm-inline">ข้อมูลทั่วไป</span></a></li>
							<li class="undone"><a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="พารามิเตอร์"><i class="fal fa-tachometer"></i> <span class="d-none d-sm-inline">พารามิเตอร์</span></a></li>
							<li class="active"><a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="ข้อมูลตัวอย่าง"><i class="fal fa-list-ul"></i> <span class="d-none d-sm-inline">ข้อมูลตัวอย่าง</span></a></li>
							<li class="undone"><a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="ตรวจสอบข้อมูล"><i class="fal fa-check-circle"></i> <span class="d-none d-sm-inline">ตรวจสอบข้อมูล</span></a></li>
						</ul>
						{{ $dataTable->table() }}
					</div>
					<div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex flex-row align-items-center">
						<div class="form-row">
							<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
								<a href="{{ route('customer.parameter.create', ['order_id' => $data['order_id']]) }}" class="btn btn-warning ml-auto"><i class="fal fa-arrow-alt-left"></i> ก่อนหน้า</a>
								<a href="{{ route('customer.sample.create', ['order_id' => $data['order_id']]) }}" class="btn btn-warning ml-auto">ถัดไป <i class="fal fa-arrow-alt-right"></i></a>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- Modal new personal data-->
<div class="modal fade font-prompt" id="new-data-modal" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-xl modal-dialog-centered" role="document">
		<div class="modal-content">
			<form name="newSampleData" action="{{ route('customer.sample.store', ['order_id' => $data['order_id']]) }}" method="POST">
				@csrf
				<div class="modal-header bg-green-600 text-white">
					<h5 class="modal-title"><i class="fal fa-plus-circle"></i> เพิ่มประเด็นมลพิษ</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true"><i class="fal fa-times"></i></span>
					</button>
					<input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
					<input type="hidden" name="order_id" value="{{ $data['order_id'] }}">
				</div>
				<div class="modal-body">
					<div class="form-row">
						<div class="form-group col-xs-12 col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-3">
							<label class="form-label text-gray-800" for="title_name">ตัวอย่างที่ <span class="text-red-600">*</span></label>
							<select name="sample_select_begin" class="select2 form-control">
								<option value="">-- โปรดเลือก --</option>
								@forelse ($data['sample_list'] as $key => $val)
									<option value="{{ $val }}">{{ $val }}</option>
								@empty
									<option value="-1">ไม่พบข้อมูล</option>
								@endforelse
							</select>
						</div>
						<div class="form-group col-xs-12 col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-3">
							<label class="form-label text-gray-800" for="title_name">ถึง <span class="text-red-600">*</span></label>
							<select name="sample_select_end" class="select2 form-control">
								<option value="">-- โปรดเลือก --</option>
								@forelse ($data['sample_list'] as $key => $val)
									<option value="{{ $val }}">{{ $val }}</option>
								@empty
									<option value="-1">ไม่พบข้อมูล</option>
								@endforelse
							</select>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
							<label class="form-label text-gray-800" for="title_name">ประเด็นมลพิษ <span class="text-red-600">*</span></label>
							<select name="sample_charecter" class="form-control select2">
								<option value="">-- โปรดเลือก --</option>
								@forelse ($data['sample_charecter'] as $key => $val)
									<option value="{{ $key }}">{{ $val }}</option>
								@empty
									<option value="-1">-- ไม่พบข้อมูล --</option>
								@endforelse
							</select>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
							<label class="form-label text-gray-800" for="sample_place_type">สถานที่เก็บตัวอย่าง <span class="text-red-600">*</span></label>
							<div class="frame-wrap">
								<div class="custom-control custom-checkbox custom-control-inline">
									<input type="checkbox" name="sample_place_type" value="1" id="chk_a" class="custom-control-input" checked>
									<label class="custom-control-label" for="chk_a">สถานที่เดียวกับหน่วยงานที่ส่งตัวอย่าง</label>
								</div>
								<div class="custom-control custom-checkbox custom-control-inline">
									<input type="checkbox" name="sample_place_type" value="2" id="chk_b" class="custom-control-input">
									<label class="custom-control-label" for="chk_b">กำหนดใหม่</label>
								</div>
							</div>
						</div>
					</div>
					<div class="grid grid-cols-6 gap-6">
						<div class="col-span-6 sm:col-span-6">
							<label for="office_type" class="block text-gray-800">กรณีเลือกสถานที่เก็บตัวอย่างใหม่ โปรดกรอกข้อมูล <span class="text-red-600">*</span></label>
							<div class="frame-wrap">
								<div class="custom-control custom-switch custom-control-inline">
									<input type="checkbox" name="sample_office_category" value="1" id="agency_type_establishment" class="custom-control-input agency_type">
									<label class="custom-control-label" for="agency_type_establishment">สถานประกอบการ <span class="text-red-600">*</span></label>
								</div>
							</div>
						</div>
						<div class="col-span-6 sm:col-span-3 md:ml-4">
							<label for="office_name_establishment" class="block text-base font-medium text-gray-700">ชื่อสถานประกอบการ <span class="text-red-600">*</span></label>
							<input type="text" name="sample_office_name" id="office_name_establishment" class="form-control" disabled>
						</div>
						<div class="col-span-6 sm:col-span-3 md:mr-4">
							<label for="office_code_establishment" class="block text-base font-medium text-gray-700">รหัสสถานประกอบการ <span class="text-red-600">*</span></label>
							<input type="text" name="sample_office_id" id="office_code_establishment" class="form-control" disabled>
						</div>
						<div class="col-span-6 sm:col-span-6">
							<div class="frame-wrap">
								<div class="custom-control custom-switch custom-control-inline">
									<input type="checkbox" name="sample_office_category" value="2" id="agency_type_hospital" class="custom-control-input agency_type">
									<label class="custom-control-label" for="agency_type_hospital">สถานพยาบาล</label>
								</div>
							</div>
						</div>
						<div class="col-span-6 sm:col-span-6 md:mx-4">
							<label for="health_place_code" class="block text-base font-medium text-gray-700">เลือกสถานพยาบาล <span class="text-red-600">*</span></label>
							<select name="sample_office_id" data-placeholder="โปรดกรอกข้อความค้นหา" id="hosp_search" class="js-data-example-ajax form-control" disabled>
							</select>
						</div>
						<div class="col-span-6 sm:col-span-6">
							<div class="frame-wrap">
								<div class="custom-control custom-switch custom-control-inline">
									<input type="checkbox" name="sample_office_category" value="3" id="agency_type_border_check_point" class="custom-control-input agency_type">
									<label class="custom-control-label" for="agency_type_border_check_point">ด่านควบคุมโรค </label>
								</div>
							</div>
						</div>
						<div class="col-span-6 sm:col-span-6 md:mx-4">
							<label for="border_check_point_id" class="block text-base font-medium text-gray-700">เลือกด่านควบคุมโรค <span class="text-red-600">*</span></label>
							<select name="sample_office_id" data-placeholder="โปรดกรอกข้อความค้นหา" id="disease_border_search" class="form-control" disabled>
							</select>
						</div>
						<div class="col-span-6 sm:col-span-6">
							<div class="frame-wrap">
								<div class="custom-control custom-switch custom-control-inline">
									<input type="checkbox" name="sample_office_category" value="4" id="agency_type_other" class="custom-control-input agency_type">
									<label class="custom-control-label" for="agency_type_other">อื่นๆ โปรดระบุ</label>
								</div>
							</div>
						</div>
						<div class="col-span-6 sm:col-span-3 md:mx-4">
							<label for="office_type_other_name" class="block text-base font-medium text-gray-700">ชื่อหน่วยงาน <span class="text-red-600">*</span></label>
							<input type="text" name="sample_office_name" id="agency_type_other_name" class="form-control">
						</div>
						<div class="col-span-6 sm:col-span-3 md:mx-4">
							<label for="office_type_other_code" class="block text-base font-medium text-gray-700">รหัสหน่วยงาน <span class="text-red-600">*</span></label>
							<input type="text" name="sample_office_id" id="agency_type_other_id" class="form-control">
						</div>
					</div>
					<div class="grid grid-cols-6 gap-6 mt-12">
						<div class="col-span-6 sm:col-span-6">
							<label for="address" class="block text-base font-medium text-gray-800">ที่อยู่ (เลขที่ หมู่ที่ ถนน หมู่บ้าน/อาคาร) <span class="text-red-600">*</span></label>
							<input type="text" name="sample_office_addr" id="sample_office_addr" class="form-control" disabled>
						</div>
						<div class="col-span-6 sm:col-span-3">
							<label for="province" class="block text-base font-medium text-gray-800">1.5 จังหวัด <span class="text-red-600">*</span></label>
							<select name="sample_office_province" id="province" class="form-control chk-b" disabled>
								<option value="">-- โปรดเลือก --</option>
								@foreach ($data['provinces'] as $key => $val)
									<option value="{{ $key }}">{{ $val }}</option>
								@endforeach
							</select>
						</div>
						<div class="col-span-6 sm:col-span-3">
							<label for="district" class="block text-base font-medium text-gray-800">1.6 เขต/อำเภอ <span class="text-red-600">*</span></label>
							<select name="sample_office_district" id="district" class="form-control" disabled>
								<option value="">-- โปรดเลือก --</option>
							</select>
						</div>
						<div class="col-span-6 sm:col-span-3">
							<label for="sub_district" class="block text-base font-medium text-gray-800">1.7 แขวง/ตำบล <span class="text-red-600">*</span></label>
							<select name="sample_office_sub_district" id="sub_district" class="form-control" disabled>
								<option value="">-- โปรดเลือก --</option>
							</select>
						</div>
						<div class="col-span-6 sm:col-span-3">
							<label for="zip_code" class="block text-base font-medium text-gray-800">1.8 รหัสไปรษณีย์ <span class="text-red-600">*</span></label>
							<input type="text" name="sample_office_postal" id="postcode" class="form-control" disabled>
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
					<button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
@section('script')
<script type="text/javascript" src="{{ URL::asset('assets/js/datagrid/datatables/datatables.bundle.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/formplugins/select2/select2.bundle.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/notifications/sweetalert2/sweetalert2.bundle.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/formplugins/inputmask/inputmask.bundle.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/buttons.server-side.js') }}"></script>
{{ $dataTable->scripts() }}
<script>
$(document).ready(function() {
	$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
	var order_id = $('#order_id').val();
	$('input[name="sample_place_type"]').on('change', function() {
		$('input[name="' + this.name + '"]').not(this).prop('checked', false);
	});
	$('input[id="agency_type_establishment"]').on('change', function() {
		if ($(this).prop("checked") == true) {
			$('#office_name_establishment').val('');
			$('#office_name_establishment').prop('disabled', false);
			$('#office_code_establishment').val('');
			$('#office_code_establishment').prop('disabled', false);
			$('#office_name_establishment').focus();
			$('#agency_type_hospital').prop('checked', false);
			$("#hosp_search").empty().trigger('change');
			$('#hosp_search').prop('disabled', true);
			$('#agency_type_border_check_point').prop('checked', false);
			$('#disease_border_search').empty().trigger('change');
			$('#disease_border_search').prop('disabled', true);
			$('#agency_type_other').prop('checked', false);
			$('#agency_type_other_name').val('');
			$('#agency_type_other_name').prop('disabled', true);
			$('#agency_type_other_id').val('');
			$('#agency_type_other_id').prop('disabled', true);
		} else {
			$('#office_name_establishment').val('');
			$('#office_name_establishment').prop('disabled', true);
			$('#office_code_establishment').val('');
			$('#office_code_establishment').prop('disabled', true);
		 }
	});
	$("#agency_type_hospital").on('change', function() {
		if ($(this).prop("checked") == true) {
			$("#hosp_search").empty().trigger('change');
			$('#hosp_search').prop('disabled', false);
			$('#hosp_search').focus();
			$('#agency_type_establishment').prop('checked', false);
			$('#office_name_establishment').val('');
			$('#office_name_establishment').prop('disabled', true);
			$('#office_code_establishment').val('');
			$('#office_code_establishment').prop('disabled', true);
			$('#agency_type_border_check_point').prop('checked', false);
			$('#disease_border_search').empty().trigger('change');
			$('#disease_border_search').prop('disabled', true);
			$('#agency_type_other').prop('checked', false);
			$('#agency_type_other_name').val('');
			$('#agency_type_other_name').prop('disabled', true);
			$('#agency_type_other_id').val('');
			$('#agency_type_other_id').prop('disabled', true);
		} else {
			$('#hosp_search').empty().trigger('change');
			$('#hosp_search').prop('disabled', true);
		}
	});
	$("#agency_type_border_check_point").on('change', function() {
		if ($(this).prop("checked") == true) {
			$("#disease_border_search").empty().trigger('change');
			$('#disease_border_search').prop('disabled', false);
			$('#disease_border_search').focus();
			$('#agency_type_establishment').prop('checked', false);
			$('#office_name_establishment').val('');
			$('#office_name_establishment').prop('disabled', true);
			$('#office_code_establishment').val('');
			$('#office_code_establishment').prop('disabled', true);
			$('#agency_type_hospital').prop('checked', false);
			$('#hosp_search').empty().trigger('change');
			$('#hosp_search').prop('disabled', true);
			$('#agency_type_other').prop('checked', false);
			$('#agency_type_other_name').val('');
			$('#agency_type_other_name').prop('disabled', true);
			$('#agency_type_other_id').val('');
			$('#agency_type_other_id').prop('disabled', true);
		} else {
			$('#disease_border_search').empty().trigger('change');
			$('#disease_border_search').prop('disabled', true);
		}
	});
	$("#agency_type_other").on('change', function() {
		if ($(this).prop("checked") == true) {
			$('#agency_type_other_name').prop('disabled', false);
			$('#agency_type_other_name').val('');
			$('#agency_type_other_name').focus();
			$('#agency_type_other_id').val('');
			$('#agency_type_other_id').prop('disabled', false);
			$('#agency_type_establishment').prop('checked', false);
			$('#office_name_establishment').val('');
			$('#office_name_establishment').prop('disabled', true);
			$('#office_code_establishment').val('');
			$('#office_code_establishment').prop('disabled', true);
			$('#agency_type_hospital').prop('checked', false);
			$('#hosp_search').empty().trigger('change');
			$('#hosp_search').prop('disabled', true);
			$('#agency_type_border_check_point').prop('checked', false);
			$('#disease_border_search').empty().trigger('change');
			$('#disease_border_search').prop('disabled', true);
		} else {
			$('#agency_type_other_name').val('');
			$('#agency_type_other_name').prop('disabled', true);
			$('#agency_type_other_id').val('');
			$('#agency_type_other_id').prop('disabled', true);
		}
	});

	$('#chk_a').on('change', function() {
		$('#agency_type_establishment').prop('checked', false);
		$('#agency_type_establishment').prop('disabled', true);
		$('#office_name_establishment').prop('disabled', true);
		$('#office_code_establishment').prop('disabled', true);

        $('#agency_type_hospital').prop('checked', false);
        $('#agency_type_hospital').prop('disabled', true);
		$('#hosp_search').empty().trigger('change');
		$('#hosp_search').prop('disabled', true);

		if ($(this).prop("checked") == true) {
			$('#sample_office_addr').val('');
			$('#sample_office_addr').prop('disabled', true);
			$('#province').prop('disabled', true);
			$('#district')[0].options.length = 1;
			$('#district').prop('disabled', true);
			$('#sub_district')[0].options.length = 1;
			$('#sub_district').prop('disabled', true);
			$('#postcode').val('');
			$('#postcode').prop('disabled', true);
		}
	});

	$('#chk_b').on('change', function() {
		if ($(this).prop("checked") == true) {
			$('#agency_type_establishment').prop('checked', false);
			$('#agency_type_establishment').prop('disabled', false);

            $('#agency_type_hospital').prop('checked', true);
            $('#agency_type_hospital').prop('disabled', false);
		    $('#hosp_search').empty().trigger('change');
		    $('#hosp_search').prop('disabled', false);

			$('#sample_office_addr').prop('disabled', false);
			$('#sample_office_addr').val('');
			$('#province').prop('disabled', false);
			$('#district').prop('disabled', false);
			$('#sub_district').prop('disabled', false);
			$('#postcode').prop('disabled', false);
		} else if ($(this).prop("checked") == false) {
			$('#agency_type_establishment').prop('checked', false);
			$('#agency_type_establishment').prop('disabled', true);

			$('#sample_office_addr').val('');
			$('#sample_office_addr').prop('disabled', true);
			$('#province').prop('disabled', true);
			$('#district')[0].options.length = 1;
			$('#district').prop('disabled', true);
			$('#sub_district')[0].options.length = 1;
			$('#sub_district').prop('disabled', true);
			$('#postcode').val('');
			$('#postcode').prop('disabled', true);
		}
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
		var id = $(this).val();
		if (id != "" || id != null || id !== undefined) {
			$.ajax({
				method: "POST",
				url: "{{ route('register.postcode') }}",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					if (!$('#postcode').is('disabled')) {
						$('#postcode').val(response);
					}
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
			$('.select2').select2({dropdownParent: $('#new-data-modal')});
			$(".select2-placeholder-multiple").select2({placeholder: "-- โปรดระบุ --"});
			$(".js-hide-search").select2({minimumResultsForSearch: 1 / 0});
			$(".js-max-length").select2({maximumSelectionLength: 2, placeholder: "Select maximum 2 items"});
			$(".select2-placeholder").select2({placeholder: "-- โปรดระบุ --", allowClear: true,dropdownParent: $('#new-data-modal')});
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
				templateSelection: formatRepoSelection,
				dropdownParent: $('#new-data-modal')
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
				templateSelection: formatRepoSelection,
				dropdownParent: $('#new-data-modal')
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
	});
	</script>
<script>function newData(){$('#new-data-modal').modal('show');}</script>
@endsection

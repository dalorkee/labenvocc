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
								<a href="{{ route('customer.parameter.create', ['order_id' => $data['order_id']]) }}" class="btn btn-info ml-auto"><i class="fal fa-arrow-alt-left"></i> ก่อนหน้า</a>
								<a href="{{ route('customer.verify.create', ['order_id' => $data['order_id']]) }}" class="btn btn-info ml-auto">ถัดไป <i class="fal fa-arrow-alt-right"></i></a>
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
			<form name="add_origin_threat" id="add_origin_threat" action="{{ route('customer.sample.store', ['order_id' => $data['order_id']]) }}" method="POST">
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
							<label class="form-label text-gray-800" for="sample_select_begin">ตัวอย่างที่ <span class="text-danger">*</span></label>
							<select name="sample_select_begin" class="form-control js-hide-search @error('sample_select_begin') is-invalid @enderror">
								<option value="">-- โปรดเลือก --</option>
								@forelse ($data['sample_list'] as $key => $val)
									@if (!empty(old('sample_select_begin')) && old('sample_select_begin') == $val)
										<option value="{{ $val }}" selected>{{ $loop->iteration }}</option>
									@else
										<option value="{{ $val }}">{{ $loop->iteration }}</option>
									@endif
								@empty
									<option value="">ไม่พบข้อมูล</option>
								@endforelse
							</select>
							@error('sample_select_begin')
								<div class="invalid-feedback" role="alert">{{ $message }}</div>
							@enderror
						</div>
						<div class="form-group col-xs-12 col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-3">
							<label class="form-label text-gray-800" for="sample_select_end">ถึง <span class="text-danger">*</span></label>
							<select name="sample_select_end" class="form-control js-hide-search @error('sample_select_end') is-invalid @enderror">
								<option value="">-- โปรดเลือก --</option>
								@forelse ($data['sample_list'] as $key => $val)
									@if (!empty(old('sample_select_end')) && old('sample_select_end') == $val)
										<option value="{{ $val }}" selected>{{ $loop->iteration }}</option>
									@else
										<option value="{{ $val }}">{{ $loop->iteration }}</option>
									@endif
								@empty
									<option value="">ไม่พบข้อมูล</option>
								@endforelse
							</select>
							@error('sample_select_end')
								<div class="invalid-feedback" role="alert">{{ $message }}</div>
							@enderror
						</div>
						<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
							<label class="form-label text-gray-800" for="origin_threat">ประเด็นมลพิษ <span class="text-danger">*</span></label>
							<select name="origin_threat" class="form-control js-hide-search @error('origin_threat') is-invalid @enderror">
								<option value="">-- โปรดเลือก --</option>
								@forelse ($data['origin_threat'] as $key => $val)
									@if (!empty(old('origin_threat')) && old('origin_threat') == $key)
										<option value="{{ $key }}" selected>{{ $val }}</option>
									@else
										<option value="{{ $key }}">{{ $val }}</option>
									@endif
								@empty
									<option value="">-- ไม่พบข้อมูล --</option>
								@endforelse
							</select>
							@error('origin_threat')
								<div class="invalid-feedback" role="alert">{{ $message }}</div>
							@enderror
						</div>
						<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
							<label class="form-label text-gray-800" for="sample_location_define">สถานที่เก็บตัวอย่าง <span class="text-danger">*</span></label>
							<div class="frame-wrap">
								<div class="custom-control custom-switch custom-control-inline">
									<input type="radio" name="sample_location_define" value="1" id="chk_a" class="custom-control-input @error('sample_location_define') is-invalid @enderror" {{(old('sample_location_define')=='1')?'checked':''}}>
									<label class="custom-control-label" for="chk_a">สถานที่เดียวกับหน่วยงานผู้ส่งตัวอย่าง</label>
								</div>
								<div class="custom-control custom-switch custom-control-inline">
									<input type="radio" name="sample_location_define" value="2" id="chk_b" class="custom-control-input @error('sample_location_define') is-invalid @enderror" {{(old('sample_location_define')=='2')?'checked':''}}>
									<label class="custom-control-label" for="chk_b">กำหนดสถานที่ใหม่</label>
								</div>
								@error('sample_location_define')
									<div class="invalid-feedback" role="alert">{{ $message }}</div>
								@enderror
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mt-3 mb-3">
							<div class="card border shadow-0 mb-g shadow-sm-hover">
								<div class="card-body" id="new_location_place">
									<div class="form-row">
										<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
											<div class="custom-control custom-switch">
												<input type="radio" name="sample_location_place_type" value="private" class="custom-control-input radio_location_type @error('sample_location_place_type') is-invalid @enderror" id="sample_location_place_type_private" disabled>
												<label class="custom-control-label" for="sample_location_place_type_private">สถานประกอบการ</label>
											</div>
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-6 col-lg-6 mb-3">
											<label for="sample_location_place_private_name" class="block text-base font-medium text-gray-700">ชื่อหน่วยงาน <span class="text-danger">*</span></label>
											<input type="text" name="sample_location_place_private_name" id="sample_location_place_private_name" class="form-control input-private-group @error('sample_location_place_private_name') is-invalid @enderror" disabled>
											@error('sample_location_place_private_name')
												<div class="invalid-feedback" role="alert">{{ $message }}</div>
											@enderror
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-6 col-lg-6 mb-3">
											<label for="sample_location_place_private_id" class="block text-base font-medium text-gray-700">รหัสสถานประกอบการ <span class="text-danger">*</span></label>
											<input type="text" name="sample_location_place_private_id" id="sample_location_place_private_id" class="form-control input-private-group @error('sample_location_place_private_id') is-invalid @enderror" disabled>
											@error('sample_location_place_private_id')
												<div class="invalid-feedback" role="alert">{{ $message }}</div>
											@enderror
										</div>
									</div>

									<div class="form-row">
										<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mt-3 mb-3">
											<div class="custom-control custom-switch">
												<input type="radio" name="sample_location_place_type" value="government" class="custom-control-input radio_location_type @error('sample_location_place_type') is-invalid @enderror" id="sample_location_place_type_government" disabled>
												<label class="custom-control-label" for="sample_location_place_type_government">หน่วยงานราชการ</label>
											</div>
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-6 col-lg-6 mb-3">
											<label for="agency_ministry" class="form-label block text-base font-medium text-gray-800">สังกัด/กระทรวง <span class="text-red-600">*</span></label>
											<select name="sample_location_place_ministry" id="sample_location_place_ministry" class="form-control input-goverment-group-select @error('sample_location_place_ministry') is-invalid @enderror" disabled>
												<option value="">-- โปรดเลือก --</option>
												@foreach ($data['governments'] as $key => $val)
													<option value="{{ $key.'|'.$val }}">{{ $val }}</option>
												@endforeach
											</select>
											@error('sample_location_place_ministry')
												<div class="invalid-feedback" role="alert">{{ $message }}</div>
											@enderror
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-6 col-lg-6 mb-3">
											<label for="sample_location_place_department" class="form-label block text-base font-medium text-gray-800">สังกัด/กรม <span class="text-red-600">*</span></label>
											<select name="sample_location_place_department" id="sample_location_place_department" class="form-control input-goverment-group-select @error('sample_location_place_department') is-invalid @enderror" disabled>
												<option value="">-- โปรดเลือก --</option>
											</select>
											@error('sample_location_place_department')
												<div class="invalid-feedback" role="alert">{{ $message }}</div>
											@enderror
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
											<label for="sample_location_place_name_government" class="block text-base font-medium text-gray-700">ชื่อหน่วยงาน/กอง/สำนัก/อื่นๆ  <span class="text-danger">*</span></label>
											<input type="text" name="sample_location_place_name_government" id="sample_location_place_name_government" class="form-control input-goverment-group @error('sample_location_place_name_government') is-invalid @enderror" disabled>
											@error('sample_location_place_name_government')
												<div class="invalid-feedback" role="alert">{{ $message }}</div>
											@enderror
										</div>
									</div>

									<div class="form-row">
										<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mt-3 mb-3">
											<div class="custom-control custom-switch">
												<input type="radio" name="sample_location_place_type" value="other" class="custom-control-input radio_location_type @error('sample_location_place_type') is-invalid @enderror" id="sample_location_place_type_other" disabled>
												<label class="custom-control-label" for="sample_location_place_type_other">อื่นๆ</label>
											</div>
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
											<label for="sample_location_place_other_name" class="block text-base font-medium text-gray-700">โปรดระบุ <span class="text-danger">*</span></label>
											<input type="text" name="sample_location_place_other_name" id="sample_location_place_other_name" class="form-control @error('sample_location_place_other_name') is-invalid @enderror" disabled>
											@error('sample_location_place_other_name')
												<div class="invalid-feedback" role="alert">{{ $message }}</div>
											@enderror
										</div>
									</div>

									<div class="form-row mt-3">
										<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
											<label for="sample_location_place_address" class="block text-base font-medium text-gray-800">ที่อยู่ (เลขที่ หมู่ที่ ถนน หมู่บ้าน/อาคาร)</label>
											<input type="text" name="sample_location_place_address" id="sample_location_place_address" class="form-control" disabled>
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-3">
											<label for="sample_location_place_province" class="block text-base font-medium text-gray-800">จังหวัด <span class="text-danger">*</span></label>
											<select name="sample_location_place_province" id="sample_location_place_province" class="form-control chk-b @error('sample_location_place_province') is-invalid @enderror" disabled>
												<option value="">-- โปรดเลือก --</option>
												@foreach ($data['provinces'] as $key => $val)
													<option value="{{ $key.'|'.$val }}">{{ $val }}</option>
												@endforeach
											</select>
											@error('sample_location_place_province')
												<div class="invalid-feedback" role="alert">{{ $message }}</div>
											@enderror
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-3">
											<label for="sample_location_place_district" class="block text-base font-medium text-gray-800">อำเภอ <span class="text-danger">*</span></label>
											<select name="sample_location_place_district" id="sample_location_place_district" class="form-control @error('sample_location_place_district') is-invalid @enderror" disabled>
												<option value="">-- โปรดเลือก --</option>
											</select>
											@error('sample_location_place_district')
												<div class="invalid-feedback" role="alert">{{ $message }}</div>
											@enderror
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-3">
											<label for="sample_location_place_sub_district" class="block text-base font-medium text-gray-800">ตำบล <span class="text-danger">*</span></label>
											<select name="sample_location_place_sub_district" id="sample_location_place_sub_district" class="form-control @error('sample_location_place_sub_district') is-invalid @enderror" disabled>
												<option value="">-- โปรดเลือก --</option>
											</select>
											@error('sample_location_place_sub_district')
												<div class="invalid-feedback" role="alert">{{ $message }}</div>
											@enderror
										</div>
										<div class="form-group col-xs-12 col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-3">
											<label for="sample_location_place_postal" class="block text-base font-medium text-gray-800">รหัสไปรษณีย์</label>
											<input type="text" name="sample_location_place_postal" id="sample_location_place_postal" class="form-control" readonly>
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
						<button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
					</div>
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
<script>
function newData() {
	// $('#chk_b').prop('checked', false);
	// $('#chk_a').prop('checked', true);
	// $('.radio_location_type').prop('checked', false);
	// $('.input-private-group').val('');
	// $('.input-private-group').prop('disabled', true);
	// $('.input-goverment-group-select').val($('.input-goverment-group-select option:first').val());
	// $('.input-goverment-group-select').prop('disabled', true);
	// $('#sample_location_place_name_government').val('');
	// $('#sample_location_place_name_government').prop('disabled', true);
	// $('#sample_location_place_other_name').val('');
	// $('#sample_location_place_other_name').prop('disabled', true);
	// $('#sample_location_place_address').val('');
	// $('#sample_location_place_address').prop('disabled', true);
	// $("#sample_location_place_province").val($("#sample_location_place_province option:first").val());
	// $('#sample_location_place_province').prop('disabled', true);
	// $('#sample_location_place_district')[0].options.length = 1;
	// $('#sample_location_place_district').prop('disabled', true);
	// $('#sample_location_place_sub_district')[0].options.length = 1;
	// $('#sample_location_place_sub_district').prop('disabled', true);
	// $('#sample_location_place_postal').val('');
	$('#new-data-modal').modal('show');
}
</script>
{{ $dataTable->scripts() }}
<script>
$(document).ready(function() {
	$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
	var order_id = $('#order_id').val();
	$('input[type=radio][name=sample_location_define]').on('change', function() {
		$('.radio_location_type').prop('checked', false);
		$('.input-private-group').val('');
		$('.input-private-group').prop('disabled', true);

		$('.input-goverment-group-select').val($('.input-goverment-group-select option:first').val());
		$('.input-goverment-group-select').prop('disabled', true);
		$('#sample_location_place_name_government').val('');
		$('#sample_location_place_name_government').prop('disabled', true);

		$('#sample_location_place_other_name').val('');
		$('#sample_location_place_other_name').prop('disabled', true);
		if (this.value === '2') {
			$('.radio_location_type').attr('disabled', false);

			$('#sample_location_place_address').prop('disabled', false);
			$('#sample_location_place_address').val('');

			$('#sample_location_place_province').prop('disabled', false);
			$("#sample_location_place_province").val($("#sample_location_place_province option:first").val());

			$('#sample_location_place_district').prop('disabled', false);
			$('#sample_location_place_district')[0].options.length = 1;

			$('#sample_location_place_sub_district').prop('disabled', false);
			$('#sample_location_place_sub_district')[0].options.length = 1;

			$('#sample_location_place_postal').val('');
		} else {
			$('.radio_location_type').attr('disabled', true);

			$('#sample_location_place_address').val('');
			$('#sample_location_place_address').prop('disabled', true);

			$("#sample_location_place_province").val($("#sample_location_place_province option:first").val());
			$('#sample_location_place_province').prop('disabled', true);

			$('#sample_location_place_district')[0].options.length = 1;
			$('#sample_location_place_district').prop('disabled', true);

			$('#sample_location_place_sub_district')[0].options.length = 1;
			$('#sample_location_place_sub_district').prop('disabled', true);

			$('#sample_location_place_postal').val('');
		}
	});

	$('input[type=radio][name=sample_location_place_type]').on('change', function() {
		switch (this.value) {
			case 'private':
				$('.input-private-group').prop('disabled', false);
				$('.input-private-group').val('');

				$('.input-goverment-group-select').val($('.input-goverment-group-select option:first').val());
				$('.input-goverment-group-select').prop('disabled', true);
				$('#sample_location_place_name_government').val('');
				$('#sample_location_place_name_government').prop('disabled', true);

				$('#sample_location_place_other_name').val('');
				$('#sample_location_place_other_name').prop('disabled', true);
				break;
			case 'government':
				$('.input-goverment-group-select').prop('disabled', false);
				$('.input-goverment-group-select').val($('.input-goverment-group-select option:first').val());
				$('#sample_location_place_name_government').prop('disabled', false);
				$('#sample_location_place_name_government').val('');

				$('.input-private-group').val('');
				$('.input-private-group').prop('disabled', true);

				$('#sample_location_place_other_name').val('');
				$('#sample_location_place_other_name').prop('disabled', true);
				break;
			case 'other':
				$('#sample_location_place_other_name').prop('disabled', false);
				$('#sample_location_place_other_name').val('');

				$('.input-private-group').val('');
				$('.input-private-group').prop('disabled', true);

				$('.input-goverment-group-select').val($('.input-goverment-group-select option:first').val());
				$('.input-goverment-group-select').prop('disabled', true);
				$('#sample_location_place_name_government').val('');
				$('#sample_location_place_name_government').prop('disabled', true);
				break;
		}
	});

	$('#sample_location_place_province').change(function() {
		if ($(this).val() != '') {
			let prov_txt = $(this).val().split('|');
			$.ajax({
				method: "GET",
				url: "{{ route('boundary.fetch.district') }}",
				dataType: "html",
				data: {id: prov_txt[0]},
				success: function(response) {
					$('#sample_location_place_district').html(response);
				},
				error: function(jqXhr, textStatus, errorMessage) {
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});
	$('#sample_location_place_district').change(function() {
		if ($(this).val() != '') {
			let dist_txt = $(this).val().split('|');
			$.ajax({
				method: "GET",
				url: "{{ route('boundary.fetch.sub.district') }}",
				dataType: "html",
				data: {id: dist_txt[0]},
				success: function(response) {
					$('#sample_location_place_sub_district').html(response);
				},
				error: function(jqXhr, textStatus, errorMessage) {
					alert('Sub district error: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});
	$('#sample_location_place_sub_district').change(function() {
		if ($(this).val() != '') {
			let sub_dist_txt = $(this).val().split('|');
			$.ajax({
				method: "GET",
				url: "{{ route('boundary.fetch.postcode') }}",
				dataType: "html",
				data: {id: sub_dist_txt[0]},
				success: function(response) {
					if (!$('#sample_location_place_postal').is('disabled')) {
						$('#sample_location_place_postal').val(response);
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
	$('#sample_location_place_ministry').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('register.department.v2') }}",
				dataType: "html",
				data: {id:id},
				success: function(response) {
					$("#sample_location_place_department").html(response);
				},
				error: function(jqXhr, textStatus, errorMessage) {
					alert('GovDept error: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});
});
</script>
<script>
$(document).ready(function() {
	$(function() {
			$('.select2').select2({dropdownParent: $('#new-data-modal')});
			// $(".select2-placeholder-multiple").select2({placeholder: "-- โปรดระบุ --"});
			$(".js-hide-search").select2({dropdownParent: $('#new-data-modal') ,minimumResultsForSearch: 1/0});
			// $(".js-max-length").select2({maximumSelectionLength: 2, placeholder: "Select maximum 2 items"});
			$(".select2-placeholder").select2({placeholder: "-- โปรดเลือก --", allowClear: true,dropdownParent: $('#new-data-modal')});
			// $(".js-select2-icons").select2({
			// 	minimumResultsForSearch: 1 / 0,
			// 	templateResult: icon,
			// 	templateSelection: icon,
			// 	escapeMarkup: function(elm){
			// 		return elm
			// 	}
			// });

			// function icon(elm){
			// 	elm.element;
			// 	return elm.id ? "<i class='" + $(elm.element).data("icon") + " mr-2'></i>" + elm.text : elm.text
			// }
			/* hospital search by name */
			// $("#hosp_search").select2({
			// 	ajax: {
			// 		method: "POST",
			// 		url: "{{ route('register.hospital') }}",
			// 		dataType: 'json',
			// 		delay: 250,
			// 		data: function (params) {
			// 			return {
			// 				q: params.term,
			// 				page: params.page
			// 			};
			// 		},
			// 		processResults: function (data, params) {
			// 			params.page = params.page || 1;
			// 			return {
			// 				results: data.items,
			// 				pagination: {
			// 					more: (params.page * 30) < data.total_count
			// 				}
			// 			};
			// 		},
			// 		cache: true
			// 	},
			// 	escapeMarkup: function (markup) { return markup; },
			// 	placeholder: "โปรดกรอกข้อมูล",
			// 	minimumInputLength: 3,
			// 	maximumInputLength: 20,
			// 	templateResult: formatRepo,
			// 	templateSelection: formatRepoSelection,
			// 	dropdownParent: $('#new-data-modal')
			// });

			/* disease border search by name */
			// $("#disease_border_search").select2({
			// 	ajax: {
			// 		method: "POST",
			// 		url: "{{ route('register.hospital') }}",
			// 		dataType: 'json',
			// 		delay: 250,
			// 		data: function (params) {
			// 			return {
			// 				q: params.term,
			// 				page: params.page
			// 			};
			// 		},
			// 		processResults: function (data, params) {
			// 			params.page = params.page || 1;
			// 			return {
			// 				results: data.items,
			// 				pagination: {
			// 					more: (params.page * 30) < data.total_count
			// 				}
			// 			};
			// 		},
			// 		cache: true
			// 	},
			// 	escapeMarkup: function (markup) { return markup; },
			// 	placeholder: "โปรดกรอกข้อมูล",
			// 	minimumInputLength: 3,
			// 	maximumInputLength: 20,
			// 	templateResult: formatRepo,
			// 	templateSelection: formatRepoSelection,
			// 	dropdownParent: $('#new-data-modal')
			// });

	});
	// function formatRepo (repo) {
	// 	if (repo.loading) return repo.text;
	// 	var markup = "<div class='select2-result-repository clearfix'>" +
	// 		"<div class='select2-result-repository__meta'>" +
	// 		"<div class='select2-result-repository__title'>" + repo.value + "</div></div></div>";
	// 		return markup;
	// }
	// function formatRepoSelection (repo) {
	// 	return repo.value || repo.text;
	// }
});
</script>
@endsection

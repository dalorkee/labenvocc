@extends('layouts.index')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/pj-step.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/datagrid/datatables/datatables.bundle.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('vendor/jquery-contextmenu/css/jquery.contextMenu.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/notifications/sweetalert2/sweetalert2.bundle.css') }}" media="screen, print">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css') }}">
<style>
.btn-group {margin:0 0 5px 0;padding:0;}
.dataTables_filter label {margin-top: 8px;}
.dataTables_filter input:first-child {margin-top: -8px;}
.buttons-create {float:left;margin-left:12px;}
.buttons-create:after {content:'';clear:both;}
.dt-btn {margin:0;padding:0;}
#order-table thead {background-color:#297FB0;color: white;}
.row-completed {width:180px;padding-right:14px;position:absolute;top:82px;right:10px;text-align:right;}
</style>
@endsection
@section('content')
<ol class="breadcrumb page-breadcrumb text-sm font-prompt">
	<li class="breadcrumb-item"><a href="javascript:void(0);">LabEnvOcc</a></li>
	<li class="breadcrumb-item">คำขอส่งตัวอย่างชีวภาพ</li>
	<li class="breadcrumb-item">พารามิเตอร์</li>
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
                <div class="row-completed"><span class="badge badge-danger p-2">จำนวน {{ number_format($row_completed) }} ตัวอย่าง</span></div>
				<form>
					<div class="panel-content">
						<ul class="steps mb-3">
							<li class="undone"><a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="ข้อมูลทั่วไป"><i class="fal fa-user"></i> <span class="d-none d-sm-inline">ข้อมูลทั่วไป</span></a></li>
							<li class="active"><a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="พารามิเตอร์"><i class="fal fa-tachometer"></i> <span class="d-none d-sm-inline">พารามิเตอร์</span></a></li>
							<li class="undone"><a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="ข้อมูลตัวอย่าง"><i class="fal fa-list-ul"></i> <span class="d-none d-sm-inline">ข้อมูลตัวอย่าง</span></a></li>
							<li class="undone"><a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="ตรวจสอบข้อมูล"><i class="fal fa-check-circle"></i> <span class="d-none d-sm-inline">ตรวจสอบข้อมูล</span></a></li>
						</ul>
						{{ $dataTable->table() }}
					</div>
					<div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex flex-row align-items-center">
						<div class="form-row">
							<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
								{{-- <button class="btn btn-primary ml-auto" type="button"><i class="fal fa-save"></i> บันทึกร่าง</button> --}}
								<a href="{{ route('customer.info.create', ['order_id' => $order_id]) }}" class="btn btn-warning ml-auto"><i class="fal fa-arrow-alt-left"></i> ก่อนหน้า</a>
								<a href="{{ route('customer.sample.create', ['order_id' => $order_id]) }}" class="btn btn-warning ml-auto">ถัดไป <i class="fal fa-arrow-alt-right"></i></a>
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
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content">
			<form name="modal_new_data" action="{{ route('customer.parameter.personal.store') }}" method="POST">
				@csrf
				<div class="modal-header bg-green-600 text-white">
					<h5 class="modal-title"><i class="fal fa-plus-circle"></i> เพิ่มข้อมูลตัวอย่างใหม่</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true"><i class="fal fa-times"></i></span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-row">
						<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
							<label class="form-label" for="title_name">คำนำหน้าชื่อ <span class="text-red-600">*</span></label>
							<div class="frame-wrap">
								<div class="custom-control custom-checkbox custom-control-inline">
									<input type="checkbox" name="title_name" value="mr" class="custom-control-input" id="chk_mr" @if (old('title_name') == 'mr') checked @endif>
									<label class="custom-control-label" for="chk_mr">นาย</label>
								</div>
								<div class="custom-control custom-checkbox custom-control-inline">
									<input type="checkbox" name="title_name" value="mrs" class="custom-control-input" id="chk_mrs" @if (old('title_name') == 'mrs') checked @endif>
									<label class="custom-control-label" for="chk_mrs">นาง</label>
								</div>
								<div class="custom-control custom-checkbox custom-control-inline">
									<input type="checkbox" name="title_name" value="miss" class="custom-control-input" id="chk_miss" @if (old('title_name') == 'miss') checked @endif>
									<label class="custom-control-label" for="chk_miss">นางสาว</label>
								</div>
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-6 col-lg-6 mb-3">
							<label class="form-label" for="id_card">เลขบัตรประชาชน <span class="text-red-600">*</span></label>
							<input type="hidden" name="order_id" value="{{ $order_id }}" id="order_id">
							<input type="text" name="id_card" value="{{ old('id_card') }}" placeholder="" data-inputmask="'mask': '9-9999-99999-99-9'" maxlength="18" class="form-control @error('id_card') is-invalid @enderror">
							@error('id_card')
								<div class="invalid-feedback" role="alert">{{ $message }}</div>
							@enderror
						</div>
						<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-6 col-lg-6 mb-3">
							<label class="form-label" for="passport">พาสปอร์ต</label>
							<input type="text" name="passport" value="{{ old('passport') }}" class="form-control @error('passport') is-invalid @enderror" >
							@error('passport')
								<div class="invalid-feedback" role="alert">{{ $message }}</div>
							@enderror
						</div>
						<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-6 col-lg-6 mb-3">
							<label class="form-label" for="firstname">ชื่อ <span class="text-red-600">*</span></label>
							<input type="text" name="firstname" value="{{ old('firstname') }}" class="form-control @error('firstname') is-invalid @enderror" >
							@error('firstname')
								<div class="invalid-feedback" role="alert">{{ $message }}</div>
							@enderror
						</div>
						<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-6 col-lg-6 mb-3">
							<label class="form-label" for="lastname">นามสกุล <span class="text-red-600">*</span></label>
							<input type="text" name="lastname" value="{{ old('lastname') }}" class="form-control @error('lastname') is-invalid @enderror" >
							@error('lastname')
								<div class="invalid-feedback" role="alert">{{ $message }}</div>
							@enderror
						</div>
						<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-6 col-lg-6 mb-3">
							<label class="form-label" for="age_year">อายุ/ปี <span class="text-red-600">*</span></label>
							<input type="number" name="age_year" value="{{ old('age_year') }}" min="1" max="100" class="form-control @error('age_year') is-invalid @enderror" >
							@error('age_year')
								<div class="invalid-feedback" role="alert">{{ $message }}</div>
							@enderror
						</div>
						<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-6 col-lg-6 mb-3">
							<label class="form-label" for="division">แผนก <span class="text-red-600">*</span></label>
							<input type="text" name="division" value="{{ old('division') }}" class="form-control @error('division') is-invalid @enderror" >
							@error('division')
								<div class="invalid-feedback" role="alert">{{ $message }}</div>
							@enderror
						</div>
						<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-6 col-lg-6 mb-3">
							<label class="form-label" for="work_life_year">อายุงาน/ปี <span class="text-red-600">*</span></label>
							<input type="number" name="work_life_year" value="{{ old('work_life_year') }}" min="1" max="100" class="form-control @error('work_life_year') is-invalid @enderror" >
							@error('work_life_year')
								<div class="invalid-feedback" role="alert">{{ $message }}</div>
							@enderror
						</div>
						<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-6 col-lg-6 mb-3">
							<label class="form-label" for="specimen_date">วันที่เก็บตัวอย่าง <span class="text-red-600">*</span></label>
							<div class="input-group">
								<input type="text" name="specimen_date" class="form-control " readonly placeholder="เลือกวันที่" id="datepicker_specimen_date">
								<div class="input-group-append">
									<span class="input-group-text fs-xl">
										<i class="fal fa-calendar-alt"></i>
									</span>
								</div>
							</div>
						</div>
						<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
							<label class="form-label" for="note">หมายเหตุ</label>
							<input type="text" name="note" value="{{ old('note') }}" class="form-control @error('note') is-invalid @enderror" >
							@error('note')
								<div class="invalid-feedback" role="alert">{{ $message }}</div>
							@enderror
						</div>
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
<!-- Modal update personal Data-->
<div class="modal fade font-prompt" id="edit-customer-personal-modal" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content" id="edit-customer-personal"></div>
	</div>
</div>
<!-- Modal add parameter-->
<div class="modal font-prompt" id="add-parameter-modal" data-keyboard="false" data-backdrop="static" tabindex="-2" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-xl modal-dialog-centered" role="document">
		<div class="modal-content">
			<form name="modal_new_parameter" action="#" method="POST">
				@csrf
				<div class="modal-header bg-green-600 text-white">
					<h5 class="modal-title"><i class="fal fa-plus-circle"></i> เพิ่มพารามิเตอร์ตัวอย่างชีวภาพ</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true"><i class="fal fa-times"></i></span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-row">
						<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
							<label class="form-label" for="parameter">กลุ่มรายงานตรวจวิเคราะห์</label>
							<input type="hidden" name="aj_order_detail_id" value="" id="aj_order_detail_id">
							<select name="parameter_group" id="parameter_group" class="select2-placeholder mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
								<option value="0">-- ทั้งหมด --</option>
								<option value="1">กลุ่มโลหะหนัก</option>
								<option value="2">กลุ่มสารอินทรีย์ระเหยและสารประกอบอินทรีย์</option>
								<option value="3">กลุ่มสารอินทรีย์แปรรูป</option>
								<option value="4">กลุ่มสิ่งก่อกลายพันธุ์</option>
							</select>
						</div>
					</div>
					<div class="form-row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
							<table class="table table-bordered text-sm dt-parameter">
								<thead class="bg-gray-300">
									<tr>
										<th>ลำดับ</th>
										<th>พารามิเตอร์</th>
										<th>สิ่งส่งตรวจ</th>
										<th>ห้องปฏิบัติการ</th>
										<th>ราคา (บาท)</th>
										<th>เพิ่ม</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
@section('script')
<script type="text/javascript" src="{{ URL::asset('assets/js/datagrid/datatables/datatables.bundle.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/buttons.server-side.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('vendor/jquery-contextmenu/js/jquery.contextMenu.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/notifications/sweetalert2/sweetalert2.bundle.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/formplugins/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/formplugins/inputmask/inputmask.bundle.js') }}"></script>
{{ $dataTable->scripts() }}
<script>
function newData(){$('#new-data-modal').modal('show');}
var controls = {leftArrow: '<i class="fal fa-angle-left" style="font-size: 1.25rem"></i>', rightArrow: '<i class="fal fa-angle-right" style="font-size: 1.25rem"></i>'}
var runDatePicker = function() {
	$('#datepicker_specimen_date').datepicker({
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		orientation: "bottom left",
		templates: controls
	});
}
</script>
<script>
$(document).ready(function() {
	$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
	var order_id = $('#order_id').val();
	runDatePicker();
	$('input[name="title_name"]').on('change', function() {
		$('input[name="' + this.name + '"]').not(this).prop('checked', false);
	});
	$(":input").inputmask();
	$.contextMenu({
		selector: '.context-nav',
		trigger: 'left',
		delay: 500,
		className: 'data-title',
		callback: function(itemKey, opt) {
			switch (itemKey) {
				case 'edit':
					let id = $(this).data('id');
					$.ajax({
						method: 'GET',
						url: '{{ route("customer.parameter.personal.edit") }}',
						data: {id:id},
						dataType: 'HTML',
						success: function(data) {
							$('#edit-customer-personal').html(data);
							$(":input").inputmask();
							$('#datepicker_edit_specimen_date').datepicker({
								format: 'dd/mm/yyyy',
								todayHighlight: true,
								orientation: "bottom left",
								templates: controls
							});
							$('#edit-customer-personal-modal').modal({backdrop: 'static', keyboard: false});
						},
						error: function(data, status, error) {alert(error);}
					});
					break;
				case 'parameter':
						let order_detail_id = $(this).data('id');
						let url = "{{ route('customer.parameter.data.list', ['order_detail_id'=>':order_detail_id','threat_type_id'=>0]) }}";
						url = url.replace(':order_detail_id', order_detail_id);
						$("#aj_order_detail_id").val(order_detail_id);
						let table = $('.dt-parameter').DataTable({
						processing: true,
						serverSide: true,
						paging: true,
						searching: true,
						bDestroy: true,
						ajax: url,
						columns: [
							/* {data: 'DT_RowIndex', name: 'DT_RowIndex'}, */
							{data: 'id', name: 'id'},
							{data: 'parameter_name', name: 'parameter_name'},
							{data: 'sample_charecter_name', name: 'sample_charecter_name'},
							{data: 'office_name', name: 'office_name'},
							{data: 'unit_name', name: 'unit_name'},
							{data: 'action', name: 'action', orderable: true, searchable: false},
						],
					});
					$('#add-parameter-modal').modal('show');
					/*table.destroy();*/
					break;
				case 'delete':
					let del_id = $(this).data('id');
					let del_url = "{{ route('customer.parameter.personal.destroy', ['id'=>':id']) }}";
					del_url = del_url.replace(':id', del_id);
					var swalWithBootstrapButtons = Swal.mixin({
						customClass:{confirmButton: "btn btn-danger",cancelButton: "btn btn-primary mr-2"},
						buttonsStyling: false
					});
					swalWithBootstrapButtons.fire({
						title: "ยืนยันการลบข้อมูล?",
						text: "การลบข้อมูลรายการนี้ พารามิเตอร์ที่เลือกไว้จะถูกลบไปด้วย",
						type: "warning",
						showCancelButton: true,
						confirmButtonText: "ลบทันที",
						cancelButtonText: 'ยกเลิก',
						reverseButtons: true,
						footer: "LAB ENV-OCC DDC",
						allowOutsideClick: false
					}).then(function(result) {
						if (result.value) {
							window.location.replace(del_url);
						}
					});
					break;
				default:
					let df_url = "{{ route('logout') }}";
					window.location.replace(df_url);
					break;
			}
		},
		items: {
			"edit": {name: "แก้ไขข้อมูล", icon: "fal fa-edit"},
			"sep1": "---------",
			"parameter": {name: "เพิ่มพารามิเตอร์", icon: "fal fa-tachometer"},
			"sep2": "---------",
			"delete": {name: "ลบข้อมูล", icon: "fal fa-trash-alt"},
			"sep3": "---------",
			"quit": {name: "ปิด", icon: "fal fa-times"}
		}
	});
	$('#parameter_group').on('change', function() {
		let order_detail_id = $("#aj_order_detail_id").val();
		let threat_type_id = $(this).val();
		let url = "{{ route('customer.parameter.data.list', ['order_detail_id'=>':order_detail_id', 'threat_type_id'=>':threat_type_id']) }}";
		url = url.replace(':order_detail_id', order_detail_id);
		url = url.replace(':threat_type_id', threat_type_id);
		let table = $('.dt-parameter').DataTable({
			processing: true,
			serverSide: true,
			paging: true,
			searching: true,
			bDestroy: true,
			ajax: url,
			columns: [
				{data: 'id', name: 'id'},
				{data: 'parameter_name', name: 'parameter_name'},
				{data: 'sample_charecter_name', name: 'sample_charecter_name'},
				{data: 'office_name', name: 'office_name'},
				{data: 'unit_name', name: 'unit_name'},
				{data: 'action', name: 'action', orderable: true, searchable: false},
			],
		});
		$('#add-parameter-modal').modal('show');
	});
});
</script>
@endsection

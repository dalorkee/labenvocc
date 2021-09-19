@extends('layouts.index')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/pj-step.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/datagrid/datatables/datatables.bundle.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('vendor/jquery-contextmenu/css/jquery.contextMenu.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/notifications/sweetalert2/sweetalert2.bundle.css') }}" media="screen, print">
<style>
.btn-group {margin:0 0 5px 0;padding:0;}
.dataTables_filter label {margin-top: 8px;}
.dataTables_filter input:first-child {margin-top: -8px;}
#order-table thead {background-color:#297FB0;color: white;}
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
					<button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
					<button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
					<button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
				</div>
			</div>
			<div class="panel-container relative">
				<form>
					<div class="panel-content">
						<ul class="steps">
							<li class="undone"><a href=""><i class="fal fa-user"></i> <span class="d-none d-sm-inline">ข้อมูลทั่วไป</span></a></li>
							<li class="active"><p><i class="fal fa-user"></i> <span class="d-none d-sm-inline">พารามิเตอร์</span></p></li>
							<li class="undone"><p><i class="fal fa-user"></i> <span class="d-none d-sm-inline">ข้อมูลตัวอย่าง</span></p></li>
							<li class="undone"><p><i class="fal fa-user"></i> <span class="d-none d-sm-inline">ตรวจสอบข้อมูล</span></p></li>
						</ul>
						{{ $dataTable->table() }}
					</div>
					<div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex flex-row align-items-center">
						<div class="form-row">
							<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
								<button class="btn btn-primary ml-auto" type="button"><i class="fal fa-save"></i> บันทึกร่าง</button>
								<a href="{{ route('customer.info') }}" class="btn btn-warning ml-auto"><i class="fal fa-arrow-alt-left"></i> ก่อนหน้า</a>
								<a href="" class="btn btn-warning ml-auto">ต่อไป <i class="fal fa-arrow-alt-right"></i></a>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- Modal New Data-->
<div class="modal fade font-prompt" id="new-data-modal" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content">
			<form name="modal_new_data" action="{{ route('customer.personal') }}" method="POST">
				@csrf
				<div class="modal-header bg-green-600 text-white">
					<h5 class="modal-title"><i class="fal fa-plus-circle"></i> เพิ่มข้อมูลใหม่</h5>
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
							<input type="text" name="id_card" value="{{ old('id_card') }}" class="form-control @error('id_card') is-invalid @enderror">
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
							<label class="form-label" for="age_year">อายุ <span class="text-red-600">*</span></label>
							<input type="text" name="age_year" value="{{ old('age_year') }}" class="form-control @error('age_year') is-invalid @enderror" >
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
							<label class="form-label" for="work_life_year">อายุงาน <span class="text-red-600">*</span></label>
							<input type="text" name="work_life_year" value="{{ old('work_life_year') }}" class="form-control @error('work_life_year') is-invalid @enderror" >
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
					<button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
					<button type="submit" class="btn btn-primary">บันทึก</button>
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
{{ $dataTable->scripts() }}
<script>
function newData(){$('#new-data-modal').modal('show');}
</script>
<script>
$(document).ready(function() {
	$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $('input[name="title_name"]').on('change', function() {
		$('input[name="' + this.name + '"]').not(this).prop('checked', false);
	});
	$.contextMenu({
		selector: '.context-nav',
		trigger: 'left',
		delay: 500,
		className: 'data-title',
		callback: function(itemKey, opt) {
			var id = $(this).data('id');
			switch (itemKey) {
				case 'edit':
					$.ajax({
						method: 'POST',
						url: '',
						data: {id:id},
						dataType: 'HTML',
						success: function(data) {
							$('#data_resp').html(data);
							$('#edit-modal').modal({backdrop: 'static', keyboard: false})
						},
						error: function(data, status, error) {
							alert(error);
						}
					});
					break;
				case 'view':
					alert('ยังไม่เปิดใช้ Featuer นี้');
					break;
				case 'export':
					alert('ยังไม่เปิดใช้ Featuer นี้');
					break;
				case 'delete':
					alert('ยังไม่เปิดใช้ Featuer นี้');
					break;
				default:
					break;
			}
		},
		items: {
			"edit": {name: "แก้ไขข้อมูล", icon: "fal fa-edit"},
			"sep1": "---------",
			"view": {name: "เพิ่มพารามิเตอร์", icon: "fal fa-tachometer"},
			"export": {name: "แก้ไขพารามิเตอร์", icon: "fal fa-tachometer-alt"},
			"sep2": "---------",
			"delete": {name: "ลบข้อมูล", icon: "fal fa-trash-alt"},
			"sep3": "---------",
			"quit": {name: "ปิด", icon: "fal fa-times"}
		}
	});
})
</script>
@endsection

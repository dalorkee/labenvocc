@extends('layouts.index')
@section('token')<meta name="csrf-token" content="{{ csrf_token() }}">@endsection
@section('style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/pj-step.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/datagrid/datatables/datatables.bundle.css') }}">
<style>
.input-date:read-only{background:#fefefe!important}
.btn-group {margin:0 0 5px 0;padding:0;}
.dataTables_filter label {margin-top: 8px;}
.dataTables_filter input:first-child {margin-top: -8px;}
.buttons-create {float:left;margin-left:12px;}
.buttons-create:after {content:'';clear:both;}
.dt-btn {margin:0;padding:0;}
#order-table thead {background-color:#297FB0;color: white;}
.row-completed {width:180px;padding-right:14px;position:absolute;top:82px;right:10px;text-align:right;}
table.dataTable.dt-checkboxes-select tbody tr,
table.dataTable thead .dt-checkboxes-select-all {cursor: pointer;}
table.dataTable thead .dt-checkboxes-select-all {text-align: center;}
div.dataTables_wrapper span.select-info,
div.dataTables_wrapper span.select-item {margin-left: 0.5em;}
@media screen and (max-width: 640px) {div.dataTables_wrapper span.select-info,div.dataTables_wrapper span.select-item {margin-left: 0;display: block;}}
</style>
@endsection
@section('content')
<ol class="breadcrumb page-breadcrumb text-sm font-prompt">
	<li class="breadcrumb-item"><i class="fal fa-home mr-1"></i> <a href="{{ route('sample.destroy.order.show') }}">งานทำลายข้อมูล</a></li>
	<li class="breadcrumb-item">รายการตัวอย่าง</li>
</ol>
<div class="row text-sm font-prompt">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
		<div id="panel-1" class="panel">
			<div class="panel-hdr">
				<h2><span class="text-primary"><i class="fal fa-th-list"></i>&nbsp;ตัวอย่าง</span></h2>
				<div class="panel-toolbar">
					<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"><i class="fal fa-window-minimize"></i></button>
					<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"><i class="fal fa-expand"></i></button>
					<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"><i class="fal fa-times"></i></button>
				</div>
			</div>
			<div class="panel-container show">
				<form name="destroy_approve_frm" action="{{ route('sample.destroy.order.approve.store') }}" id="destroy_approve_frm" method="POST">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="panel-content">
						<ul class="steps">
							<li class="undone"><a href="{{ route('sample.received.create') }}"><span class="d-none d-sm-inline">รายการคำขอ</span></a></li>
							<li class="undone"><p><span class="d-none d-sm-inline">รับตัวอย่าง</span></p></li>
							<li class="active"><p><span class="d-none d-sm-inline">การตรวจวิเคราะห์</span></p></li>
							<li class="undone"><p><span class="d-none d-sm-inline">รายงานผล</span></p></li>
						</ul>
						<h4>รายการตัวอย่าง</h4>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mt-4">
								<div id="order-table">
									{{ $dataTable->table() }}
								</div>
							</div>
						</div>
					</div>
					<div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0 text-right">
						{{-- <a href="#" class="btn btn-primary"><i class="fal fa-home"></i> กลับไปหน้าแรก</a> --}}
						<button type="button" class="btn btn-success" id="btn_submit"><i class="fal fa-save"></i> บันทึกข้อมูล</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script type="text/javascript" src="{{ URL::asset('assets/js/datagrid/datatables/datatables.bundle.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/buttons.server-side.js') }}"></script>
{{ $dataTable->scripts() }}
<script type="text/javascript">
	$(document).ready(function() {
		$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
		$('#btn_submit').click(function(e) {
			 e.preventDefault();
			let $form = $('form#destroy_approve_frm');
		 	Swal.fire({
		 		type: "info",
		 		title: "<span class='text-danger'>ยืนยันการอนุมัติลำลายตัวอย่าง</span>",
		 		html: "<span class='text-primary'>โปรดตรวจสอบข้อมูลว่าถูกต้องแล้วหรือไม่ </span> <p class='text-danger'>ต้องการการบันทึกข้อมูลใช่หรือไม่ ?</p>" ,
		 		showCancelButton: true,
		 		cancelButtonColor: '#dd3333',
		 		cancelButtonText: "ยกเลิก",
				confirmButtonColor: '#3085d6',
		 		confirmButtonText: "ตกลง",
		 		footer: "Lab Env-Occ",
		 		allowOutsideClick: false
		 	}).then((result) => {
		  		if (result.value == true) {
					 $form.submit();
		 		} else {
		 			return false;
		 		}
		 	});
		 });
	});
</script>
@endpush

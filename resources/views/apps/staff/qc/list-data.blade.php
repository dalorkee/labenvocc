@extends('layouts.index')
@section('token')<meta name="csrf-token" content="{{ csrf_token() }}">@endsection
@section('style')
<link type="text/css" rel="stylesheet" href="{{ URL::asset('css/pj-step.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/datagrid/datatables/datatables.bundle.css') }}">
{{-- <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/notifications/sweetalert2/sweetalert2.bundle.css') }}" media="screen, print"> --}}
<style type="text/css">
	.input-date:read-only{background:#fefefe!important}
	.btn-group {margin:0 0 5px 0;padding:0}
	.dataTables_filter label {margin-top: 8px}
	.dataTables_filter input:first-child {margin-top: -8px}
	.buttons-create {float:left;margin-left:12px}
	.buttons-create:after {content:'';clear:both}
	.dt-btn {margin:0;padding:0}
	table thead {background-color:#297FB0;color: white}
	.row-completed {width:180px;padding-right:14px;position:absolute;top:82px;right:10px;text-align:right}
	table.dataTable.dt-checkboxes-select tbody tr,
	table.dataTable thead .dt-checkboxes-select-all {cursor: pointer}
	table.dataTable thead .dt-checkboxes-select-all {text-align: center}
	div.dataTables_wrapper span.select-info,
	div.dataTables_wrapper span.select-item {margin-left: 0.5em}
	@media screen and (max-width: 640px) {div.dataTables_wrapper span.select-info,div.dataTables_wrapper span.select-item {margin-left: 0;display: block}}
	</style>
@endsection
@section('content')
<ol class="breadcrumb page-breadcrumb text-sm font-prompt">
	<li class="breadcrumb-item"><i class="fal fa-home mr-1"></i> <a href="{{ route('sample.received.index') }}">งานตรวจวิเคราะห์</a></li>
	<li class="breadcrumb-item"><a href="#">รายการตัวอย่าง</a></li>
	<li class="breadcrumb-item">Lab xxx</li>
</ol>
<div class="row text-sm font-prompt">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
		<div id="panel-1" class="panel">
			<div class="panel-hdr">
				<h2><span class="text-blue-500"><i class="fal fa-th-list"></i>&nbsp;ตัวอย่าง</span></h2>
				<div class="panel-toolbar">
					<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"><i class="fal fa-window-minimize"></i></button>
					<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"><i class="fal fa-expand"></i></button>
					<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"><i class="fal fa-times"></i></button>
				</div>
			</div>
			<div class="panel-container show">
				<form name="qcData" action="" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="panel-content">
						<ul class="steps">
							<li class="undone"><a href="{{ route('sample.received.create') }}"><span class="d-none d-sm-inline">รายการคำขอ</span></a></li>
							<li class="undone"><p><span class="d-none d-sm-inline">รับตัวอย่าง</span></p></li>
							<li class="active"><p><span class="d-none d-sm-inline">การตรวจวิเคราะห์</span></&p></li>
							<li class="undone"><p><span class="d-none d-sm-inline">รายงานผล</span></p></li>
						</ul>
						<div class="row">
							<div class="table-responsive col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mt-4 mb-3">
								<table class="table table-striped" id="tbl_data" width="100%">
									<thead class="bg-primary-100">
										<tr>
											<th>ลำดับ</th>
											<th>หมายเลขทดสอบ</th>
											<th>พารามิเตอร์</th>
											<th></th>
										</tr>
									</thead>
									<tfoot></tfoot>
									<tbody></tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0">
						<div class="relative" style="height: 50px;">
							<div class="absolute top-0 left-0">
								<button type="button" class="btn btn-primary"><i class="fal fa-home"></i> กลับไปหน้าหลัก</button>
								<button type="button" class="btn btn-info" onclick="showAllResultModal('{{ $data['order_id'] }}','{{ $data['lab_no'] }}');"><i class="fal fa-eye"></i> View All</button>
							</div>
							<div class="absolute top-0 right-0">
								<button type="button" class="btn btn-success" data-lab_no="0000166"><i class="fal fa-check-circle"></i> Approve</button>
								<button type="button" id="ijet" class="btn btn-danger"><i class="fal fa-minus-circle"></i> Reject</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="loader text-center">
	<div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
		<span class="sr-only">Loading...</span>
	</div>
</div>
<div id="result-modal-wrapper"></div>
<div id="result-curve-modal-wrapper"></div>
<div id="result-all-modal-wrapper"></div>
@endsection
@push('scripts')
<script type="text/javascript" src="{{ URL::asset('assets/js/datagrid/datatables/datatables.bundle.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/buttons.server-side.js') }}"></script>
{{-- <script type="text/javascript" src="{{ URL::asset('assets/js/notifications/sweetalert2/sweetalert2.bundle.js') }}"></script> --}}
<script type="text/javascript">
$(document).ready(function() {
	$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
	var table = $('#tbl_data').DataTable({
		processing: true,
		serverSide: true,
		stateSave : true,
		paging: true,
		searching: false,
		deferRender: true,
		lengthMenu: [10, 20, 40],
		language: {'url': '/vendor/DataTables/i18n/thai.json'},
		ajax: "{{ route('sample.qc.list.data.dt', ['id'=>'1', 'user_id'=>'25', 'lab_no'=>'0000166']) }}",
		columns: [
			{data: 'DT_RowIndex', name: 'DT_RowIndex', width: '6%', className: 'text-center'},
			{data: 'sample_test_no', name: 'sample_test_no'},
			{data: 'paramet', name: 'paramet'},
			{data: 'btn', name: 'btn', className: 'text-right'},
		],
		order: [[1, 'asc']]
	});
});
function showResultModal(btn, lab_no, order_id, test_no) {
	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		type: "POST",
		url: "{{ route('sample.qc.result.modal') }}",
		dataType: "html",
		data: {btn:btn, lab_no:lab_no, order_id:order_id, test_no:test_no},
		beforeSend: function() {$(".loader").show()},
		success: function(data) {
			$('#result-modal-wrapper').html(data);
			$('#view-modal-lg-center').modal('show');
		},
		complete: function() {$('.loader').hide()},
		error: function(jqXhr, textStatus, errorMessage) {alert('Error: ' + jqXhr.status + errorMessage)}
	});
}
function showCurveResultModal(order_id, lab_no) {
	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		type: "POST",
		url: "{{ route('sample.qc.result.modal.curve') }}",
		dataType: "html",
		data: {order_id:order_id, lab_no:lab_no},
		beforeSend: function() {$(".loader").show()},
		success: function(data) {
			$('#result-curve-modal-wrapper').html(data);
			$('#view-curve-modal-lg-center').modal('show');
		},
		complete: function() {$('.loader').hide()},
		error: function(jqXhr, textStatus, errorMessage) {alert('Error: ' + jqXhr.status + errorMessage)}
	});
}
function showAllResultModal(order_id, lab_no) {
	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		type: "POST",
		url: "{{ route('sample.qc.result.modal.all') }}",
		dataType: "html",
		data: {order_id:order_id, lab_no:lab_no},
		beforeSend: function() {$(".loader").show()},
		success: function(data) {
			$('#result-all-modal-wrapper').html(data);
			$('#view-all-modal-lg-center').modal('show');
		},
		complete: function() {$('.loader').hide()},
		error: function(jqXhr, textStatus, errorMessage) {alert('Error: ' + jqXhr.status + errorMessage)}
	});
}
</script>
@endpush
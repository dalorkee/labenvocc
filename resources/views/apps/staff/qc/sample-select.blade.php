@extends('layouts.index')
@section('token')<meta name="csrf-token" content="{{ csrf_token() }}">@endsection
@section('style')
<link type="text/css" rel="stylesheet" href="{{ URL::asset('css/pj-step.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/datagrid/datatables/datatables.bundle.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/notifications/sweetalert2/sweetalert2.bundle.css') }}" media="screen, print">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('vendor/jquery-datatables-checkboxes/dataTables.checkboxes.css') }}">
<style type="text/css">
	.input-date:read-only{background:#fefefe!important}
	.btn-group {margin:0 0 5px 0;padding:0;}
	.dataTables_filter label {margin-top: 8px;}
	.dataTables_filter input:first-child {margin-top: -8px;}
	.buttons-create {float:left;margin-left:12px;}
	.buttons-create:after {content:'';clear:both;}
	.dt-btn {margin:0;padding:0;}
	table#sample thead {background-color:#297FB0;color: white;}
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
				<form name="analyze_select" action="" method="POST" enctype="multipart/form-data">
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
								<table class="table table-striped" id="sample" width="100%">
									<caption>Lab No. 0000166 </caption>
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
						<button type="button" id="sample_reserve" class="btn btn-primary"><i class="fal fa-home"></i> กลับหน้าหลัก</button>
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
<div id="view_result_modal_wrapper"></div>
@endsection
@push('scripts')
<script type="text/javascript" src="{{ URL::asset('assets/js/datagrid/datatables/datatables.bundle.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/buttons.server-side.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/notifications/sweetalert2/sweetalert2.bundle.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/formplugins/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('vendor/jquery-datatables-checkboxes/dataTables.checkboxes.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {
	$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
	var table = $('#sample').DataTable({
		processing: true,
		serverSide: true,
		stateSave : true,
		paging: true,
		searching: true,
		deferRender: true,
		lengthMenu: [10, 20, 40],
		language: {'url': '/vendor/DataTables/i18n/thai.json'},
		ajax: "{{ route('sample.qc.select.dt', ['id'=>'1', 'user_id'=>'25']) }}",
		columns: [
			{data: 'DT_RowIndex', name: 'DT_RowIndex', width: '6%', className: 'text-center'},
			{data: 'sample_test_no', name: 'sample_test_no'},
			{data: 'paramet', name: 'paramet'},
			{data: 'action', name: 'action', className: 'text-right'},
		],
		order: [[1, 'asc']]
	});

    $('#btn_view_result_modal').on('click', function() {
		// let view_lno = $(this).data('view_lno');
		// let view_oid = $(this).data('view_oid');
		// let view_analyze_user = $(this).data('view_analyze_user');
		$.ajax({
			method: "POST",
			url: "{{ route('sample.qc.result.view.create') }}",
			dataType: "html",
			// data: {view_lab_no: view_lno, view_order_id: view_oid, view_analyze_user: view_analyze_user},
			beforeSend: function() {$(".loader").show()},
			success: function(response) {
				$('#view_modal_wrapper').html(response);
				$('#view-modal-lg-center').modal('show');
			},
			complete: function() {$('.loader').hide()},
			error: function(jqXhr, textStatus, errorMessage) {alert('Error: ' + jqXhr.status + errorMessage)}
		});
	});

});
</script>
@endpush

@extends('layouts.index')
@section('token')<meta name="csrf-token" content="{{ csrf_token() }}">@endsection
@section('style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/pj-step.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/datagrid/datatables/datatables.bundle.css') }}">
@endsection
@section('content')
<ol class="breadcrumb page-breadcrumb text-sm font-prompt">
	<li class="breadcrumb-item"><i class="fal fa-home mr-1"></i> งานรับตัวอย่าง</li>
	<li class="breadcrumb-item"><a href="#">ใบคำขอ</a></li>
</ol>
<div class="row text-sm font-prompt" style="background-color: #EBF6FD">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
		<ul class="steps">
			<li class="active"><a href="{{ route('sample.received.create') }}"><span class="d-none d-sm-inline">รายการคำขอ</span></a></li>
			<li class="undone"><p><span class="d-none d-sm-inline">รับตัวอย่าง</span></p></li>
			<li class="undone"><p><span class="d-none d-sm-inline">การตรวจวิเคราะห์</span></&p></li>
			<li class="undone"><p><span class="d-none d-sm-inline">รายงานผล</span></p></li>
		</ul>
	</div>
</div>
<div class="row text-sm font-prompt">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
		<div id="panel-1" class="panel">
			<div class="panel-hdr">
				<h2><span class="text-primary"><i class="fal fa-th-list"></i>&nbsp;รายการคำขอ</span></h2>
				<div class="panel-toolbar">
					<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"><i class="fal fa-window-minimize"></i></button>
					<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"><i class="fal fa-expand"></i></button>
					<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"><i class="fal fa-times"></i></button>
				</div>
			</div>
			<div class="panel-container show">
				<div class="panel-content">
					<div class="table-responsive">
						<table id="receive_table" class="table table-bordered responsive" style="cursor:pointer;width:100%">
							<thead class="bg-blue-600 text-white m-0" style="width:100%">
								<tr>
									<th>รหัส</th>
									<th>เลขที่คำขอ</th>
									<th>หน่วยงานที่ส่ง</th>
									<th>วันที่ส่ง</th>
									<th>รหัสลูกค้า</th>
									<th>จำนวน ตย./พารามิเตอร์</th>
									<th>จัดการ</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script type="text/javascript" src="{{ URL::asset('assets/js/datagrid/datatables/datatables.bundle.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/buttons.server-side.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {
	$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
	$('#receive_table').DataTable({
		processing: true,
		serverSide: true,
		stateSave : false,
		paging: true,
		searching: false,
		deferRender: true,
		autoWidth: false,
		lengthMenu: [6, 12, 24],
		lengthChange: false,
		language: {'url': '/vendor/DataTables/i18n/thai.json'},
		ajax: "{{ route('sample.received.create') }}",
		columns: [
			{data: 'id', name: 'id', width: "5%"},
			{data: 'order_no', name: 'order_no'},
			{data: 'customer_agency_name', name: 'customer_agency_name'},
			{data: 'order_confirmed_date', name: 'order_confirmed_date'},
			{data: 'user_id', name: 'user_id'},
			{data: 'total', name: 'total'},
			{data: 'action', name: 'action', className: 'text-center'},
		]
	});
});
</script>
@endsection

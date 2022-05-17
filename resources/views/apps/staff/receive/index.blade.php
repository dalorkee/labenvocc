@extends('layouts.index')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/datagrid/datatables/datatables.bundle.css') }}">
<style type="text/css">

</style>
@endsection
@section('content')
<ol class="breadcrumb page-breadcrumb text-sm font-prompt">
	<li class="breadcrumb-item"><i class="fal fa-home mr-1"></i> <a href="{{ route('sample.receive.index') }}">งานรับตัวอย่าง</a></li>
	<li class="breadcrumb-item">รายการคำขอ</li>
</ol>
<div class="row text-sm font-prompt">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
		<div id="panel-1" class="panel">
			<div class="panel-hdr">
				<h2>รายการคำขอ</h2>
				<div class="panel-toolbar">
					<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"><i class="fal fa-window-minimize"></i></button>
					<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"><i class="fal fa-expand"></i></button>
					<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"><i class="fal fa-times"></i></button>
				</div>
			</div>
			<div class="panel-container show">
				<div class="panel-content">
					<div class="table-responsive">
						<table id="receive_table" class="table table-bordered responsive style="cursor:pointer;width:100%"">
							<thead class="bg-green-600 text-white m-0" style="width:100%">
								<tr>
									<th>ไอดี</th>
									<th>เลขที่คำขอ</th>
									<th>หน่วยงานที่ส่ง</th>
									<th>วันที่ส่ง</th>
									<th>รหัสลูกค้า</th>
									<th>จำนวนตัวอย่าง/รายการทดสอบ</th>
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
		searching: true,
		deferRender: true,
        autoWidth: false,
		lengthMenu: [6, 12, 24],
		language: {'url': '/vendor/DataTables/i18n/thai.json'},
		ajax: "{{ route('sample.receive.create') }}",
		columns: [
			{data: 'id', name: 'id', width: "5%"},
			{data: 'order_no', name: 'order_no'},
			{data: 'customer_agency_name', name: 'customer_agency_name'},
			{data: 'order_confirmed', name: 'order_confirmed'},
			{data: 'customer_agency_code', name: 'customer_agency_code'},
			{data: 'total', name: 'total'},
			{data: 'action', name: 'action'},
		]
	});
});
</script>
@endsection

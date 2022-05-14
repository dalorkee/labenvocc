@extends('layouts.index')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/datagrid/datatables/datatables.bundle.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/miscellaneous/fullcalendar/fullcalendar.bundle.css') }}" media="screen, print">
<style>
.btn-group {margin:0;padding:0;}
.dt-buttons {display:flex;flex-direction:row;flex-wrap:wrap;justify-content:flex-end;}
.dataTables_filter label {margin-top: 8px;}
.dataTables_filter input:first-child {margin-top: -8px;}
#order-table thead {background-color:#297FB0;color: white;}
/* Extra small devices (phones, 600px and down) */
@media only screen and (max-width:600px) {.pj-btn{position:absolute;top:10px;z-index:1;}}
/* Small devices (portrait tablets and large phones, 600px and up) */
@media only screen and (min-width:600px) {.pj-btn {position:absolute;top:10px;z-index:1;}}
/* Medium devices (landscape tablets, 768px and up) */
@media only screen and (min-width:768px) {.pj-btn {position:absolute;top:16px;z-index:1;}}
/* Large devices (laptops/desktops, 992px and up) */
@media only screen and (min-width:992px) {.pj-btn{position:absolute;top:16px;z-index:1;}}
/* Extra large devices (large laptops and desktops, 1200px and up) */
@media only screen and (min-width:1200px) {.pj-btn{position:absolute;top:16px;z-index:1;}}
</style>
@endsection
@section('content')
<ol class="breadcrumb page-breadcrumb text-sm font-prompt">
	<li class="breadcrumb-item"><i class="fal fa-home mr-1"></i> <a href="{{ route('staff.index') }}">หน้าหลัก</a></li>
</ol>
<div class="row font-prompt">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
		<div class="border px-3 pt-3 pb-0 rounded">
			<ul class="nav">
				<li class="nav-item"><a class="nav-link" href="{{ route('staff.index') }}"><i class="fal fa-user mr-1"></i>ข้อมูลส่วนตัว</a></li>
				<li class="nav-item"><a class="nav-link btn btn-sm btn-danger" href="{{ route('staff.inbox') }}"><i class="fal fa-envelope mr-1"></i>กล่องข้อความ</a></li>
				<li class="nav-item"><a class="nav-link" href="{{ route('staff.calendar') }}"><i class="fal fa-calendar-check mr-1"></i>ปฏิทินงาน</a></li>
			</ul>
			<div class="tab-content py-3">
                <div class="tab-pane fade show active" id="js_pill_border_icon-1" role="tabpanel">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
							<table id="talek_team" class="table table-bordered text-sm">
								<thead class="bg-gray-300">
									<tr>
										<th>Id</th>
										<th>order_no</th>
										<th>order_type</th>
									</tr>
								</thead>
								<tfoot></tfoot>
								<tbody></tbody>
							</table>
						</div>
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
	$('#jetkhe').on('click', function() {
		$('#talek_team').dataTable().fnClearTable();
		$('#talek_team').dataTable().fnDestroy();
		$('#talek_team').DataTable({
			processing: true,
			serverSide: true,
			ajax: "{{ route('staff.inbox') }}",
			columns: [
				{ data: 'id', name: 'id' },
				{ data: 'order_no', name: 'order_no' },
				{ data: 'order_type', name: 'order_type' }
			]
		});
	});
});
</script>

@endsection

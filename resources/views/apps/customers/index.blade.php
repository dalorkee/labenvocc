@extends('layouts.index')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/datagrid/datatables/datatables.bundle.css') }}">
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
	<li class="breadcrumb-item"><a href="javascript:void(0);">คำขอส่งตัวอย่าง</a></li>
	<li class="breadcrumb-item">รายการคำขอ</li>
</ol>
<div class="row text-sm font-prompt">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
		<div id="panel-customer" class="panel">
			<div class="panel-hdr">
				<h2 class="text-gray-600"><i class="fal fa-list"></i>&nbsp;รายการข้อมูล</h2>
				<div class="panel-toolbar">
					<button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
					<button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
					<button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
				</div>
			</div>
			<div class="panel-container show">
				<div class="panel-content">
					<div class="pj-btn">
						<div class="btn-group" role="group">
							<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><i class="fal fa-plus-circle"></i> <span class="d-none d-sm-inline">สร้างคำขอส่งตัวอย่าง</span></button>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="{{ route('customer.general') }}">ตัวอย่างชีวภาพ</a>
								<a class="dropdown-item" href="javascript:void(0)">ตัวอย่างสิ่งแวดล้อม</a>
							</div>
						</div>
					</div>
					{{ $dataTable->table() }}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script type="text/javascript" src="{{ URL::asset('assets/js/datagrid/datatables/datatables.bundle.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/buttons.server-side.js') }}"></script>
{{ $dataTable->scripts() }}
<script>
$(document).ready(function() {

});
</script>
@endsection

@extends('layouts.index')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('style')
<link href="{{ URL::asset('css/pj-step.css') }}" rel="stylesheet" type="text/css">
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
	<li class="breadcrumb-item"><a href="javascript:void(0);">LabEnvOcc</a></li>
	<li class="breadcrumb-item">คำขอส่งตัวอย่าง</li>
	<li class="breadcrumb-item">พารามิเตอร์</li>
</ol>
<div class="row text-sm font-prompt">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
		<div id="panel-customer" class="panel">
			<div class="panel-hdr">
				<h2 class="text-gray-600"><i class="fal fa-clipboard"></i>&nbsp;คำขอส่งตัวอย่าง</h2>
				<div class="panel-toolbar">
					<button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
					<button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
					<button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
				</div>
			</div>
			<div class="panel-container show">
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
@endsection
@section('script')
<script type="text/javascript" src="{{ URL::asset('assets/js/datagrid/datatables/datatables.bundle.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/buttons.server-side.js') }}"></script>
{{ $dataTable->scripts() }}
<script>
$(document).ready(function() {
	$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
})
</script>
@endsection

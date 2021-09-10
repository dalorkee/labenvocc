@extends('layouts.index')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/datagrid/datatables/datatables.bundle.css') }}">
<style>
	.dataTables_filter input:first-child {
		margin-top: -8px;
	}
	#order-table thead {
		background-color:#297FB0;
		color: white;
	}
    .pj {
        position: absolute;
        left:18px;
        top: 18px;
        z-index: 1;
    }
    .pjx {
        visibility: hidden;
    }
</style>
@endsection
@section('content')
<ol class="breadcrumb page-breadcrumb text-sm font-prompt">
	<li class="breadcrumb-item"><a href="javascript:void(0);">คำขอส่งตัวอย่าง</a></li>
	<li class="breadcrumb-item">รายการคำขอ</li>
	{{-- <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li> --}}
</ol>
<div class="row text-sm font-prompt">
	<div class="col-xl-12">
		<div id="panel-1" class="panel">
			<div class="panel-hdr">
				<h2 class="text-gray-600"><i class="fal fa-list"></i>&nbsp;รายการข้อมูล</h2>
				<div class="panel-toolbar">
					<button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
					<button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
					<button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
				</div>
			</div>
			<div class="panel-container show">
				<div class="panel-content relative">
                    <div class="btn-group pj" role="group">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">สร้างคำขอส่งตัวอย่าง</button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="javascript:void(0)">Dropdown link</a>
                            <a class="dropdown-item" href="javascript:void(0)">Dropdown link</a>
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

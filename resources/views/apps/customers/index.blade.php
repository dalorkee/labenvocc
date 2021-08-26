@extends('layouts.index')
@section('style')
<link rel="stylesheet" href="{{ URL::asset('vendor/jquery-smartwizard/css/smart_wizard_arrows.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('vendor/css/datagrid/datatables/datatables.bundle.css') }}" media="screen, print">
@endsection
@section('content')
<ol class="breadcrumb page-breadcrumb font-prompt fs-md">
	<li class="breadcrumb-item"><a href="javascript:void(0);">หน้าแรก</a></li>
</ol>
<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2>
                    Example <span class="fw-300"><i>Table</i></span>
                </h2>
                <div class="panel-toolbar">
                    <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <!-- datatable start -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ URL::asset('vendor/js/datagrid/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
<script>
$(document).ready(function() {
});
</script>
@endsection

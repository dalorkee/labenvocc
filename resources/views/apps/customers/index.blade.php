@extends('layouts.index')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('vendor/DataTables/DataTables-1.10.22/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('vendor/DataTables/Buttons-1.6.5/css/buttons.jqueryui.min.css') }}">
<link rel='stylesheet' type="text/css" href="{{ URL::asset('vendor/DataTables/Responsive-2.2.6/css/responsive.dataTables.min.css') }}">
@endsection
@section('content')
<ol class="breadcrumb page-breadcrumb font-prompt">
	<li class="breadcrumb-item"><a href="javascript:void(0);">คำขอส่งตัวอย่าง</a></li>
	<li class="breadcrumb-item">รายการคำขอ</li>
	{{-- <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li> --}}
</ol>
{{ $dataTable->table() }}
@endsection
@section('script')
<script type="text/javascript" src="{{ URL::asset('vendor/DataTables/DataTables-1.10.22/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('vendor/DataTables/Buttons-1.6.5/js/dataTables.buttons.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('vendor/DataTables/Responsive-2.2.6/js/dataTables.responsive.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/buttons.server-side.js') }}"></script>
{{ $dataTable->scripts() }}
<script>
$(document).ready(function() {

});
</script>
@endsection

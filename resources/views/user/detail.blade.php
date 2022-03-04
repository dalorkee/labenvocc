@extends('layouts.guest.index')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('vendor/jquery-smartwizard/css/smart_wizard_arrows.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('vendor/DataTables/DataTables-1.10.22/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('vendor/DataTables/Buttons-1.6.5/css/buttons.jqueryui.min.css') }}">
<link rel='stylesheet' type="text/css" href="{{ URL::asset('vendor/DataTables/Responsive-2.2.6/css/responsive.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('vendor/jquery-contextmenu/css/jquery.contextMenu.min.css') }}">
@endsection
@section('content')
<div class="subheader">
	<h1 class="subheader-title"><small>รายละเอียดข่าวประชาสัมพันธ์</small></h1>
</div>
@if (Session::get('success'))
	<div class="alert alert-success">
		<p>{{ Session::get('success') }}</p>
	</div>
@elseif (Session::get('error'))
	<div class="alert alert-danger">
		<p>{{ Session::get('error') }}</p>
	</div>
@endif
<div class="fs-lg fw-300 p-5 bg-white border-faded rounded mb-g">
	<div class="frame-wrap">        
		<div class="form-row">
			<div class="col-md-6 mb3">
				<label class="form-label text-info" for="advertise_date">ประกาศวันที่</label>
				<span class="badge badge-secondary">{{ date('Y-F-d',strtotime($advertise['advertise_date'])); }}</span>
			</div>	
        </div>
		<div class="form-row">
			<div class="col-md-6 mb3">
				<label class="form-label text-info" for="advertise_date">หัวข้อข่าว</label>
				<span class="badge badge-primary">{{ $advertise['advertise_title'] }}</span>
			</div>	
        </div>
        <div class="form-row">
			<div class="col-md-12 mb-6">
				<label class="form-label text-info" for="advertise_detail">รายละเอียด</label>
				<textarea class="form-control" id="advertise_detail" name="advertise_detail" readonly>{{ $advertise['advertise_detail'] }}</textarea>					
			</div>				
		</div>
		<a class="btn btn-primary" href="{{ route('login') }}">กลับ</a>		
	</div>
</div>
@endsection
@section('script')
<script type="text/javascript" src="{{ URL::asset('vendor/DataTables/DataTables-1.10.22/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('vendor/DataTables/Buttons-1.6.5/js/dataTables.buttons.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('vendor/DataTables/Responsive-2.2.6/js/dataTables.responsive.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('vendor/jquery-contextmenu/js/jquery.contextMenu.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/buttons.server-side.js') }}"></script>
@endsection
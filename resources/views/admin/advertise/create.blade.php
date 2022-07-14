@extends('layouts.index')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('vendor/jquery-smartwizard/css/smart_wizard_arrows.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('vendor/DataTables/DataTables-1.10.22/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('vendor/DataTables/Buttons-1.6.5/css/buttons.jqueryui.min.css') }}">
<link rel='stylesheet' type="text/css" href="{{ URL::asset('vendor/DataTables/Responsive-2.2.6/css/responsive.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('vendor/jquery-contextmenu/css/jquery.contextMenu.min.css') }}">
@endsection
@section('content')
<ol class="breadcrumb page-breadcrumb">
	<li class="breadcrumb-item"><a href="javascript:void(0);">Admin</a></li>
	<li class="breadcrumb-item">Advertise Create</li>
</ol>
<div class="subheader">
	<h1 class="subheader-title"><small>เพิ่มข้อมูลหน่วยงาน</small></h1>
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
		<form action="{{ route('advertise.store') }}" method="POST">
		@csrf
			<div class="form-row">
				<div class="col-md-6 mb-3">
					<label class="form-label" for="advertise_type">ประเภทหัวข้อ</label>
					<select class="custom-select" name="advertise_type" required>
						<option value="">---เลือก---</option>
						<option value="ประชาสัมพันธ์">ประชาสัมพันธ์</option>
						<option value="มาตราฐานคุณภาพ">มาตราฐานคุณภาพ</option>
					</select>
				</div>
				<div class="col-md-6 mb-3">
					<label class="form-label" for="advertise_title">หัวข้อข่าว</label>
					<input type="text" class="form-control" id="advertise_title" name="advertise_title" required>			
				</div>
			</div>
			<div class="form-row">
				<div class="col-md-8 mb-3">
					<label class="form-label" for="advertise_detail">รายละเอียด</label>
					<textarea class="form-control" id="advertise_detail" name="advertise_detail" required></textarea>					
				</div>				
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>		
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
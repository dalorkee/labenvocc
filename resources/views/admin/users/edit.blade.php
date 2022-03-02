@extends('layouts.admin.index')
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
	<li class="breadcrumb-item">User Customer Manage</li>
</ol>
<div class="subheader">
	<h1 class="subheader-title"><small>แก้ไขข้อมูลลูกค้า</small></h1>
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
	@foreach ($userCus as $value)
	<div class="frame-wrap">
		<form action="{{ route('users.update',$value->user_id) }}" method="POST">
		@csrf
		@method('PUT')
			<div class="form-row">
				<div class="col-md-6 mb-3">
					<label class="form-label" for="user_id">UserId</label>
					<input type="text" class="form-control" id="user_id" name="user_id" value="{{ $value->user_id }}" readonly>
				</div>
				<div class="col-md-6 mb-3">
					<label class="form-label" for="username">UserName</label>
					<input type="text" class="form-control" id="username" name="username" value="{{ $value->username }}" readonly>
				</div>				
			</div>
			<div class="form-row">
				<div class="col-md-6 mb-3">
					<label class="form-label" for="first_name">FirstName</label>
					<input type="text" class="form-control" id="first_name" name="first_name" value="{{ $value->first_name }}">
				</div>
				<div class="col-md-6 mb-3">
					<label class="form-label" for="last_name">LastName</label>
					<input type="text" class="form-control" id="last_name" name="last_name" value="{{ $value->last_name }}">
				</div>				
			</div>
			<div class="form-row form-group">
				<div class="col-md-4 mb-3">
					<label class="form-label" for="user_status">สถานะ<span class="text-danger">*</span></label>
					<select class="custom-select" name="user_status">
						<option value="">---เลือก---</option>
						<option {{ ($value->user_status) == 'สมัครใหม่' ? 'selected' : '' }} value="สมัครใหม่">สมัครใหม่</option>
						<option {{ ($value->user_status) == 'อนุญาต' ? 'selected' : '' }} value="อนุญาต">อนุญาต</option>
						<option {{ ($value->user_status) == 'ไม่อนุญาต' ? 'selected' : '' }} value="ไม่อนุญาต">ไม่อนุญาต</option>
					</select>
				</div>
			</div>
			<div class="form-row">
				<div class="col-md-4 mb-3">
					<label class="form-label" for="ref_office_lab_code">รหัสสถานประกอบการ</label>
					<input type="text" class="form-control" id="ref_office_lab_code" name="ref_office_lab_code" value="{{ $value->ref_office_lab_code }}">
				</div>
				<div class="col-md-4 mb-3">
					<label class="form-label" for="ref_office_env_code">รหัสสถานประกอบการ(Env)</label>
					<input type="text" class="form-control" id="ref_office_env_code" name="ref_office_env_code" value="{{ $value->ref_office_env_code }}">
				</div>
				<div class="col-md-4 mb-3">
					<label class="form-label" for="agency_code">รหัสสถานประกอบการ(Moph)</label>
					<input type="text" class="form-control" id="agency_code" name="agency_code" value="{{ $value->agency_code }}">
				</div>				
			</div>
			<div class="form-row">
				<div class="col-md-6 mb-3">
					<label class="form-label" for="agency_name">OfficeName</label>
					<input type="text" class="form-control" id="agency_name" name="agency_name" value="{{ $value->agency_name }}">
				</div>
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>		
	</div>
	@endforeach
</div>
@endsection
@section('script')
<script type="text/javascript" src="{{ URL::asset('vendor/DataTables/DataTables-1.10.22/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('vendor/DataTables/Buttons-1.6.5/js/dataTables.buttons.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('vendor/DataTables/Responsive-2.2.6/js/dataTables.responsive.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('vendor/jquery-contextmenu/js/jquery.contextMenu.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/buttons.server-side.js') }}"></script>
@endsection
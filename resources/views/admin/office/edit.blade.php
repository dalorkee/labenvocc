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
	<li class="breadcrumb-item">User Staff Manage</li>
</ol>
<div class="subheader">
	<h1 class="subheader-title"><small>แก้ไขข้อมูลหน่วยงาน</small></h1>
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
		<form action="{{ route('office.update',$userStuff[0]->user_id) }}" method="POST">
		@csrf
		@method('PUT')
			<div class="form-row">
				<div class="col-md-6 mb-3">
					<label class="form-label" for="user_id">UserId</label>
					<input type="text" class="form-control" id="user_id" name="user_id" value="{{ $userStuff[0]->user_id }}" readonly>
				</div>
				<div class="col-md-6 mb-3">
					<label class="form-label" for="username">UserName</label>
					<input type="text" class="form-control" id="username" name="username" value="{{ $userStuff[0]->username }}" readonly>
				</div>				
			</div>
			<div class="form-row">
				<div class="col-md-6 mb-3">
					<label class="form-label" for="first_name">FirstName</label>
					<input type="text" class="form-control" id="first_name" name="first_name" value="{{ $userStuff[0]->first_name }}">
				</div>
				<div class="col-md-6 mb-3">
					<label class="form-label" for="last_name">LastName</label>
					<input type="text" class="form-control" id="last_name" name="last_name" value="{{ $userStuff[0]->last_name }}">
				</div>				
			</div>
			<div class="form-row form-group">
				<div class="col-md-4 mb-3">
					<label class="form-label" for="user_status">สถานะ<span class="text-danger">*</span></label>
					<select class="custom-select" name="user_status">
						<option value="">---เลือก---</option>
						<option {{ ($userStuff[0]->user_status) == 'สมัครใหม่' ? 'selected' : '' }} value="สมัครใหม่">สมัครใหม่</option>
						<option {{ ($userStuff[0]->user_status) == 'อนุญาต' ? 'selected' : '' }} value="อนุญาต">อนุญาต</option>						
						<option {{ ($userStuff[0]->user_status) == 'ไม่อนุญาต' ? 'selected' : '' }} value="ไม่อนุญาต">ไม่อนุญาต</option>
					</select>
				</div>
			</div>
			<div class="form-row">
				<div class="col-md-4 mb-3">
					<label class="form-label" for="position">ตำแหน่ง</label>
					<select class="custom-select" name="position">
						<option value=" {{ $userStuff[0]->position??null }} ">{{ $positions[$userStuff[0]->position]??null }}</option>
						<option value="">---เลือก---</option>
						@foreach ($positions as $key=>$val)
							<option value="{{ $key }}">{{ $val }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-md-4 mb-3">
					<label class="form-label" for="position_level">ระดับ</label>
					<select class="custom-select" name="position_level">
						<option value=" {{ $userStuff[0]->position_level??null }} ">{{ $position_levels[$userStuff[0]->position_level]??null }}</option>
						<option value="">---เลือก---</option>
						@foreach ($position_levels as $key=>$val)
							<option value="{{ $key }}">{{ $val }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-md-4 mb-3">
					<label class="form-label" for="duty">หน้าที่</label>					
					<select class="custom-select" name="duty">
						<option value=" {{ $userStuff[0]->duty??null }} ">{{ $duties[$userStuff[0]->duty]??null }}</option>
						<option value="">---เลือก---</option>
						@foreach ($duties as $key=>$val)
							<option value="{{ $key }}">{{ $val }}</option>
						@endforeach
					</select>
				</div>	
				<div class="col-md-4 mb-3">
					<label class="form-label" for="mobile">เบอร์โทร</label>
					<input type="text" class="form-control" id="mobile" name="mobile" value="{{ $userStuff[0]->mobile }}">
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
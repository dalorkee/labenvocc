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
					<label class="form-label text-info">UserId: {{ $userStuff[0]->user_id }}</label>
					<input type="hidden" name="user_id" value="{{ $userStuff[0]->user_id }}">
				</div>
			</div>
			<div class="form-row">
				<div class="col-md-6 mb-3">
					<label class="form-label" for="username">UserName</label>
					<input type="text" class="form-control" id="username" name="username" value="{{ $userStuff[0]->username }}" readonly>
				</div>
			</div>
			<div class="form-row">
                <div class="col-md-6 mb-3 input-group">
                    <div class="form-group col">
                        <label class="form-label" for="password">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control border-right-0" id="password" name="password" readonly>
                            <div class="input-group-append">
                                <span class="input-group-text bg-transparent border-left-0">
                                    <i class="fal fa-eye toggle-password" toggle="#password"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="custom-control custom-switch mt-5 mb-5">
                        <input type="checkbox" class="custom-control-input" id="change_password" name="change_password" value="pw_chk">
                        <label class="custom-control-label" for="change_password">Change Password</label>
                    </div>
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
					<select class="custom-select" name="user_status" id="user_status">
						<option value="">---เลือก---</option>
						<option {{ ($userStuff[0]->user_status) == 'สมัครใหม่' ? 'selected' : '' }} value="สมัครใหม่">สมัครใหม่</option>
						<option {{ ($userStuff[0]->user_status) == 'อนุญาต' ? 'selected' : '' }} value="อนุญาต">อนุญาต</option>
						<option {{ ($userStuff[0]->user_status) == 'ไม่อนุญาต' ? 'selected' : '' }} value="ไม่อนุญาต">ไม่อนุญาต</option>
					</select>
				</div>
			</div>
			<div class="form-row">
				<div class="col-md-6 mb-3">
					<label class="form-label" for="position">ตำแหน่ง</label>
					<select class="custom-select" name="position" id="position">
						<option value=" {{ $userStuff[0]->position??null }} ">{{ $positions[$userStuff[0]->position]??null }}</option>
						<option value="">---เลือก---</option>
						@foreach ($positions as $key=>$val)
							<option value="{{ $key }}">{{ $val }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-md-6 mb-3">
					<label class="form-label" for="position_level">ระดับ</label>
					<select class="custom-select" name="position_level" id="position_level">
						<option value=" {{ $userStuff[0]->position_level??null }} ">{{ $position_levels[$userStuff[0]->position_level]??null }}</option>
						<option value="">---เลือก---</option>
						@foreach ($position_levels as $key=>$val)
							<option value="{{ $key }}">{{ $val }}</option>
						@endforeach
					</select>
				</div>
            </div>
			<div class="form-row">
                <div class="col-md-6 mb-3">
					<label class="form-label" for="duty">หน้าที่</label>
					<select class="custom-select duty-multi" name="duty[]" id="duty" multiple=multiple>
						<option value=" {{ $userStuff[0]->duty??null }} ">{{ $duties[$userStuff[0]->duty]??null }}</option>
						<option value="">---เลือก---</option>
						@foreach ($duties as $key=>$val)
							<option value="{{ $key }}">{{ $val }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-md-6 mb-3">
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
<script>
    $(document).ready(function() {
        $('#change_password').change(function(){
            if(this.checked){
                $('#password').prop('readonly',false);
            }
            else{
                $('#password').prop('readonly',true);
                $('#change_password').prop('checked',false);
                $('#password').val('');
            }
        });
        $(function(){
	        $(".toggle-password").click(function() {
		        $(this).toggleClass("fa-eye fa-eye-slash");
		        var type = $($(this).attr("toggle"));
		        if (type.attr("type") == "password") {
			        type.attr("type", "text");
		        }
                else {
			        type.attr("type", "password");
		        }
	        });
        });
        $('#duty').select2();
    });
</script>
@endsection

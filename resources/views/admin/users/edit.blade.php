@extends('layouts.index')
@section('token')<meta name="csrf-token" content="{{ csrf_token() }}">@endsection
@section('content')
<ol class="breadcrumb page-breadcrumb font-prompt">
	<li class="breadcrumb-item"><a href="#">Admin</a></li>
	<li class="breadcrumb-item">จัดการข้อมูล</li>
</ol>
@if (Session::get('success'))
	<div class="alert alert-success">
		<p>{{ Session::get('success') }}</p>
	</div>
@elseif (Session::get('error'))
	<div class="alert alert-danger">
		<p>{{ Session::get('error') }}</p>
	</div>
@endif
<div class="fs-lg fw-300 p-5 bg-white border-faded rounded mb-g font-prompt">
	@foreach ($userCus as $value)
	<div class="frame-wrap">
		<form action="{{ route('users.update',$value->user_id) }}" method="POST">
		@csrf
		@method('PUT')
			<div class="form-row">
				<div class="col-md-6 mb-3">
					<label class="form-label" for="user_id">รหัส</label>
					<input type="text" name="user_id" class="form-control" value="{{ $value->user_id }}" readonly>
				</div>
				<div class="col-md-6 mb-3">
					<label class="form-label" for="username">ชื่อผู้ใช้</label>
					<input type="text" class="form-control" id="username" name="username" value="{{ $value->username }}" readonly>
				</div>
				<div class="col-md-6 mb-3">
					<label class="form-label" for="password">รหัสผ่าน</label>
					<div class="input-group">
						<input type="password" class="form-control border-right-0" id="password" name="password" readonly>
						<div class="input-group-append">
							<span class="input-group-text bg-primary border-left-0">
								<i class="fal fa-eye toggle-password text-white" toggle="#password"></i>
							</span>
						</div>
					</div>
				</div>
				<div class="col-md-6 mb-3">
					<label class="form-label" for="change_password_lbl">&nbsp;</label>
					<div class="custom-control custom-switch mt-2">
						<input type="checkbox" class="custom-control-input" id="change_password" name="change_password" value="pw_chk">
						<label class="custom-control-label" for="change_password">เปลี่ยนรหัสผ่าน</label>
					</div>
				</div>
				<div class="col-md-6 mb-3">
					<label class="form-label" for="first_name">ชื่อ</label>
					<input type="text" class="form-control" id="first_name" name="first_name" value="{{ $value->first_name }}">
				</div>
				<div class="col-md-6 mb-3">
					<label class="form-label" for="last_name">นามสกุล</label>
					<input type="text" class="form-control" id="last_name" name="last_name" value="{{ $value->last_name }}">
				</div>
				<div class="col-md-6 mb-3">
					<label class="form-label" for="user_status">สถานะ <span class="text-danger">*</span></label>
					<select class="custom-select" name="user_status">
						<option value="">---เลือก---</option>
						<option {{ ($value->user_status) == 'สมัครใหม่' ? 'selected' : '' }} value="สมัครใหม่">สมัครใหม่</option>
						<option {{ ($value->user_status) == 'อนุญาต' ? 'selected' : '' }} value="อนุญาต">อนุญาต</option>
						<option {{ ($value->user_status) == 'ไม่อนุญาต' ? 'selected' : '' }} value="ไม่อนุญาต">ไม่อนุญาต</option>
					</select>
				</div>
				<div class="col-md-6 mb-3">
					<label class="form-label" for="ref_office_lab_code">รหัสสถานประกอบการ</label>
					<input type="text" class="form-control" id="ref_office_lab_code" name="ref_office_lab_code" value="{{ $value->ref_office_lab_code }}">
				</div>
				<div class="col-md-6 mb-3">
					<label class="form-label" for="ref_office_env_code">รหัสสถานประกอบการ (ENV)</label>
					<input type="text" class="form-control" id="ref_office_env_code" name="ref_office_env_code" value="{{ $value->ref_office_env_code }}">
				</div>
				<div class="col-md-6 mb-3">
					<label class="form-label" for="agency_code">รหัสสถานประกอบการ (MOPH)</label>
					<input type="text" class="form-control" id="agency_code" name="agency_code" value="{{ $value->agency_code }}">
				</div>
			</div>
			<div class="form-row">
				<div class="col-md-12 mb-3">
					<label class="form-label" for="agency_name">ชื่อสถานประกอบการ</label>
					<input type="text" class="form-control" id="agency_name" name="agency_name" value="{{ $value->agency_name }}">
				</div>
			</div>
			<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> บันทึกข้อมูล</button>
		</form>
	</div>
	@endforeach
</div>
@endsection
@section('script')
<script type="text/javascript" src="{{ URL::asset('js/buttons.server-side.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('#change_password').change(function() {
		if (this.checked) {
			$('#password').prop('readonly',false);
		} else {
			$('#password').prop('readonly',true);
			$('#change_password').prop('checked',false);
			$('#password').val('');
		}
	});
	$(function() {
		$(".toggle-password").click(function() {
			$(this).toggleClass("fa-eye fa-eye-slash");
			var type = $($(this).attr("toggle"));
			if (type.attr("type") == "password") {
				type.attr("type", "text");
			} else {
				type.attr("type", "password");
			}
		});
	});
});
</script>
@endsection

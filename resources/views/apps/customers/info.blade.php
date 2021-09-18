@extends('layouts.index')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('style')
<link href="{{ URL::asset('css/pj-step.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('assets/css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('content')
<ol class="breadcrumb page-breadcrumb text-sm font-prompt">
	<li class="breadcrumb-item"><a href="javascript:void(0);">LabEnvOcc</a></li>
	<li class="breadcrumb-item">คำขอส่งตัวอย่างชีวภาพ</li>
	<li class="breadcrumb-item">ข้อมูลทั่วไป</li>
</ol>
<div class="row text-sm font-prompt">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
		<div id="panel-customer" class="panel">
			<div class="panel-hdr">
				<h2 class="text-gray-600"><i class="fal fa-clipboard"></i>&nbsp;คำขอส่งตัวอย่างชีวภาพ</h2>
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
							<li class="active"><a href=""><i class="fal fa-user"></i> <span class="d-none d-sm-inline">ข้อมูลทั่วไป</span></a></li>
							<li class="undone"><p><i class="fal fa-user"></i> <span class="d-none d-sm-inline">พารามิเตอร์</span></p></li>
							<li class="undone"><p><i class="fal fa-user"></i> <span class="d-none d-sm-inline">ข้อมูลตัวอย่าง</span></p></li>
							<li class="undone"><p><i class="fal fa-user"></i> <span class="d-none d-sm-inline">ตรวจสอบข้อมูล</span></p></li>
						</ul>
						<div class="form-row">
							<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
								<label class="form-label" for="firstname">หน่วยงานที่ส่งตัวอย่าง <span class="text-red-600">*</span></label>
								<input type="text" name="firstname" value="{{ old('firstname') }}" class="form-control @error('firstname') is-invalid @enderror" required>
								@error('firstname')
									<div class="invalid-feedback" role="alert">{{ $message }}</div>
								@enderror
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
								<label class="form-label" for="firstname">ประเภทงาน <span class="text-red-600">*</span></label>
								<div class="frame-wrap">
									<div class="custom-control custom-checkbox custom-control-inline">
										<input type="checkbox" class="custom-control-input" id="defaultInline2" checked="">
										<label class="custom-control-label" for="defaultInline2">บริการ</label>
									</div>
									<div class="custom-control custom-checkbox custom-control-inline">
										<input type="checkbox" class="custom-control-input" id="defaultUnchecked">
										<label class="custom-control-label" for="defaultUnchecked">วิจัย</label>
									</div>
									<div class="custom-control custom-checkbox custom-control-inline">
										<input type="checkbox" class="custom-control-input" id="defaultUnchecked">
										<label class="custom-control-label" for="defaultUnchecked">เฝ้าระวัง</label>
									</div>
									<div class="custom-control custom-checkbox custom-control-inline">
										<input type="checkbox" class="custom-control-input" id="defaultUnchecked">
										<label class="custom-control-label" for="defaultUnchecked">SRRT/สอบสวนโรค</label>
									</div>
									<div class="custom-control custom-checkbox custom-control-inline">
										<input type="checkbox" class="custom-control-input" id="defaultUnchecked">
										<label class="custom-control-label" for="defaultUnchecked">อื่นๆ ระบุ</label>
									</div>
								</div>
							</div>
							<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
								<label class="form-label" for="mobile">ประเภทงานอื่นๆ ระบุ</label>
								<input type="text" name="mobile" value="{{ old('mobile') }}" class="form-control @error('mobile') is-invalid @enderror" required>
								@error('moblie')
									<div class="invalid-feedback" role="alert">{{ $message }}</div>
								@enderror
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-6 col-lg-6 mb-3">
								<label class="form-label" for="mobile">เลขที่หนังสือนำส่ง <span class="text-red-600">*</span></label>
								<input type="text" name="mobile" value="{{ old('mobile') }}" class="form-control @error('mobile') is-invalid @enderror" required>
								@error('moblie')
									<div class="invalid-feedback" role="alert">{{ $message }}</div>
								@enderror
							</div>
							<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-6 col-lg-6 mb-3">
								<label class="form-label" for="email">ลงวันที่ <span class="text-red-600">*</span></label>
								<div class="input-group">
									<input type="text" class="form-control " readonly placeholder="Select date" id="datepicker-2">
									<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fal fa-calendar-alt"></i>
										</span>
									</div>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-6 col-lg-6 mb-3">
								<label class="form-label" for="inputGroupFile01">แนบไฟล์หนังสือนำส่ง <span class="text-red-600">*</span></label>
								<div class="input-group">
									<div class="custom-file">
										<input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
										<label class="custom-file-label" for="inputGroupFile01">เลือกไฟล์</label>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex flex-row align-items-center">
						<div class="form-row">
							<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
								<button class="btn btn-primary ml-auto" type="button"><i class="fal fa-save"></i> บันทึกร่าง</button>
								<a href="{{ route('customer.parameter') }}" class="btn btn-warning ml-auto">ต่อไป <i class="fal fa-arrow-alt-right"></i></a>
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
<script src="{{ URL::asset('assets/js/formplugins/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
<script>
	var controls = {
	    leftArrow: '<i class="fal fa-angle-left" style="font-size: 1.25rem"></i>',
	    rightArrow: '<i class="fal fa-angle-right" style="font-size: 1.25rem"></i>'
    }
	var runDatePicker = function() {
        $('#datepicker-2').datepicker({
            todayHighlight: true,
            orientation: "bottom left",
            templates: controls
        });
    }
</script>
<script>
$(document).ready(function() {
	$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
	runDatePicker();
});
</script>
@endsection

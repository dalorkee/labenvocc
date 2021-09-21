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
				<form name="saveInfo" action="{{ route('customer.storeInfo') }}" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="panel-content">
						<ul class="steps">
							<li class="active"><a href=""><i class="fal fa-user"></i> <span class="d-none d-sm-inline">ข้อมูลทั่วไป</span></a></li>
							<li class="undone"><p><i class="fal fa-user"></i> <span class="d-none d-sm-inline">พารามิเตอร์</span></p></li>
							<li class="undone"><p><i class="fal fa-user"></i> <span class="d-none d-sm-inline">ข้อมูลตัวอย่าง</span></p></li>
							<li class="undone"><p><i class="fal fa-user"></i> <span class="d-none d-sm-inline">ตรวจสอบข้อมูล</span></p></li>
						</ul>
						<div class="form-row">
							<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
								<label class="form-label" for="office_name">หน่วยงานที่ส่งตัวอย่าง <span class="text-red-600">*</span></label>
								<input type="text" name="office_name" value="{{ Auth::user()->userCustomer->office_name }}" class="form-control" readonly>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
								<label class="form-label" for="type_of_work">ประเภทงาน <span class="text-red-600">*</span></label>
								<div class="frame-wrap">
									<div class="custom-control custom-checkbox custom-control-inline">
										<input type="checkbox" name="type_of_work" class="custom-control-input" id="type_of_work1" checked>
										<label class="custom-control-label" for="type_of_work1">บริการ</label>
									</div>
									<div class="custom-control custom-checkbox custom-control-inline">
										<input type="checkbox" class="custom-control-input" id="type_of_work2">
										<label class="custom-control-label" for="type_of_work2">วิจัย</label>
									</div>
									<div class="custom-control custom-checkbox custom-control-inline">
										<input type="checkbox" class="custom-control-input" id="type_of_work3">
										<label class="custom-control-label" for="type_of_work3">เฝ้าระวัง</label>
									</div>
									<div class="custom-control custom-checkbox custom-control-inline">
										<input type="checkbox" class="custom-control-input" id="type_of_work4">
										<label class="custom-control-label" for="type_of_work4">SRRT/สอบสวนโรค</label>
									</div>
									<div class="custom-control custom-checkbox custom-control-inline">
										<input type="checkbox" class="custom-control-input" id="type_of_work5">
										<label class="custom-control-label" for="type_of_work5">อื่นๆ ระบุ</label>
									</div>
								</div>
							</div>
							<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
								<label class="form-label" for="type_of_work_other">ประเภทงานอื่นๆ ระบุ</label>
								<input type="text" name="type_of_work_other" value="{{ old('motype_of_work_other') }}" class="form-control @error('type_of_work_other') is-invalid @enderror" disabled>
								@error('type_of_work_other')
									<div class="invalid-feedback" role="alert">{{ $message }}</div>
								@enderror
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-6 col-lg-6 mb-3">
								<label class="form-label" for="book_no">เลขที่หนังสือนำส่ง <span class="text-red-600">*</span></label>
								<input type="text" name="book_no" value="{{ old('book_no') }}" class="form-control @error('book_no') is-invalid @enderror">
								@error('book_no')
									<div class="invalid-feedback" role="alert">{{ $message }}</div>
								@enderror
							</div>
							<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-6 col-lg-6 mb-3">
								<label class="form-label" for="book_date">ลงวันที่ <span class="text-red-600">*</span></label>
								<div class="input-group">
									<input type="text" name="book_date" value="{{ old('book_date') }}" placeholder="เลือกวันที่" class="form-control @error('book_date') is-invalid @enderror" id="datepicker_book_date" readonly >
									<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fal fa-calendar-alt"></i>
										</span>
									</div>
								</div>
								@error('book_date')
									<div class="invalid-feedback" role="alert">{{ $message }}</div>
								@enderror
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-6 col-lg-6 mb-3">
								<label class="form-label" for="inputGroupFile01">แนบไฟล์หนังสือนำส่ง <span class="text-red-600">*</span></label>
								<div class="input-group">
									<div class="custom-file">
										<input type="file" name="book_file" value="{{ old('book_file') }}" class="custom-file-input @error('book_file') is-invalid @enderror" id="bookFile01" aria-describedby="bookFile01">
										<label class="custom-file-label" for="bookFile01" id="book_label">เลือกไฟล์</label>
									</div>
								</div>
								@error('book_file')
									<div class="invalid-feedback" role="alert">{{ $message }}</div>
								@enderror
							</div>
						</div>
					</div>
					<div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex flex-row align-items-center">
						<div class="form-row">
							<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
								<button type="submit" class="btn btn-primary ml-auto"><i class="fal fa-save"></i> บันทึกร่าง</button>
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
		$('#datepicker_book_date').datepicker({
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

    $('#bookFile01').on('change',function(){
                //get the file name
                var fileName = $(this).val();
                //replace the "Choose a file" label
                $(this).next('.book_label').html(fileName);
            })
});
</script>
@endsection

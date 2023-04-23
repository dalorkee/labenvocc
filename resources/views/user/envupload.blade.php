@extends('layouts.index')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('style')
<link href="{{ URL::asset('css/pj-step.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css') }}" rel="stylesheet" type="text/css">
<style type="text/css">
.input-date:read-only{background:#fefefe!important}
</style>
@endsection
@section('content')
<ol class="breadcrumb page-breadcrumb text-sm font-prompt">
	<li class="breadcrumb-item">ส่งตัวอย่าง (Upload)</li>
    <li class="breadcrumb-item">สิ่งแวดล้อม</li>
    <li class="breadcrumb-item"><a href="javascript:void(0);">ข้อมูลทั่วไป</a></li>
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
<div class="row text-sm font-prompt">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
		<div id="panel-customer" class="panel">
			<div class="panel-hdr">
				<h2 class="text-gray-600 text-primary"><i class="fal fa-clipboard"></i>&nbsp;คำขอส่งตัวอย่างสิ่งแวดล้อม (Upload)</h2>
				<div class="panel-toolbar">
					<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"><i class="fal fa-window-minimize"></i></button>
					<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"><i class="fal fa-expand"></i></button>
					<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"><i class="fal fa-times"></i></button>
				</div>
			</div>
			<div class="panel-container show">
				<form name="envUpload" action="{{ route('sampleupload.envimport') }}" method="POST" enctype="multipart/form-data">
					@csrf
					<input type="hidden" name="order_type" value="2">
					<input type="hidden" name="order_type_name" value="ตัวอย่างสิ่งแวดล้อม">
					<div class="panel-content">
						<ul class="steps">
							<li class="active"><a href=""><i class="fal fa-user"></i> <span class="d-none d-sm-inline">ข้อมูลทั่วไป</span></a></li>
							<li class="undone"><p><i class="fal fa-user"></i> <span class="d-none d-sm-inline">พารามิเตอร์</span></p></li>
							<li class="undone"><p><i class="fal fa-user"></i> <span class="d-none d-sm-inline">ข้อมูลตัวอย่าง</span></p></li>
							<li class="undone"><p><i class="fal fa-user"></i> <span class="d-none d-sm-inline">ตรวจสอบข้อมูล</span></p></li>
						</ul>
						@switch ($auth->userCustomer->customer_type)
							@case('personal')
								<div class="form-row">
									<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
										<label class="form-label text-primary" for="customer_name">ผู้ส่งตัวอย่าง <span class="text-red-600">*</span></label>
										<input type="text" name="customer_name" value="{{$auth->userCustomer->first_name}} {{$auth->userCustomer->last_name}}" class="form-control" maxlength="60" readonly>
									</div>
								</div>
								@break
							@case('private')
							@case('government')
								<div class="form-row">
									<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
										<label class="form-label text-primary" for="office_name">หน่วยงานที่ส่งตัวอย่าง <span class="text-red-600">*</span></label>
										<input type="text" name="office_name" value="{{$auth->userCustomer->agency_name}}" class="form-control" maxlength="80" readonly>
										@error('customer_name')
											<div class="invalid-feedback" role="alert">{{ $message }}</div>
										@enderror
									</div>
								</div>
								@break
						@endswitch
						<div class="form-row">                       {{--  edit to checked once --}}
							<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
								<label class="form-label text-primary" for="type_of_work">ประเภทงาน <span class="text-red-600">*</span></label>
								<div class="frame-wrap">
									<div class="custom-control custom-checkbox custom-control-inline">
										<input type="checkbox" name="type_of_work" value="1" class="custom-control-input type-of-work1" id="type_of_work1">
										<label class="custom-control-label" for="type_of_work1">บริการ</label>
									</div>
                                    <div class="custom-control custom-checkbox custom-control-inline">
										<input type="checkbox" name="type_of_work" value="2" class="custom-control-input type-of-work2" id="type_of_work2">
										<label class="custom-control-label" for="type_of_work2">วิจัย</label>
									</div>
                                    <div class="custom-control custom-checkbox custom-control-inline">
										<input type="checkbox" name="type_of_work" value="3" class="custom-control-input type-of-work3" id="type_of_work3">
										<label class="custom-control-label" for="type_of_work3">เฝ้าระวัง</label>
									</div>
                                    <div class="custom-control custom-checkbox custom-control-inline">
										<input type="checkbox" name="type_of_work" value="4" class="custom-control-input type-of-work4" id="type_of_work4">
										<label class="custom-control-label" for="type_of_work4">SRRT/สอบสวนโรค</label>
									</div>
                                    <div class="custom-control custom-checkbox custom-control-inline">
										<input type="checkbox" name="type_of_work" value="5" class="custom-control-input type-of-work5" id="type_of_work5">
										<label class="custom-control-label" for="type_of_work5">อื่นๆ</label>
									</div>
								</div>
							</div>
							<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
								<label class="form-label text-primary" for="type_of_work_other">ประเภทงานอื่นๆ ระบุ</label>
								<input type="text" name="type_of_work_other" id="type_of_work_other" class="form-control" disabled>
								@error('type_of_work_other')
									<div class="invalid-feedback" role="alert">{{ $message }}</div>
								@enderror
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-6 col-lg-6 mb-3">
								<label class="form-label" for="sample_date">วันที่เก็บตัวอย่าง</label>
								<div class="input-group">
									<input type="text" name="sample_date" placeholder="เลือกวันที่" class="form-control" id="sample_date">
									<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fal fa-calendar-alt"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-6 col-lg-6 mb-3">
								<label class="form-label text-primary" for="uploadenv">อัพโหลดไฟล์ Excel</label>
								<div class="input-group">
									<div class="custom-file">
										<input type="file" name="uploadenv" class="custom-file-input" id="uploadenv" aria-describedby="uploadenv">
										<label class="custom-file-label" for="uploadenv">เลือกไฟล์ Excel</label>
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
									<button type="submit" class="btn btn-primary ml-auto"><i class="fal fa-save"></i> บันทึก</button>
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
<script type="text/javascript">$(document).ready(function(){$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});});</script>
<script type="text/javascript" src="{{ URL::asset('assets/js/formplugins/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
<script>
	$(document).ready(function() {
		$('#sample_date').datepicker({
			format: 'dd/mm/yyyy',
			todayHighlight: true,
			orientation: "bottom left",
			autoclose: true,
		});
        $('input[name="type_of_work"]').on('change', function() {
			$('input[name="' + this.name + '"]').not(this).prop('checked', false);
			let chk = this.value;
			if (chk === '5') {
				$('#type_of_work_other').prop('disabled', false);
			}
			else {
				$('#type_of_work_other').val('');
				$('#type_of_work_other').prop('disabled', true);
			}
		});
        $('#uploadenv').on('change',function() {
		let fileName = $(this).val();
		$(this).next('.custom-file-label').html(fileName);
	})
	});
</script>
@endsection

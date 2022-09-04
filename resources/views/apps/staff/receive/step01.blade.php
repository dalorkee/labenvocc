@extends('layouts.index')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('style')
<link type="text/css" href="{{ URL::asset('vendor/bootstrap-datepicker/dist/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
<link type="text/css" href="{{ URL::asset('css/pj-step.css') }}" rel="stylesheet" >
@endsection
@section('content')
<ol class="breadcrumb page-breadcrumb text-sm font-prompt">
	<li class="breadcrumb-item"><i class="fal fa-home mr-1"></i> <a href="{{ route('sample.receive.index') }}">งานรับตัวอย่าง</a></li>
	<li class="breadcrumb-item">รับตัวอย่าง</li>
</ol>
<div class="row text-sm font-prompt">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
		<div id="panel-1" class="panel">
			<div class="panel-hdr">
				<h2><span class="text-blue-500"><i class="fal fa-th-list"></i>&nbsp;ตัวอย่าง รหัส {{ number_format($order_id) }}</span></h2>
				<div class="panel-toolbar">
					<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"><i class="fal fa-window-minimize"></i></button>
					<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"><i class="fal fa-expand"></i></button>
					<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"><i class="fal fa-times"></i></button>
				</div>
			</div>
			<div class="panel-container show">
				<form name="sample_detail" action="#" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="order_id" value="{{ $order_id }}">
					<input type="hidden" name="order_type" value="1">
					<input type="hidden" name="order_type_name" value="ตัวอย่างชีวภาพ">
					<div class="panel-content">
						<ul class="steps">
							<li class="undone"><a href="{{ route('sample.receive.create') }}"><span class="d-none d-sm-inline">รายการคำขอ</span></a></li>
							<li class="active"><p><span class="d-none d-sm-inline">รับตัวอย่าง</span></p></li>
							<li class="undone"><p><span class="d-none d-sm-inline">การตรวจวิเคราะห์</span></&p></li>
							<li class="undone"><p><span class="d-none d-sm-inline">รายงานผล</span></p></li>
						</ul>
						<div class="row">
							<div class="form-group col-xs-12 col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-3">
								<label class="form-label" for="lab_no">Lab No. <span class="text-red-600">*</span></label>
								<input type="text" name="lab_no" value="{{ old('lab_no') }}" class="form-control" maxlength="60">
							</div>
							<div class="form-group col-xs-12 col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-3">
								<label class="form-label" for="report_due_date">กำหนดส่งรายงาน</label>
								<div class="input-group date date_data">
									<input type="text" name="report_due_date" value="{{ old('report_due_date') }}" class="form-control @error('report_due_date') is-invalid @enderror input-date" id="report_due_date" placeholder="เลือกวันที่" readonly >
									<div class="input-group-append">
										<span class="input-group-text fs-xl"><i class="fal fa-calendar-alt"></i></span>
									</div>
								</div>
								@error('report_due_date')
									<div class="invalid-feedback" role="alert">{{ $message }}</div>
								@enderror
							</div>
							<div class="form-group col-xs-12 col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-3">
								<label class="form-label" for="type_of_work">ประเภทงาน <span class="text-red-600">*</span></label>
                                <select name="type_of_work" class="form-control @error('type_of_work') is-invalid @enderror">
                                    <option value="">-- โปรดเลือก --</option>
                                    @foreach ($type_of_work as $key => $val)
                                        <option value="{{ $key }}" {{ (old('type_of_work') == $key) ? 'selected' : '' }}>{{ $val }}</option>
                                    @endforeach
                                </select>
                                @error('type_of_work')
                                    <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                @enderror
							</div>
							<div class="form-group col-xs-12 col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-3">
								<label class="form-label" for="group_of_work">กลุ่มงาน <span class="text-red-600">*</span></label>
								<input type="text" name="group_of_work" value="{{ old('group_of_work') }}" class="form-control" maxlength="60">
							</div>
						</div>
					</div>
					<div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex flex-row align-items-center">
						<div class="form-row">
							<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
								<button type="submit" class="btn btn-warning ml-auto"><i class="fal fa-pencil"></i> แก้ไขข้อมูล</button>
								<a href="" class="btn btn-info ml-auto">ถัดไป <i class="fal fa-arrow-alt-right"></i></a>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script type="text/javascript" src="{{ URL::asset('vendor/moment/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('vendor/bootstrap-datepicker/dist/js/bootstrap-datetimepicker.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {
	$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
	 $('.date_data').datetimepicker({
		allowInputToggle: true,
		showClose: true,
		showClear: true,
		showTodayButton: true,
		format: "DD/MM/YYYY",
		ignoreReadonly: true,
	});
});
</script>
@endpush

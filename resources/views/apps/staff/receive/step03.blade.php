@extends('layouts.index')
@section('token')<meta name="csrf-token" content="{{ csrf_token() }}">@endsection
@section('style')
<link type="text/css" rel="stylesheet" href="{{ URL::asset('css/pj-step.css') }}">
<style type="text/css">
table#example_table thead {background-color:#2D8AC9;color: white;}
</style>
@endsection
@section('content')
<ol class="breadcrumb page-breadcrumb text-sm font-prompt">
	<li class="breadcrumb-item"><i class="fal fa-home mr-1"></i> <a href="{{ route('sample.received.index') }}">งานรับตัวอย่าง</a></li>
	<li class="breadcrumb-item">ใบคำขอ</li>
</ol>
<div class="row text-sm font-prompt">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
		<div id="panel-1" class="panel">
			<div class="panel-hdr">
				<h2><span class="text-blue-500"><i class="fal fa-th-list"></i>&nbsp;ตัวอย่าง</span></h2>
				<div class="panel-toolbar">
					<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"><i class="fal fa-window-minimize"></i></button>
					<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"><i class="fal fa-expand"></i></button>
					<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"><i class="fal fa-times"></i></button>
				</div>
			</div>
			<div class="panel-container show">
				<form name="received_step03_frm" id="received_step03_frm" action="{{ route('sample.received.step03.post') }}" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="id" value="{{ $order['id'] ?? old('id') }}">
					<input type="hidden" name="order_no" value="{{ $order['order_no'] ?? old('order_no') }}">
					<input type="hidden" name="order_no_ref" value="{{ $order['order_no'] ?? old('order_no_ref') }}">
					<input type="hidden" name="order_type" value="{{ $order['order_type'] ?? old('order_type') }}">
					<input type="hidden" name="order_type_name" value="{{ $order['order_type_name'] ?? old('order_type_name') }}">

					<div class="panel-content">
						<ul class="steps">
							<li class="undone"><a href="{{ route('sample.received.create') }}"><span class="d-none d-sm-inline">รายการคำขอ</span></a></li>
							<li class="active"><p><span class="d-none d-sm-inline">รับตัวอย่าง</span></p></li>
							<li class="undone"><p><span class="d-none d-sm-inline">การตรวจวิเคราะห์</span></&p></li>
							<li class="undone"><p><span class="d-none d-sm-inline">รายงานผล</span></p></li>
						</ul>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-4">
								<div class="panel-tag">
									<h4>สรุปจำนวนตัวอย่าง</h4>
									<div class="pt-4 pl-4">
										<div class="subheader">
											<h4 style="width:160px;" class="text-primary">สมบูรณ์</h4>
											<div class="subheader-block d-lg-flex align-items-center">
												<div class="d-inline-flex flex-column justify-content-center mr-3">
													<span class="fw-300 fs-xs d-block opacity-50"><small>ตัวอย่าง</small></span>
													<span class="fw-500 fs-xl d-block color-primary-500">{{ number_format($sample_sumary['sample_completed']) }}</span>
												</div>
											</div>
											<div class="subheader-block d-lg-flex align-items-center border-faded border-right-0 border-top-0 border-bottom-0 ml-3 pl-3">
												<div class="d-inline-flex flex-column justify-content-center mr-3">
													<span class="fw-300 fs-xs d-block opacity-50"><small>รายการทดสอบ</small></span>
													<span class="fw-500 fs-xl d-block color-primary-500">{{ number_format($sample_sumary['sample_completed_amount']) }}</span>
												</div>
											</div>
										</div>
										<div class="subheader">
											<h4 style="width: 160px;" class="text-danger">ไม่สมบูรณ์</h4>
											<div class="subheader-block d-lg-flex align-items-center">
												<div class="d-inline-flex flex-column justify-content-center mr-3">
													<span class="fw-300 fs-xs d-block opacity-50"><small>ตัวอย่าง</small></span>
													<span class="fw-500 fs-xl d-block color-danger-500">{{ number_format($sample_sumary['sample_not_completed']) }}</span>
												</div>
											</div>
											<div class="subheader-block d-lg-flex align-items-center border-faded border-right-0 border-top-0 border-bottom-0 ml-3 pl-3">
												<div class="d-inline-flex flex-column justify-content-center mr-3">
													<span class="fw-300 fs-xs d-block opacity-50"><small>รายการทดสอบ</small></span>
													<span class="fw-500 fs-xl d-block color-danger-500">{{ number_format($sample_sumary['sample_not_completed_amount']) }}</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0">
						<a href="{{ route('sample.received.step02', ['order_id' => $order_id]) }}" class="btn btn-primary" style="width:120px"> <i class="fal fa-arrow-alt-left"></i> ก่อนหน้า</a>
						<button type="button" class="btn btn-success" id="btn_submit" style="width:120px"><i class="fal fa-save"></i> บันทึกข้อมูล</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script type="text/javascript" src="{{ URL::asset('js/buttons.server-side.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {
	$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
    $('#btn_submit').click(function(e) {
		 e.preventDefault();
		let $form = $('form#received_step03_frm');
	 	Swal.fire({
	 		type: "warning",
	 		title: "<span class='text-danger'>ยืนยันบันทึกข้อมูล</span>",
	 		html: "<span class='text-primary'>โปรดตรวจสอบข้อมูลให้ถูกต้องเสมอ </span> <p class='text-danger'>ต้องการการบันทึกข้อมูลใช่หรือไม่ ?</p>" ,
	 		showCancelButton: true,
	 		cancelButtonColor: '#dd3333',
	 		cancelButtonText: "ยกเลิก",
			confirmButtonColor: '#3085d6',
	 		confirmButtonText: "ตกลง",
	 		footer: "Lab Env-Occ",
	 		allowOutsideClick: false
	 	}).then((result) => {
 	 		if (result.value == true) {
				 $form.submit();
	 		} else {
	 			return false;
	 		}
	 	});
	 });
});
</script>
@endpush

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
					<input type="hidden" name="order_id" value="{{ $order_id ?? old('order_id') }}">
					<input type="hidden" name="order_type" value="1">
					<input type="hidden" name="order_type_name" value="ตัวอย่างชีวภาพ">
					<div class="panel-content">
						<ul class="steps">
							<li class="undone"><a href="{{ route('sample.received.create') }}"><span class="d-none d-sm-inline">รายการคำขอ</span></a></li>
							<li class="active"><p><span class="d-none d-sm-inline">รับตัวอย่าง</span></p></li>
							<li class="undone"><p><span class="d-none d-sm-inline">การตรวจวิเคราะห์</span></&p></li>
							<li class="undone"><p><span class="d-none d-sm-inline">รายงานผล</span></p></li>
						</ul>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-4">
								<div class="alert alert-success alert-dismissible fade show" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true"><i class="fal fa-times"></i></span>
									</button>
									<div class="d-flex align-items-center">
										<div class="alert-icon">
											<span class="icon-stack icon-stack-md">
												<i class="base-7 icon-stack-3x color-success-600"></i>
												<i class="fal fa-check icon-stack-1x text-white"></i>
											</span>
										</div>
										<div class="flex-1">
											<span class="h4">บันทึกข้อมูลรหัส {{ $order_id }} แล้ว</span>
											<br>
											สถานะการรับตัวอย่างสำเร็จ
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-4 px-4">
							<table class="table table-bordered table-hover">
								<tbody class="text-2xl">
									<tr>
										<td style="width: 20%; vertical-align: middle;">รายการคำขอ</td>
										<td><span class="text-primary">{{ $order_arr['book_no'] }}</span></td>
									</tr>
									<tr>
										<td style="width: 20%; vertical-align: middle;">Lab No.</td>
										<td><span class="text-primary">{{ $order_arr['lab_no'] }}</span></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex flex-row align-items-center">
						<div class="form-row">
							<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
								<a href="{{ route('sample.received.print', ['order_id' => $order_id]) }}" class="btn btn-info ml-auto"> <i class="fal fa-print"></i> พิมพ์</a>
								<button type="button" class="btn btn-warning ml-auto" id="btn_submit"><i class="fal fa-home"></i> กลับหน้าแรก</button>
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

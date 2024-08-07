@extends('layouts.index')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/pj-step.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/datagrid/datatables/datatables.bundle.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/notifications/sweetalert2/sweetalert2.bundle.css') }}" media="screen">
<style type="text/css">
.dataTables_filter label {margin-top: 8px;}
.dataTables_filter input:first-child {margin-top: -8px}
table.dataTable thead th {background-color: #056676;color: white}
</style>
@endsection
@section('content')
<ol class="breadcrumb page-breadcrumb text-sm font-prompt">
	<li class="breadcrumb-item"><a href="javascript:void(0);">LabEnvOcc</a></li>
	<li class="breadcrumb-item">สร้างคำขอส่งตัวอย่างชีวภาพ</li>
	<li class="breadcrumb-item">ข้อมูลตัวอย่าง</li>
</ol>
<div class="row text-sm font-prompt">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
		<div id="panel-customer" class="panel">
			<div class="panel-hdr">
				<h2 class="text-gray-600"><i class="fal fa-clipboard"></i>&nbsp;คำขอส่งตัวอย่างชีวภาพ</h2>
				<div class="panel-toolbar">
					<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"><i class="fal fa-window-minimize"></i></button>
					<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"><i class="fal fa-expand"></i></button>
					<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"><i class="fal fa-times"></i></button>
				</div>
			</div>
			<div class="panel-container relative">
				<form name="custVerify" action="{{ route('customer.verify.store') }}" method="POST">
					@csrf
					<input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
					<input type="hidden" name="order_id" value="{{ $data['order_id'] }}">
					<div class="panel-content">
						<ul class="steps mb-3">
							<li class="undone"><a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="ข้อมูลทั่วไป"><i class="fal fa-user"></i> <span class="d-none d-sm-inline">ข้อมูลทั่วไป</span></a></li>
							<li class="undone"><a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="พารามิเตอร์"><i class="fal fa-tachometer"></i> <span class="d-none d-sm-inline">พารามิเตอร์</span></a></li>
							<li class="undone"><a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="ข้อมูลตัวอย่าง"><i class="fal fa-list-ul"></i> <span class="d-none d-sm-inline">ข้อมูลตัวอย่าง</span></a></li>
							<li class="active"><a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="ตรวจสอบข้อมูล"><i class="fal fa-check-circle"></i> <span class="d-none d-sm-inline">ตรวจสอบข้อมูล</span></a></li>
						</ul>
						@switch (auth()->user()->userCustomer->customer_type)
							@case('personal')
								<div class="form-row">
									<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
										<label class="form-label" for="customer_name">ผู้ส่งตัวอย่าง</label>
										<input type="text" name="customer_name" value="{{ $data['order'][0]->customer_agency_name ?? auth()->user()->userCustomer->first_name }}" class="form-control" readonly>
									</div>
								</div>
								@break
							@case('private')
							@case('government')
								<div class="form-row">
									<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
										<label class="form-label" for="office_name">หน่วยงานที่ส่งตัวอย่าง <span class="text-red-600">*</span></label>
										<input type="text" name="customer_name" value="{{ $data['order'][0]->customer_agency_name ?? auth()->user()->userCustomer->agency_name }}" class="form-control @error('customer_name') is-invalid @enderror" maxlength="80" readonly>
										@error('customer_name')
											<div class="invalid-feedback" role="alert">{{ $message }}</div>
										@enderror
									</div>
								</div>
								@break
						@endswitch
						<div class="form-row">
							<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
								<label class="form-label" for="type_of_work">ประเภทงาน <span class="text-red-600">*</span></label>
								<div class="frame-wrap">
									@foreach ($data['type_of_work'] as $key => $val)
									<div class="custom-control custom-checkbox custom-control-inline">
										<input type="checkbox" name="type_of_work" value="{{ $key }}" class="custom-control-input type-of-work @error('type_of_work') is-invalid @enderror"" id="type_of_work{{ $key }}" {{ (isset($data['order'][0]->type_of_work) && $data['order'][0]->type_of_work == $key) ? 'checked' : '' }} disabled>
										<label class="custom-control-label" for="type_of_work{{ $key }}">{{ $val }}</label>
									</div>
									@endforeach
								</div>
							</div>
							<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
								<label class="form-label" for="type_of_work_other">ประเภทงานอื่นๆ</label>
								<input type="text" name="type_of_work_other" value="{{ $data['order'][0]->type_of_work_other ?? '' }}" id="type_of_work_other" class="form-control @error('type_of_work_other') is-invalid @enderror" readonly>
							</div>
							<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-6 col-lg-6 mb-3">
								<label class="form-label" for="book_no">เลขที่หนังสือนำส่ง</label>
								<div class="input-group">
									<input type="text" name="book_no" value="{{ $data['order'][0]->book_no ?? null }}" class="form-control" readonly>
									<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fal fa-file-alt"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-6 col-lg-6 mb-3">
								<label class="form-label" for="book_date">ลงวันที่</label>
								<div class="input-group">
								<input type="text" name="book_date" value="{{ $data['order'][0]->book_date ?? '' }}" placeholder="เลือกวันที่" class="form-control" readonly>
								<div class="input-group-append">
									<span class="input-group-text fs-xl">
										<i class="fal fa-calendar-alt"></i>
									</span>
								</div>
							</div>
						</div>
						<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
							<label class="form-label" for="attach_file">ไฟล์หนังสือนำส่ง</label>
							<div class="input-group">
								<input type="text" name="book_file" value="{{ $data['order'][0]['uploads'][0]->file_name ?? 'ไม่มีไฟล์แนบ' }}" class="form-control" readonly>
								<div class="input-group-append">
									<span class="input-group-text fs-xl">
										<i class="fal fa-file-pdf"></i>
									</span>
								</div>
							</div>
						</div>
					</div>
					{{ $dataTable->table() }}
					</div>
					<div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0">
						<div class="row">
							<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-4">
								<div class="frame-wrap">
									<div class="custom-control custom-checkbox custom-control-inline">
										<input type="checkbox" name="confirm_chk" value="y" class="custom-control-input @error('confirm_chk') is-invalid @enderror" id="confirm_chk" {{ ((isset($data['order'][0]->confirm_chk) == 'y') || old('confirm_chk') == 'y') ? "checked" : "" }}>
										<label class="custom-control-label" for="confirm_chk">ฉันได้ตรวจสอบความถูกต้องของข้อมูลแล้ว</label>
									</div>
								</div>
							</div>
						</div>
						<!-- Modal Confirmation -->
						<div class="modal fade" id="default-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-header border-bottom">
										<h4 class="modal-title">ยืนยัน</h4>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true"><i class="fal fa-times"></i></span>
										</button>
									</div>
									<div class="modal-body">
										<h3 class="text-center text-danger mt-2 mb-4">โปรดตรวจสอบข้อมูล !!</h3>
										<p class="text-center text-primary">เมื่อส่งคำขอแล้ว จะไม่สามารถแก้ไขข้อมูลได้อีก !!</p>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
										<button type="submit" class="btn btn-success">ส่งคำขอ</button>
									</div>
								</div>
							</div>
						</div>
						<div class="d-flex flex-row justify-content-between">
							<div style="width:102px;height:40px;">
								<a href="{{ route('customer.sample.create', ['order_id' => $data['order_id']]) }}" class="btn btn-info ml-auto"><i class="fal fa-arrow-alt-left"></i> ก่อนหน้า</a>
							</div>
							<div style="width:100px;height:40px;">
								{{-- <a href="javascript:void(0);" class="btn btn-outline-primary" id="js-sweetalert2-example-7">Try me!</a> --}}
								{{-- <button type="submit" class="btn btn-danger ml-auto">ส่งคำขอ <i class="fal fa-arrow-alt-right"></i></button> --}}
								<button type="button" class="btn btn-success" data-toggle="modal" data-target="#default-example-modal-center" data-backdrop="static" data-keyboard="false">ส่งคำขอ</button>
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
<script type="text/javascript" src="{{ URL::asset('assets/js/datagrid/datatables/datatables.bundle.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/notifications/sweetalert2/sweetalert2.bundle.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/buttons.server-side.js') }}"></script>
{{ $dataTable->scripts() }}
<script>
$(document).ready(function() {
	$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
});
</script>
@endsection

@extends('layouts.index')
@section('token')<meta name="csrf-token" content="{{ csrf_token() }}">@endsection
@section('style')
<link type="text/css" rel="stylesheet" href="{{ URL::asset('assets/css/datagrid/datatables/datatables.bundle.css') }}">
<link type="text/css" href="{{ URL::asset('vendor/bootstrap-datepicker/dist/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
<link type="text/css" rel="stylesheet" href="{{ URL::asset('vendor/jquery-datatables-checkboxes/dataTables.checkboxes.css') }}">
<link type="text/css" href="{{ URL::asset('css/pj-step.css') }}" rel="stylesheet">
<style type="text/css">
#example_table thead {background-color:#2D8AC9;color: white;}
table.dataTable.dt-checkboxes-select tbody tr,
table.dataTable thead .dt-checkboxes-select-all {cursor: pointer;}
table.dataTable thead .dt-checkboxes-select-all {text-align: center;}
div.dataTables_wrapper span.select-info,
div.dataTables_wrapper span.select-item {margin-left: 0.5em;}
@media screen and (max-width: 640px) {div.dataTables_wrapper span.select-info,div.dataTables_wrapper span.select-item {margin-left: 0;display: block;}}
</style>
@endsection
@section('content')
<ol class="breadcrumb page-breadcrumb text-sm font-prompt">
	<li class="breadcrumb-item"><i class="fal fa-home mr-1"></i> <a href="{{ route('sample.receives.index') }}">งานรับตัวอย่าง</a></li>
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
				<form name="sample_detail" id="sample_detail" action="{{ route("sample.receives.step01.store") }}" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="order_id" value="{{ $order['id'] }}">
					<input type="hidden" name="order_type" value="1">
					<input type="hidden" name="order_type_name" value="ตัวอย่างชีวภาพ">
					<div class="panel-content">
						<ul class="steps">
							<li class="undone"><a href="{{ route('sample.receives.create') }}"><span class="d-none d-sm-inline">รายการคำขอ</span></a></li>
							<li class="active"><p><span class="d-none d-sm-inline">รับตัวอย่าง</span></p></li>
							<li class="undone"><p><span class="d-none d-sm-inline">การตรวจวิเคราะห์</span></&p></li>
							<li class="undone"><p><span class="d-none d-sm-inline">รายงานผล</span></p></li>
						</ul>
						<div class="row">
							<div class="form-group col-xs-12 col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-3">
								<label class="form-label" for="lab_no">Lab No. <span class="text-red-600">*</span></label>
								<input type="text" name="lab_no" value="{{ $order['order_no'] ?? old('lab_no') }}" class="form-control" maxlength="60">
							</div>
							<div class="form-group col-xs-12 col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-3">
								<label class="form-label" for="report_due_date">กำหนดส่งรายงาน</label>
								<div class="input-group date date_data">
									<input type="text" name="report_due_date" value="{{ $order['report_due_date'] ?? old('report_due_date') }}" class="form-control @error('report_due_date') is-invalid @enderror input-date" id="report_due_date" placeholder="เลือกวันที่" readonly >
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
										<option value="{{ $key }}" {{ ($order['type_of_work'] == $key || old('type_of_work') == $key) ? 'selected' : '' }}>{{ $val }}</option>
									@endforeach
								</select>
								@error('type_of_work')
									<div class="invalid-feedback" role="alert">{{ $message }}</div>
								@enderror
							</div>
							<div class="form-group col-xs-12 col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-3">
								<label class="form-label" for="type_of_work_other">ประเภทงานอื่นๆ ระบุ</label>
								<input type="text" name="type_of_work_other" value="{{ $order['type_of_work_other'] ?? old('type_of_work_other') }}" id="type_of_work_other" class="form-control @error('type_of_work_other') is-invalid @enderror" {{ ((!empty($order['type_of_work']) && $order['type_of_work'] == 5) || old('type_of_work_other') == 5) ? '' : 'disabled' }}>
								@error('type_of_work_other')
									<div class="invalid-feedback" role="alert">{{ $message }}</div>
								@enderror
							</div>
							{{-- <div class="form-group col-xs-12 col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-3">
								<label class="form-label" for="group_of_work">กลุ่มงาน <span class="text-red-600">*</span></label>
								<input type="text" name="group_of_work" value="{{ old('group_of_work') }}" class="form-control" maxlength="60">
							</div> --}}
							<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-6 col-lg-6 mb-3">
								<label class="form-label" for="book_no">เลขที่หนังสือนำส่ง</label>
								<input type="text" name="book_no" value="{{ $order['book_no'] ?? old('book_no') }}" class="form-control @error('book_no') is-invalid @enderror">
								@error('book_no')
									<div class="invalid-feedback" role="alert">{{ $message }}</div>
								@enderror
							</div>
							<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-6 col-lg-6 mb-3">
								<label class="form-label" for="book_date">ลงวันที่</label>
								<div class="input-group">
									<input type="text" name="book_date" value="{{ $order['book_date'] ?? old('book_date') }}" placeholder="เลือกวันที่" class="form-control @error('book_date') is-invalid @enderror input-date" id="datepicker_book_date" readonly >
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
							<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-6 col-lg-6 mb-3">
								<label class="form-label" for="example_type">ชนิดตัวอย่าง</label>
								<input type="text" name="example_type" value="{{ $order['example_type'] ?? old('example_type') }}" class="form-control @error('example_type') is-invalid @enderror">
								@error('example_type')
									<div class="invalid-feedback" role="alert">{{ $message }}</div>
								@enderror
							</div>
							<div class="form-group col-xs-12 col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-3">
								<label class="form-label" for="group_of_work">กลุ่มงาน <span class="text-red-600">*</span></label>
								<select name="group_of_work" class="form-control @error('group_of_work') is-invalid @enderror">
									<option value="">-- โปรดเลือก --</option>
									@foreach ($type_of_work as $key => $val)
										<option value="{{ $key }}" {{ ($order['type_of_work'] == $key || old('type_of_work') == $key) ? 'selected' : '' }}>{{ $val }}</option>
									@endforeach
								</select>
								@error('group_of_work')
									<div class="invalid-feedback" role="alert">{{ $message }}</div>
								@enderror
							</div>
						</div>
						<div class="row">
							<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
								<div class="tw-relative">
									<div class="row">
										<div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
											{{ $dataTable->table() }}
										</div>
									</div>
									{{-- <caption class="d-none"><i class="fa fa-clone"></i> การตรวจสอบตัวอย่าง</caption> --}}
									{{-- <table class="table-striped" id="table-1" data-toggle="table" data-show-columns="true">
										<thead>
											<tr class="bg-primary text-white">
												<th>ลำดับ</th>
												<th>รหัส ตย.</th>
												<th>ชนิด ตย.</th>
												<th>รายการทดสอบ</th>
												<th>จำนวนรายการทดสอบ</th>
												<th>เลือก</th>
												<th>สถานะ</th>
											</tr>
										</thead>
										<tfoot></tfoot>
										<tbody>
										@foreach ($order_example as $key => $val)
											<tr>
												<td>{{ $loop->iteration}}</td>
												<td>{{ $val['id'] }}</td>
												<td>
													<input type="text" name="exam_type[]" />
												</td>
												<td>
													@forelse ($order_parameter as $k => $v)
														<ul>
															<li>{{ $v['parameter_name'] }}</li>
														</ul>
													@empty
														{{ '-' }}
													@endforelse
												</td>
												<td>{{ count($order_parameter) }}</td>
												<td>
													<input type="checkbox" name="a[]" />
												</td>
												<td>รับ</td>
											</tr>
										@endforeach
										</tbody>
									</table> --}}
								</div>
							</div>

						</div>
					</div>
					<div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex flex-row align-items-center">
						<div class="form-row">
							<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
								<button type="submit" class="btn btn-warning ml-auto"><i class="fal fa-pencil"></i> บันทึกข้อมูล</button>
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
<script type="text/javascript" src="{{ URL::asset('assets/js/datagrid/datatables/datatables.bundle.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/buttons.server-side.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('vendor/bootstrap-datepicker/dist/js/bootstrap-datetimepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('vendor/jquery-datatables-checkboxes/dataTables.checkboxes.min.js') }}"></script>
{{ $dataTable->scripts() }}
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

	$('#sample_detail').on('submit', function(e) {
		e.preventDefault();
		var action = $(this).attr("action");
		var method = $(this).attr("method");
		let form = this;
		let table = $('#example_table').DataTable();
		let rows_selected = table.column(0).checkboxes.selected();
		$.each(rows_selected, function(index, rowId) {
			$(form).append($('<input>').attr('type', 'hidden').attr('name', 'table_select_id_arr[]').val(rowId));
		});
		var form_data = new FormData($(this)[0]);
		console.log(form_data);
		// $.ajax({
		// 	url: action,
		// 	type: method,
		// 	data: form_data,
		// 	dataType: 'html',
		// 	success: function(response) {
		// 		console.log(response);
		// 	},
		// 	error: function(response) {
		// 		alert(response);
		// 	}
		// })
	});

	$('#select_all').click(function() {
		// if (this.checked) {
			alert('ok');
			// $('.ok').prop('checked', true);
		// } else {
		//     alert ('nok');
		//     // $('.ok').prop('checked', false);
		// }
	})
});
</script>
@endpush

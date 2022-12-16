@extends('layouts.index')
@section('token')<meta name="csrf-token" content="{{ csrf_token() }}">@endsection
@section('style')
<link type="text/css" rel="stylesheet" href="{{ URL::asset('vendor/bootstrap-table/dist/bootstrap-table.min.css') }}">
<link type="text/css" rel="stylesheet" href="{{ URL::asset('vendor/jquery-datatables-checkboxes/dataTables.checkboxes.css') }}">
<link type="text/css" rel="stylesheet" href="{{ URL::asset('vendor/bootstrap-datepicker/dist/css/bootstrap-datetimepicker.min.css') }}">
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
				<form name="received_step02_frm" action="{{ route('sample.received.step02.post') }}" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="order_id" value="{{ $order['id'] ?? old('id') }}">
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
							<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
								<div class="tw-relative">
									<div class="row">
										<div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
											<table class="table-striped" id="table-1" data-toggle="table" data-show-columns="true">
												<caption class="d-none"><i class="fa fa-clone"></i> การตรวจสอบตัวอย่าง</caption>
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
													@foreach ($result as $val)
														<tr>
															<td>{{ $loop->iteration}}</td>
															<td>
																<span>{{ $val['sample_id'] }}</span>
																<input type="hidden" name="sample_id[]" value="{{ $val['sample_id'] }}">
															</td>
															<td>
																@foreach ($val['parameter_type'] as $key => $value)
																	<ul>
																		<li>{{ $value }}</li>
																	</ul>
																@endforeach
															</td>
															<td>
																@forelse ($val['parameter_name'] as $key => $value)
																	<ul>
																		<li>{{ $value }}</li>
																	</ul>
																@endforeach
															</td>
															<td>{{ $val['sample_count'] }}</td>
															<td>
																<input type="checkbox" name="chk_sample[]" value="{{ $val['sample_id'] }}">
																<label>สมบูรณ์</label>
															</td>
															<td>
																<select name="select_sample[]" class="form-control select2">
																	<option value="">-- โปรดเลือก --</option>
																	<option value="y">รับ</option>
																	<option value="n">ปฏิเสธ</option>
																</select>
															</td>
														</tr>
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>
					<div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex flex-row align-items-center">
						<div class="form-row">
							<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
								<a href="{{ route('sample.received.step01', ['order_id' => $order['id']]) }}" class="btn btn-success ml-auto"><i class="fal fa-arrow-alt-left"></i> ก่อนหน้า</a>
								<button type="submit" class="btn btn-success ml-auto">ถัดไป <i class="fal fa-arrow-alt-right"></i></button>
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
<script type="text/javascript" src="{{ URL::asset('vendor/bootstrap-table/dist/bootstrap-table.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('vendor/bootstrap-table/dist/locale/bootstrap-table-th-TH.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('vendor/bootstrap-datepicker/dist/js/bootstrap-datetimepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/buttons.server-side.js') }}"></script>
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

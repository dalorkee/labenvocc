@extends('layouts.index')
@section('token')<meta name="csrf-token" content="{{ csrf_token() }}">@endsection
@section('style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/pj-step.css') }}">
<style type="text/css">
	table#example_table thead {background-color:#0e629b;color:white}
    .v-wp {display:flex; flex-direction:row; justify-content:space-between; width:130px; margin:0; padding:0}
    .v-wp div {width:90px;}
    .v-wp div+div {width:40px; font-size: .80em}
</style>
@endsection
@section('content')
<ol class="breadcrumb page-breadcrumb text-sm font-prompt">
	<li class="breadcrumb-item"><i class="fal fa-home mr-1"></i> <a href="{{ route('sample.received.index') }}">งานตรวจวิเคราะห์</a></li>
	<li class="breadcrumb-item">รายการตัวอย่าง</li>
</ol>
<div class="row text-sm font-prompt">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
		<div id="panel-1" class="panel">
			<div class="panel-hdr">
				<h2><span class="text-primary"><i class="fal fa-th"></i>&nbsp;รายการตัวอย่าง</span></h2>
				<div class="panel-toolbar">
					<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"><i class="fal fa-window-minimize"></i></button>
					<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"><i class="fal fa-expand"></i></button>
					<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"><i class="fal fa-times"></i></button>
				</div>
			</div>
			<div class="panel-container show">
				<form name="lab_result_form" action="{{ route('sample.analyze.lab.result.save') }}" method="POST">
					<input type="hidden" name="_token" value="{{ csrf_token() }}" />
					<div class="panel-content">
						<ul class="steps">
							<li class="undone"><a href="{{ route('sample.received.create') }}"><span class="d-none d-sm-inline">รายการคำขอ</span></a></li>
							<li class="undone"><p><span class="d-none d-sm-inline">รับตัวอย่าง</span></p></li>
							<li class="active"><p><span class="d-none d-sm-inline">การตรวจวิเคราะห์</span></p></li>
							<li class="undone"><p><span class="d-none d-sm-inline">รายงานผล</span></p></li>
						</ul>
						<h4><span class="badge badge-danger p-2 m-0">Lab No. {{ $lab_no }}</span></h4>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mt-4">
								<div class="table-responsive">
									<table class="table table-striped" id="example_table">
										<thead>
											<tr>
												<th>หมายเลขทดสอบ</th>
												<th>พารามิเตอร์</th>
												<th>เครื่องมือ</th>
												<th>Blank</th>
												<th>Amount</th>
												<th>ปริมาตรอากาศ</th>
												<th>น้ำหนักดิน</th>
												<th>Dilution</th>
												<th>Result</th>
												<th>#</th>
											</tr>
										</thead>
										<tfoot></tfoot>
										<tbody>
											@foreach ($data as $key => $val)
												@foreach ($val['parameters'] as $k => $v)
													<tr>
														<td style="width: 100px;">
                                                            <input type="hidden" name="lab_no" value="{{ $lab_no }}">
															<input type="hidden" name="ref_order_id[]" value="{{ $val['order_id'] }}">
															<input type="hidden" name="ref_order_sample_id[]" value="{{ $val['id'] }}">
															<input type="hidden" name="has_parameter[]" value="{{ $val['has_parameter'] }}">
															<input type="hidden" name="sample_test_no[]" value="{{ $val['sample_test_no'] }}">
															{{ $val['sample_test_no'] }}
														</td>
														<td style="width: 300px;">
															<input type="hidden" name="order_sample_parameter_id[]" value="{{ $v['id'] }}">
															<input type="hidden" name="parameter_id[]" value="{{ $v['parameter_id'] }}">
															<input type="hidden" name="parameter_name[]" value="{{ $v['parameter_name'] }}">
															{{ $v['parameter_name'] }}
														</td>
														<td>
															<select name="machine_id[]" class="form-control" style="width: 170px;">
																<option value="0">-- โปรดเลือก --</option>
																@foreach ($machine as $mk => $mv)
																	<option value="{{ $mv['id'] }}" {{ (!empty($v['machine_id']) && $v['machine_id'] == $mv['id']) ? 'selected' : '' }}>{{ $mv['machine_name'] }}</option>
																@endforeach
															</select>
														</td>
														<td><input type="text" name="lab_result_blank[]" value="{{ $v['lab_result_blank'] }}" class="form-control" style="width: 100px;"></td>
														<td><input type="text" name="lab_result_amount[]" value="{{ $v['lab_result_amount'] }} " class="form-control" style="width: 100px;"></td>
														<td><input type="text" name="air_volume[]" value="{{ $val['air_volume'] }}" class="form-control" style="width: 100px;" readonly></td>
														<td><input type="text" name="weight_sample[]" value="{{ $val['weight_sample'] }}" class="form-control"style="width: 100px;" readonly></td>
														<td><input type="text" name="lab_dilution[]" value="{{ $v['lab_dilution'] }}" class="form-control" style="width: 100px;"></td>
														<td><input type="text" name="lab_result[]" value="{{ $v['lab_result'] }}" class="form-control" style="width: 100px;"></td>
														<td style="width: 200px; text-center;">
															{{-- <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#default-example-modal-lg-center">ADD</button>&nbsp; --}}
															<button type="button" class="btn btn-sm btn-success add-lab-result-file" data-xpid="{{ $v['id'] }}" data-xorder_id="{{ $order_id }}">ADD</button>&nbsp;
															<button type="button" class="btn btn-sm btn-primary comment-lab-result-file" data-ypid="{{ $v['id'] }}">Comment</button>
														</td>
													</tr>
												@endforeach
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0">
						<div class="relative" style="height: 50px;">
							<div class="absolute top-0 left-0">
								<button type="button" id="btn_upload_chart" class="btn btn-success" data-zlno="{{ $lab_no }}" data-zoid="{{ $order_id }}"><i class="fal fa-file"></i> Add File</button>
								<button type="submit" class="btn btn-danger"><i class="fal fa-save"></i> Save</button>
							</div>
							<div class="absolute top-0 right-0">
								<button type="button" class="btn btn-info" id="btn_view_modal" data-view_lno="{{ $lab_no }}" data-view_oid="{{ $order_id }}" data-view_analyze_user="{{ $main_analys_user_id }}"><i class="fal fa-eye"></i> View</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="loader text-center">
	<div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
		<span class="sr-only">Loading...</span>
	</div>
</div>
<div id="add_file_modal_wrapper"></div>
<div id="comment_modal_wrapper"></div>
<div id="upload_chart_modal_wrapper"></div>
<div id="view_modal_wrapper"></div>
@endsection
@push('scripts')
{{-- <script type="text/javascript" src="{{ URL::asset('assets/js/notifications/sweetalert2/sweetalert2.bundle.js') }}"></script> --}}
<script type="text/javascript">
$(document).ready(function() {
	$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
	$('.add-lab-result-file').on('click', function() {
		let xoid = $(this).data('xorder_id');
		let xpid = $(this).data('xpid');;
		$.ajax({
			method: "POST",
			url: "{{ route('sample.analyze.lab.result.upload.create') }}",
			dataType: "html",
			data: {xorder_id: xoid, xparamet_id: xpid},
			beforeSend: function() {$(".loader").show()},
			success: function(response) {
				$('#add_file_modal_wrapper').html(response);
				$('#default-example-modal-lg-center').modal('show');
			},
			complete: function() {$('.loader').hide()},
			error: function(jqXhr, textStatus, errorMessage) {alert('Error: ' + jqXhr.status + errorMessage)}
		});
	});
	$('.comment-lab-result-file').on('click', function() {
		let ypid = $(this).data('ypid');
		$.ajax({
			method: "POST",
			url: "{{ route('sample.analyze.lab.result.comment.create') }}",
			dataType: "html",
			data: {yparamet_id: ypid},
			beforeSend: function() {$(".loader").show()},
			success: function(response) {
				$('#comment_modal_wrapper').html(response);
				$('#comment-modal-lg-center').modal('show');
			},
			complete: function() {$('.loader').hide()},
			error: function(jqXhr, textStatus, errorMessage) {alert('Error: ' + jqXhr.status + errorMessage)}
		});
	});
	$('#btn_upload_chart').on('click', function() {
		let zlno = $(this).data('zlno');
		let zoid = $(this).data('zoid');
		$.ajax({
			method: "POST",
			url: "{{ route('sample.analyze.result.upload.file.create') }}",
			dataType: "html",
			data: {zlab_no: zlno, zorder_id: zoid},
			beforeSend: function() {$(".loader").show()},
			success: function(response) {
				$('#upload_chart_modal_wrapper').html(response);
				$('#chart-modal-lg-center').modal('show');
			},
			complete: function() {$('.loader').hide()},
			error: function(jqXhr, textStatus, errorMessage) {alert('Error: ' + jqXhr.status + errorMessage)}
		});
	});
	$('#btn_view_modal').on('click', function() {
		let view_lno = $(this).data('view_lno');
		let view_oid = $(this).data('view_oid');
		let view_analyze_user = $(this).data('view_analyze_user');
		$.ajax({
			method: "POST",
			url: "{{ route('sample.analyze.result.view.create') }}",
			dataType: "html",
			data: {view_lab_no: view_lno, view_order_id: view_oid, view_analyze_user: view_analyze_user},
			beforeSend: function() {$(".loader").show()},
			success: function(response) {
				$('#view_modal_wrapper').html(response);
				$('#view-modal-lg-center').modal('show');
			},
			complete: function() {$('.loader').hide()},
			error: function(jqXhr, textStatus, errorMessage) {alert('Error: ' + jqXhr.status + errorMessage)}
		});
	});
});
</script>
@endpush

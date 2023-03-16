@extends('layouts.index')
@section('token')<meta name="csrf-token" content="{{ csrf_token() }}">@endsection
@section('style')
<link type="text/css" rel="stylesheet" href="{{ URL::asset('css/pj-step.css') }}">
<style type="text/css">table#example_table thead {background-color:#2D8AC9;color:white;}</style>
<style type="text/css">
fieldset {
	border: 1px solid #93c5fd;
	padding: 0 20px 20px 20px;
	background: none;
}
legend {
	width: 50px;
	font-size: 1.175em;
	padding: 0 5px;
	background-color: none !important;
}
</style>
@endsection
@section('content')
<ol class="breadcrumb page-breadcrumb text-sm font-prompt">
	<li class="breadcrumb-item"><i class="fal fa-home mr-1"></i> <a href="{{ route('sample.received.index') }}">งานตรวจวิเคราะห์</a></li>
	<li class="breadcrumb-item">เบิกตัวอย่าง</li>
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
				<div class="panel-content">
					<ul class="steps">
						<li class="undone"><a href="{{ route('sample.received.create') }}"><span class="d-none d-sm-inline">รายการคำขอ</span></a></li>
						<li class="undone"><p><span class="d-none d-sm-inline">รับตัวอย่าง</span></p></li>
						<li class="active"><p><span class="d-none d-sm-inline">การตรวจวิเคราะห์</span></&p></li>
						<li class="undone"><p><span class="d-none d-sm-inline">รายงานผล</span></p></li>
					</ul>
					<h4>เบิกตัวอย่าง</h4>
					<form name="analyze_form" action="{{ route('sample.analyze.requisition.create.ajax') }}" method="GET" enctype="multipart/form-data">
						<fieldset>
							<legend>ค้นหา</legend>
							<input type="hidden" name="_token" value="{{ csrf_token() }}" />
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-xl-6 col-lg-6 mb-2">
									<div class="form-group">
										<label class="form-label" for="lab_no">Lab No.</label>
										<div class="input-group flex-nowrap">
											<input type="text" name="lab_no" class="form-control" id="lab_no" placeholder="Lab No." />
										</div>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12 col-xl-6 col-lg-6 mb-4">
									<div class="form-group">
										<label class="form-label" for="analyze_user">ผู้วิเคราะห์</label>
										<select name="analyze_user" id="analyze_user" class="form-control" id="analyze_user">
											<option value="0">-- โปรดเลือก --</option>
											@foreach ($analyze_user as $key => $value)
												<option value="{{ $key }}">{{ $value }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-2">
									<button type="button" class="btn btn-info btn-md" id="analyze_search_btn">ค้นหา</button>
									<button type="submit" class="btn btn-secondary btn-md" id="analyze_search_btn">ค้นหาx</button>
								</div>
							</div>
						</fieldset>
					</form>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mt-4">
							<div id="loader" class="text-center hidden">
								<span class="spinner-grow spinner-grow-sm text-danger" role="status" aria-hidden="true"></span>
								<span class="text-danger" style="line-height:16px;">Loading...</span>
							</div>
							<div id="order_sample_table"></div>
						</div>
					</div>
				</div>
				<div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex flex-row align-items-center">
					<div class="form-row">
						<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
							<a href="" class="btn btn-primary ml-auto" id="print_testing_btn" disabled> <i class="fal fa-save"></i> พิมพ์บันทึกการทดสอบ</a>
							<a href="{{ route('sample.received.index') }}" type="button" class="btn btn-primary ml-auto"><i class="fal fa-home"></i> กลับไปหน้าแรก</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
$(document).ready(function() {
	$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
	$('#analyze_search_btn').click(function() {
		$('#order_sample_table').html('');
		let lab_no = $('#lab_no').val();
		let analyze_user = $('#analyze_user').val();
		$.ajax({
			type: "GET",
			url: "{{ route('sample.analyze.requisition.create.ajax') }}",
			data: {lab_no: lab_no, analyze_user: analyze_user},
			dataType: "html",
			beforeSend: function() {
				$('#loader').removeClass('hidden')
			},
			success: function(response) {
				$('#order_sample_table').html(response);
			},
			complete: function() {
				$('#loader').addClass('hidden')
			},
			error: function(jqXhr, textStatus, errorMessage) {
				alert('Error code: ' + jqXhr.status + errorMessage);
			}
		});
	});
});
</script>
@endpush

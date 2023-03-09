@extends('layouts.index')
@section('token')<meta name="csrf-token" content="{{ csrf_token() }}">@endsection
@section('style')
<link type="text/css" rel="stylesheet" href="{{ URL::asset('css/pj-step.css') }}">
<style type="text/css">table#example_table thead {background-color:#2D8AC9;color:white;}</style>
@endsection
@section('content')
<ol class="breadcrumb page-breadcrumb text-sm font-prompt">
	<li class="breadcrumb-item"><i class="fal fa-home mr-1"></i> <a href="{{ route('sample.received.index') }}">งานรับตัวอย่าง</a></li>
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
				<form name="setTestNofrm" action="{{ route('sample.received.test.no.set') }}" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					{{-- <input type="hidden" name="order_id" value="{{ $order_id ?? old('order_id') }}">
					<input type="hidden" name="order_type" value="1">
					<input type="hidden" name="order_type_name" value="ตัวอย่างชีวภาพ"> --}}
					<div class="panel-content">
						<ul class="steps">
							<li class="undone"><a href="{{ route('sample.received.create') }}"><span class="d-none d-sm-inline">รายการคำขอ</span></a></li>
							<li class="active"><p><span class="d-none d-sm-inline">รับตัวอย่าง</span></p></li>
							<li class="undone"><p><span class="d-none d-sm-inline">การตรวจวิเคราะห์</span></&p></li>
							<li class="undone"><p><span class="d-none d-sm-inline">รายงานผล</span></p></li>
						</ul>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-4">
								<h5>เบิกตัวอย่าง</h5>
								<div class="form-group mt-4">
									<label for="lbl">ค้นหา Lab No.</label>
									<div class="input-group">
										<input type="text" name="set_test_no_search" class="form-control" id="set_test_no_search" placeholder="ค้นหา Lab No.">
										<div class="input-group-append">
											<button type="button" class="btn btn-info" id="set_test_no_search_btn"><i class="fal fa-search"></i></button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-4" id="order_sample_table"></div>
						</div>
					</div>

					<div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex flex-row align-items-center">
						<div class="form-row">
							<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
								<button type="submit" class="btn btn-info ml-auto" id="print_testing_btn" disabled> <i class="fal fa-save"></i> พิมพ์บันทึกการทดสอบ</button>
								<a href="{{ route('sample.received.index') }}" type="button" class="btn btn-warning ml-auto"><i class="fal fa-home"></i> กลับไปหน้าแรก</a>
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
<script type="text/javascript">
$(document).ready(function() {
	$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
	$('#set_test_no_search_btn').click(function() {
		let lab_no = $('#set_test_no_search').val();
		$.ajax({
			type: "GET",
			url: "{{ route('sample.received.requisition.create.ajax') }}",
			data: {lab_no: lab_no},
			dataType: "html",
			success: function(response) {
				$('#order_sample_table').html(response);
			},
			error: function(jqXhr, textStatus, errorMessage) {
				alert('Error code: ' + jqXhr.status + errorMessage);
			}
		});
	});
});
</script>
@endpush

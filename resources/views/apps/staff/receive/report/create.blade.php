@extends('layouts.index')
@section('token')<meta name="csrf-token" content="{{ csrf_token() }}">@endsection
@section('style')
<link type="text/css" rel="stylesheet" href="{{ URL::asset('css/pj-step.css') }}">
<link href="{{ URL::asset('assets/css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css') }}" rel="stylesheet" type="text/css">
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
	<li class="breadcrumb-item"><i class="fal fa-home mr-1"></i> <a href="{{ route('sample.received.index') }}">งานรับตัวอย่าง</a></li>
	<li class="breadcrumb-item">ออกรายงาน</li>
</ol>
<div class="row text-sm font-prompt">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
		<div id="panel-1" class="panel">
			<div class="panel-hdr">
				<h2><span class="text-primary"><i class="fal fa-th-list"></i>&nbsp;ออกรายงาน</span></h2>
				<div class="panel-toolbar">
					<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"><i class="fal fa-window-minimize"></i></button>
					<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"><i class="fal fa-expand"></i></button>
					<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"><i class="fal fa-times"></i></button>
				</div>
			</div>
			<div class="panel-container show">
				<form name="requisition_form" action="{{ route('sample.received.requisition.print') }}" method="POST">
					<input type="hidden" name="_token" value="{{ csrf_token() }}" />
					<div class="panel-content">
						<ul class="steps">
							<li class="undone"><a href="{{ route('sample.received.create') }}"><span class="d-none d-sm-inline">รายการคำขอ</span></a></li>
							<li class="undone"><p><span class="d-none d-sm-inline">รับตัวอย่าง</span></p></li>
							<li class="undone"><p><span class="d-none d-sm-inline">การตรวจวิเคราะห์</span></p></li>
							<li class="active"><p><span class="d-none d-sm-inline">รายงานผล</span></p></li>
						</ul>
						<h4>ออกรายงาน</h4>
						{{-- <form name="requisition_form" action="#" method="GET"> --}}
							<fieldset>
								<legend>ค้นหา</legend>
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-2">
										<div class="form-group">
											<label class="form-label" for="lab_no">Lab No.</label>
											<div class="input-group flex-nowrap">
												<input type="text" name="lab_no" class="form-control" id="lab_no" placeholder="Lab No." />
												<div class="input-group-append">
													<button type="button" class="btn btn-info" id="search_btn"><i class="fal fa-search"></i></button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</fieldset>
						{{-- </form> --}}
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mt-4">
								<div id="loader" class="text-center hidden">
									<span class="spinner-grow spinner-grow-sm text-danger" role="status" aria-hidden="true"></span>
									<span class="text-danger" style="line-height:16px;">กำลังโหลด...</span>
								</div>
								<div id="order_sample_table"></div>
							</div>
						</div>
					</div>
					<div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0">
						<a href="{{ route('sample.received.index') }}" class="btn btn-primary"><i class="fal fa-home"></i> กลับไปหน้าแรก</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div id="parcel_post_modal_wrapper"></div>
@endsection
@push('scripts')
<script type="text/javascript" src="{{ URL::asset('assets/js/formplugins/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {
	$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
	$('#search_btn').click(function() {
		$('#order_sample_table').html('');
		let lab_no = $('#lab_no').val();
		$.ajax({
			type: "POST",
			url: "{{ route('sample.received.report.create.ajax') }}",
			data: {lab_no: lab_no},
			dataType: "html",
			beforeSend: function() { $('#loader').removeClass('hidden')},
			success: function(res) { $('#order_sample_table').html(res)},
			complete: function() { $('#loader').addClass('hidden')},
			error: function(xhr, status, error) { console.log('Error code: ' + xhr.status + ':' + xhr.responseText)}
		});
	});
});
function parcelPost(lab_no) {
		$.ajax({
			method: "GET",
			url: "{{ route('sample.received.return.parcel.post.modal') }}",
			dataType: "html",
			data: {lab_no: lab_no},
			success: function(response) {
				$('#parcel_post_modal_wrapper').html(response);
				$('#pacel_post_modal').modal('show');
			},
			error: function(jqXhr, textStatus, errorMessage) {alert('Error: ' + jqXhr.status + errorMessage)}
		});
}
</script>
@endpush

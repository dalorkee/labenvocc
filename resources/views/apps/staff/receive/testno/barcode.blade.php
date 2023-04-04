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
	<li class="breadcrumb-item">พิมพ์บาร์โค้ด</li>
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
				<form name="setTestNofrm" action="{{ route('sample.received.test.no.barcode') }}" method="POST" enctype="multipart/form-data">
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
								<h5>พิมพ์บาร์โค้ด</h5>
								{{-- <div class="form-group mt-4">
									<label for="lbl">ค้นหา Lab No.</label>
									<div class="input-group">
										<input type="text" name="lab_no" class="form-control" placeholder="ค้นหา Lab No." />
										<div class="input-group-append">
											<button type="button" class="btn btn-info" id="find_test_no_btn"><i class="fal fa-search"></i></button>
										</div>
									</div>
								</div> --}}
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-4" id="abcdefg">
								<div class="table-responsive">
									<table class="table table-striped" style="width: 100%">
										<thead>
											<tr class="bg-primary text-white">
												<th>ลำดับ</th>
												<th>รหัส ตย.</th>
												<th>ชนิด ตย.</th>
												<th>รายการทดสอบ</th>
												<th>จำนวนรายการทดสอบ</th>
												<th>หมายเลขทดสอบ</th>
											</tr>
										</thead>
										<tfoot></tfoot>
										<tbody>
											@if (count($result) > 0)
												@foreach ($result as $key => $value)
													<tr>
														<td>{{ $loop->iteration}}</td>
														<td>
															{{ $value['sample_id'] }}
															<input type="hidden" name="sample_id[]" value="{{ $value['sample_id'] }}" />
														</td>
														<td>
														@foreach ($value['parameter_type'] as $key1 => $value1)
															<ul>
																<li>{{ $value1 }}</li>
															</ul>
														@endforeach
														<td>
														@foreach ($value['parameter_name'] as $key2 => $value2)
															<ul>
																<li>{{ $value2 }}</li>
															</ul>
														@endforeach
														</td>
														<td>{{ $value['sample_count'] }}</td>
														<td><input type="text" name="sample_no[]" value="{{ $value['sample_test_no'] }}" class="form-control" readonly /></td>
													</tr>
												@endforeach
											@endif
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>

					<div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0">
						<button type="submit" class="btn btn-warning"> <i class="fal fa-print"></i> พิมพ์บาร์โค้ด</button>
						<a href="{{ route('sample.received.index') }}" type="button" class="btn btn-primary"><i class="fal fa-home"></i> กลับไปหน้าแรก</a>
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
});
</script>
@endpush

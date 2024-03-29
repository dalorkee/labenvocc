@extends('layouts.index')
@section('token')<meta name="csrf-token" content="{{ csrf_token() }}">@endsection
@section('style')
<link type="text/css" rel="stylesheet" href="{{ URL::asset('vendor/bootstrap-table/dist/bootstrap-table.min.css') }}">
<link type="text/css" rel="stylesheet" href="{{ URL::asset('vendor/jquery-datatables-checkboxes/dataTables.checkboxes.css') }}">
<link type="text/css" rel="stylesheet" href="{{ URL::asset('assets/css/formplugins/select2/select2.bundle.css') }}">
<link type="text/css" rel="stylesheet" href="{{ URL::asset('css/pj-step.css') }}">
<style type="text/css">table#example_table thead {background-color:#2D8AC9;color: white;}</style>
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
				<h2><span class="text-primary"><i class="fal fa-th-list"></i>&nbsp;รายการตัวอย่าง</span></h2>
				<div class="panel-toolbar">
					<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"><i class="fal fa-window-minimize"></i></button>
					<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"><i class="fal fa-expand"></i></button>
					<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"><i class="fal fa-times"></i></button>
				</div>
			</div>
			<div class="panel-container show">
				<form name="received_step02_frm" action="{{ route('sample.received.step02.post') }}" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="id" value="{{ $order['id'] ?? old('id') }}">
					<input type="hidden" name="order_id" value="{{ $order['id'] ?? old('order_id') }}">
					<input type="hidden" name="order_no" value="{{ $order['order_no'] ?? old('order_no') }}">
					<input type="hidden" name="order_no_ref" value="{{ $order['order_no'] ?? old('order_no_ref') }}">
					<input type="hidden" name="order_type" value="{{ $order['order_type'] ?? old('order_type') }}">
					<input type="hidden" name="order_type_name" value="{{ $order['order_type_name'] ?? old('order_type_name') }}">
					<input type="hidden" name="result_count" value="{{ $result_count ?? 0 }}">
					<div class="panel-content">
						<ul class="steps">
							<li class="undone"><a href="{{ route('sample.received.create') }}"><span class="d-none d-sm-inline">รายการคำขอ</span></a></li>
							<li class="active"><p><span class="d-none d-sm-inline">รับตัวอย่าง</span></p></li>
							<li class="undone"><p><span class="d-none d-sm-inline">การตรวจวิเคราะห์</span></p></li>
							<li class="undone"><p><span class="d-none d-sm-inline">รายงานผล</span></p></li>
						</ul>
						<div class="row">
							<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
								<div class="tw-relative">
									<div class="row">
										<div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
											{{-- <table class="table-striped" id="table-1" data-toggle="table" data-show-columns="true"> --}}
											<table class="table table-striped">
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
														{{-- <th>หมายเหตุ</th> --}}
													</tr>
												</thead>
												<tfoot></tfoot>
												<tbody>
													@foreach ($result as $val)
														<tr>
															<td>{{ $loop->iteration}}</td>
															<td>
																<span>{{ $val['sample_id'] }}</span>
																<input type="hidden" name="sample_id[]" value="{{ $val['sample_id'] }}" />
																<input type="hidden" name="sample_id_{{ $val['sample_id'] }}" value="{{ $val['sample_id'] }}" />
															</td>
															<td>
																@foreach ($val['parameter_type'] as $key => $value)
																	<ul>
																		<li>{{ $value }}</li>
																	</ul>
																@endforeach
															</td>
															<td>
																@foreach ($val['parameter_name'] as $key => $value)
																	<ul>
																		<li>{{ $value }}</li>
																	</ul>
																@endforeach
															</td>
															<td>
																<span>{{ $val['sample_count'] }}</span>
																<input type="hidden" name="sample_count_{{ $val['sample_id'] }}" value="{{ $val['sample_count'] }}" />
															</td>
															<td>
																<div class="frame-wrap">
																		<div class="custom-control custom-switch">
																			<input type="radio" name="sample_verified_status_{{ $val['sample_id'] }}" value="complete"
																			{{ (!is_null($session_sample_result) && $session_sample_result[$val['sample_id']]['sample_verified_status_'.$val['sample_id']] == 'complete') ? 'checked' : '' }}
																			class="custom-control-input @error('sample_verified_status_'.$val['sample_id']) is-invalid @enderror" id="sample_chk_{{ $val['sample_id'] }}_y">
																			<label class="custom-control-label" for="sample_chk_{{ $val['sample_id'] }}_y">สมบูรณ์</label>
																		</div>
																		<div class="custom-control custom-switch mt-2">
																			<input type="radio" name="sample_verified_status_{{ $val['sample_id'] }}" value="reject"
																			{{ (!is_null($session_sample_result) && $session_sample_result[$val['sample_id']]['sample_verified_status_'.$val['sample_id']] == 'reject') ? 'checked' : '' }}
																			class="custom-control-input @error('sample_verified_status_'.$val['sample_id']) is-invalid @enderror" id="sample_chk_{{ $val['sample_id'] }}_n">
																			<label class="custom-control-label" for="sample_chk_{{ $val['sample_id'] }}_n">ไม่สมบูรณ์</label>
																		</div>
																</div>
															</td>
															<td>
																<select name="sample_received_status_{{ $val['sample_id'] }}" class="form-control w-100 @error('sample_received_status_'.$val['sample_id']) is-invalid @enderror" style="min-width: 100px;">
																	<option value="">- เลือก -</option>
																	<option value="y" {{ (!is_null($session_sample_result) && $session_sample_result[$val['sample_id']]['sample_received_status_'.$val['sample_id']] == 'y') ? 'selected' : '' }}>รับ</option>
																	<option value="n" {{ (!is_null($session_sample_result) && $session_sample_result[$val['sample_id']]['sample_received_status_'.$val['sample_id']] == 'n') ? 'selected' : '' }}>ปฏิเสธ</option>
																</select>
															</td>
															{{-- <td><button type="button" value="{{ $val['sample_id'] }}" class="btn btn-sm btn-warning sample_note">หมายเหตุ</button></td> --}}
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
					<div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0">
						<a href="{{ route('sample.received.step01', ['order_id' => $order['id']]) }}" class="btn btn-primary" style="width:110px"><i class="fal fa-arrow-alt-left"></i> ก่อนหน้า</a>
						<button type="submit" class="btn btn-primary" style="width:110px">ถัดไป <i class="fal fa-arrow-alt-right"></i></button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- Modal Sample Note -->
<div class="modal fade font-prompt" id="sample_note_modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">หมายเหตุ</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true"><i class="fal fa-times"></i></span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-row">
					<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
						<label class="form-label" for="sample_note_string">เนื่องจาก</label>
						<input type="text" name="sample_note_string" class="form-control" />
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
						<div class="input-group">
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="sample_note_file" aria-describedby="inputGroupFileAddon01">
								<label class="custom-file-label" for="inputGroupFile01">เลือกไฟล์</label>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
				<button type="button" class="btn btn-primary">บันทึก</button>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script type="text/javascript" src="{{ URL::asset('vendor/moment/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('vendor/bootstrap-table/dist/bootstrap-table.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('vendor/bootstrap-table/dist/locale/bootstrap-table-th-TH.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/formplugins/select2/select2.bundle.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/buttons.server-side.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {
	$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
	$('.select2').select2();
	$('.sample_note').on('click', function() {
		$('#sample_note_modal').modal('show');
	})
	$('#sample_note_file').on('change',function() {
		let fileName = $(this).val();
		$(this).next('.custom-file-label').html(fileName);
	})
});
</script>
@endpush

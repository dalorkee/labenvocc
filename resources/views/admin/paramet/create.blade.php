@extends('layouts.index')
@section('token')<meta name="csrf-token" content="{{ csrf_token() }}">@endsection
@section('style')
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/formplugins/select2/select2.bundle.css') }}">
@endsection
@section('content')
<ol class="breadcrumb page-breadcrumb text-sm font-prompt">
	<li class="breadcrumb-item"><a href="#">Admin</a></li>
	<li class="breadcrumb-item">Parameter Manage</li>
</ol>
<div class="row font-prompt">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
		<div id="panel-1" class="panel">
			<div class="panel-hdr">
				<h2>เพิ่มข้อมูลพารามิเตอร์</h2>
				<div class="panel-toolbar">
					<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"><i class="fal fa-window-minimize"></i></button>
					<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"><i class="fal fa-expand"></i></button>
					<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"><i class="fal fa-times"></i></button>
				</div>
			</div>
			<div class="panel-container show">
				<div class="panel-content">
					@if (Session::get('success'))
						<div class="alert alert-success">
							<p>{{ Session::get('success') }}</p>
						</div>
					@elseif (Session::get('error'))
						<div class="alert alert-danger">
							<p>{{ Session::get('error') }}</p>
						</div>
					@endif
					<form action="{{ route('advertise.store') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3">
								<div class="form-group">
									<label for="parameter_name">ชื่อพารามิเตอร์</label>
									<select name="parameter_name" class="select2 form-control" required>
										<option value="">--- เลือก ---</option>
										@foreach ($parameters as $paramet)
											<option value="{{$paramet->id}}">{{$paramet->parameter_name}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3">
								<div class="form-group">
									<label for="sample_character_name">ประเภทตัวอย่าง</label>
									<select name="sample_character_name" class="select2 form-control" required>
										<option value="">--- เลือก ---</option>
										<option value="1">A</option>
										<option value="2">B</option>
									</select>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3">
								<label for="sample_type_name">ประเภทใบคำขอ</label>
								<select name="sample_type_name" class="select2 form-control" required>
									<option value="">--- เลือก ---</option>
									<option value="1">A</option>
									<option value="2">B</option>
								</select>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3">
								<label for="threat_type_name">ประเภทมลพิษ</label>
								<select name="threat_type_name" class="select2 form-control" required>
									<option value="">--- เลือก ---</option>
									<option value="1">A</option>
									<option value="2">B</option>
								</select>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3">
								<div class="form-group">
									<label for="unit_name">หน่วย(env)</label>
									<select name="unit_name" class="select2 form-control" required>
										<option value="">--- เลือก ---</option>
										<option value="1">A</option>
										<option value="2">B</option>
									</select>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3">
								<div class="form-group">
									<label for="unit_customer_name">หน่วย(customer)</label>
									<select name="unit_customer_name" class="select2 form-control" required>
										<option value="">--- เลือก ---</option>
										<option value="1">A</option>
										<option value="2">B</option>
									</select>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3">
								<div class="form-group">
									<label for="unit_choice1_name">หน่วยทางเลือก1</label>
									<select name="unit_choice1_name" class="select2 form-control" required>
										<option value="">--- เลือก ---</option>
										<option value="1">A</option>
										<option value="2">B</option>
									</select>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3">
								<div class="form-group">
									<label for="unit_choice2_name">หน่วยทางเลือก2</label>
									<select name="unit_choice2_name" class="select2 form-control" required>
										<option value="">--- เลือก ---</option>
										<option value="1">A</option>
										<option value="2">B</option>
									</select>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3">
								<div class="form-group">
									<label for="price">ราคา</label>
									<input type="number" class="form-control" id="price" name="price" min="1" required>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3">
								<div class="form-group">
									<label for="main_analys">ผู้วิเคราะห์หลัก</label>
									<select name="main_analys" class="select2 form-control" required>
										<option value="">--- เลือก ---</option>
										<option value="1">A</option>
										<option value="2">B</option>
									</select>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3">
								<div class="form-group">
									<label for="sub_analys">ผู้วิเคราะห์รอง</label>
									<select name="sub_analys" class="select2 form-control" required>
										<option value="">--- เลือก ---</option>
										<option value="1">A</option>
										<option value="2">B</option>
									</select>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3">
								<div class="form-group">
                                    <label for="main_control">ผู้ควบคุมหลัก</label>
                                    <select name="main_control" class="select2 form-control" required>
                                        <option value="">--- เลือก ---</option>
                                        <option value="1">A</option>
                                        <option value="2">B</option>
                                    </select>
							    </div>
                            </div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3">
								<div class="form-group">
									<label for="sub_control">ผู้ควบคุมรอง</label>
									<select name="sub_control" class="select2 form-control" required>
										<option value="">--- เลือก ---</option>
										<option value="1">A</option>
										<option value="2">B</option>
									</select>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3">
								<div class="form-group">
									<label for="technic_name">เทคนิคการตรวจ</label>
									<select name="technic_name" class="select2 form-control" required>
										<option value="">--- เลือก ---</option>
										<option value="1">A</option>
										<option value="2">B</option>
									</select>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3">
								<div class="form-group">
									<label for="method_name">วิธีวิเคราะห์</label>
									<select name="method_name" class="select2 form-control" required>
										<option value="">--- เลือก ---</option>
										<option value="1">A</option>
										<option value="2">B</option>
									</select>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3">
								<div class="form-group">
									<label for="machine_name">เครื่องวิเคราะห์</label>
									<select name="machine_name" class="select2 form-control" required>
										<option value="">--- เลือก ---</option>
										<option value="1">A</option>
										<option value="2">B</option>
									</select>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3">
								<div class="form-group">
									<label for="office">หน่วยงาน</label>
									<select name="office" class="select2 form-control" required>
										<option value="">--- เลือก ---</option>
										<option value="1">A</option>
										<option value="2">B</option>
									</select>
								</div>
							</div>
                        </div>
                        <div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
								<div class="form-group">
									<button type="submit" class="btn btn-primary">Submit</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script type="text/javascript" src="{{ URL::asset('assets/js/formplugins/select2/select2.bundle.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {
	$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
	$(function() {
		$('.select2').select2();
	});
});
</script>
@endsection

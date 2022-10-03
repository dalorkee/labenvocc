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
					<form action="{{ route('paramet.store') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3">
								<div class="form-group">
									<label for="parameter_id">ชื่อพารามิเตอร์</label>
									<select name="parameter_id" class="select2 form-control" id="parameter_id" required>
										<option value="">--- เลือก ---</option>
										@foreach ($parameters as $paramet)
											<option value="{{$paramet->id}}">{{$paramet->parameter_name}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3">
								<div class="form-group">
									<label for="sample_character_id">ประเภทตัวอย่าง</label>
									<select name="sample_character_id" class="select2 form-control" id="sample_character_id" required>
										<option value="">--- เลือก ---</option>
										@foreach ($sample_characters as $sample_char)
											<option value="{{$sample_char->id}}">{{$sample_char->sample_character_name}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3">
								<label for="sample_type_id">ประเภทใบคำขอ</label>
								<select name="sample_type_id" class="select2 form-control" id="sample_type_id" required>
									<option value="">--- เลือก ---</option>
									<option value="1">ชีวภาพ</option>
									<option value="2">สิ่งแวดล้อม</option>
								</select>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3">
								<label for="threat_type_id">ประเภทมลพิษ</label>
								<select name="threat_type_id" class="select2 form-control" id="threat_type_id" required>
									<option value="">--- เลือก ---</option>
									@foreach ($threat_types as $threat_type)
											<option value="{{$threat_type->id}}">{{$threat_type->threat_type_name}}</option>
									@endforeach
								</select>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3">
								<div class="form-group">
									<label for="unit_id">หน่วย(env)</label>
									<select name="unit_id" class="select2 form-control" id="unit_id" required>
										<option value="">--- เลือก ---</option>
										@foreach ($units as $unit)
											<option value="{{$unit->id}}">{{$unit->unit_name}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3">
								<div class="form-group">
									<label for="unit_customer_id">หน่วย(customer)</label>
									<select name="unit_customer_id" class="select2 form-control" id="unit_customer_id" required>
										<option value="">--- เลือก ---</option>
										@foreach ($unit_customers as $unit_customer)
											<option value="{{$unit_customer->id}}">{{$unit_customer->unit_customer_name}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3">
								<div class="form-group">
									<label for="unit_choice1_id">หน่วยทางเลือก1</label>
									<select name="unit_choice1_id" class="select2 form-control" id="unit_choice1_id">
										<option value="">--- เลือก ---</option>
										@foreach ($unit_choice1 as $unit_choice_1)
											<option value="{{$unit_choice_1->id}}">{{$unit_choice_1->unit_choice1_name}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3">
								<div class="form-group">
									<label for="unit_choice2_id">หน่วยทางเลือก2</label>
									<select name="unit_choice2_id" class="select2 form-control" id="unit_choice2_id">
										<option value="">--- เลือก ---</option>
										<option value="1">ppm</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3">
								<div class="form-group">
									<label for="price_id">ราคา</label>
									<select name="price_id" class="select2 form-control" id="price_id" required>
										<option value="">--- เลือก ---</option>
										@foreach ($prices as $price)
											<option value="{{$price->id}}">{{$price->price_name}}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3">
								<div class="form-group">
									<label for="main_analys_id">ผู้วิเคราะห์หลัก</label>
									<select name="main_analys_id" class="select2 form-control" id="main_analys_id" required>
										<option value="">--- เลือก ---</option>
										@foreach ($user_stuffs as $user_stuff)
											<option value="{{$user_stuff->user_id}}">{{$user_stuff->first_name}} {{ $user_stuff->last_name }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3">
								<div class="form-group">
									<label for="sub_analys_id">ผู้วิเคราะห์รอง</label>
									<select name="sub_analys_id" class="select2 form-control" id="sub_analys_id">
										<option value="">--- เลือก ---</option>
										@foreach ($user_stuffs as $user_stuff)
											<option value="{{$user_stuff->user_id}}">{{$user_stuff->first_name}} {{ $user_stuff->last_name }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3">
								<div class="form-group">
                                    <label for="main_control_id">ผู้ควบคุมหลัก</label>
                                    <select name="main_control_id" class="select2 form-control" id="main_control_id" required>
                                        <option value="">--- เลือก ---</option>
                                        @foreach ($user_stuffs as $user_stuff)
											<option value="{{$user_stuff->user_id}}">{{$user_stuff->first_name}} {{ $user_stuff->last_name }}</option>
										@endforeach
                                    </select>
							    </div>
                            </div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3">
								<div class="form-group">
									<label for="sub_control_id">ผู้ควบคุมรอง</label>
									<select name="sub_control_id" class="select2 form-control" id="sub_control_id">
										<option value="">--- เลือก ---</option>
										@foreach ($user_stuffs as $user_stuff)
											<option value="{{$user_stuff->user_id}}">{{$user_stuff->first_name}} {{ $user_stuff->last_name }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3">
								<div class="form-group">
									<label for="technic_id">เทคนิคการตรวจ</label>
									<select name="technic_id" class="select2 form-control" id="technic_id">
										<option value="">--- เลือก ---</option>
										@foreach ($technicals as $technical)
											<option value="{{$technical->id}}">{{$technical->technic_name}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3">
								<div class="form-group">
									<label for="method_id">วิธีวิเคราะห์</label>
									<select name="method_id" class="select2 form-control" id="method_id">
										<option value="">--- เลือก ---</option>
										@foreach ($method_analys as $method_analysis)
											<option value="{{$method_analysis->id}}">{{$method_analysis->method_name}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3">
								<div class="form-group">
									<label for="machine_id">เครื่องวิเคราะห์</label>
									<select name="machine_id" class="select2 form-control" id="machine_id">
										<option value="">--- เลือก ---</option>
										@foreach ($machines as $machine)
											<option value="{{$machine->id}}">{{$machine->machine_name}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3">
								<div class="form-group">
									<label for="office_id">หน่วยงาน</label>
									<select name="office_id" class="select2 form-control" id="office_id" required>
										<option value="">--- เลือก ---</option>
										<option value="130">ศูนย์อ้างอิงทางห้องปฏิบัติการและพิษวิทยา</option>
										<option value="131">ห้องปฏิบัติการ ศูนย์พัฒนาวิชาการอาชีวอนามัยและสิ่งแวดล้อม จังหวัดระยอง</option>
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
		$('.select2').select2({

		});
	});
});
</script>
@endsection

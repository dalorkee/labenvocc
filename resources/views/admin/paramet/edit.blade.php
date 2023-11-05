@extends('layouts.index')
@section('style')
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/formplugins/select2/select2.bundle.css') }}">
@endsection
@section('content')
<ol class="breadcrumb page-breadcrumb">
	<li class="breadcrumb-item"><a href="javascript:void(0);">Admin</a></li>
	<li class="breadcrumb-item">Parameter Manage</li>
</ol>
<div class="subheader">
	<h1 class="subheader-title"><small>แก้ไขข้อมูลพารามิเตอร์</small></h1>
</div>
@if (Session::get('success'))
	<div class="alert alert-success">
		<p>{{ Session::get('success') }}</p>
	</div>
@elseif (Session::get('error'))
	<div class="alert alert-danger">
		<p>{{ Session::get('error') }}</p>
	</div>
@endif
<div class="fs-lg fw-300 p-5 bg-white border-faded rounded mb-g">
	<div class="frame-wrap">
		<form action="{{ route('paramet.update', $z_parameter['id']) }}" method="POST">
		@csrf
		@method('PUT')
			<div class="form-row">
				<div class="col-md-6 mb-3">
					<label class="form-label" for="z_parameter_id">Id</label>
					<input type="text" class="form-control" id="z_parameter_id" name="z_parameter_id" value="{{ $z_parameter['id'] }}" readonly>
				</div>
			</div>
			<div class="form-row">
				<div class="col-md-6 mb-3">
					<label for="parameter_id">ชื่อพารามิเตอร์</label>
					<select name="parameter_id" class="select2 form-control" id="parameter_id">
						<option value="{{ $z_parameter['parameter_id'] }}">{{ $z_parameter['parameter_name'] }}</option>	
						<option value="">--- เลือก ---</option>						
					@foreach ($parameters as $parameter)
						<option value="{{ $parameter->id }}">{{ $parameter->parameter_name }}</option>
					@endforeach
					</select>
				</div>
				<div class="col-md-6 mb-3">
					<label for="sample_character_id">ประเภทตัวอย่าง</label>
					<select name="sample_character_id" class="select2 form-control" id="sample_character_id">
						<option value="{{ $z_parameter['sample_character_type_id'] }}">{{ $z_parameter['sample_character_name'] }}</option>		
						<option value="">--- เลือก ---</option>
					@foreach ($sample_characters as $sample_character)
						<option value="{{$sample_character->id}}">{{$sample_character->sample_character_name}}</option>
					@endforeach
					</select>
				</div>
			</div>
			<div class="form-row">
				<div class="col-md-6 mb-3">
					<label for="sample_type_id">ประเภทใบคำขอ</label>
					<select name="sample_type_id" class="select2 form-control" id="sample_type_id">
						<option value="{{ $z_parameter['sample_type_id'] }}">{{ $z_parameter['sample_type_name'] }}</option>		
						<option value="">--- เลือก ---</option>
						<option value="1">ชีวภาพ</option>
						<option value="2">สิ่งแวดล้อม</option>
					</select>
				</div>
				<div class="col-md-6 mb-3">
					<label for="threat_type_id">ประเภทมลพิษ</label>
					<select name="threat_type_id" class="select2 form-control" id="threat_type_id">
						<option value="{{ $z_parameter['threat_type_id'] }}">{{ $z_parameter['threat_type_name'] }}</option>		
						<option value="">--- เลือก ---</option>
					@foreach ($threat_types as $threat_type)
						<option value="{{$threat_type->id}}">{{$threat_type->threat_type_name}}</option>
					@endforeach
					</select>
				</div>
			</div>
			<div class="form-row">
				<div class="col-md-6 mb-3">
					<label for="unit_id">หน่วย(env)</label>
					<select name="unit_id" class="select2 form-control" id="unit_id" required>
						<option value="{{ $z_parameter['unit_id'] }}">{{ $z_parameter['unit_name'] }}</option>		
						<option value="">--- เลือก ---</option>
					@foreach ($units as $unit)
						<option value="{{$unit->id}}">{{$unit->unit_name}}</option>
					@endforeach
					</select>
				</div>
				<div class="col-md-6 mb-3">
					<label for="unit_customer_id">หน่วย(customer)</label>
					<select name="unit_customer_id" class="select2 form-control" id="unit_customer_id">
						<option value="{{ $z_parameter['unit_customer_id'] }}">{{ $z_parameter['unit_customer_name'] }}</option>		
						<option value="">--- เลือก ---</option>
					@foreach ($unit_customers as $unit_customer)
						<option value="{{$unit_customer->id}}">{{$unit_customer->unit_customer_name}}</option>
					@endforeach
					</select>
				</div>
			</div>
			<div class="form-row">
				<div class="col-md-6 mb-3">
					<label for="unit_choice1_id">หน่วยทางเลือก1</label>
					<select name="unit_choice1_id" class="select2 form-control" id="unit_choice1_id">
						<option value="{{ $z_parameter['unit_choice1_id'] }}">{{ $z_parameter['unit_choice1_name'] }}</option>
						<option value="">--- เลือก ---</option>
					@foreach ($unit_choice1 as $unit_choice_1)
						<option value="{{$unit_choice_1->id}}">{{$unit_choice_1->unit_choice1_name}}</option>
					@endforeach
					</select>
				</div>
				<div class="col-md-6 mb-3">
					<label for="unit_choice2_id">หน่วยทางเลือก2</label>
					<select name="unit_choice2_id" class="select2 form-control" id="unit_choice2_id">
						<option value="{{ $z_parameter['unit_choice2_id'] }}">{{ $z_parameter['unit_choice2_name'] }}</option>
						<option value="">--- เลือก ---</option>
						<option value="1">ppm</option>
					</select>
				</div>
			</div>
			<div class="form-row">
				<div class="col-md-6 mb-3">
					<label for="price_id">ราคา</label>
					<select name="price_id" class="select2 form-control" id="price_id">
						<option value="{{ $z_parameter['price_id'] }}">{{ $z_parameter['price_name'] }}</option>
						<option value="">--- เลือก ---</option>
					@foreach ($prices as $price)
						<option value="{{$price->id}}">{{$price->price_name}}</option>
					@endforeach
					</select>
				</div>
			</div>
			<div class="form-row">
				<div class="col-md-6 mb-3">
					<label for="main_analys_id">ผู้วิเคราะห์หลัก</label>
					<select name="main_analys_id" class="select2 form-control" id="main_analys_id">
						<option value="{{ $z_parameter['main_analys_user_id'] }}">{{ $z_parameter['main_analys'] }}</option>
						<option value="">--- เลือก ---</option>
					@foreach ($user_stuffs as $user_stuff)
						<option value="{{$user_stuff->user_id}}">{{$user_stuff->first_name}} {{ $user_stuff->last_name }}</option>
					@endforeach
					</select>
				</div>
				<div class="col-md-6 mb-3">
					<label for="sub_analys_id">ผู้วิเคราะห์รอง</label>
					<select name="sub_analys_id" class="select2 form-control" id="sub_analys_id">
						<option value="{{ $z_parameter['sub_analys_user_id'] }}">{{ $z_parameter['sub_analys'] }}</option>
						<option value="">--- เลือก ---</option>
					@foreach ($user_stuffs as $user_stuff)
						<option value="{{$user_stuff->user_id}}">{{$user_stuff->first_name}} {{ $user_stuff->last_name }}</option>
					@endforeach
					</select>
				</div>
			</div>
			<div class="form-row">
				<div class="col-md-6 mb-3">
					<label for="main_control_id">ผู้ควบคุมหลัก</label>
                    <select name="main_control_id" class="select2 form-control" id="main_control_id">
						<option value="{{ $z_parameter['main_control_user_id'] }}">{{ $z_parameter['main_control'] }}</option>
                        <option value="">--- เลือก ---</option>
                    @foreach ($user_stuffs as $user_stuff)
						<option value="{{$user_stuff->user_id}}">{{$user_stuff->first_name}} {{ $user_stuff->last_name }}</option>
					@endforeach
                    </select>
				</div>
				<div class="col-md-6 mb-3">
					<label for="sub_control_id">ผู้ควบคุมรอง</label>
					<select name="sub_control_id" class="select2 form-control" id="sub_control_id">
						<option value="{{ $z_parameter['sub_control_user_id'] }}">{{ $z_parameter['sub_control'] }}</option>
						<option value="">--- เลือก ---</option>
					@foreach ($user_stuffs as $user_stuff)
						<option value="{{$user_stuff->user_id}}">{{$user_stuff->first_name}} {{ $user_stuff->last_name }}</option>
					@endforeach
					</select>
				</div>
			</div>
			<div class="form-row">
				<div class="col-md-6 mb-3">
					<label for="technic_id">เทคนิคการตรวจ</label>
					<select name="technic_id" class="select2 form-control" id="technic_id">
						<option value="{{ $z_parameter['technic_id'] }}">{{ $z_parameter['technic_name'] }}</option>
						<option value="">--- เลือก ---</option>
					@foreach ($technicals as $technical)
						<option value="{{$technical->id}}">{{$technical->technic_name}}</option>
					@endforeach
					</select>
				</div>
				<div class="col-md-6 mb-3">
					<label for="method_id">วิธีวิเคราะห์</label>
					<select name="method_id" class="select2 form-control" id="method_id">
						<option value="{{ $z_parameter['method_analys_id'] }}">{{ $z_parameter['method_name'] }}</option>
						<option value="">--- เลือก ---</option>
					@foreach ($method_analys as $method_analysis)
						<option value="{{$method_analysis->id}}">{{$method_analysis->method_name}}</option>
					@endforeach
					</select>
				</div>
			</div>
			<div class="form-row">
				<div class="col-md-6 mb-3">
					<label for="machine_id">เครื่องวิเคราะห์</label>
					<select name="machine_id" class="select2 form-control" id="machine_id">
						<option value="{{ $z_parameter['machine_id'] }}">{{ $z_parameter['machine_name'] }}</option>
						<option value="">--- เลือก ---</option>
					@foreach ($machines as $machine)
						<option value="{{$machine->id}}">{{$machine->machine_name}}</option>
					@endforeach
					</select>
				</div>
				<div class="col-md-6 mb-3">
					<label for="office_id">หน่วยงาน</label>
					<select name="office_id" class="select2 form-control" id="office_id">
						<option value="{{ $z_parameter['office_id'] }}">{{ $z_parameter['office_name'] }}</option>
						<option value="">--- เลือก ---</option>
						<option value="130">ศูนย์อ้างอิงทางห้องปฏิบัติการและพิษวิทยา</option>
						<option value="131">ห้องปฏิบัติการ ศูนย์พัฒนาวิชาการอาชีวอนามัยและสิ่งแวดล้อม จังหวัดระยอง</option>
					</select>
				</div>
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
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

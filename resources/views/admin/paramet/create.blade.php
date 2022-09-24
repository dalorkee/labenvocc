@extends('layouts.index')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('vendor/selectpicker/css/bootstrap-select.min.css') }}">
<style type="text/css">
.bootstrap-select {width: 100%; margin: 0; padding: 0; color: red}
</style>
@endsection
@section('content')
<ol class="breadcrumb page-breadcrumb">
	<li class="breadcrumb-item"><a href="javascript:void(0);">Admin</a></li>
	<li class="breadcrumb-item">Parameter Manage</li>
</ol>
<div class="subheader">
	<h1 class="subheader-title"><small>เพิ่มข้อมูลพารามิเตอร์</small></h1>
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
		<form action="{{ route('advertise.store') }}" method="POST">
		@csrf
			<div class="row">
				<div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for="parameter_name">ชื่อพารามิเตอร์</label>
                        <select name="parameter_name" class="form-control" required>
                            <option value="">---เลือก---</option>
                            @foreach ($parameters as $paramet)
                                <option style="" value="{{$paramet->id}}">{{$paramet->parameter_name}}</option>
                            @endforeach
                        </select>
                    </div>
				</div>
				<div class="col-md-6 mb-3">
                    <div class="form-group">
					    <label for="sample_character_name">ประเภทตัวอย่าง</label>
                        <select name="sample_character_name" class="form-control" required>
                            <option value="">---เลือก---</option>
                            <option value="1">A</option>
                            <option value="2">B</option>
                        </select>
                    </div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-md-6 mb-3">
					<label class="form-label" for="sample_type_name">ประเภทใบคำขอ</label>
                    <select class="custom-select" name="sample_type_name" required>
						<option value="">---เลือก---</option>
						<option value="1">A</option>
						<option value="2">B</option>
					</select>
				</div>
                <div class="col-md-6 mb-3">
					<label class="form-label" for="threat_type_name">ประเภทมลพิษ</label>
					<select class="custom-select" name="threat_type_name" required>
						<option value="">---เลือก---</option>
						<option value="1">A</option>
						<option value="2">B</option>
					</select>
				</div>
			</div>
            <div class="form-row">
				<div class="col-md-6 mb-3">
					<label class="form-label" for="unit_name">หน่วย(env)</label>
					<select class="custom-select" name="unit_name" required>
						<option value="">---เลือก---</option>
						<option value="1">A</option>
						<option value="2">B</option>
					</select>
				</div>
                <div class="col-md-6 mb-3">
					<label class="form-label" for="unit_customer_name">หน่วย(customer)</label>
					<select class="custom-select" name="unit_customer_name" required>
						<option value="">---เลือก---</option>
						<option value="1">A</option>
						<option value="2">B</option>
					</select>
				</div>
			</div>
            <div class="form-row">
				<div class="col-md-6 mb-3">
					<label class="form-label" for="unit_choice1_name">หน่วยทางเลือก1</label>
					<select class="custom-select" name="unit_choice1_name" required>
						<option value="">---เลือก---</option>
						<option value="1">A</option>
						<option value="2">B</option>
					</select>
				</div>
                <div class="col-md-6 mb-3">
					<label class="form-label" for="unit_choice2_name">หน่วยทางเลือก2</label>
					<select class="custom-select" name="unit_choice2_name" required>
						<option value="">---เลือก---</option>
						<option value="1">A</option>
						<option value="2">B</option>
					</select>
				</div>
			</div>
            <div class="form-row">
				<div class="col-md-6 mb-3">
					<label class="form-label" for="price">ราคา</label>
					<input type="number" class="form-control" id="price" name="price" min="1" required>
				</div>
			</div>
            <div class="form-row">
				<div class="col-md-6 mb-3">
					<label class="form-label" for="main_analys">ผู้วิเคราะห์หลัก</label>
					<select class="custom-select" name="main_analys" required>
						<option value="">---เลือก---</option>
						<option value="1">A</option>
						<option value="2">B</option>
					</select>
				</div>
                <div class="col-md-6 mb-3">
					<label class="form-label" for="sub_analys">ผู้วิเคราะห์รอง</label>
					<select class="custom-select" name="sub_analys" required>
						<option value="">---เลือก---</option>
						<option value="1">A</option>
						<option value="2">B</option>
					</select>
				</div>
			</div>
            <div class="form-row">
				<div class="col-md-6 mb-3">
					<label class="form-label" for="main_control">ผู้ควบคุมหลัก</label>
					<select class="custom-select" name="main_control" required>
						<option value="">---เลือก---</option>
						<option value="1">A</option>
						<option value="2">B</option>
					</select>
				</div>
                <div class="col-md-6 mb-3">
					<label class="form-label" for="sub_control">ผู้ควบคุมรอง</label>
					<select class="custom-select" name="sub_control" required>
						<option value="">---เลือก---</option>
						<option value="1">A</option>
						<option value="2">B</option>
					</select>
				</div>
			</div>
            <div class="form-row">
				<div class="col-md-6 mb-3">
					<label class="form-label" for="technic_name">เทคนิคการตรวจ</label>
					<select class="custom-select" name="technic_name" required>
						<option value="">---เลือก---</option>
						<option value="1">A</option>
						<option value="2">B</option>
					</select>
				</div>
                <div class="col-md-6 mb-3">
					<label class="form-label" for="method_name">วิธีวิเคราะห์</label>
					<select class="custom-select" name="method_name" required>
						<option value="">---เลือก---</option>
						<option value="1">A</option>
						<option value="2">B</option>
					</select>
				</div>
			</div>
            <div class="form-row">
				<div class="col-md-6 mb-3">
					<label class="form-label" for="machine_name">เครื่องวิเคราะห์</label>
					<select class="custom-select" name="machine_name" required>
						<option value="">---เลือก---</option>
						<option value="1">A</option>
						<option value="2">B</option>
					</select>
				</div>
                <div class="col-md-6 mb-3">
					<label class="form-label" for="office">หน่วยงาน</label>
					<select class="custom-select" name="office" required>
						<option value="">---เลือก---</option>
						<option value="1">A</option>
						<option value="2">B</option>
					</select>
				</div>
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
</div>
@endsection
@section('script')
<script type="text/javascript" src="{{ URL::asset('vendor/selectpicker/js/bootstrap-select.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('vendor/popper/umd/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('vendor/jquery/jquery-3.2.1.slim.min.js') }}"></script>
<script>
$(function () {
    $('select').selectpicker({
        size: 4
    });
});
</script>
@endsection

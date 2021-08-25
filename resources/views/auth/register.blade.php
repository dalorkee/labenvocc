@extends('layouts.guest.index')
@section('meta-token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('style')
<link href="{{ URL::asset('assets/css/ionicons.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/multi_step_form.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/css/formplugins/select2/select2.bundle.css') }}" rel="stylesheet">
<style type="text/css">
.select2{width:100%!important;}
.select2-selection{overflow:hidden;}
.select2-selection__rendered{white-space:normal;word-break:break-all;}
.select2-selection__rendered{line-height:39px!important;}
.select2-container .select2-selection--single{height:38px!important;border:1px solid #cccccc;border-radius:0;}
.select2-selection__arrow{height:37px!important;}
.custom-control-label{font-size: 1.175em;}
.title {text-align: center;padding-bottom: 10px;}
.title h1, .form-title-label{font: 400 24px/28px "cs_chatthaiuiregular";color: #01937C;padding-bottom: 5px;}
.title p{font: 400 18px/24px "cs_chatthaiuiregular";color: #01937C;}
.panel-hdr h2{font-size: 1.275em;color: #1abc9c;}
fieldset h2{font-size: 1em;font-weight: 400;}
.form-label, .custom-control-label{font-size: 1em;font-weight: 400;}
::-webkit-input-placeholder{ /* Edge */font-size: 1em;}
:-ms-input-placeholder{ /* IE 10-11 */font-size: 1em;}
::placeholder{font-size: 1em;}
.captcha img{border: 1px solid blue;}
input[type="text"]:disabled{background: #eeeeee !important;}
</style>
@endsection
@section('content')
<div class="row mt-10">
	<div class="col-xl-6">
		<div id="regis-title" class="title">
			<h1>ลงทะเบียน ผู้รับบริการ</h1>
			<p>โปรดกรอกข้อมูลและตรวจสอบให้ถูกต้อง</p>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xl-6">
		<section class="multi_step_form">
			<form action="{{ route('register.store') }}" method="POST" id="msform">
				@csrf
				<ul id="progressbar" class="pb-2">
					<li class="active">ข้อมูลหน่วยงาน</li>
					<li>ข้อมูลผู้รับบริการ</li>
					<li>ข้อมูลติดต่อ</li>
					<li>บัญชีผู้ใช้</li>
				</ul>
				<fieldset>
					<div id="panel-1" class="panel">
						<div class="panel-hdr">
							<h2 class="text-green-400"><i class="fal fa-clipboard"></i>&nbsp;&nbsp;ข้อมูลหน่วยงาน</h2>
							<div class="panel-toolbar">
								<button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
							</div>
						</div>
						<div class="panel-container show">
							<div class="panel-content">
								<h2 class="text-green-600">1. ข้อมูลทั่วไปของผู้รับบริการ</h2>
								<div class="mt-0 sm:mt-0">
									<div class="md:grid md:grid-cols-1">
										<div class="mt-2 md:mt-0 md:col-span-2">
											<div class="overflow-hidden">
												<div class="px-6 pt-5 pb-16">
													<div class="grid grid-cols-6 gap-6">
														<div class="col-span-6 sm:col-span-3 mb-4">
															<label for="office_category" class="block text-base font-medium text-gray-800">1.1 ประเภทหน่วยงาน <span class="text-red-600">*</span></label>
															<div class="frame-wrap">
																@foreach ($agency_type as $key => $value)
																<div class="custom-control custom-checkbox custom-control-inline">
																	<input type="checkbox" name="office_category" value="{{ $key }}" id="{{ $key }}" class="custom-control-input" @if (old('office_category') == $key) checked @endif>
																	<label class="custom-control-label" for="{{ $key }}">{{ $value }}</label>
																</div>
																@endforeach
															</div>
														</div>
													</div>
													<div class="grid grid-cols-6 gap-6 mt-4">
														<div class="col-span-6 sm:col-span-6">
															<label for="office_type" class="block text-base font-medium text-gray-800">1.2 ชนิดหน่วยงาน (เลือกได้ 1 ชนิดเท่านั้น) <span class="text-red-600">*</span></label>
															<div class="frame-wrap">
																<div class="custom-control custom-switch custom-control-inline">
																	<input type="checkbox" name="office_type" value="1" id="agency_type_establishment" class="custom-control-input agency_type" @if (old('office_type') == "1") checked @endif>
																	<label class="custom-control-label" for="agency_type_establishment">สถานประกอบการ <span class="text-red-600">*</span></label>
																</div>
															</div>
														</div>
														<div class="col-span-6 sm:col-span-3 md:ml-4">
															<label for="office_name_establishment" class="block text-base font-medium text-gray-700">ชื่อสถานประกอบการ <span class="text-red-600">*</span></label>
															<input type="text" name="office_name_establishment" value="{{ old('office_name_establishment') }}" id="office_name_establishment" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-md sm:text-sm border-gray-300" {{ (old('office_type') == '1') ? '' : 'disabled' }}>
														</div>
														<div class="col-span-6 sm:col-span-3 md:mr-4">
															<label for="office_code_establishment" class="block text-base font-medium text-gray-700">รหัสสถานประกอบการ <span class="text-red-600">*</span></label>
															<input type="text" name="office_code_establishment" value="{{ old('office_code_establishment') }}" id="office_code_establishment" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-md sm:text-sm border-gray-300" {{ (old('office_type') == '1') ? '' : 'disabled' }}>
														</div>
														<div class="col-span-6 sm:col-span-6">
															<div class="frame-wrap">
																<div class="custom-control custom-switch custom-control-inline">
																	<input type="checkbox" name="office_type" value="2" id="agency_type_hospital" class="custom-control-input agency_type" @if (old('office_type') == "2") checked @endif>
																	<label class="custom-control-label" for="agency_type_hospital">สถานพยาบาล</label>
																</div>
															</div>
														</div>
														<div class="col-span-6 sm:col-span-6 md:mx-4">
															<label for="health_place_code" class="block text-base font-medium text-gray-700">เลือกสถานพยาบาล <span class="text-red-600">*</span></label>
															<select name="health_place_code" data-placeholder="โปรดกรอกข้อความค้นหา" id="hosp_search" class="mt-1 block w-full py-2 px-3 border border-gray-400 bg-white shadow-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" disabled>
															</select>
														</div>
														<div class="col-span-6 sm:col-span-6">
															<div class="frame-wrap">
																<div class="custom-control custom-switch custom-control-inline">
																	<input type="checkbox" name="office_type" value="3" id="agency_type_border_check_point" class="custom-control-input agency_type" @if (old('office_type') == "3") checked @endif>
																	<label class="custom-control-label" for="agency_type_border_check_point">ด่านควบคุมโรค </label>
																</div>
															</div>
														</div>
														<div class="col-span-6 sm:col-span-6 md:mx-4">
															<label for="border_check_point_id" class="block text-base font-medium text-gray-700">เลือกด่านควบคุมโรค <span class="text-red-600">*</span></label>
															<select name="border_check_point_code" data-placeholder="โปรดกรอกข้อความค้นหา" id="disease_border_search" class="mt-1 block w-full py-2 px-3 border border-gray-800 bg-white shadow-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" disabled>
															</select>
														</div>
														<div class="col-span-6 sm:col-span-6">
															<div class="frame-wrap">
																<div class="custom-control custom-switch custom-control-inline">
																	<input type="checkbox" name="office_type" value="4" id="agency_type_other" class="custom-control-input agency_type" @if (old('office_type') == "4") checked @endif>
																	<label class="custom-control-label" for="agency_type_other">อื่นๆ โปรดระบุ</label>
																</div>
															</div>
														</div>
														<div class="col-span-6 sm:col-span-3 md:mx-4">
															<label for="office_type_other_name" class="block text-base font-medium text-gray-700">ชื่อหน่วยงาน <span class="text-red-600">*</span></label>
															<input type="text" name="office_type_other_name" value="{{ old('agency_type_other_name') }}" id="agency_type_other_name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-md sm:text-sm border-gray-300" {{ (old('office_type') == '4') ? '' : 'disabled' }}>
														</div>
														<div class="col-span-6 sm:col-span-3 md:mx-4">
															<label for="office_type_other_code" class="block text-base font-medium text-gray-700">รหัสหน่วยงาน <span class="text-red-600">*</span></label>
															<input type="text" name="office_type_other_code" value="{{ old('agency_type_other_code') }}" id="agency_type_other_id" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-md sm:text-sm border-gray-300" {{ (old('office_type') == '4') ? '' : 'disabled' }}>
														</div>
													</div>
													<div class="grid grid-cols-6 gap-6 mt-12">
														<div class="col-span-6 sm:col-span-6">
															<label for="taxpayer_no" class="block text-base font-medium text-gray-800l">1.3 หมายเลขผู้เสียภาษี <span class="text-red-600">*</span></label>
															<input type="text" name="office_taxpayer_no" value="{{ old('office_taxpayer_no') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-md sm:text-sm border-gray-300">
														</div>
														<div class="col-span-6 sm:col-span-6">
															<label for="address" class="block text-base font-medium text-gray-800">1.4 ที่อยู่ (เลขที่ หมู่ที่ ถนน หมู่บ้าน/อาคาร) <span class="text-red-600">*</span></label>
															<input type="text" name="office_address" value="{{ old('office_address') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-md sm:text-sm border-gray-300">
														</div>
														<div class="col-span-6 sm:col-span-3">
															<label for="province" class="block text-base font-medium text-gray-800">1.5 จังหวัด <span class="text-red-600">*</span></label>
															<select name="office_province" id="province" class="select2-placeholder mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
																<option value="">-- โปรดเลือก --</option>
																@foreach ($provinces as $key => $val)
																	<option value="{{ $key }}">{{ $val }}</option>
																@endforeach
															</select>
														</div>
														<div class="col-span-6 sm:col-span-3">
															<label for="district" class="block text-base font-medium text-gray-800">1.6 เขต/อำเภอ <span class="text-red-600">*</span></label>
															<select name="office_district" id="district" class="select2-placeholder mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
																<option value="">-- โปรดเลือก --</option>
															</select>
														</div>
														<div class="col-span-6 sm:col-span-3">
															<label for="sub_district" class="block text-base font-medium text-gray-800">1.7 แขวง/ตำบล <span class="text-red-600">*</span></label>
															<select name="office_sub_district" id="sub_district" class="select2-placeholder form-control mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
																<option>-- โปรดเลือก --</option>
															</select>
														</div>
														<div class="col-span-6 sm:col-span-3">
															<label for="zip_code" class="block text-base font-medium text-gray-800">1.8 รหัสไปรษณีย์ <span class="text-red-600">*</span></label>
															<input type="text" name="office_postal" value="{{ old('office_postal') }}" id="postcode" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-200">
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<button type="button" class="previous btn btn-secondary btn-pills" disabled>ก่อนหน้า</button>
					<button type="button" class="next btn btn-info btn-pills">ถัดไป</button>
				</fieldset>
				<fieldset>
					<div id="panel-2" class="panel">
						<div class="panel-hdr">
							<h2 class="text-green-900"><i class="fal fa-clipboard"></i>&nbsp;&nbsp;ข้อมูลผู้รับบริการ</h2>
							<div class="panel-toolbar">
								<button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
							</div>
						</div>
						<div class="panel-container show">
							<div class="panel-content">
								<h2 class="text-green-700">2. ข้อมูลผู้รับบริการ</h2>
								<div class="mt-0 sm:mt-0">
									<div class="md:grid md:grid-cols-1">
										<div class="mt-2 md:mt-0 md:col-span-2">
											<div class="overflow-hidden">
												<div class="px-6 pt-5 pb-16">
													<div class="grid grid-cols-6 gap-6">
														<div class="col-span-6 sm:col-span-6">
															<label for="title_name" class="block text-base font-medium text-gray-800">2.1 คำนำหน้าชื่อ <span class="text-red-600">*</span></label>
															<div class="frame-wrap">
																<div class="custom-control custom-checkbox custom-control-inline">
																	<input type="checkbox" name="title_name" value="mr" id="mister" class="custom-control-input" @if (old('title_name') == "mr") checked @endif>
																	<label class="custom-control-label" for="mister">นาย</label>
																</div>
																<div class="custom-control custom-checkbox custom-control-inline">
																	<input type="checkbox" name="title_name" value="mrs" id="mistress" class="custom-control-input" @if (old('title_name') == "mrs") checked @endif>
																	<label class="custom-control-label" for="mistress">นาง</label>
																</div>
																<div class="custom-control custom-checkbox custom-control-inline">
																	<input type="checkbox" name="title_name" value="miss" id="miss" class="custom-control-input" @if (old('title_name') == "miss") checked @endif>
																	<label class="custom-control-label" for="miss">นางสาว</label>
																</div>
															</div>
														</div>
														<div class="col-span-6 sm:col-span-3">
															<label for="first_name" class="block text-base font-medium text-gray-800">2.2 ชื่อจริง <span class="text-red-600">*</span></label>
															<input type="text" name="first_name" value="{{ old('first_name') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-md sm:text-sm border-gray-300">
														</div>
														<div class="col-span-6 sm:col-span-3">
															<label for="last_name" class="block text-base font-medium text-gray-800">2.3 นามสกุล <span class="text-red-600">*</span></label>
															<input type="text" name="last_name" value="{{ old('last_name') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-md sm:text-sm border-gray-300">
														</div>
														<div class="col-span-6 sm:col-span-6">
															<label for="position" class="block text-base font-medium text-gray-800">2.4 ตำแหน่ง <span class="text-red-600">*</span></label>
															<input type="text" name="position" value="{{ old('position') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-md sm:text-sm border-gray-300">
														</div>
														{{-- <div class="col-span-6 sm:col-span-3">
															<label for="position" class="block text-base font-medium text-gray-800">2.4 ตำแหน่ง <span class="text-red-600">*</span></label>
															<select name="position" id="position" class="select2-placeholder mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
																<option value="">-- โปรดเลือก --</option>
																foreach ($positions as $key => $val)
																	<option value="{{ $key }}">{{ $val }}</option>
																endforeach
															</select>
														</div> --}}
														{{-- <div class="col-span-6 sm:col-span-3">
															<label for="position_other" class="block text-base font-medium text-gray-800">2.5 ตำแหน่งอื่นๆ ระบุ</label>
															<input type="text" name="position_other" value="{{ old('position_other') }}" id="position_other" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-md sm:text-sm border-gray-300" disabled>
														</div> --}}
														<div class="col-span-6 sm:col-span-3">
															<label for="mobile" class="block text-base font-medium text-gray-800">2.7 โทรศัพท์เคลื่อนที่ <span class="text-red-600">*</span></label>
															<input type="tel" name="mobile" value="{{ old('mobile') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-md sm:text-sm border-gray-300">
														</div>
														<div class="col-span-6 sm:col-span-3">
															<label for="service_email" class="block text-base font-medium text-gray-800">2.6 อีเมล์ <span class="text-red-600">*</span></label>
															<input type="text" name="service_email" value="{{ old('service_email') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-md sm:text-sm border-gray-300">
														</div>

													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<button type="button" class="previous btn btn-info btn-pills">ก่อนหน้า</button>
					<button type="button" class="next btn btn-info btn-pills">ถัดไป</button>
				</fieldset>
				<fieldset>
					<div id="panel-3" class="panel">
						<div class="panel-hdr">
							<h2 class="text-green-900"><i class="fal fa-clipboard"></i>&nbsp;&nbsp;ข้อมูลติดต่อ</h2>
							<div class="panel-toolbar">
								<button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
							</div>
						</div>
						<div class="panel-container show">
							<div class="panel-content">

								<h2 class="text-green-700">3. ข้อมูลติดต่อ</h2>
								<div class="mt-0 sm:mt-0">
									<div class="md:grid md:grid-cols-1">
										<div class="mt-2 md:mt-0 md:col-span-2">
											<div class="overflow-hidden">
												<div class="px-6 pt-5 pb-16">
													<div class="grid grid-cols-6 gap-6">
														<div class="col-span-6 sm:col-span-3">
															<label for="send_address" class="block text-base font-medium text-gray-800">3.1 ที่อยู่สำหรับส่งผลการตรวจ <span class="text-red-600">*</span></label>
															<div class="frame-wrap">
																<div class="custom-control custom-switch custom-control-inline">
																	<input type="checkbox" name="contact_addr_opt" value="1" id="old_addr" class="custom-control-input" @if (old('contact_addr_opt') == "1") checked @endif>
																	<label class="custom-control-label" for="old_addr">ที่อยู่เดียวกับผู้รับบริการ</label>
																</div>
																<div class="custom-control custom-switch custom-control-inline">
																	<input type="checkbox" name="contact_addr_opt" value="2" id="new_addr" class="custom-control-input" @if (old('contact_addr_opt') == "2") checked @endif>
																	<label class="custom-control-label" for="new_addr">ที่อยู่ใหม่</label>
																</div>
															</div>
														</div>
													</div>
													<div class="grid grid-cols-6 gap-6 mt-4">
														<div class="col-span-6 sm:col-span-6">
															<label for="simpleinput" class="block text-base font-medium text-gray-800">3.2 คำนำหน้าชื่อ <span class="text-red-600">*</span></label>
															<div class="frame-wrap">
																<div class="custom-control custom-checkbox custom-control-inline">
																	<input type="checkbox" name="contact_title_name" value="mr" id="contact_title_name_mr" class="contact_title_name custom-control-input" @if (old('contact_title_name') == 'mr') checked @endif {{ (old('contact_addr_opt') == '2') ? '' : 'disabled' }}>
																	<label class="custom-control-label" for="contact_title_name_mr">นาย</label>
																</div>
																<div class="custom-control custom-checkbox custom-control-inline">
																	<input type="checkbox" name="contact_title_name" value="mrs" id="contact_title_name_mrs" class="contact_title_name custom-control-input" @if (old('contact_title_name') == 'mrs') checked @endif {{ (old('contact_addr_opt') == '2') ? '' : 'disabled' }}>
																	<label class="custom-control-label" for="contact_title_name_mrs">นาง</label>
																</div>
																<div class="custom-control custom-checkbox custom-control-inline">
																	<input type="checkbox" name="contact_title_name" value="miss" id="contact_title_name_ms" class="contact_title_name custom-control-input" @if (old('contact_title_name') == 'miss') checked @endif {{ (old('contact_addr_opt') == '2') ? '' : 'disabled' }}>
																	<label class="custom-control-label" for="contact_title_name_ms">นางสาว</label>
																</div>
															</div>
														</div>
														<div class="col-span-6 sm:col-span-3">
															<label for="contact_first_name" class="block text-base font-medium text-gray-800">3.3 ชื่อจริง <span class="text-red-600">*</span></label>
															<input type="text" name="contact_first_name" value="{{ old('contact_first_name') }}" class="contact_field mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-md sm:text-sm border-gray-300" {{ (old('contact_addr_opt') == '2') ? '' : 'disabled' }}>
														</div>
														<div class="col-span-6 sm:col-span-3">
															<label for="contact_last_name" class="block text-base font-medium text-gray-800">3.4 นามสกุล <span class="text-red-600">*</span></label>
															<input type="text" name="contact_last_name" value="{{ old('contact_last_name') }}" class="contact_field mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-md sm:text-sm border-gray-300" {{ (old('contact_addr_opt') == '2') ? '' : 'disabled' }}>
														</div>
														<div class="col-span-6 sm:col-span-6">
															<label for="contact_position" class="block text-base font-medium text-gray-800">3.5 ตำแหน่ง <span class="text-red-600">*</span></label>
															<input type="text" name="contact_position" value="{{ old('contact_position') }}" class="contact_field mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-md sm:text-sm border-gray-300" {{ (old('contact_addr_opt') == '2') ? '' : 'disabled' }}>
														</div>
														<div class="col-span-6 sm:col-span-3">
															<label for="contact_mobile" class="block text-base font-medium text-gray-800">3.6 โทรศัพท์เคลื่อนที่ <span class="text-red-600">*</span></label>
															<input type="text" name="contact_mobile" value="{{ old('contact_mobile') }}" class="contact_field mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-md sm:text-sm border-gray-300" {{ (old('contact_addr_opt') == '2') ? '' : 'disabled' }}>
														</div>
														<div class="col-span-6 sm:col-span-3">
															<label for="contact_email" class="block text-base font-medium text-gray-800">3.7 อีเมล์ <span class="text-red-600">*</span></label>
															<input type="text" name="contact_email" value="{{ old('contact_email') }}" class="contact_field mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-md sm:text-sm border-gray-300" {{ (old('contact_addr_opt') == '2') ? '' : 'disabled' }}>
														</div>
														<div class="col-span-6 sm:col-span-6">
															<label for="contact_addr" class="block text-base font-medium text-gray-800">3.8 ที่อยู่ใหม่ (เลขที่ หมู่ที่ ถนน หมู่บ้าน/อาคาร) <span class="text-red-600">*</span></label>
															<input type="text" name="contact_addr" value="{{ old('contact_addr') }}" class="contact_field mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-md sm:text-sm border-gray-300" {{ (old('contact_addr_opt') == '2') ? '' : 'disabled' }}>
														</div>
														<div class="col-span-6 sm:col-span-3">
															<label for="contact_province" class="block text-base font-medium text-gray-800">3.9 จังหวัด <span class="text-red-600">*</span></label>
															<select name="contact_province" id="contact_province" class="select2-placeholder mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" {{ (old('contact_addr_opt') == '2') ? '' : 'disabled' }}>
																<option value="">-- โปรดเลือก --</option>
																@foreach ($provinces as $key => $val)
																	<option value="{{ $key }}">{{ $val }}</option>
																@endforeach
															</select>
														</div>
														<div class="col-span-6 sm:col-span-3">
															<label for="contact_district" class="block text-base font-medium text-gray-800">3.10 เขต/อำเภอ <span class="text-red-600">*</span></label>
															<select name="contact_district" id="contact_district" class="select2-placeholder mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" {{ (old('contact_addr_opt') == '2') ? '' : 'disabled' }}>
																<option value="">-- โปรดเลือก --</option>
															</select>
														</div>
														<div class="col-span-6 sm:col-span-3">
															<label for="contact_sub_district" class="block text-base font-medium text-gray-800">3.11 แขวง/ตำบล <span class="text-red-600">*</span></label>
															<select name="contact_sub_district" id="contact_sub_district" class="select2-placeholder form-control mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" {{ (old('contact_addr_opt') == '2') ? '' : 'disabled' }}>
																<option>-- โปรดเลือก --</option>
															</select>
														</div>
														<div class="col-span-6 sm:col-span-3">
															<label for="contact_postcode" class="block text-base font-medium text-gray-800">3.12 รหัสไปรษณีย์ <span class="text-red-600">*</span></label>
															<input type="text" name="contact_postcode" value="{{ old('contact_postcode') }}" id="contact_postcode" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-md sm:text-sm border-gray-300" {{ (old('contact_addr_opt') == '2') ? '' : 'disabled' }}>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<button type="button" class="previous btn btn-info btn-pills">ก่อนหน้า</button>
					<button type="button" class="next btn btn-info btn-pills">ถัดไป</button>
				</fieldset>
				<fieldset>
					<div id="panel-4" class="panel">
						<div class="panel-hdr">
							<h2 class="text-green-900"><i class="fal fa-clipboard"></i>&nbsp;&nbsp;ข้อมูลผู้ใช้</h2>
							<div class="panel-toolbar">
								<button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
							</div>
						</div>
						<div class="panel-container show">
							<div class="panel-content">
								<h2 class="text-green-700">4. บัญชีผู้ใช้</h2>
								<div class="mt-0 sm:mt-0">
									<div class="md:grid md:grid-cols-1">
										<div class="mt-2 md:mt-0 md:col-span-2">
											<div class="overflow-hidden">
												<div class="px-6 pt-5 pb-16">
													<div class="grid grid-cols-6 gap-6">
														<div class="col-span-6 sm:col-span-3">
															<label for="user_name" class="block text-base font-medium text-gray-700">ชื่อผู้ใช้ <span class="text-red-600">*</span></label>
															<input type="text" name="username" value="{{ old('username') }}" id="user_name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-md sm:text-sm border-gray-300">
														</div>
														<div class="col-span-6 sm:col-span-3">
															<label for="user_email" class="block text-base font-medium text-gray-700">อีเมล์ <span class="text-red-600">*</span></label>
															<input type="email" name="email" value="{{ old('email') }}" id="user_email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-md sm:text-sm border-gray-300">
														</div>

														<div class="col-span-6 sm:col-span-3">
															<label for="user_password" class="block text-base font-medium text-gray-700">รหัสผ่าน (อย่างน้อย 6 ตัว) <span class="text-red-600">*</span></label>
															<input type="password" name="password" id="user_password" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-md sm:text-sm border-gray-300">
															<span toggle="#user_password" class="fal fa-eye field-icon toggle-password text-red-600"></span>
														</div>
														<div class="col-span-6 sm:col-span-3">
															<label for="user_confirm_password" class="block text-base font-medium text-gray-700">ยืนยันรหัสผ่าน <span class="text-red-600">*</span></label>
															<input type="password" name="password_confirmation" id="user_confirm_password" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-md sm:text-sm border-gray-300">
															<span toggle="#user_confirm_password" class="fal fa-eye field-icon toggle-confirm-password text-red-600"></span>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="mt-0 sm:mt-0">
									<div class="md:grid md:grid-cols-1">
										<div class="mt-2 md:mt-0 md:col-span-2">
											<div class="px-6 pt-5 pb-16">
												<div class="grid grid-cols-6 gap-6">
													<div class="col-span-6 sm:col-span-6">
														<div class="captcha inline-block">{!! captcha_img('flat') !!}</div>
														<button type="button" class="btn btn-sm btn-dark" id="refresh-captcha" style="margin-bottom:24px;">
															<span>&#x21bb;</span>
														</button>
													</div>
													<div class="col-span-6 sm:col-span-6 mt-0">
														<input name="captcha" id="captcha" type="text" class="form-control" placeholder="ป้อนรหัสที่ท่านเห็น">
													</div>
													<div class="col-span-6 sm:col-span-6">
														<button type="submit" class="btn btn-lg btn-primary">ลงทะเบียน</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<button type="button" class="previous btn btn-info btn-pills">ก่อนหน้า</button>
					<button type="button" class="next btn btn-secondary btn-pills" disabled>ถัดไป</button>
				</fieldset>
			</form>
		</section>
	</div>
</div>
@endsection
@section('script')
<script src="{{ URL::asset('assets/js/formplugins/select2/select2.bundle.js') }}"></script>
<script>
$(document).ready(function() {
	$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
	$('input[name="office_category"]').on('change', function() {
		$('input[name="' + this.name + '"]').not(this).prop('checked', false);
	});
	$('#position').on('change', function() {
		let pos_id = $(this).val();
		if (pos_id == 81) {
			$('#position_other').prop('disabled', false);
			$('#position_other').val('');
		} else {
			$('#position_other').val('');
			$('#position_other').prop('disabled', true);
		}
	});
	$('input[id="agency_type_establishment"]').on('change', function() {
		if ($(this).prop("checked") == true) {
			$('#office_name_establishment').val('');
			$('#office_name_establishment').prop('disabled', false);
			$('#office_code_establishment').val('');
			$('#office_code_establishment').prop('disabled', false);
			$('#office_name_establishment').focus();
			$('#agency_type_hospital').prop('checked', false);
			$("#hosp_search").empty().trigger('change');
			$('#hosp_search').prop('disabled', true);
			$('#agency_type_border_check_point').prop('checked', false);
			$('#disease_border_search').empty().trigger('change');
			$('#disease_border_search').prop('disabled', true);
			$('#agency_type_other').prop('checked', false);
			$('#agency_type_other_name').val('');
			$('#agency_type_other_name').prop('disabled', true);
			$('#agency_type_other_id').val('');
			$('#agency_type_other_id').prop('disabled', true);
		} else {
			$('#office_name_establishment').val('');
			$('#office_name_establishment').prop('disabled', true);
			$('#office_code_establishment').val('');
			$('#office_code_establishment').prop('disabled', true);
		 }
	});
	$("#agency_type_hospital").on('change', function() {
		if ($(this).prop("checked") == true) {
			$("#hosp_search").empty().trigger('change');
			$('#hosp_search').prop('disabled', false);
			$('#hosp_search').focus();
			$('#agency_type_establishment').prop('checked', false);
			$('#office_name_establishment').val('');
			$('#office_name_establishment').prop('disabled', true);
			$('#office_code_establishment').val('');
			$('#office_code_establishment').prop('disabled', true);
			$('#agency_type_border_check_point').prop('checked', false);
			$('#disease_border_search').empty().trigger('change');
			$('#disease_border_search').prop('disabled', true);
			$('#agency_type_other').prop('checked', false);
			$('#agency_type_other_name').val('');
			$('#agency_type_other_name').prop('disabled', true);
			$('#agency_type_other_id').val('');
			$('#agency_type_other_id').prop('disabled', true);
		} else {
			$('#hosp_search').empty().trigger('change');
			$('#hosp_search').prop('disabled', true);
		}
	});
	$("#agency_type_border_check_point").on('change', function() {
		if ($(this).prop("checked") == true) {
			$("#disease_border_search").empty().trigger('change');
			$('#disease_border_search').prop('disabled', false);
			$('#disease_border_search').focus();
			$('#agency_type_establishment').prop('checked', false);
			$('#office_name_establishment').val('');
			$('#office_name_establishment').prop('disabled', true);
			$('#office_code_establishment').val('');
			$('#office_code_establishment').prop('disabled', true);
			$('#agency_type_hospital').prop('checked', false);
			$('#hosp_search').empty().trigger('change');
			$('#hosp_search').prop('disabled', true);
			$('#agency_type_other').prop('checked', false);
			$('#agency_type_other_name').val('');
			$('#agency_type_other_name').prop('disabled', true);
			$('#agency_type_other_id').val('');
			$('#agency_type_other_id').prop('disabled', true);
		} else {
			$('#disease_border_search').empty().trigger('change');
			$('#disease_border_search').prop('disabled', true);
		}
	});
	$("#agency_type_other").on('change', function() {
		if ($(this).prop("checked") == true) {
			$('#agency_type_other_name').prop('disabled', false);
			$('#agency_type_other_name').val('');
			$('#agency_type_other_name').focus();
			$('#agency_type_other_id').val('');
			$('#agency_type_other_id').prop('disabled', false);
			$('#agency_type_establishment').prop('checked', false);
			$('#office_name_establishment').val('');
			$('#office_name_establishment').prop('disabled', true);
			$('#office_code_establishment').val('');
			$('#office_code_establishment').prop('disabled', true);
			$('#agency_type_hospital').prop('checked', false);
			$('#hosp_search').empty().trigger('change');
			$('#hosp_search').prop('disabled', true);
			$('#agency_type_border_check_point').prop('checked', false);
			$('#disease_border_search').empty().trigger('change');
			$('#disease_border_search').prop('disabled', true);
		} else {
			$('#agency_type_other_name').val('');
			$('#agency_type_other_name').prop('disabled', true);
			$('#agency_type_other_id').val('');
			$('#agency_type_other_id').prop('disabled', true);
		}
	});
	$('input[name="title_name"]').on('change', function() {
		$('input[name="' + this.name + '"]').not(this).prop('checked', false);
	});
	$('input[name="contact_addr_opt"]').on('change', function() {
		$('input[name="' + this.name + '"]').not(this).prop('checked', false);
	});
	$('input[name="contact_title_name"]').on('change', function() {
		$('input[name="' + this.name + '"]').not(this).prop('checked', false);
	});
	$("#new_addr").on('change', function() {
		if ($(this).prop("checked") == true) {
			$('#old_addr').prop('checked', false);
			$('.contact_title_name').prop('checked', false);
			$('.contact_title_name').prop('disabled', false);
			$('.contact_field').val('');
			$('.contact_field').prop('disabled', false);
			$('#contact_province').prop('disabled', false);
			$('#contact_district').prop('disabled', false);
			$('#contact_district').empty().trigger('change');
			$('#contact_sub_district').prop('disabled', false);
			$('#contact_sub_district').empty().trigger('change');
			$('#contact_postcode').prop('disabled', false);
			$('#contact_postcode').val('');
		} else {
			$('#old_addr').prop('checked', true);
			$('.contact_title_name').prop('checked', false);
			$('.contact_title_name').prop('disabled', true);
			$('.contact_field').val('');
			$('.contact_field').prop('disabled', true);
			$('#contact_province').prop('disabled', true);
			$('#contact_district').empty().trigger('change');
			$('#contact_district').prop('disabled', true);
			$('#contact_sub_district').empty().trigger('change');
			$('#contact_sub_district').prop('disabled', true);
			$('#contact_postcode').val('');
			$('#contact_postcode').prop('disabled', true);
		 }
	});
	$("#old_addr").on('change', function() {
		if ($(this).prop("checked") == true) {

			$('.contact_title_name').prop('checked', false);
			$('.contact_title_name').prop('disabled', true);

			$('.contact_field').val('');
			$('.contact_field').prop('disabled', true);

			$('#contact_province').prop('disabled', true);
			$('#contact_district').empty().trigger('change');
			$('#contact_district').prop('disabled', true);
			$('#contact_sub_district').empty().trigger('change');
			$('#contact_sub_district').prop('disabled', true);
			$('#contact_postcode').val('');
			$('#contact_postcode').prop('disabled', true);
		}
	});
	$('#refresh-captcha').click(function () {
		$.ajax({
			type: "POST",
			url: "{{ route('register.refresh-captcha') }}",
			success: function (data) {
				$(".captcha").html(data.captcha);
			}
		});
	});
	$('#province').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('register.district') }}",
				dataType: "html",
				data: {id:id},
				success: function(response) {
					$('#district').html(response);
				},
				error: function(jqXhr, textStatus, errorMessage) {
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});
	$('#contact_province').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('register.district') }}",
				dataType: "html",
				data: {id:id},
				success: function(response) {
					$('#contact_district').html(response);
				},
				error: function(jqXhr, textStatus, errorMessage) {
					alert('Error code: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});
	$('#district').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('register.subDistrict') }}",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#sub_district').html(response);
				},
				error: function(jqXhr, textStatus, errorMessage) {
					alert('Sub district error: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});
	$('#contact_district').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('register.subDistrict') }}",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#contact_sub_district').html(response);
				},
				error: function(jqXhr, textStatus, errorMessage) {
					alert('Sub district error: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});
	$('#sub_district').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('register.postcode') }}",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#postcode').val(response);
				},
				error: function(jqXhr, textStatus, errorMessage) {
					alert('Postcode error: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});
	$('#contact_sub_district').change(function() {
		if ($(this).val() != '') {
			var id = $(this).val();
			$.ajax({
				method: "POST",
				url: "{{ route('register.postcode') }}",
				dataType: "HTML",
				data: {id:id},
				success: function(response) {
					$('#contact_postcode').val(response);
				},
				error: function(jqXhr, textStatus, errorMessage) {
					alert('Postcode error: ' + jqXhr.status + errorMessage);
				}
			});
		}
	});
	$(".toggle-password").click(function() {
		$(this).toggleClass("fa-eye fa-eye-slash");
		var type = $($(this).attr("toggle"));
		if (type.attr("type") == "password") {
			type.attr("type", "text");
		} else {
			type.attr("type", "password");
		}
	});
	$(".toggle-confirm-password").click(function() {
		$(this).toggleClass("fa-eye fa-eye-slash");
		var type = $($(this).attr("toggle"));
		if (type.attr("type") == "password") {
			type.attr("type", "text");
		} else {
			type.attr("type", "password");
		}
	});
});
</script>
<script>
$(document).ready(function() {
	$(function() {
		$('.select2').select2();
		$(".select2-placeholder-multiple").select2({placeholder: "-- โปรดระบุ --"});
		$(".js-hide-search").select2({minimumResultsForSearch: 1 / 0});
		$(".js-max-length").select2({maximumSelectionLength: 2, placeholder: "Select maximum 2 items"});
		$(".select2-placeholder").select2({placeholder: "-- โปรดระบุ --", allowClear: true});
		$(".js-select2-icons").select2({
			minimumResultsForSearch: 1 / 0,
			templateResult: icon,
			templateSelection: icon,
			escapeMarkup: function(elm){
				return elm
			}
		});
		function icon(elm){
			elm.element;
			return elm.id ? "<i class='" + $(elm.element).data("icon") + " mr-2'></i>" + elm.text : elm.text
		}
		/* hospital search by name */
		$("#hosp_search").select2({
			ajax: {
				method: "POST",
				url: "{{ route('register.hospital') }}",
				dataType: 'json',
				delay: 250,
				data: function (params) {
					return {
						q: params.term,
						page: params.page
					};
				},
				processResults: function (data, params) {
					params.page = params.page || 1;
					return {
						results: data.items,
						pagination: {
							more: (params.page * 30) < data.total_count
						}
					};
				},
				cache: true
			},
			escapeMarkup: function (markup) { return markup; },
			placeholder: "โปรดกรอกข้อมูล",
			minimumInputLength: 3,
			maximumInputLength: 20,
			templateResult: formatRepo,
			templateSelection: formatRepoSelection
		});

		/* disease border search by name */
		$("#disease_border_search").select2({
			ajax: {
				method: "POST",
				url: "{{ route('register.hospital') }}",
				dataType: 'json',
				delay: 250,
				data: function (params) {
					return {
						q: params.term,
						page: params.page
					};
				},
				processResults: function (data, params) {
					params.page = params.page || 1;
					return {
						results: data.items,
						pagination: {
							more: (params.page * 30) < data.total_count
						}
					};
				},
				cache: true
			},
			escapeMarkup: function (markup) { return markup; },
			placeholder: "โปรดกรอกข้อมูล",
			minimumInputLength: 3,
			maximumInputLength: 20,
			templateResult: formatRepo,
			templateSelection: formatRepoSelection
		});

	});
	function formatRepo (repo) {
		if (repo.loading) return repo.text;
		var markup = "<div class='select2-result-repository clearfix'>" +
			"<div class='select2-result-repository__meta'>" +
			"<div class='select2-result-repository__title'>" + repo.value + "</div></div></div>";
			return markup;
	}
	function formatRepoSelection (repo) {
		return repo.value || repo.text;
	}
});
</script>
<script>
(function($) {
	"use strict";
	function verificationForm() {
		var current_fs, next_fs, previous_fs;
		var left, opacity, scale;
		var animating;
		$(".next").click(function () {
			if (animating) return false;
			animating = true;
			current_fs = $(this).parent();
			next_fs = $(this).parent().next();
			$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
			next_fs.show();
			current_fs.animate({
				opacity: 0
			}, {
				step: function (now, mx) {
					scale = 1 - (1 - now) * 0.2;
					left = (now * 50) + "%";
					opacity = 1 - now;
					current_fs.css({
						'transform': 'scale(' + scale + ')',
						'position': 'absolute'
					});
					next_fs.css({
						'left': left,
						'opacity': opacity
					});
				},
				duration: 800,
				complete: function () {
					current_fs.hide();
					animating = false;
				},
				easing: 'easeInOutBack'
			});
			$("html, body").animate({ scrollTop: $("#regis-title").offset().top}, 2000);
		});
		$(".previous").click(function () {
			if (animating) return false;
			animating = true;
			current_fs = $(this).parent();
			previous_fs = $(this).parent().prev();
			$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
			previous_fs.show();
			current_fs.animate({
				opacity: 0
			}, {
				step: function (now, mx) {
					scale = 0.8 + (1 - now) * 0.2;
					left = ((1 - now) * 50) + "%";
					opacity = 1 - now;
					current_fs.css({
						'left': left
					});
					previous_fs.css({
						'transform': 'scale(' + scale + ')',
						'opacity': opacity
					});
				},
				duration: 800,
				complete: function () {
					current_fs.hide();
					animating = false;
				},
				easing: 'easeInOutBack'
			});
			$("html, body").animate({ scrollTop: $("#regis-title").offset().top}, 2000);
		});
	};
	verificationForm ();
})(jQuery);
</script>
@endsection

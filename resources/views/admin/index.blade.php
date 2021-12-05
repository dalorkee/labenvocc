@extends('layouts.admin.index')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('vendor/jquery-smartwizard/css/smart_wizard_arrows.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('vendor/DataTables/DataTables-1.10.22/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('vendor/DataTables/Buttons-1.6.5/css/buttons.jqueryui.min.css') }}">
<link rel='stylesheet' type="text/css" href="{{ URL::asset('vendor/DataTables/Responsive-2.2.6/css/responsive.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('vendor/jquery-contextmenu/css/jquery.contextMenu.min.css') }}">
@endsection
@section('content')
<ol class="breadcrumb page-breadcrumb">
	<li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
	<li class="breadcrumb-item">Admin</li>
</ol>
<div class="subheader">
	<h1 class="subheader-title"><small>บริหารจัดการระบบ</small></h1>
</div>
<div class="fs-lg fw-300 p-5 bg-white border-faded rounded mb-g">
	<div class="frame-wrap">
		<div class="bg-white bg-opacity-25 grid grid-cols-1 md:grid-cols-2">
			<div class="p-6 border border-gray-200">
				<div class="flex items-center">
					<i class="fal fa-user-plus fa-lg"></i>
					<div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
						<a href="{{route('users.index')}}">จัดการข้อมูลผู้ใช้งาน</a>
					</div>
				</div>
			</div>
			<div class="p-6 border border-gray-200">
				<div class="flex items-center">
					<i class="fal fa-user-plus fa-lg"></i>
					<div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
						<a href="{{route('office.index')}}">จัดการข้อมูลเจ้าหน้าที่</a>
					</div>
				</div>
			</div>
			<div class="p-6 border border-gray-200">
				<div class="flex items-center">
					<i class="fal fa-bullhorn fa-lg"></i>
					<div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
						<a href="{{route('advertise.index')}}">จัดการข้อมูลประชาสัมพันธ์</a>
					</div>
				</div>
			</div>
			<div class="p-6 border border-gray-200">
				<div class="flex items-center">
					<i class="fal fa-asterisk fa-lg"></i>
					<div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
						<a href="#">จัดการข้อมูลแหล่งกำเนิดสิ่งคุกคาม</a>
					</div>
				</div>
			</div>			
			<div class="p-6 border border-gray-200">
				<div class="flex items-center">
					<i class="fal fa-asterisk fa-lg"></i>
					<div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
						<a href="#">จัดการข้อมูลประเภทสิ่งคุกคาม</a>
					</div>
				</div>
			</div>
			<div class="p-6 border border-gray-200">
				<div class="flex items-center">
					<i class="fal fa-vial fa-lg"></i>
					<div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
						<a href="#">จัดการข้อมูลประเภทตัวอย่าง</a>
					</div>
				</div>
			</div>
			<div class="p-6 border border-gray-200">
				<div class="flex items-center">
					<i class="fal fa-user-md fa-lg"></i>
					<div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
						<a href="#">จัดการข้อมูลวัตถุประสงค์การตรวจ</a>
					</div>
				</div>
			</div>
			<div class="p-6 border border-gray-200">
				<div class="flex items-center">
					<i class="fal fa-vials fa-lg"></i>
					<div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
						<a href="#">จัดการข้อมูลลักษณะตัวอย่าง</a>
					</div>
				</div>
			</div>
			<div class="p-6 border border-gray-200">
				<div class="flex items-center">
					<i class="fal fa-braille fa-lg"></i>
					<div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
						<a href="#">จัดการข้อมูลพารามิเตอร์</a>
					</div>
				</div>
			</div>
			<div class="p-6 border border-gray-200">
				<div class="flex items-center">
					<i class="fal fa-handshake fa-lg"></i>
					<div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
						<a href="#">จัดการข้อมูลการรับสัมผัส</a>
					</div>
				</div>
			</div>
			<div class="p-6 border border-gray-200">
				<div class="flex items-center">
					<i class="fal fa-prescription-bottle fa-lg"></i>
					<div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
						<a href="#">จัดการข้อมูลหน่วยวัด</a>
					</div>
				</div>
			</div>
			<div class="p-6 border border-gray-200">
				<div class="flex items-center">
					<i class="fal fa-user-md fa-lg"></i>
					<div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
						<a href="#">จัดการข้อมูลวิธีวิเคราะห์</a>
					</div>
				</div>
			</div>
			<div class="p-6 border border-gray-200">
				<div class="flex items-center">
					<i class="fal fa-diagnoses fa-lg"></i>
					<div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
						<a href="#">จัดการข้อมูลเทคนิควิเคราะห์</a>
					</div>
				</div>
			</div>
			<div class="p-6 border border-gray-200">
				<div class="flex items-center">
					<i class="fal fa-x-ray fa-lg"></i>
					<div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
						<a href="#">จัดการข้อมูลเครื่องวิเคราะห์</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script>
$(document).ready(function() {

});
</script>
@endsection

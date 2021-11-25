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
					<svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-400">
						<path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
					</svg>
					<div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
						<a href="{{route('users.index')}}">จัดการข้อมูลผู้ใช้งาน</a>
					</div>
				</div>
			</div>
			<div class="p-6 border border-gray-200">
				<div class="flex items-center">
					<svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-400">
						<path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
					</svg>
					<div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
						<a href="{{route('office.index')}}">จัดการข้อมูลเจ้าหน้าที่</a>
					</div>
				</div>
			</div>
			<div class="p-6 border border-gray-200">
				<div class="flex items-center">
					<svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-400">
						<path d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
						<path d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
					</svg>
					<div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
						<a href="#">จัดการข้อมูลแหล่งกำเนิดสิ่งคุกคาม</a>
					</div>
				</div>
			</div>
			<div class="p-6 border border-gray-200">
				<div class="flex items-center">
					<svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-400">
						<path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
					</svg>
					<div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
						<a href="#">จัดการข้อมูลประเภทสิ่งคุกคาม</a>
					</div>
				</div>
			</div>
			<div class="p-6 border border-gray-200">
				<div class="flex items-center">
					<svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-400"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
					<div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
						<a href="#">จัดการข้อมูลประเภทตัวอย่าง</a>
					</div>
				</div>
			</div>
			<div class="p-6 border border-gray-200">
				<div class="flex items-center">
					<svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-400">
						<path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
					</svg>
					<div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
						<a href="#">จัดการข้อมูลวัตถุประสงค์การตรวจ</a>
					</div>
				</div>
			</div>
			<div class="p-6 border border-gray-200">
				<div class="flex items-center">
					<svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-400">
						<path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
					</svg>
					<div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
						<a href="#">จัดการข้อมูลลักษณะตัวอย่าง</a>
					</div>
				</div>
			</div>
			<div class="p-6 border border-gray-200">
				<div class="flex items-center">
					<svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-400">
						<path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
					</svg>
					<div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
						<a href="#">จัดการข้อมูลพารามิเตอร์</a>
					</div>
				</div>
			</div>
			<div class="p-6 border border-gray-200">
				<div class="flex items-center">
					<svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-400">
						<path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
					</svg>
					<div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
						<a href="#">จัดการข้อมูลการรับสัมผัส</a>
					</div>
				</div>
			</div>
			<div class="p-6 border border-gray-200">
				<div class="flex items-center">
					<svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-400">
						<path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
					</svg>
					<div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
						<a href="#">จัดการข้อมูลหน่วยวัด</a>
					</div>
				</div>
			</div>
			<div class="p-6 border border-gray-200">
				<div class="flex items-center">
					<svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-400">
						<path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
					</svg>
					<div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
						<a href="#">จัดการข้อมูลวิธีวิเคราะห์</a>
					</div>
				</div>
			</div>
			<div class="p-6 border border-gray-200">
				<div class="flex items-center">
					<svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-400">
						<path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
					</svg>
					<div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
						<a href="#">จัดการข้อมูลเทคนิควิเคราะห์</a>
					</div>
				</div>
			</div>
			<div class="p-6 border border-gray-200">
				<div class="flex items-center">
					<svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-400">
						<path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
					</svg>
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

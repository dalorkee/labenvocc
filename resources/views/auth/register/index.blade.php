@extends('layouts.guest.index')
<link rel="stylesheet" href="{{ URL::asset('css/step.css') }}">
@section('content')
<div class="row font-prompt mt-4 mb-6">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
		<h2 class="fw-600 mt-4 text-xl text-center">ลงทะเบียนใช้งานระบบ</h2>
	</div>
</div>
<div class="row font-prompt mt-6 mb-6">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
		<ul class="list-unstyled multi-steps">
			<li class="is-active">ประเภทผู้รับบริการ</li>
			<li>ข้อมูลผู้รับบริการ</li>
			<li>ข้อมูลติดต่อ</li>
			<li>บัญชีผู้ใช้</li>
			<li>ตรวจสอบข้อมูล</li>
		</ul>
	</div>
</div>

<div class="row font-prompt mb-6" style="padding: 0 10em">
	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
		<div class="card text-center border-none shadow-none mt-6">
			<div class="card-body">
				<p style="font-size:4rem"><i class="fal fa-users mr-1"></i></p>
			</div>
			<a href="{{ route('register.personal.step2.get') }}" title="Register" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-4 px-8 border-b-4 border-blue-700 hover:border-blue-500 rounded">บุคคลทั่วไป</a>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
		<div class="card text-center border-none shadow-none mt-6">
			<div class="card-body">
				<p style="font-size:4rem"><i class="fal fa-warehouse mr-1"></i></p>
			</div>
			<a href="{{ route('register.private.step2.get') }}" title="Register" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-4 px-8 border-b-4 border-blue-700 hover:border-blue-500 rounded">หน่วยงานเอกชน</a>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
		<div class="card text-center border-none shadow-none mt-6">
			<div class="card-body">
				<p style="font-size:4rem"><i class="fal fa-home mr-1"></i></p>
			</div>
			<a href="{{ route('register.gov.step2.get') }}" title="Register" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-4 px-8 border-b-4 border-blue-700 hover:border-blue-500 rounded">หน่วยงานรัฐบาล</a>
		</div>
	</div>
</div>
@endsection


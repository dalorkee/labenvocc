@extends('layouts.guest.index')
@section('style')
<style>
.multi-steps > li.is-active:before, .multi-steps > li.is-active ~ li:before {
	 content: counter(stepNum);
	 font-family: inherit;
	 font-weight: 700;
}
 .multi-steps > li.is-active:after, .multi-steps > li.is-active ~ li:after {
	background-color: #ededed;
	z-index: 0;
}
 .multi-steps {
	 display: table;
	 table-layout: fixed;
	 width: 100%;
}
 .multi-steps > li {
	 counter-increment: stepNum;
	 text-align: center;
	 display: table-cell;
	 position: relative;
	 color: #90C146;
}
 .multi-steps > li:before {
	 content: '\f00c';
	 content: '\2713;
	 content: '\10003';
	 content: '\10004';
	 content: '\2713';
	 display: block;
	 margin: 0 auto 4px;
	 background-color: #EAEAAE;
	 width: 50px;
	 height: 50px;
	 line-height: 44px;
	 text-align: center;
	 font-weight: bold;
	 border-width: 4px;
	 border-style: solid;
	 border-color: #90C146;
	 border-radius: 50%;
}
 .multi-steps > li:after {
	 content: '';
	 margin-left: 18px;
	 height: 4px;
	 width: 100%;
	 background-color: #90C146;
	 position: absolute;
	 top: 22px;
	 left: 52%;
	 /* z-index: -1; */
}
 .multi-steps > li:last-child:after {
	 display: none;
}
 .multi-steps > li.is-active:before {
	 background-color: #fff;
	 border-color: #90C146;
}
 .multi-steps > li.is-active ~ li {
	 color: #808080;
}
 .multi-steps > li.is-active ~ li:before {
	 background-color: #ededed;
	 border-color: #ededed;
	 color: white;
}

</style>
@endsection
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
		</ul>
	</div>
</div>

<div class="row font-prompt mb-6" style="padding: 0 10em">
	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
		<div class="card text-center border-none shadow-none mt-6">
			<div class="card-body">
				<p style="font-size:4rem"><i class="fal fa-users mr-1"></i></p>
			</div>
			<a href="{{ route('register.personal.step2.get') }}" title="Register" class="btn btn-lg btn-primary">บุคคลทั่วไป</a>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
		<div class="card text-center border-none shadow-none mt-6">
			<div class="card-body">
				<p style="font-size:4rem"><i class="fal fa-user-plus mr-1"></i></p>
			</div>
			<a href="{{ route('register.private.step2.get') }}" title="Register" class="btn btn-lg btn-info">หน่วยงานเอกชน</a>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
		<div class="card text-center border-none shadow-none mt-6">
			<div class="card-body">
				<p style="font-size:4rem"><i class="fal fa-user-plus mr-1"></i></p>
			</div>
			<a href="{{ route('register.gov.step2.get') }}" title="Register" class="btn btn-lg btn-info">หน่วยงานภาครัฐ</a>
		</div>
	</div>
</div>
@endsection


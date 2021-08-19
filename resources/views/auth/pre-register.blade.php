@extends('layouts.guest.index')
@section('content')
<div class="row font-cs-chatthai">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
		<h2 class="fw-600 mt-4 text-xl text-center">ลงทะเบียน</h2>
	</div>
</div>
<div class="row font-cs-chatthai mb-12">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
		<div class="card text-center mt-6">
			<div class="card-body">
				<h2>ผู้รับบริการ</h2>
				<p style="font-size:4rem"><i class="fal fa-users mr-1"></i></p>
			</div>
			<a href="{{ route('register.create') }}" title="Register" class="btn btn-lg btn-primary">ลงทะเบียน</a>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
		<div class="card text-center mt-6">
			<div class="card-body">
				<h2>เจ้าหน้าที่</h2>
				<p style="font-size:4rem"><i class="fal fa-user-plus mr-1"></i></p>
			</div>
			<button type="button" class="btn btn-lg btn-info">ลงทะเบียน</button>
		</div>
	</div>
</div>
@endsection

@extends('layouts.guest.index')
@section('style')
<link rel="stylesheet" href="{{ URL::asset('css/register_staff.css') }}">
<style>
.input-group-text {
	background-color: #F3F3F3 !important;
}
.toggle-password {
	color: #1AB3A3;
}
</style>
@endsection
@section('content')
<div class="row bg-white font-prompt">
	<div class="col-md-6">
		<div class="row mt-4 mb-4">
			<div class="col-md-12">
				<form method="POST" action="{{ route('login') }}">
					@csrf
					<fieldset style="height:484px;padding:10px 30px; border: 1px solid #d3ebe8">
						<legend style="width:auto;padding:2px;font-size:1.10em">ลงชื่อเข้าใช้</legend>
						<div class="col-md-12">
							<div class="form-group">
								<label for="username" class="form-label">ชื่อผู้ใช้/อีเมล์</label>
								<input name="identity" type="text" value="{{ old('identity') }}" id="username" class="form-control @error('identity') is-invalid @enderror" maxlength="90">
								@if ($errors->has('identity'))
									<span class="invalid-feedback" role="alert">{{ $errors->first('identity') }}</span>
								@else
									<div class="help-block">{{ 'สามารถใช้อีเมล์แทนชื่อผู้ใช้ได้' }}</div>
								@endif
							</div>
							<div class="form-group">
								<label class="form-label" for="password">รหัสผ่าน</label>
								<div class="input-group">
									<input name="password" type="password" id="password" class="form-control @error('password') is-invalid @enderror" maxlength="90">
									<div class="input-group-append">
										<span class="input-group-text"><i class="fal fa-eye toggle-password" toggle="#password"></i></span>
									</div>
								</div>
									@if ($errors->has('password'))
										<div class="help-block invalid-feedback d-block text-danger" role="alert">{{ $errors->first('password') }}</div>
									@else
										<div class="help-block">{{ 'รหัสผ่านของท่าน' }}</div>
									@endif
							</div>
						</div>
						<div class="col-md-12 mt-4">
							<button id="js-login-btn" type="submit" class="btn btn-info btn-block btn-lg">เข้าสู่ระบบ</button>
						</div>
						<div class="col-md-12">
							<nav class="row mt-4 text-sm">
								<div class="col-sm-4">
									<a href="#"><i class="fal fa-key"></i> ลืมรหัสผ่าน ?</a>
								</div>
								<div class="col-sm-4">
									<a href="#"><i class="fal fa-book"></i> คู่มือการใช้งาน</a>
								</div>
								<div class="col-sm-4">
									<span><i class="fal fa-user"></i></span><a href="{{ route('register.index') }}" title="ลงทะเบียน"> ลงทะเบียนใหม่</a>
								</div>
							</nav>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="row mt-4 mb-4">
			<div class="col-md-12">
				<form method="POST" action="{{ route('login') }}">
					<fieldset style="padding:10px 30px; border: 1px solid #d3ebe8">
						<legend style="width:auto;padding:2px;color:#39675D;font-size:1.10em">ข่าวสารประชาสัมพันธ์</legend>
						<div class="card m-0 p-0 shadow-0" style="border:none;background: none;">
							<div class="card-body p-0">
								<div class="custom-scroll" style="height: 220px">
									<section>
										<div class="alert border-faded bg-transparent text-secondary fade show" role="alert">
											<div class="d-flex align-items-center">
												<div class="alert-icon">
													<span class="icon-stack icon-stack-md">
														<i class="base-7 icon-stack-3x color-success-600"></i>
														<i class="fal fa-info icon-stack-1x text-white"></i>
													</span>
												</div>
												<div class="flex-1">
													<span class="h5 color-success-600">ขณะนี้ศูนย์อ้างอิงทางห้องปฏิบัติการและพิษวิทยาไม่สามารถให้บริการตรวจวิเคราะห์สารแปรรูปของเบนซีน (trans,trans-Muconic acid) ได้ชั่วคราว</span>
												</div>
												<a href="#" class="btn btn-outline-success btn-sm btn-w-m">รายละเอียด</a>
											</div>
										</div>
										<div class="alert border-faded bg-transparent text-secondary fade show" role="alert">
											<div class="d-flex align-items-center">
												<div class="alert-icon">
													<span class="icon-stack icon-stack-md">
														<i class="base-7 icon-stack-3x color-success-600"></i>
														<i class="fal fa-info icon-stack-1x text-white"></i>
													</span>
												</div>
												<div class="flex-1">
													<span class="h5 color-success-600">ขณะนี้ศูนย์อ้างอิงทางห้องปฏิบัติการและพิษวิทยาไม่สามารถให้บริการตรวจวิเคราะห์สารแปรรูปของเบนซีน (trans,trans-Muconic acid) ได้ชั่วคราว</span>
												</div>
												<a href="#" class="btn btn-outline-success btn-sm btn-w-m">รายละเอียด</a>
											</div>
										</div>
										<div class="alert border-faded bg-transparent text-secondary fade show" role="alert">
											<div class="d-flex align-items-center">
												<div class="alert-icon">
													<span class="icon-stack icon-stack-md">
														<i class="base-7 icon-stack-3x color-success-600"></i>
														<i class="fal fa-info icon-stack-1x text-white"></i>
													</span>
												</div>
												<div class="flex-1">
													<span class="h5 color-success-600">ขณะนี้ศูนย์อ้างอิงทางห้องปฏิบัติการและพิษวิทยาไม่สามารถให้บริการตรวจวิเคราะห์สารแปรรูปของเบนซีน (trans,trans-Muconic acid) ได้ชั่วคราว</span>
												</div>
												<a href="#" class="btn btn-outline-success btn-sm btn-w-m">รายละเอียด</a>
											</div>
										</div>
									</section>
								</div>
							</div>
						</div>
					</fieldset>
				</form>
			</div>
			<div class="col-md-12 mt-4">
				<form method="POST" action="{{ route('login') }}">
					<fieldset style="padding:30px; border: 1px solid #d3ebe8">
						<legend style="width:auto;padding:2px;color:#39675D;font-size:1.10em">มาตรฐานคุณภาพ</legend>
						<div class="card m-0 p-0 shadow-0" style="border:none;background: none;">
							<div class="card-body p-0">
								<div class="custom-scroll" style="height: 80px">
									<section>
										<div class="fs-xl fw-500 color-success-600">
											ขณะนี้ศูนย์อ้างอิงทางห้องปฏิบัติการและพิษวิทยาไม่สามารถให้บริการตรวจวิเคราะห์สารแปรรูปของเบนซีน (trans,trans-Muconic acid) ได้ชั่วคราว
										</div>
									</section>
								</div>
							</div>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="d-sm-flex flex-column align-items-center justify-content-center d-md-block">
			<div class="px-0 py-1 mt-5 text-white fs-nano opacity-50">
				Env-Occ social media
			</div>
			<div class="d-flex flex-row opacity-70">
				<a href="#" class="mr-2 fs-xxl text-white">
					<i class="fab fa-facebook-square"></i>
				</a>
				<a href="#" class="mr-2 fs-xxl text-white">
					<i class="fab fa-twitter-square"></i>
				</a>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script>
 $("#js-login-btn").click(function(event) {
	var form = $("#js-login")
	if (form[0].checkValidity() === false) {
		event.preventDefault()
		event.stopPropagation()
	}
	form.addClass('was-validated');
	// Perform ajax submit here...
});
</script>
<script>
$(function(){
	$(".toggle-password").click(function() {
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
@endsection


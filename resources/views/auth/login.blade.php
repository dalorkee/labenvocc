@extends('layouts.guest.index')
@section('content')
<div class="row bg-white">
	<div class="col-md-6">
		<div class="row mt-4 mb-4">
			<div class="col-md-12">
				<form method="POST" action="{{ route('login') }}">
					@csrf
					<fieldset style="height:505px;padding:10px 30px; border: 2px solid #4AD3C5">
						<legend style="width:auto;padding:2px;color:#39675D">ลงชื่อเข้าใช้</legend>
						<div class="col-md-12">
							<div class="form-group">
								<label for="username" class="form-label">ชื่อผู้ใช้/อีเมล์</label>
								<input name="identity" type="text" id="username" class="form-control form-control-lg" required>
								<div class="invalid-feedback">No, you missed this one.</div>
								<div class="help-block">สามารถใช้อีเมล์แทนชื่อผู้ใช้ได้</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="password">รหัสผ่าน</label>
								<input name="password" type="password" id="password" class="form-control form-control-lg" required>
								<div class="invalid-feedback">Sorry, you missed this one.</div>
								<div class="help-block">รหัสผ่านของคุณ</div>
							</div>
							<div class="form-group text-left">
								<div class="custom-control custom-checkbox">
									<input type="checkbox" name="remember" id="remember_me" class="custom-control-input">
									<label class="custom-control-label" for="rememberme">จดจำผู้ใช้</label>
								</div>
							</div>
						</div>
						<div class="col-md-12 mt-4">
							<button id="js-login-btn" type="submit" class="btn btn-info btn-block btn-lg">เข้าสู่ระบบ</button>
						</div>
						<div class="col-md-12">
							<nav class="row mt-4 text-sm">
								<div class="col-sm-3">
									<a href="#"><i class="fal fa-key"></i> ลืมรหัสผ่าน ?</a>
								</div>
								<div class="col-sm-3">
									<a href="#"><i class="fal fa-book"></i> คู่มือการใช้งาน</a>
								</div>
								<div class="col-sm-6">
									<span><i class="fal fa-user"></i> ยังไม่มีบัญชีผู้ใช้ ?</span>&nbsp;&nbsp;&nbsp;<a href="#">ลงทะเบียนใช้งาน</a>
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
					<fieldset style="padding:10px 30px; border: 2px solid #4AD3C5">
						<legend style="width:auto;padding:2px;color:#39675D">ข่าวสารประชาสัมพันธ์</legend>
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
					<fieldset style="padding:30px; border: 2px solid #4AD3C5">
						<legend style="width:auto;padding:2px;color:#39675D">มาตรฐานคุณภาพ</legend>
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
@endsection


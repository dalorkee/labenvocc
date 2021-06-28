@extends('layouts.guest.index')
@section('content')
<div class="flex-1" style="background: url(img/svg/pattern-1.svg) no-repeat center bottom fixed; background-size: cover;">
	<div class="container py-4 py-lg-5 my-lg-5 px-4 px-sm-0">
		<div class="row">
			<div class="col-sm-12 col-md-6 col-lg-5 col-xl-4 ml-auto">
				<h1 class="text-white fw-300 mb-3 d-sm-block d-md-none">App Sing in</h1>
				<div class="card p-4 rounded-plus bg-faded">
					<form method="POST" action="{{ route('login') }}">
						@csrf
						<div class="form-group">
							<label class="form-label" for="username">Username/Email</label>
							<input name="identity" type="text" id="username" class="form-control form-control-lg" required>
							<div class="invalid-feedback">No, you missed this one.</div>
							<div class="help-block">Your unique username to app</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="password">Password</label>
							<input name="password" type="password" id="password" class="form-control form-control-lg" required>
							<div class="invalid-feedback">Sorry, you missed this one.</div>
							<div class="help-block">Your password</div>
						</div>
						<div class="form-group text-left">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="rememberme">
								<label class="custom-control-label" for="rememberme"> Remember me</label>
							</div>
						</div>
						<div class="row no-gutters">
							<div class="col-lg-6 pr-lg-1 my-2">
								<button type="reset" class="btn btn-warning btn-block btn-lg text-white">Clear</button>
							</div>
							<div class="col-lg-6 pl-lg-1 my-2">
								<button id="js-login-btn" type="submit" class="btn btn-info btn-block btn-lg"> Sign in</button>
							</div>
						</div>
					</form>
				</div>
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
			<div class="col col-md-6 col-lg-7 hidden-sm-down font-sukhumvit">
				<div class="panel" style="min-height: 398px;">
					<div class="panel-hdr">
						<h2>ข่าวสารประชาสัมพันธ์</h2>
						<div class="panel-toolbar">
							<button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
							<button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
						</div>
					</div>
					<div class="panel-container show">
						<div class="panel-content">
							<div class="panel-tag">
								คำแนะนำการปฏิบัติตนสำหรับเจ้าหน้าที่หน่วยงานอื่นๆ (ไม่ใช่เจ้าหน้าที่สาธารณสุข) 
								ที่เข้าไปปฏิบัติงานในพื้นที่ที่เกิดการระบาดของโรคติดเชื้อไวรัสโคโรนา 2019
							</div>
							<div class="panel-tag">
								คำแนะนำการปฏิบัติตนสำหรับเจ้าหน้าที่หน่วยงานอื่นๆ (ไม่ใช่เจ้าหน้าที่สาธารณสุข) 
								ที่เข้าไปปฏิบัติงานในพื้นที่ที่เกิดการระบาดของโรคติดเชื้อไวรัสโคโรนา 2019    
							</div>
							<div class="panel-tag">
								ขณะนี้ศูนย์อ้างอิงทางห้องปฏิบัติการและพิษวิทยาไม่สามารถให้บริการตรวจวิเคราะห์สารแปรรูปของเบนซีน 
								(trans,trans-Muconic acid) ได้ชั่วคราว
							</div>
						</div>
					</div>
				</div>
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


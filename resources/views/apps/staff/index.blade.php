@extends('layouts.index')
@section('token')<meta name="csrf-token" content="{{ csrf_token() }}">@endsection
@section('content')
<ol class="breadcrumb page-breadcrumb text-sm font-prompt">
	<li class="breadcrumb-item"><i class="fal fa-home mr-1"></i> <a href="{{ route('staff.index') }}">หน้าหลัก</a></li>
	<li class="breadcrumb-item">ข้อมูลส่วนตัว</li>
</ol>
<div class="row font-prompt">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
		<div class="border px-3 pt-3 pb-0 rounded">
			<ul class="nav" role="tablist">
				<li class="nav-item"><a class="nav-link btn btn-sm btn-primary" href="{{ route('staff.index') }}"><i class="fal fa-user mr-1"></i>ข้อมูลส่วนตัว</a></li>
				<li class="nav-item"><a class="nav-link" href="{{ route('staff.inbox') }}"><i class="fal fa-envelope mr-1"></i>กล่องข้อความ</a></li>
				<li class="nav-item"><a class="nav-link" href="{{ route('staff.calendar') }}"><i class="fal fa-calendar-check mr-1"></i>ปฏิทินงาน</a></li>
			</ul>
			<div class="row mt-3">
				<div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
					<div class="panel">
						<div class="panel-hdr">
							<h2>ข้อมูลส่วนตัว</h2>
							<div class="panel-toolbar">
								<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"><i class="fal fa-window-minimize"></i></button>
								<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"><i class="fal fa-expand"></i></button>
								<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"><i class="fal fa-times"></i></button>
							</div>
						</div>
						<div class="panel-container">
							<div class="panel-content">
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-3">
										<div class="card">
											<div class="card-body" style="min-height:300px;">
												<div class="row">
													<div class="col-sm-3">
														<p class="mb-0">ชื่อ-นามสกุล</p>
													</div>
													<div class="col-sm-9">
														<p class="text-muted mb-0">{{ $data['first_name']." ".$data['last_name'] }}</p>
													</div>
												</div>
												<hr>
												<div class="row">
													<div class="col-sm-3">
														<p class="mb-0">ตำแหน่ง</p>
													</div>
													<div class="col-sm-9">
														<p class="text-muted mb-0">{{ $data['position'][0]['name'] }}</p>
													</div>
												</div>
												<hr>
												<div class="row">
													<div class="col-sm-3">
														<p class="mb-0">สังกัด</p>
													</div>
													<div class="col-sm-9">
														<p class="text-muted mb-0">{{ $data['affiliation'] }}</p>
													</div>
												</div>
												<hr>
												<div class="row">
													<div class="col-sm-3">
														<p class="mb-0">หน้าที่รับผิดชอบ</p>
													</div>
													<div class="col-sm-9">
														<p class="text-muted mb-0">{{ $data['duty'][0]['duty_name'] }}</p>
													</div>
												</div>
												<hr>
											</div>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-3">
										<div class="card">
											<div class="card-body text-center" style="min-height:300px;">
												<div class="flex justify-center items-center">
													@if (!empty(auth()->user()->profile_photo))
														<img src="{{ URL::asset('images/avartar/'.auth()->user()->profile_photo) }}" alt="avatar" class="rounded-circle img-fluid" style="width: 100px;">
													@else
														<img src="{{ URL::asset('images/avartar/avartar.png')}}" alt="avatar" class="rounded-circle img-fluid" style="width: 100px;">
													@endif
												</div>
												<h5 class="my-3">{{ auth()->user()->username }}</h5>
												<p class="text-muted mb-1">{{ auth()->user()->email }}</p>
												<p class="text-muted mb-4">{{ auth()->user()->user_type }}</p>
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
	</div>
</div>
@endsection
@section('script')
<script type="text/javascript">
$(document).ready(function() {
	$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
});
</script>
@endsection

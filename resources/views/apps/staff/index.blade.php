@extends('layouts.index')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
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
									<div class="col-12">
										<div class="d-flex flex-column align-items-center justify-content-center p-4">
											<img src="{{ URL::asset('images/small-moph-logo-32x32.png') }}" class="rounded-circle shadow-2 img-thumbnail" alt="">
											<h5 class="mb-0 fw-700 text-center mt-2">
												{{ auth()->user()->username }}
												<small class="text-muted mb-0">{{ auth()->user()->user_type }}, {{ auth()->user()->email }}</small>
											</h5>
											<div class="text-center mt-2">
												<a href="javascript:void(0);" class="fs-sm" style="color:#3b5998"><i class="fal fa-circle"></i></a>
												<a href="javascript:void(0);" class="fs-sm" style="color:#38A1F3"><i class="fal fa-circle"></i></a>
												<a href="javascript:void(0);" class="fs-sm" style="color:#db3236"><i class="fal fa-circle"></i></a>
												<a href="javascript:void(0);" class="fs-sm" style="color:#0077B5"><i class="fal fa-circle"></i></a>
												<a href="javascript:void(0);" class="fs-sm" style="color:#000000"><i class="fal fa-circle"></i></a>
												<a href="javascript:void(0);" class="fs-sm" style="color:#00AFF0"><i class="fal fa-circle"></i></a>
												<a href="javascript:void(0);" class="fs-sm" style="color:#0063DC"><i class="fal fa-circle"></i></a>
											</div>
										</div>
									</div>
									<div class="col-12">
										<div class="text-center py-3">
											<div class="ml-3">
												<strong>ชื่อ-สกุล</strong>
												<p class="text-indigo-400">{{ auth()->user()->userStaff->first_name.' '.auth()->user()->userStaff->last_name }}</p>
											</div>
											<div class="mt-3 ml-3">
												<strong>ตำแหน่ง</strong>
												<p class="text-indigo-400">นักวิทยาศาสตร์การแพทย์</p>
											</div>
											<div class="mt-3 ml-3">
												<strong>สังกัด</strong>
												<p class="text-indigo-400">ศูนย์อ้างอิงทางห้องปฏิบัติการและพิษวิทยา</p>
											</div>
											<div class="mt-3 ml-3">
												<strong>หน้าที่รับผิดชอบ</strong>
												<p class="text-indigo-400">ผู้รับตัวอย่าง</p>
											</div>
										</div>
									</div>
									<div class="col-12">
										<div class="p-3 text-center">
											<a href="javascript:void(0);" class="btn-link font-weight-bold">แก้ไขข้อมูล</a>
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

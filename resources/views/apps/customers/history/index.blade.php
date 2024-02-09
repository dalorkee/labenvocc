@extends('layouts.index')
@section('token')<meta name="csrf-token" content="{{ csrf_token() }}">@endsection
@section('content')
<ol class="breadcrumb page-breadcrumb text-sm font-prompt">
	<li class="breadcrumb-item"><a href="javascript:void(0);">หน้าหลัก</a></li>
	<li class="breadcrumb-item">ประวัติของฉัน</li>
</ol>
<div class="row text-sm font-prompt">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
		<div id="panel-customer" class="panel">
			<div class="panel-hdr">
				<h2 class="text-primary"><i class="fal fa-list"></i>&nbsp;ประวัติของฉัน</h2>
				<div class="panel-toolbar">
					<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"><i class="fal fa-window-minimize"></i></button>
					<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"><i class="fal fa-expand"></i></button>
					<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"><i class="fal fa-times"></i></button>
				</div>
			</div>
			<div class="panel-container show">
				<div class="panel-content">
					<div class="row" id="js-contacts">
						<div class="col-xl-12">
							<div id="c_1" class="card border shadow-0 mb-g shadow-sm-hover" data-filter-tags="oliver kopyov">
								<div class="card-body border-faded border-top-0 border-left-0 border-right-0 rounded-top">
									<div class="d-flex flex-row align-items-center">
										<span class="status status-success mr-3">
											<span class="rounded-circle profile-image d-block " style="background-image:url('{{ URL::asset('assets/img/avatars/avatar-m.png') }}'); background-size: cover;"></span>
										</span>
										<div class="info-card-text flex-1">
											<a href="javascript:void(0);" class="fs-xl text-truncate text-truncate-lg text-info" data-toggle="dropdown" aria-expanded="false">
												{{ $data['customer_name'] }}
											</a>
											<span class="text-truncate text-truncate-xl">{{ $data['customer_type'] }}</span>
										</div>
										<button class="js-expand-btn btn btn-sm btn-default d-none" data-toggle="collapse" data-target="#c_1 > .card-body + .card-body" aria-expanded="false">
											<span class="collapsed-hidden">+</span>
											<span class="collapsed-reveal">-</span>
										</button>
									</div>
								</div>
								<div class="card-body p-0 collapse show">
									<div class="p-3">
										<a href="#" class="mt-1 d-block fs-sm fw-400 text-dark">
											<i class="fas fa-mobile-alt text-muted mr-2"></i> {{ $data['mobile'] }}
										</a>
										<a href="mailto:{{ $data['email'] }}" class="mt-1 d-block fs-sm fw-400 text-dark">
											<i class="fas fa-mouse-pointer text-muted mr-2"></i> {{ $data['email'] }}
										</a>
										<address class="fs-sm fw-400 mt-4 text-muted">
											<i class="fas fa-map-pin mr-2"></i> {{ $data['address']." ต.".$data['sub_district']." อ.".$data['district']." จ.".$data['province']." ".$data['postcode'] }}
										</address>
										{{-- <div class="d-flex flex-row">
											<a href="javascript:void(0);" class="mr-2 fs-xxl" style="color:#3b5998">
												<i class="fab fa-facebook-square"></i>
											</a>
											<a href="javascript:void(0);" class="mr-2 fs-xxl" style="color:#38A1F3">
												<i class="fab fa-twitter-square"></i>
											</a>
											<a href="javascript:void(0);" class="mr-2 fs-xxl" style="color:#0077B5">
												<i class="fab fa-linkedin"></i>
											</a>
										</div> --}}
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-12">
							<div id="c_2" class="card border shadow-0 mb-g shadow-sm-hover" data-filter-tags="sesha gray">
								<div class="card-body border-faded border-top-0 border-left-0 border-right-0 rounded-top">
									<div class="d-flex flex-row align-items-center">
										<div class="info-card-text flex-1">
											<a href="javascript:void(0);" class="fs-xl text-truncate text-truncate-lg text-info" data-toggle="dropdown" aria-expanded="false">
												ที่อยู่สำหรับส่งรายงานผลการตรวจ
											</a>
										</div>
										<button class="js-expand-btn btn btn-sm btn-default d-none" data-toggle="collapse" data-target="#c_2 > .card-body + .card-body" aria-expanded="false">
											<span class="collapsed-hidden">+</span>
											<span class="collapsed-reveal">-</span>
										</button>
									</div>
								</div>
								<div class="card-body p-0 collapse show">
									<div class="p-3">
										<a href="#" class="mt-1 d-block fs-sm fw-400 text-dark">
											<i class="fas fa-user-alt text-muted mr-2"></i> {{ $data['contact_name'] }}
										</a>
										<a href="#" class="mt-1 d-block fs-sm fw-400 text-dark">
											<i class="fas fa-mobile-alt text-muted mr-2"></i> {{ $data['contact_mobile'] }}
										</a>
										<a href="mailto:{{ $data['contact_email'] }}" class="mt-1 d-block fs-sm fw-400 text-dark">
											<i class="fas fa-mouse-pointer text-muted mr-2"></i> {{ $data['contact_email'] }}
										</a>
										<address class="fs-sm fw-400 mt-4 text-muted">
											<i class="fas fa-map-pin mr-2"></i> {{ $data['contact_addr']." ต.".$data['contact_sub_district']." อ.".$data['contact_district']." จ.".$data['contact_province']." ".$data['contact_postcode'] }}</address>
										{{-- <div class="d-flex flex-row">
											<a href="javascript:void(0);" class="mr-2 fs-xxl" style="color:#3b5998">
												<i class="fab fa-facebook-square"></i>
											</a>
											<a href="javascript:void(0);" class="mr-2 fs-xxl" style="color:#38A1F3">
												<i class="fab fa-twitter-square"></i>
											</a>
											<a href="javascript:void(0);" class="mr-2 fs-xxl" style="color:#0077B5">
												<i class="fab fa-linkedin"></i>
											</a>
										</div> --}}
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
<script type="text/javascript" src="{{ URL::asset('js/buttons.server-side.js') }}"></script>
<script type="text/javascript">$(document).ready(function(){$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});});</script>
@endsection

<!-- we need this logo when user switches to nav-function-top -->
<div class="page-logo">
	<a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-toggle="modal" data-target="#modal-shortcut">
		<img src="{{ URL::asset('assets/img/small-moph-logo.png') }}" alt="pj logo" aria-roledescription="logo">
		<span class="page-logo-text mr-1">{{ env('APP_NAME') }}</span>
		<span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
		<i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
	</a>
</div>
<!-- DOC: nav menu layout change shortcut -->
<div class="hidden-md-down dropdown-icon-menu position-relative">
	<a href="#" class="header-btn btn js-waves-off" data-action="toggle" data-class="nav-function-hidden" title="Hide Navigation">
		<i class="ni ni-menu"></i>
	</a>
	<ul>
		<li>
			<a href="#" class="btn js-waves-off" data-action="toggle" data-class="nav-function-minify" title="Minify Navigation">
				<i class="ni ni-minify-nav"></i>
			</a>
		</li>
		<li>
			<a href="#" class="btn js-waves-off" data-action="toggle" data-class="nav-function-fixed" title="Lock Navigation">
				<i class="ni ni-lock-nav"></i>
			</a>
		</li>
	</ul>
</div>
<!-- DOC: mobile button appears during mobile width -->
<div class="hidden-lg-up">
	<a href="#" class="header-btn btn press-scale-down" data-action="toggle" data-class="mobile-nav-on">
		<i class="ni ni-menu"></i>
	</a>
</div>
<div class="search">
	<form class="app-forms hidden-xs-down" role="search" action="page_search.html" autocomplete="off">
		<input type="text" id="search-field" placeholder="Search for anything" class="form-control" tabindex="1">
		<a href="#" onclick="return false;" class="btn-danger btn-search-close js-waves-off d-none" data-action="toggle" data-class="mobile-search-on">
			<i class="fal fa-times"></i>
		</a>
	</form>
</div>
<div class="ml-auto d-flex">
	<!-- activate app search icon (mobile) -->
	<div class="hidden-sm-up">
		<a href="#" class="header-icon" data-action="toggle" data-class="mobile-search-on" data-focus="search-field" title="Search">
			<i class="fal fa-search"></i>
		</a>
	</div>
	<!-- app notification -->
	{{-- @switch(auth()->user()->user_type)
		@case('staff')
			<div>
				<a href="#" class="header-icon" data-toggle="dropdown" title="You got 11 notifications">
					<i class="fal fa-bell"></i>
					<span class="badge badge-icon">2</span>
				</a>
				<div class="dropdown-menu dropdown-menu-animated dropdown-xl font-prompt">
					<div class="dropdown-header bg-trans-gradient d-flex justify-content-center align-items-center rounded-top mb-2">
						<h4 class="m-0 text-center color-white">2 New <small class="mb-0 opacity-80">Notifications</small></h4>
					</div>
					<ul class="nav nav-tabs nav-tabs-clean" role="tablist">
						<li class="nav-item w-100">
							<a class="nav-link px-4 fs-md js-waves-on fw-500" data-toggle="tab" href="#tab-messages" data-i18n="drpdwn.messages">Messages</a>
						</li>
					</ul>
					<div class="tab-content tab-notification">
						<div class="tab-pane active p-3 text-center">
							<h5 class="mt-4 pt-4 fw-500">
								<span class="d-block fa-3x pb-4 text-muted">
									<i class="ni ni-arrow-up text-gradient opacity-70"></i>
								</span> Select a tab above to activate
								<small class="mt-3 fs-b fw-400 text-muted">
									This blank page message helps protect your privacy, or you can show the first message here automatically through
									<a href="#">settings page</a>
								</small>
							</h5>
						</div>
						<div class="tab-pane" id="tab-messages" role="tabpanel">
							<div class="custom-scroll h-100">
								<ul class="notification">
									<li class="unread">
										<a href="#" class="d-flex align-items-center">
											<span class="status mr-2">
												<span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/demo/avatars/avatar-b.png')"></span>
											</span>
											<span class="d-flex flex-column flex-1 ml-1">
												<span class="name">อนุมัติ <span class="badge badge-success fw-n position-absolute pos-top pos-right mt-1">Approved</span></span>
												<span class="msg-a fs-sm">ตัวอย่างของคุณได้รับอนุมัติแล้ว</span>
												<span class="fs-nano text-muted mt-1">56 seconds ago</span>
											</span>
										</a>
									</li>
									<li class="unread">
										<a href="#" class="d-flex align-items-center">
											<span class="status mr-2">
												<span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/demo/avatars/avatar-a.png')"></span>
											</span>
											<span class="d-flex flex-column flex-1 ml-1">
												<span class="name">Adison Lee</span>
												<span class="msg-a fs-sm">Msed quia non numquam eius</span>
												<span class="fs-nano text-muted mt-1">2 minutes ago</span>
											</span>
										</a>
									</li>
									<li>
										<a href="#" class="d-flex align-items-center">
											<span class="status status-success mr-2">
												<span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/demo/avatars/avatar-b.png')"></span>
											</span>
											<span class="d-flex flex-column flex-1 ml-1">
												<span class="name">Oliver Kopyuv</span>
												<span class="msg-a fs-sm">Msed quia non numquam eius</span>
												<span class="fs-nano text-muted mt-1">3 days ago</span>
											</span>
										</a>
									</li>
									<li>
										<a href="#" class="d-flex align-items-center">
											<span class="status status-warning mr-2">
												<span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/demo/avatars/avatar-e.png')"></span>
											</span>
											<span class="d-flex flex-column flex-1 ml-1">
												<span class="name">Dr. John Cook PhD</span>
												<span class="msg-a fs-sm">Msed quia non numquam eius</span>
												<span class="fs-nano text-muted mt-1">2 weeks ago</span>
											</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="py-2 px-3 bg-faded d-block rounded-bottom text-right border-faded border-bottom-0 border-right-0 border-left-0">
						<a href="#" class="fs-xs fw-500 ml-auto">view all notifications</a>
					</div>
				</div>
			</div>
		@break
	@endswitch --}}
	<!-- app user menu -->
	<div>
		<a href="#" data-toggle="dropdown" title="drlantern@gotbootstrap.com" class="header-icon d-flex align-items-center justify-content-center ml-2">
			<img src="{{ URL::asset('images/avartar/avartar.png') }}" class="profile-image rounded-circle" alt="avatar">
			<!-- you can also add username next to the avatar with the codes below:
			<span class="ml-1 mr-1 text-truncate text-truncate-header hidden-xs-down">Me</span>
			<i class="ni ni-chevron-down hidden-xs-down"></i> -->
		</a>
		<div class="dropdown-menu dropdown-menu-animated dropdown-lg">
			<div class="dropdown-header bg-trans-gradient d-flex flex-row py-4 rounded-top">
				<div class="d-flex flex-row align-items-center mt-1 mb-1 color-white">
					<span class="mr-2">
						<img src="{{ asset('images/avartar/avartar.png') }}" class="rounded-circle profile-image" alt="avatar">
					</span>
					<div class="info-card-text">
						<div class="fs-lg text-truncate text-truncate-lg">{{ auth()->user()->name ?? '' }}</div>
						<span class="text-truncate text-truncate-md opacity-80">{{ auth()->user()->email ?? '' }}</span>
					</div>
				</div>
			</div>
			<div class="dropdown-divider m-0"></div>
			<a href="#" class="dropdown-item" data-toggle="modal" data-target=".js-modal-settings">
				<span data-i18n="drpdwn.settings">Settings</span>
			</a>
			<div class="dropdown-divider m-0"></div>
			<a href="#" class="dropdown-item" data-action="app-fullscreen">
				<span data-i18n="drpdwn.fullscreen">Fullscreen</span>
				<i class="float-right text-muted fw-n">F11</i>
			</a>
			<a href="#" class="dropdown-item" data-action="app-print">
				<span data-i18n="drpdwn.print">Print</span>
				<i class="float-right text-muted fw-n">Ctrl + P</i>
			</a>
			<div class="dropdown-divider m-0"></div>
			<form method="POST" action="{{ route('logout') }}">
				@csrf
				<a class="dropdown-item fw-500 pt-3 pb-3" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
					<span data-i18n="drpdwn.page-logout">Logout</span>
					<span class="float-right fw-n">&commat;{{ auth()->user()->username ?? 'pj' }}</span>
				</a>
			</form>
		</div>
	</div>
</div>

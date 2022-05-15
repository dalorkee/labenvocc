<div class="page-logo">
	<a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-toggle="modal" data-target="#modal-shortcut">
		<img src="{{ URL::asset('assets/img/small-moph-logo.png') }}" alt="PJX Apps" aria-roledescription="logo">
		<span class="page-logo-text mr-1">{{ env('APP_NAME') }}</span>
		<span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
		<i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
	</a>
</div>
<!-- BEGIN PRIMARY NAVIGATION -->
<nav id="js-primary-nav" class="primary-nav font-prompt" role="navigation">
	<div class="nav-filter">
		<div class="position-relative">
			<input type="text" id="nav_filter_input" placeholder="Filter menu" class="form-control" tabindex="0">
			<a href="#" onclick="return false;" class="btn-primary btn-search-close js-waves-off" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar">
				<i class="fal fa-chevron-up"></i>
			</a>
		</div>
	</div>
	<div class="info-card">
		<img src="{{ URL::asset('assets/img/d3.jpg') }}" class="profile-image rounded-circle" alt="avatar">
		<div class="info-card-text">
			<a href="#" class="d-flex align-items-center text-white">
				<span class="text-truncate text-truncate-sm d-inline-block">{{ auth()->user()->username ?? 'Guest' }}</span>
			</a>
			<span class="d-inline-block text-truncate text-truncate-sm">{{ auth()->user()->email ?? 'Role' }}</span>
		</div>
		<img src="{{ URL::asset('images/nav-bg.png') }}" class="cover" alt="cover">
		<a href="#" onclick="return false;" class="pull-trigger-btn" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar" data-focus="nav_filter_input">
			<i class="fal fa-angle-down"></i>
		</a>
	</div>
	<ul id="js-nav-menu" class="nav-menu nav-function-hidden">
		@switch(auth()->user()->user_type)
			@case('customer')
				<li class="nav-title">Specimen</li>
				<li class="active open">
					<a href="{{ route('customer.index') }}" title="คำขอส่งตัวอย่าง" data-filter-tags="home">
						<i class="fal fa-clipboard"></i>
						<span class="nav-link-text">คำขอส่งตัวอย่าง</span>
					</a>
				</li>
				<li>
					<a href="#" title="Upload" data-filter-tags="upload">
						<i class="fal fa-upload"></i>
						<span class="nav-link-text" data-i18n="nav.upload">ส่งตัวอย่าง(Upload)</span>
					</a>
					<ul>
						<li>
							<a href="{{ route('sampleupload.index',['order_id' => 'new']) }}" title="Biological" data-filter-tags="biological">
								<span class="nav-link-text" data-i18n="nav.biological">ตัวอย่างชีวภาพ</span>
							</a>
						</li>
						<li>
							<a href="{{ route('sampleupload.env') }}" title="Environment" data-filter-tags="environment"> <!-- รอแก้ route-->
								<span class="nav-link-text" data-i18n="nav.environment">ตัวอย่างสิ่งแวดล้อม</span>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-title">Common</li>
				<li>
					<a href="#" title="Application Intel" data-filter-tags="application intel">
						<i class="fal fa-download"></i>
						<span class="nav-link-text" data-i18n="nav.application_intel">ดาวน์โหลด</span>
					</a>
				</li>
				<li>
					<a href="#" title="Application Intel" data-filter-tags="application intel">
						<i class="fal fa-question-circle"></i>
						<span class="nav-link-text" data-i18n="nav.application_intel">คำถามที่พบบ่อย</span>
					</a>
				</li>
				<li>
					<a href="#" title="Application Intel" data-filter-tags="application intel">
						<i class="fal fa-book"></i>
						<span class="nav-link-text" data-i18n="nav.application_intel">เกี่ยวกับหน่วยงาน</span>
					</a>
				</li>
				<li>
					<a href="#" title="Application Intel" data-filter-tags="application intel">
						<i class="fal fa-map-marker-alt"></i>
						<span class="nav-link-text" data-i18n="nav.application_intel">ติดต่อหน่วยงาน</span>
					</a>
				</li>
				@break
			@case('root')
			@case('admin')
			@case('staff')
				<li class="nav-title">Navigation</li>
				<li class="active open">
					<a href="{{ route('staff.index') }}" title="หน้าหลัก" data-filter-tags="home">
						<i class="fal fa-home"></i>
						<span class="nav-link-text">หน้าหลัก</span>
					</a>
				</li>
				<li>
					<a href="#" title="งานรับตัวอย่าง" data-filter-tags="specimen">
						<i class="fal fa-cube"></i>
						<span class="nav-link-text">งานรับตัวอย่าง</span>
					</a>
				</li>
				<li>
					<a href="#" title="งานตรวจวิเคราะห์" data-filter-tags="verify">
						<i class="fal fa-flask"></i>
						<span class="nav-link-text">งานตรวจวิเคราะห์</span>
					</a>
				</li>
				<li>
					<a href="#" title="รายงานผล" data-filter-tags="report">
						<i class="fal fa-clipboard"></i>
						<span class="nav-link-text">รายงานผล</span>
					</a>
				</li>
				<li>
					<a href="#" title="งานทำลายตัวอย่าง" data-filter-tags="destroy">
						<i class="fal fa-burn"></i>
						<span class="nav-link-text">งานทำลายตัวอย่าง</span>
					</a>
				</li>
				<li class="nav-title">Administrator</li>
				<li>
					<a href="{{ route('office.index') }}" title="Application Intel" data-filter-tags="application intel">
						<i class="fal fa-cog"></i>
						<span class="nav-link-text" data-i18n="nav.application_intel">จัดการผู้ใช้</span>
					</a>
				</li>
			@break
		@endswitch
	</ul>
	<div class="filter-message js-filter-message bg-danger-600">aaa</div>
</nav>
<!-- END PRIMARY NAVIGATION -->

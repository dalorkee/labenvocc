<div class="page-logo">
	<a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-toggle="modal" data-target="#modal-shortcut">
		<img src="{{ URL::asset('assets/img/small-moph-logo.png') }}" alt="PJX Apps" aria-roledescription="logo">
		<span class="page-logo-text mr-1">Administrator</span>
		<span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
		<i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
	</a>
</div>
<nav id="js-primary-nav" class="primary-nav" role="navigation">
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
				<span class="text-truncate text-truncate-sm d-inline-block">{{ Auth::user()->username }}</span>
			</a>
			<span class="d-inline-block text-truncate text-truncate-sm">{{ Auth::user()->email }}</span>
		</div>
		<img src="{{ URL::asset('assets/img/card-backgrounds/cover-2-lg.png') }}" class="cover" alt="cover">
		<a href="#" onclick="return false;" class="pull-trigger-btn" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar" data-focus="nav_filter_input">
			<i class="fal fa-angle-down"></i>
		</a>
	</div>
	<ul id="js-nav-menu" class="nav-menu">
		<li class="nav-title">Administrator</li>
		<li>
			<a href="{{ route('admin.index') }}" title="Utilities" data-filter-tags="utilities">
				<i class="fal fa-users"></i>
				<span class="nav-link-text" data-i18n="nav.utilities">หน้าหลัก</span>
			</a>
		</li>
		<li>
			<a href="#" title="Utilities" data-filter-tags="utilities">
				<i class="fal fa-users"></i>
				<span class="nav-link-text" data-i18n="nav.utilities">จัดการผู้ใช้</span>
			</a>
		</li>
		<li>
			<a href="#" title="Tables" data-filter-tags="tables">
				<i class="fal fa-tasks"></i>
				<span class="nav-link-text" data-i18n="nav.tables">จัดการสิทธิ์</span>
			</a>
			<ul>
				<li>
					<a href="{{ route('roles.index')  }}" title="Roles" data-filter-tags="Roles">
						<span class="nav-link-text" data-i18n="nav.Roles">Role</span>
					</a>
				</li>
				<li>
					<a href="{{ route('permissions.index') }}" title="Permissions" data-filter-tags="Permissions">
						<span class="nav-link-text" data-i18n="nav.Permissions">Permission</span>
					</a>
				</li>
			</ul>
		</li>
	</ul>
	<div class="filter-message js-filter-message bg-success-600"></div>
</nav>


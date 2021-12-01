@extends('layouts.admin.index')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('vendor/jquery-smartwizard/css/smart_wizard_arrows.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('vendor/DataTables/DataTables-1.10.22/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('vendor/DataTables/Buttons-1.6.5/css/buttons.jqueryui.min.css') }}">
<link rel='stylesheet' type="text/css" href="{{ URL::asset('vendor/DataTables/Responsive-2.2.6/css/responsive.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('vendor/jquery-contextmenu/css/jquery.contextMenu.min.css') }}">
@endsection
@section('content')
<ol class="breadcrumb page-breadcrumb">
	<li class="breadcrumb-item"><a href="javascript:void(0);">Admin</a></li>
	<li class="breadcrumb-item">Users Customer Manage</li>
</ol>
<div class="subheader">
	<h1 class="subheader-title"><small>จัดการข้อมูลลูกค้า</small></h1>
</div>
<div class="fs-lg fw-300 p-5 bg-white border-faded rounded mb-g">
	<div class="frame-wrap">
		{{ $dataTable->table() }}
	</div>
</div>
@endsection
@section('script')
<script type="text/javascript" src="{{ URL::asset('vendor/DataTables/DataTables-1.10.22/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('vendor/DataTables/Buttons-1.6.5/js/dataTables.buttons.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('vendor/DataTables/Responsive-2.2.6/js/dataTables.responsive.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('vendor/jquery-contextmenu/js/jquery.contextmenu.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/buttons.server-side.js') }}"></script>
	{{ $dataTable->scripts() }}

<script>
	$(document).ready(function() {
		$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
		$.contextMenu({
			selector: '.usercus-manage-nav',
			trigger:'left',
			callback: function(key, options) {
				var userCusId = $(this).data('id');
				switch(key){
					case 'edit':
						let userCusUrl = '{{ route("users.edit", ":id") }}';
						userCusUrl = userCusUrl.replace(':id', userCusId);
						alert(userCusUrl);
						window.open(userCusUrl, '_self');
					break;
				}
			},
			items: {
				"edit": {name: "แก้ไข", icon: "fal fa-edit"},
				"sep1":"--------",
				"allow": {name: "อนุญาต", icon: "fal fa-lock-open-alt"},
				"deny": {name: "ไม่อนุญาต", icon: "fal fa-lock-alt"},
				"close": {name: "ปิดใช้งาน", icon: "fal fa-exclamation-triangle"},
				"delete": {name: "ลบ", icon: "fal fa-eraser"},
			}
		});
	});
</script>
@endsection

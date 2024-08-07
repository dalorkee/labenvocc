@extends('layouts.index')
@section('token')<meta name="csrf-token" content="{{ csrf_token() }}">@endsection
@section('style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('vendor/DataTables/DataTables-1.10.22/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('vendor/DataTables/Buttons-1.6.5/css/buttons.jqueryui.min.css') }}">
<link rel='stylesheet' type="text/css" href="{{ URL::asset('vendor/DataTables/Responsive-2.2.6/css/responsive.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('vendor/jquery-contextmenu/css/jquery.contextMenu.min.css') }}">
@endsection
@section('content')
<ol class="breadcrumb page-breadcrumb font-prompt">
	<li class="breadcrumb-item"><a href="#">Admin</a></li>
	<li class="breadcrumb-item">จัดการข้อมูลลูกค้า</li>
</ol>
<div class="subheader">
	<h1 class="subheader-title"><small>จัดการข้อมูลลูกค้า</small></h1>
</div>
<div class="fs-lg fw-300 p-5 bg-white border-faded rounded mb-g font-prompt">
	<div class="frame-wrap">
		{{ $dataTable->table() }}
	</div>
</div>
@endsection
@section('script')
<script type="text/javascript" src="{{ URL::asset('vendor/DataTables/DataTables-1.10.22/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('vendor/DataTables/Buttons-1.6.5/js/dataTables.buttons.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('vendor/DataTables/Responsive-2.2.6/js/dataTables.responsive.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('vendor/jquery-contextmenu/js/jquery.contextMenu.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/buttons.server-side.js') }}"></script>
{{ $dataTable->scripts() }}
<script type="text/javascript">
	$(document).ready(function() {
		$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
		$.contextMenu({
			selector: '.usercus-manage-nav',
			trigger:'left',
			callback: function(key, options) {
				var userCusId = $(this).data('id');
				switch(key){
					case 'edit':
						let userCusEditUrl = '{{ route("users.edit", ":id") }}';
						userCusEditUrl = userCusEditUrl.replace(':id', userCusId);
						window.open(userCusEditUrl, 'blank');
					break;
					case 'allow':
						let userCusAllowUrl = '{{ route("users.allow", ":id") }}';
						userCusAllowUrl = userCusAllowUrl.replace(':id', userCusId);
						window.open(userCusAllowUrl, '_self');
					break;
					case 'deny':
						let userCusDenyUrl = '{{ route("users.deny", ":id") }}';
						userCusDenyUrl = userCusDenyUrl.replace(':id', userCusId);
						window.open(userCusDenyUrl, '_self');
					break;
					case 'delete':
						let userCusDelUrl = '{{ route("users.destroy", ":id") }}';
						userCusDelUrl = userCusDelUrl.replace(':id', userCusId);
						window.open(userCusDelUrl, '_self');
					break;
					default :
						alert('ยังไม่เปิดใช้งาน');
					break;
				}
			},
			items: {
				"edit": {name: "แก้ไข", icon: "fal fa-edit"},
				"sep1":"--------",
				"allow": {name: "อนุญาต", icon: "fal fa-lock-open-alt"},
				"deny": {name: "ไม่อนุญาต", icon: "fal fa-lock-alt"},
				"delete": {name: "ลบ", icon: "fal fa-eraser"},
			}
		});
	});
</script>
@endsection

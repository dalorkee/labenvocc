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
	<li class="breadcrumb-item">User Staff Manage</li>
</ol>
<div class="subheader">
	<h1 class="subheader-title"><small>จัดการข้อมูลเจ้าหน้าที่</small></h1>
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
<script type="text/javascript" src="{{ URL::asset('vendor/jquery-contextmenu/js/jquery.contextMenu.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/buttons.server-side.js') }}"></script>
    {{ $dataTable->scripts() }}

<script>
	$(document).ready(function() {
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
		$.contextMenu({
            selector: '.userstaff-manage-nav',
            trigger:'left',
            callback: function(key, options) {
                var userStaffId = $(this).data('id');
                switch(key){
                    case 'edit':                       
                        let userStaffEditUrl = '{{ route("office.edit", ":id") }}';
                        userStaffEditUrl = userStaffEditUrl.replace(':id', userStaffId);                        
                        window.open(userStaffEditUrl, '_self');
                    break;
                    case 'allow':                       
                        let userStaffAllowUrl = '{{ route("office.allow", ":id") }}';
                        userStaffAllowUrl = userStaffAllowUrl.replace(':id', userStaffId);                        
                        window.open(userStaffAllowUrl, '_self');
                    break;
                    case 'deny':                       
                        let userStaffDenyUrl = '{{ route("office.deny", ":id") }}';
                        userStaffDenyUrl = userStaffDenyUrl.replace(':id', userStaffId);                        
                        window.open(userStaffDenyUrl, '_self');
                    break;
                    case 'delete':                       
                        let userStaffDeleteUrl = '{{ route("office.destroy", ":id") }}';
                        userStaffDeleteUrl = userStaffDeleteUrl.replace(':id', userStaffId);                        
                        window.open(userStaffDeleteUrl, '_self');
                    break;
                    default:
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
@extends('layouts.index')
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
	<li class="breadcrumb-item">Parameter Manage</li>
</ol>
<div class="subheader">
	<h1 class="subheader-title"><small>ตั้งค่าพารามิเตอร์</small></h1>
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
            selector: '.parameter-manage-nav',
            trigger:'left',
            callback: function(key, options) {
                var parameter_id = $(this).data('id');
                switch(key){
                    // case 'edit':
                    //     let parameter_edit_url = '{{ route("paramet.edit", ":id") }}';
                    //     parameter_edit_url = parameter_edit_url.replace(':id', parameter_id);
                    //     window.open(parameter_edit_url, '_self');
                    // break;
                    case 'allow':
                        let parameter_allow_url = '{{ route("paramet.allow", ":id") }}';
                        parameter_allow_url = parameter_allow_url.replace(':id', parameter_id);
                        window.open(parameter_allow_url, '_self');
                    break;
                    case 'deny':
                        let parameter_deny_url = '{{ route("paramet.deny", ":id") }}';
                        parameter_deny_url = parameter_deny_url.replace(':id', parameter_id);
                        window.open(parameter_deny_url, '_self');
                    break;
                    default:
                        alert('ยังไม่เปิดใช้งาน');
                    break;
                }
            },
            items: {
                // "edit": {name: "แก้ไข", icon: "fal fa-edit"},
                // "sep1":"--------",
                "allow": {name: "เปิดใช้งาน", icon: "fal fa-lock-open-alt"},
                "deny": {name: "ปิดใช้งาน", icon: "fal fa-lock-alt"},
            }
        });
	});
</script>
@endsection

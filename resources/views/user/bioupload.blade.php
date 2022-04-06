@extends('layouts.index')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('vendor/jquery-smartwizard/css/smart_wizard_arrows.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('vendor/DataTables/DataTables-1.10.22/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('vendor/DataTables/Buttons-1.6.5/css/buttons.jqueryui.min.css') }}">
<link rel='stylesheet' type="text/css" href="{{ URL::asset('vendor/DataTables/Responsive-2.2.6/css/responsive.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('vendor/jquery-contextmenu/css/jquery.contextMenu.min.css') }}">
<style>
    .btn-group {margin:0;padding:0;}
    .dt-buttons {display:flex;flex-direction:row;flex-wrap:wrap;justify-content:flex-end;}
    .dataTables_filter label {margin-top: 8px;}
    .dataTables_filter input:first-child {margin-top: -8px;}
    #order-table thead {background-color:#297FB0;color: white;}
    /* Extra small devices (phones, 600px and down) */
    @media only screen and (max-width:600px) {.pj-btn{position:absolute;top:10px;z-index:1;}}
    /* Small devices (portrait tablets and large phones, 600px and up) */
    @media only screen and (min-width:600px) {.pj-btn {position:absolute;top:10px;z-index:1;}}
    /* Medium devices (landscape tablets, 768px and up) */
    @media only screen and (min-width:768px) {.pj-btn {position:absolute;top:16px;z-index:1;}}
    /* Large devices (laptops/desktops, 992px and up) */
    @media only screen and (min-width:992px) {.pj-btn{position:absolute;top:16px;z-index:1;}}
    /* Extra large devices (large laptops and desktops, 1200px and up) */
    @media only screen and (min-width:1200px) {.pj-btn{position:absolute;top:16px;z-index:1;}}
</style>
@endsection
@section('content')
<ol class="breadcrumb page-breadcrumb text-sm font-prompt">
	<li class="breadcrumb-item"><a href="javascript:void(0);">ส่งตัวอย่าง(upload)</a></li>
	<li class="breadcrumb-item">นำเข้าข้อมูลตัวอย่าง</li>
    <li class="breadcrumb-item">ชีวภาพ</li>
</ol>
@if (Session::get('success'))
	<div class="alert alert-success">
		<p>{{ Session::get('success') }}</p>
	</div>
@elseif (Session::get('error'))
	<div class="alert alert-danger">
		<p>{{ Session::get('error') }}</p>
	</div>
@endif
<div class="row text-sm font-prompt">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
		<div id="panel-customer" class="panel">
			<div class="panel-hdr">
				<h2 class="text-gray-600"><i class="fal fa-list"></i>&nbsp;รายการข้อมูลชีวภาพ</h2>
				<div class="panel-toolbar">
					<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"><i class="fal fa-window-minimize"></i></button>
					<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"><i class="fal fa-expand"></i></button>
					<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"><i class="fal fa-times"></i></button>
				</div>
			</div>
			<div class="panel-container show">
				<div class="panel-content">
                    <form action="{{ route('sampleupload.bioimport') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="uploadbio">เลือกไฟล์</label>
                                <input type="file" name="uploadbio" class="form-control" id="uploadbio"/>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary upload">อัพโหลดไฟล์</button>
                    </form>
                </div>
                <hr>
                <div class="panel-content">
                    <div class="form-row">
                        ตารางรายการตกค้าง
                        <div class="col-md-12 mb-6">
                            <form action="" method="POST">
                                {{ $dataTable->table() }}
                                <div><button type="submit" class="btn btn-info checkbox">ส่งข้อมูล</button></div>
                            </form>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script type="text/javascript" src="{{ URL::asset('vendor/DataTables/DataTables-1.10.22/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('vendor/DataTables/Buttons-1.6.5/js/dataTables.buttons.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('vendor/DataTables/Responsive-2.2.6/js/dataTables.responsive.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('vendor/jquery-contextmenu/js/jquery.contextMenu.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/buttons.server-side.js') }}"></script>
<script type="text/javascript">$(document).ready(function(){$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});});</script>
{{ $dataTable->scripts() }}
<script>
	$(document).ready(function() {
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
		$.contextMenu({
            selector: '.bioupload-manage-nav',
            trigger:'left',
            callback: function(key, options) {
                var advId = $(this).data('id');
                switch(key){
                    case 'edit':
                        let advUrl = '{{ route("sampleupload.edit", ":id") }}';
                        advUrl = advUrl.replace(':id', advId);
                        window.open(advUrl, '_self');
                    break;
                    case 'delete':
                        let advDesUrl = '{{ route("sampleupload.destroy", ":id") }}';
                        advDesUrl = advDesUrl.replace(':id', advId);
                        window.open(advDesUrl, '_self');
                    break;
                }
            },
            items: {
                "edit": {name: "แก้ไข", icon: "fal fa-edit"},
                "sep1":"--------",
                "delete": {name: "ลบ", icon: "fal fa-eraser"},
            }
        });
        $('.checkbox').click(function(){
            var chkbio = [];
            $.each($("input[name='biobox']:checked"),function(){
                chkbio.push($(this).val());
            });
            let biourl = '{{ route("sampleupload.biocreate", ":id") }}';
            biourl = biourl.replace(':id',chkbio);
            alert(biourl);
            window.open(biourl,'_self');
        });
	});
</script>
@endsection

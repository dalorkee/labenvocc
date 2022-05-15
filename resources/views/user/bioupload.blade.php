@extends('layouts.index')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('style')
<link href="{{ URL::asset('css/pj-step.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css') }}" rel="stylesheet" type="text/css">
<style type="text/css">
.input-date:read-only{background:#fefefe!important}
</style>
@endsection
@section('content')
<ol class="breadcrumb page-breadcrumb text-sm font-prompt">
	<li class="breadcrumb-item"><a href="javascript:void(0);">ส่งตัวอย่าง(upload)</a></li>
    <li class="breadcrumb-item">ชีวภาพ</li>
    <li class="breadcrumb-item">ข้อมูลทั่วไป</li>
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
				<h2 class="text-gray-600"><i class="fal fa-clipboard"></i>&nbsp;คำขอส่งตัวอย่างชีวภาพ</h2>
				<div class="panel-toolbar">
					<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"><i class="fal fa-window-minimize"></i></button>
					<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"><i class="fal fa-expand"></i></button>
					<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"><i class="fal fa-times"></i></button>
				</div>
			</div>
			<div class="panel-container show">
				<form name="saveInfo" action="{{ route('customer.info.store') }}" method="POST" enctype="multipart/form-data">
					@csrf
					<input type="hidden" name="order_type" value="1">
					<input type="hidden" name="order_type_name" value="ตัวอย่างชีวภาพ">
					<div class="panel-content">
						<ul class="steps">
							<li class="active"><a href=""><i class="fal fa-user"></i> <span class="d-none d-sm-inline">ข้อมูลทั่วไป</span></a></li>
							<li class="undone"><p><i class="fal fa-user"></i> <span class="d-none d-sm-inline">พารามิเตอร์</span></p></li>
							<li class="undone"><p><i class="fal fa-user"></i> <span class="d-none d-sm-inline">ข้อมูลตัวอย่าง</span></p></li>
							<li class="undone"><p><i class="fal fa-user"></i> <span class="d-none d-sm-inline">ตรวจสอบข้อมูล</span></p></li>
						</ul>
						@switch ($auth->userCustomer->customer_type)
							@case('personal')
								<div class="form-row">
									<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
										<label class="form-label" for="personal_name">ผู้ส่งตัวอย่าง <span class="text-red-600">*</span></label>
										<input type="text" name="customer_name" value="{{$auth->userCustomer->first_name}} {{$auth->userCustomer->last_name}}" class="form-control" maxlength="60" readonly>
									</div>
								</div>
								@break
							@case('private')
							@case('government')
								<div class="form-row">
									<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
										<label class="form-label" for="office_name">หน่วยงานที่ส่งตัวอย่าง <span class="text-red-600">*</span></label>
										<input type="text" name="customer_name" value="{{$auth->userCustomer->first_name}} {{$auth->userCustomer->last_name}}" class="form-control" maxlength="80" readonly>
										@error('customer_name')
											<div class="invalid-feedback" role="alert">{{ $message }}</div>
										@enderror
									</div>
								</div>
								@break
						@endswitch
						<div class="form-row">                       {{--  edit to checked once --}}
							<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
								<label class="form-label" for="type_of_work">ประเภทงาน <span class="text-red-600">*</span></label>
								<div class="frame-wrap">
									<div class="custom-control custom-checkbox custom-control-inline">
										<input type="checkbox" name="type_of_work" value="1" class="custom-control-input type-of-work1" id="type_of_work1">
										<label class="custom-control-label" for="type_of_work1">บริการ</label>
									</div>
                                    <div class="custom-control custom-checkbox custom-control-inline">
										<input type="checkbox" name="type_of_work" value="2" class="custom-control-input type-of-work2" id="type_of_work2">
										<label class="custom-control-label" for="type_of_work2">วิจัย</label>
									</div>
                                    <div class="custom-control custom-checkbox custom-control-inline">
										<input type="checkbox" name="type_of_work" value="3" class="custom-control-input type-of-work3" id="type_of_work3">
										<label class="custom-control-label" for="type_of_work3">เฝ้าระวัง</label>
									</div>
                                    <div class="custom-control custom-checkbox custom-control-inline">
										<input type="checkbox" name="type_of_work" value="4" class="custom-control-input type-of-work4" id="type_of_work4">
										<label class="custom-control-label" for="type_of_work4">SRRT/สอบสวนโรค</label>
									</div>
                                    <div class="custom-control custom-checkbox custom-control-inline">
										<input type="checkbox" name="type_of_work" value="5" class="custom-control-input type-of-work5" id="type_of_work5">
										<label class="custom-control-label" for="type_of_work5">อื่นๆ</label>
									</div>
								</div>
							</div>
							<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
								<label class="form-label" for="type_of_work_other">ประเภทงานอื่นๆ ระบุ</label>
								<input type="text" name="type_of_work_other" value="" id="type_of_work_other" class="form-control">
								@error('type_of_work_other')
									<div class="invalid-feedback" role="alert">{{ $message }}</div>
								@enderror
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-6 col-lg-6 mb-3">
								<label class="form-label" for="book_no">เลขที่หนังสือนำส่ง</label>
								<input type="text" name="book_no" value="" class="form-control">
								@error('book_no')
									<div class="invalid-feedback" role="alert">{{ $message }}</div>
								@enderror
							</div>
							<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-6 col-lg-6 mb-3">
								<label class="form-label" for="book_date">ลงวันที่</label>
								<div class="input-group">
									<input type="text" name="book_date" value="" placeholder="เลือกวันที่" class="form-control input-date" id="datepicker_book_date" readonly >
									<div class="input-group-append">
										<span class="input-group-text fs-xl">
											<i class="fal fa-calendar-alt"></i>
										</span>
									</div>
								</div>
								@error('book_date_js')
									<div class="invalid-feedback" role="alert">{{ $message }}</div>
								@enderror
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-6 col-lg-6 mb-3">
								<label class="form-label" for="inputGroupFile01">แนบไฟล์หนังสือนำส่ง</label>
								<div class="input-group">
									<div class="custom-file">
										<input type="file" name="book_file" class="custom-file-input" id="bookFile01" aria-describedby="bookFile01">
										<label class="custom-file-label" for="bookFile01">no file</label>
									</div>
								</div>
								@error('book_file')
									<div class="invalid-feedback" role="alert">{{ $message }}</div>
								@enderror
							</div>
						</div>
					</div>
					<div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex flex-row align-items-center">
						<div class="form-row">
							<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
									<button type="submit" class="btn btn-primary ml-auto"><i class="fal fa-save"></i> บันทึกร่าง</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>




















<div class="row text-sm font-prompt">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
		<div id="panel-customer" class="panel">
			<div class="panel-hdr">
				<h2 class="text-gray-600"><i class="fal fa-list"></i>&nbsp;อัพโหลดไฟล์</h2>
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
			</div>
		</div>
	</div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div id="panel-customer" class="panel">
            <div class="panel-hdr">
				<h2 class="text-gray-600"><i class="fal fa-list"></i>&nbsp;รายการข้อมูลชีวภาพ</h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="form-row">
                        <input type="checkbox" id="chkall"/><span>&nbsp;เลือกทั้งหมด</span>
                        <div class="col-md-12 mb-6">
                            <form action="{{ route("sampleupload.biocreate") }}" method="POST">
                                @csrf
                                {{-- {{ $dataTable->table() }} --}}
                                <div><button type="submit" class="btn btn-info sendchkbio">ส่งข้อมูล</button></div>
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
{{-- {{ $dataTable->scripts() }} --}}
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
        $("#chkall").click(function(){
            if(this.checked){
                $('.biochk').prop('checked', true);
            }
            else{
                $('.biochk').prop('checked', false);
            }

        });
        // $('.sendchkbio').click(function(){
        //     var chkbio = [];
        //     $.each($("input[name='biobox']:checked"),function(){
        //         chkbio.push($(this).val());
        //     });
        //     let biourl = '{{ route("sampleupload.biocreate", ":id") }}';
        //     biourl = biourl.replace(':id',chkbio);
        //     alert(biourl);
        //     window.open(biourl,'_self');
        // });
	});
</script>
@endsection

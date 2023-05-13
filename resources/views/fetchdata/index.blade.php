@extends('layouts.index')
@section('token')<meta name="csrf-token" content="{{ csrf_token() }}">@endsection
@section('style')
<link href="{{ URL::asset('assets/css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('content')
<ol class="breadcrumb page-breadcrumb text-sm font-prompt">
	<li class="breadcrumb-item"><i class="fal fa-home mr-1"></i> <a href="{{ route('staff.index') }}">หน้าหลัก</a></li>
	<li class="breadcrumb-item">ดึงข้อมูล</li>
</ol>
<div class="row font-prompt">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
		<div class="row mt-3">
			<div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
				<div class="panel">
					<div class="panel-hdr">
						<h2>ข้อมูลผลการวิเคราะห์ทางห้องปฏิบัติการ สำหรับการเฝ้าระวัง</h2>
						<div class="panel-toolbar">
							<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"><i class="fal fa-window-minimize"></i></button>
							<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"><i class="fal fa-expand"></i></button>
							<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"><i class="fal fa-times"></i></button>
						</div>
					</div>
					<div class="panel-container">
						<div class="panel-content">
                            <form name="received_step01_frm" action="{{ route('sample.received.step01.post') }}" method="POST" enctype="multipart/form-data">
                                <div class="panel-content">
                                    <div class="form-row">
                                        <div class="col-4">
                                            <label class="form-label" for="sample_type">ระบุประเภทตัวอย่าง</label>
                                            <select class="custom-select" id="sample_type">
                                                <option value="0">เลือก</option>
                                                <option value="1">ชีวภาพ</option>
                                                <option value="2">สิ่งแวดล้อม</option>
                                                <option value="3">เลือกทั้งหมด</option>
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <label class="form-label" for="sample_character">ชนิดตัวอย่าง</label>
                                            <select class="custom-select" id="sample_character">
                                                <option value="0">เลือก</option>
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <label class="form-label" for="type_of_work">ประเภทงาน</label>
                                            <select class="custom-select" id="type_of_work">
                                                <option value="0">เลือก</option>
                                                <option value="1">บริการ</option>
                                                <option value="2">วิจัย</option>
                                                <option value="3">เฝ้าระวัง</option>
                                                <option value="4">สอบสวน</option>
                                                <option value="5">อื่นๆ</option>
                                                <option value="6">เลือกทั้งหมด</option>
                                            </select>                                            
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-row">                                        
                                        <div class="col-3 orgt">
                                            <label class="form-label" for="original_threat">ประเภทแหล่งมลพิษ</label>
                                            <select class="custom-select" id="original_threat" disabled>
                                                <option value="0">เลือก</option>
                                                <option value="1">ขยะ</option>
                                                <option value="2">มลพิษอากาศ</option>
                                                <option value="3">โลหะหนัก</option>
                                                <option value="4">เหมืองแร่</option>
                                                <option value="5">โรงไฟฟ้า</option>
                                                <option value="6">กิจการในชุมชน</option>
                                                <option value="7">อื่นๆ</option>
                                                <option value="8">เลือกทั้งหมด</option>
                                            </select>                                            
                                        </div>
                                        <div class="col-3 fact">
                                            <label class="form-label" for="factory_type">ประเภทสถานประกอบการ</label>
                                            <select class="custom-select" id="factory_type" disabled>
                                                <option value="0">เลือก</option>
                                                <option value="1">โรงโม่</option>
                                                <option value="2">ประกอบชิ้นส่วน</option>
                                                <option value="3">ปิโตรเคมี</option>
                                                <option value="4">อื่นๆ</option>
                                                <option value="5">เลือกทั้งหมด</option>
                                            </select>                                            
                                        </div>
                                        <div class="col-3 prm">
                                            <label class="form-label" for="parameter">พารามิเตอร์</label>
                                            <select class="custom-select" id="parameter">
                                                <option value="0">เลือก</option>
                                                <option value="1">ขยะ</option>
                                                <option value="2">มลพิษอากาศ</option>
                                                <option value="3">โลหะหนัก</option>
                                                <option value="4">เหมืองแร่</option>
                                                <option value="5">โรงไฟฟ้า</option>
                                                <option value="6">กิจการในชุมชน</option>
                                                <option value="7">อื่นๆ</option>
                                                <option value="8">เลือกทั้งหมด</option>
                                            </select>                                            
                                        </div>
                                        <div class="col-3 prmg">
                                            <label class="form-label" for="parameter_group">กลุ่มพารามิเตอร์</label>
                                            <select class="custom-select" id="parameter_group" disabled>
                                                <option value="0">เลือก</option>
                                                <option value="1">ขยะ</option>
                                                <option value="2">มลพิษอากาศ</option>
                                                <option value="3">โลหะหนัก</option>
                                                <option value="4">เหมืองแร่</option>
                                                <option value="5">โรงไฟฟ้า</option>
                                                <option value="6">กิจการในชุมชน</option>
                                                <option value="7">อื่นๆ</option>
                                                <option value="8">เลือกทั้งหมด</option>
                                            </select>                                            
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-row">
                                        <div class="col-4">
                                            <label class="form-label" for="province">จังหวัด</label>
                                            <select class="custom-select" id="province">
                                                <option value="0">เลือก</option>
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <label class="form-label" for="district">อำเภอ</label>
                                            <select class="custom-select" id="district">
                                                <option value="0">เลือก</option>
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <label class="form-label" for="sub_district">ตำบล</label>
                                            <select class="custom-select" id="sub_district">
                                                <option value="0">เลือก</option>
                                            </select>                                            
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-row">
                                        <div class="col-6">
                                            <label class="form-label" for="datepicker">ระบุช่วงเวลา</label>
                                            <div class="col-12">
                                                <div class="input-daterange input-group" id="datepicker">
                                                    <input type="text" class="form-control" name="date_start">
                                                    <div class="input-group-append input-group-prepend">
                                                        <span class="input-group-text fs-xl">
                                                            <i class="fal fa-ellipsis-h"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control" name="date_end">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex flex-row align-items-center">       
                                    <button class="btn btn-primary ml-auto" type="submit">Submit</button>
                                </div>
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
<script type="text/javascript" src="{{ URL::asset('assets/js/formplugins/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
	    $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
    });
</script>
<script type="text/javascript">
    var controls = {
        leftArrow: '<i class="fal fa-angle-left" style="font-size: 1.25rem"></i>',
        rightArrow: '<i class="fal fa-angle-right" style="font-size: 1.25rem"></i>'
    }
    var runDatePicker = function(){
        $('#datepicker').datepicker({
            todayHighlight: true,
            templates: controls
        });
    }
    $(document).ready(function(){
        runDatePicker();
        $('.orgt').hide();
        $('.fact').hide();
        $('.prmg').hide();
        $('#sample_type').on("click", function(){
            var st = this.value;
            if(st == '1'){
                $('.orgt').show();                
                $('.fact').hide();
                $('#original_threat').prop('disabled', false);
                $('#factory_type').prop('disabled', true);
            }
            else if(st == '2'){
                $('.fact').show();
                $('.orgt').hide();
                $('#original_threat').prop('disabled', true);
                $('#factory_type').prop('disabled', false);
            }
            else if(st == '3' || st == '0'){
                $('.orgt').show();
                $('.fact').show();
                $('#original_threat').prop('disabled', false);
                $('#factory_type').prop('disabled', false);
            }
            else{
                $('.orgt').hide();
                $('.fact').hide();
                $('#original_threat').prop('disabled', true);
                $('#factory_type').prop('disabled', true);
            }
            if(st != ''){
                $.ajax({
				method: "POST",
				url: "{{ route('register.department.v2') }}",
				dataType: "html",
				data: {id:st},
				success: function(response) {
					$("#sample_location_place_department").html(response);
				},
				error: function(jqXhr, textStatus, errorMessage) {
					alert('GovDept error: ' + jqXhr.status + errorMessage);
				}
			});
            }
        });
        $('#parameter').on("click", function(){
            var prmt = this.value;
            if(prmt != '0'){
                $('.prmg').show();
                $('#parameter_group').prop('disabled', false);
            }
            else{
                $('.prmg').hide();
                $('#parameter_group').prop('disabled', true);
            }
        });
    });
</script>
@endsection

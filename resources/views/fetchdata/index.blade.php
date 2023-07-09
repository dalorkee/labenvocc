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
                            <form name="fetch_date" action="{{ route('fetchdata.datafetch') }}" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">                                
                                <div class="panel-content">
                                    <div class="form-row">
                                        <div class="col-4">
                                            <label class="form-label" for="sample_type">ระบุประเภทตัวอย่าง</label>
                                            <select class="custom-select" id="sample_type" name="sample_type">
                                                <option value="">เลือก</option>
                                                <option value="1">ชีวภาพ</option>
                                                <option value="2">สิ่งแวดล้อม</option>                                                
                                            </select>
                                        </div>
                                        <div class="col-4 sample_character">
                                            <label class="form-label" for="sample_character">ชนิดตัวอย่าง</label>
                                            <select class="custom-select" id="sample_character" name="sample_character">
                                                <option value="seall">เลือกทั้งหมด</option>
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <label class="form-label" for="type_of_work">ประเภทงาน</label>
                                            <select class="custom-select" id="type_of_work" name="type_of_work">
                                                <option value="seall">เลือกทั้งหมด</option>
                                                <option value="1">บริการ</option>
                                                <option value="2">วิจัย</option>
                                                <option value="3">เฝ้าระวัง</option>
                                                <option value="4">สอบสวน</option>
                                                <option value="5">อื่นๆ</option>
                                            </select>                                            
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-row">                                        
                                        <div class="col-3 orgt">
                                            <label class="form-label" for="original_threat">ประเภทแหล่งมลพิษ</label>
                                            <select class="custom-select" id="original_threat" name="original_threat" disabled>
                                                <option value="seall">เลือกทั้งหมด</option>
                                                <option value="1">ขยะ</option>
                                                <option value="2">มลพิษอากาศ</option>
                                                <option value="3">โลหะหนัก</option>
                                                <option value="4">เหมืองแร่</option>
                                                <option value="5">โรงไฟฟ้า</option>
                                                <option value="6">กิจการในชุมชน</option>
                                                <option value="7">อื่นๆ</option>
                                            </select>                                            
                                        </div>
                                        <div class="col-3 fact">
                                            <label class="form-label" for="factory_type">ประเภทสถานประกอบการ</label>
                                            <select class="custom-select" id="factory_type" name="factory_type" disabled>
                                                <option value="seall">เลือกทั้งหมด</option>
                                                <option value="1">โรงโม่</option>
                                                <option value="2">ประกอบชิ้นส่วน</option>
                                                <option value="3">ปิโตรเคมี</option>
                                                <option value="4">อื่นๆ</option>
                                            </select>                                            
                                        </div>
                                        <div class="col-3 prmg">
                                            <label class="form-label" for="parameter_group">กลุ่มพารามิเตอร์</label>
                                            <select class="custom-select" id="parameter_group" name="parameter_group">
                                                <option value="seall">เลือกทั้งหมด</option>
                                                <option value="1">กลุ่มกรด ด่าง/โลหะอัลคาไลน์</option>
                                                <option value="2">กลุ่มจุลชีววิยา</option>
                                                <option value="3">กลุ่มฝุ่นซิลิก้า</option>
                                                <option value="4">กลุ่มสารอินทรีย์ระเหย</option>
                                                <option value="5">กลุ่มแร่ใยหิน</option>
                                                <option value="6">กลุ่มโลหะหนัก</option>
                                                <option value="7">กลุ่มอื่นๆ</option>
                                            </select>                                            
                                        </div>
                                        <div class="col-3 prm">
                                            <label class="form-label" for="parameter">พารามิเตอร์</label>
                                            <select class="custom-select" id="parameter" name="parameter" disabled>
                                                <option value="seall">เลือกทั้งหมด</option>
                                            </select>                                            
                                        </div>                                        
                                    </div>
                                    <hr>
                                    <div class="form-row">
                                        <div class="col-4">
                                            <label class="form-label" for="province">จังหวัด</label>
                                            <select class="custom-select" id="province" name="province">
                                                <option value="seall">เลือกทั้งหมด</option>
                                            @foreach ($provinces as $province)
                                                <option value="{{ $province->province_id }}">{{ $province->province_name }}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <label class="form-label" for="district">อำเภอ</label>
                                            <select class="custom-select" id="district" name="district">
                                                <option value="seall">เลือกทั้งหมด</option>
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <label class="form-label" for="sub_district">ตำบล</label>
                                            <select class="custom-select" id="sub_district" name="sub_district">
                                                <option value="seall">เลือกทั้งหมด</option>
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

    $(document).ready(function(){
        var controls = {
            leftArrow: '<i class="fal fa-angle-left" style="font-size: 1.25rem"></i>',
            rightArrow: '<i class="fal fa-angle-right" style="font-size: 1.25rem"></i>'
        }
        $('#datepicker').datepicker({
            autoclose: true,
            /*calendarWeeks: true,*/
            clearBtn: true,
            todayHighlight: true,
            todayBtn: "linked",
            templates: controls,
            format: "dd/mm/yyyy",
            startDate: "-5y",
            endDate: "0d"

        });
        $('.orgt').hide();
        $('.fact').hide();
        $('.prm').hide();
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
            else if(st == ''){
                $('#sample_character').find('option').remove().end().append('<option value="seall">เลือกทั้งหมด</option>');
                $('.orgt').hide();
                $('.fact').hide();
                $('#original_threat').prop('disabled', true);
                $('#factory_type').prop('disabled', true);
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
                    url: "{{ route('fetchdata.sampletype') }}",
                    dataType: "html",
                    data: {id:st},
                    success: function(response) {
                        $("#sample_character").html(response);
                    },
                    error: function(jqXhr, textStatus, errorMessage) {
                        alert('Sample Type error: ' + jqXhr.status + errorMessage);
                    }
			    });
            }
        });
        $('#parameter_group').on("click", function(){
            var prmt = this.value;
            if(prmt >= '0'){
                $('.prm').show();
                $('#parameter').prop('disabled', false);
            }
            else{
                $('.prm').hide();
                $('#parameter').prop('disabled', true);
            }
            if(prmt != ''){
                $.ajax({
                    method: "POST",
                    url: "{{ route('fetchdata.parameter') }}",
                    dataType: "html",
                    data: {id:prmt},
                    success: function(response) {
                        $("#parameter").html(response);
                    },
                    error: function(jqXhr, textStatus, errorMessage) {
                        alert('Group Parameter error: ' + jqXhr.status + errorMessage);
                    }
			    });
            }
        });
        $('#province').on("click", function(){
            var province = this.value;
            if(province != ''){
                $.ajax({
                    method: "POST",
                    url: "{{ route('fetchdata.district') }}",
                    dataType: "html",
                    data: {id:province},
                    success: function(response) {
                        $("#district").html(response);
                    },
                    error: function(jqXhr, textStatus, errorMessage) {
                        alert('District data error: ' + jqXhr.status + errorMessage);
                    }
			    });
            }
        });
        $('#district').on("click", function(){
            var district = this.value;
            if(district != ''){
                $.ajax({
                    method: "POST",
                    url: "{{ route('fetchdata.subdistrict') }}",
                    dataType: "html",
                    data: {id:district},
                    success: function(response) {
                        $("#sub_district").html(response);
                    },
                    error: function(jqXhr, textStatus, errorMessage) {
                        alert('Sub District data error: ' + jqXhr.status + errorMessage);
                    }
			    });
            }
        });
    });
</script>
@endsection

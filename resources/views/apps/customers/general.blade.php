@extends('layouts.index')
@section('style')
<style>
.steps {
  list-style-type: none;
  padding: 0;
}
.steps li {
  display: inline-block;
  margin-bottom: 3px;
}
.steps li a, .steps li p {
  background: #e5f4fd;
  padding: 8px 20px 8px 8px;
  color: #0077bf;
  display: block;
  font-size: 14px;
  font-weight: bold;
  position: relative;
  text-indent: 12px;
}
.steps li a:hover, .steps li p:hover {
  text-decoration: none;
}
.steps li a:before, .steps li p:before {
  border-bottom: 18px solid transparent;
  border-left: 12px solid #fff;
  border-top: 18px solid transparent;
  content: "";
  height: 0;
  position: absolute;
  left: 0;
  top: 50%;
  width: 0;
  margin-top: -18px;
}
.steps li a:after, .steps li p:after {
  border-bottom: 18px solid transparent;
  border-left: 12px solid #e5f4fd;
  border-top: 18px solid transparent;
  content: "";
  height: 0;
  position: absolute;
  /*right: -12px;*/
  left:100%;
  top: 50%;
  width: 0;
  margin-top: -18px;
  z-index: 1;
}
.steps li.active a, .steps li.active p {
  background: #0077bf;
  color: #fff;
}
.steps li.active a:after, .steps li.active p:after {
  border-left: 12px solid #0077bf;
}
.steps li.undone a, .steps li.undone p {
  background: #eee;
  color: #333;
}
.steps li.undone a:after, .steps li.undone p:after {
  border-left: 12px solid #eee;
}
.steps li.undone p {
  color: #aaa;
}
</style>
@endsection
@section('content')
<ol class="breadcrumb page-breadcrumb text-sm font-prompt">
	<li class="breadcrumb-item"><a href="javascript:void(0);">คำขอส่งตัวอย่าง</a></li>
	<li class="breadcrumb-item">ข้อมูลทั่วไป</li>
</ol>
<div class="row text-sm font-prompt">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
		<div id="panel-customer" class="panel">
			<div class="panel-hdr">
				<h2 class="text-gray-600"><i class="fal fa-clipboard"></i>&nbsp;คำขอส่งตัวอย่าง</h2>
				<div class="panel-toolbar">
					<button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
					<button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
					<button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
				</div>
			</div>
			<div class="panel-container show">
				<div class="panel-content">


                    <ul class="steps">
                        <li class="active"><a href=""><i class="fal fa-user"></i> <span class="d-none d-sm-inline">ข้อมูลทั่วไป</span></a></li>
                        <li class="undone"><p><i class="fal fa-user"></i> <span class="d-none d-sm-inline">พารามิเตอร์</span></p></li>
                        <li class="undone"><p><i class="fal fa-user"></i> <span class="d-none d-sm-inline">ข้อมูลตัวอย่าง</span></p></li>
                        <li class="undone"><p><i class="fal fa-user"></i> <span class="d-none d-sm-inline">ตรวจสอบข้อมูล</span></p></li>
                    </ul>

                    <form>
                    <section>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="form-label" for="id_card">หน่วยงานที่ส่งตัวอย่าง <span class="text-red-600">*</span></label>
                                <input type="text" name="id_card" id="id_card" value="{{ old('id_card') }}" class="form-control @error('id_card') is-invalid @enderror" required>
                                @error('id_card')
                                    <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="form-label" for="firstname">1.3 ชื่อ <span class="text-red-600">*</span></label>
                                <input type="text" name="firstname" value="{{ old('firstname') }}" class="form-control @error('firstname') is-invalid @enderror" required>
                                @error('firstname')
                                    <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="lastname">1.4 นามสกุล <span class="text-red-600">*</span></label>
                                <input type="text" name="lastname" value="{{ old('lastname') }}" class="form-control @error('lastname') is-invalid @enderror" required>
                                @error('lastname')
                                    <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="form-label" for="mobile">1.5 โทรศัพท์เคลื่อนที่ <span class="text-red-600">*</span></label>
                                <input type="text" name="mobile" value="{{ old('mobile') }}" class="form-control @error('mobile') is-invalid @enderror" required>
                                @error('moblie')
                                    <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="email">1.6 อีเมล์ <span class="text-red-600">*</span></label>
                                <input type="email" name="email" value="{{ old('email') }}" id="email" class="form-control @error('email') is-invalid @enderror" required>
                                @error('email')
                                    <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </section>
                    </form>



				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script>
$(document).ready(function() {

var back = $(".prev");
var next = $(".next");
var steps = $(".step");

next.bind("click", function() {
  $.each(steps, function(i) {
    if (!$(steps[i]).hasClass('current') && !$(steps[i]).hasClass('done')) {
      $(steps[i]).addClass('current');
      $(steps[i - 1]).removeClass('current').addClass('done');
      return false;
    }
  })
});
back.bind("click", function() {
  $.each(steps, function(i) {
    if ($(steps[i]).hasClass('done') && $(steps[i + 1]).hasClass('current')) {
      $(steps[i + 1]).removeClass('current');
      $(steps[i]).removeClass('done').addClass('current');
      return false;
    }
  })
});

})
</script>
@endsection

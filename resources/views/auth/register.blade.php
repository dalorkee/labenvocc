@extends('layouts.guest.index')
@section('style')
<link rel="stylesheet" href="{{ URL::asset('assets/css/ionicons.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/multi_step_form.css') }}">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
.select2 {
	width:100%!important;
}
.select2-selection { overflow: hidden; }
.select2-selection__rendered { white-space: normal; word-break: break-all; }
.select2-selection__rendered {
	line-height: 40px !important;
}
.select2-container .select2-selection--single {
	height: 40px !important;
	border: 1px solid #e1e1e1;
}
.select2-selection__arrow {
	height: 40px !important;
}
</style>

@endsection
@section('content')
<article>
	<section class="multi_step_form">  
		<form id="msform"> 
			<div class="tittle">
				<h2>ลงทะเบียนใช้งาน</h2>
				<p>โปรดกรอกข้อมูลและตรวจสอบให้ถูกต้องทุกขั้นตอน</p>
			</div>
			<ul id="progressbar">
				<li class="active">ข้อมูลหน่วยงาน</li>
				<li>ข้อมูลผู้รับบริการ</li>
				<li>ข้อมูลติดต่อ</li>
				<li>บัญชีผู้ใช้</li>
			</ul>
			<fieldset>
				<h3>ข้อมูลหน่วยงาน</h3>
				<h4>1. ข้อมูลทั่วไปของผู้รับบริการ</h4> 
				<div class="form-row pb-4"> 
					<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
						<label for="simpleinput" class="form-label">ประเภทหน่วยงาน <span class="text-red-600">*</span></label>
						<div class="frame-wrap">
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" class="custom-control-input" id="defaultInline1">
								<label class="custom-control-label" for="defaultInline1">หน่วยงานภาครัฐ</label>
							</div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" class="custom-control-input" id="defaultInline2">
								<label class="custom-control-label" for="defaultInline2">หน่วยงานรัฐวิสาหกิจ</label>
							</div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" class="custom-control-input" id="defaultInline3">
								<label class="custom-control-label" for="defaultInline3">หน่วยงานเอกชน</label>
							</div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" class="custom-control-input" id="defaultInline4">
								<label class="custom-control-label" for="defaultInline4">สถานประกอบการ</label>
							</div>
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
						<label for="simpleinput" class="form-label">ชื่อหน่วยงาน <span class="text-red-600">*</span></label>
						<input type="text" id="simpleinput" class="form-control">
					</div>
					<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
						<label class="form-label" for="simpleinput">รหัสหน่วยงาน</label>
						<input type="text" id="simpleinput" class="form-control">
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
						<label for="simpleinput" class="form-label">หมายเลขผู้เสียภาษี <span class="text-red-600">*</span></label>
						<input type="text" id="simpleinput" class="form-control">
					</div>
					<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
						<label class="form-label" for="simpleinput">รหัสหน่วยงาน</label>
						<input type="text" id="simpleinput" class="form-control">
					</div>
				</div>

				<div class="form-row pb-4"> 
					<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
						<label for="simpleinput" class="form-label">ประเภทหน่วยงาน</label>
						<div class="frame-wrap">
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" class="custom-control-input" id="x1">
								<label class="custom-control-label" for="x1">หน่วยงานภาครัฐ</label>
							</div>
						</div>
					</div>
				</div>

				<div class="form-group form-row">
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
						<div class="form-group">
							<label class="form-label">จังหวัด</label>
							<select class="form-control input-lg" id="mySelect">
								<option value="">-- โปรดเลือก --</option>
								<option>สถานพยาบาล</option>
								<option>ด่านควบคุมโรค</option>
								<option>อื่นๆ โปรดระบุ</option>
							</select>	
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
						<div class="form-group">
							<label class="form-label">อำเภอ</label>
							<select class="form-control input-lg" id="mySelect1">
								<option>xyx</option>
								<option>yyx</option>
							</select>	
						</div>
					</div>
				</div>

				<button type="button" class="action-button previous_button">Back</button>
				<button type="button" class="next action-button">Continue</button>
			</fieldset>

			<fieldset>
				<h3>ข้อมูลผู้รับบริการ</h3>
				<button type="button" class="action-button previous previous_button">Back</button>
				<button type="button" class="next action-button">Continue</button>  
			</fieldset> 

			<fieldset>
				<h3>ข้อมูลติดต่อ</h3>
				<button type="button" class="action-button previous previous_button">Back</button>
				<button type="button" class="next action-button">Continue</button>  
			</fieldset>

			<fieldset>
				<h3>บัญชีผู้ใช้</h3>
				<button type="button" class="action-button previous previous_button">Back</button> 
				<a href="#" class="action-button">Finish</a> 
			</fieldset>
		</form>
	</section> 
</article>
@endsection
@section('script')

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
function matchCustom(params, data) {
	// If there are no search terms, return all of the data
	if ($.trim(params.term) === '') {
	  return data;
	}

	// Do not display the item if there is no 'text' property
	if (typeof data.text === 'undefined') {
	  return null;
	}

	// `params.term` should be the term that is used for searching
	// `data.text` is the text that is displayed for the data object
	if (data.text.indexOf(params.term) > -1) {
	  var modifiedData = $.extend({}, data, true);
	  modifiedData.text += ' (matched)';

	  // You can return modified objects from here
	  // This includes matching the `children` how you want in nested data sets
	  return modifiedData;
	}

	// Return `null` if the term should not be displayed
	return null;
}
</script>
<script>
$(document).ready(function(){
	$("#mySelect").select2();
	$("#mySelect1").select2();
});
</script>
<script>
 (function($) {
		"use strict";  
		
		//* Form js
		function verificationForm(){
				//jQuery time
				var current_fs, next_fs, previous_fs; //fieldsets
				var left, opacity, scale; //fieldset properties which we will animate
				var animating; //flag to prevent quick multi-click glitches

				$(".next").click(function () {
						if (animating) return false;
						animating = true;

						current_fs = $(this).parent();
						next_fs = $(this).parent().next();

						//activate next step on progressbar using the index of next_fs
						$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

						//show the next fieldset
						next_fs.show();
						//hide the current fieldset with style
						current_fs.animate({
								opacity: 0
						}, {
								step: function (now, mx) {
										//as the opacity of current_fs reduces to 0 - stored in "now"
										//1. scale current_fs down to 80%
										scale = 1 - (1 - now) * 0.2;
										//2. bring next_fs from the right(50%)
										left = (now * 50) + "%";
										//3. increase opacity of next_fs to 1 as it moves in
										opacity = 1 - now;
										current_fs.css({
												'transform': 'scale(' + scale + ')',
												'position': 'absolute'
										});
										next_fs.css({
												'left': left,
												'opacity': opacity
										});
								},
								duration: 800,
								complete: function () {
										current_fs.hide();
										animating = false;
								},
								//this comes from the custom easing plugin
								easing: 'easeInOutBack'
						});
				});

				$(".previous").click(function () {
						if (animating) return false;
						animating = true;

						current_fs = $(this).parent();
						previous_fs = $(this).parent().prev();

						//de-activate current step on progressbar
						$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

						//show the previous fieldset
						previous_fs.show();
						//hide the current fieldset with style
						current_fs.animate({
								opacity: 0
						}, {
								step: function (now, mx) {
										//as the opacity of current_fs reduces to 0 - stored in "now"
										//1. scale previous_fs from 80% to 100%
										scale = 0.8 + (1 - now) * 0.2;
										//2. take current_fs to the right(50%) - from 0%
										left = ((1 - now) * 50) + "%";
										//3. increase opacity of previous_fs to 1 as it moves in
										opacity = 1 - now;
										current_fs.css({
												'left': left
										});
										previous_fs.css({
												'transform': 'scale(' + scale + ')',
												'opacity': opacity
										});
								},
								duration: 800,
								complete: function () {
										current_fs.hide();
										animating = false;
								},
								//this comes from the custom easing plugin
								easing: 'easeInOutBack'
						});
				});

				$(".submit").click(function () {
						return false;
				})
		}; 
		/*Function Calls*/  
		verificationForm ();


})(jQuery);
</script>
@endsection
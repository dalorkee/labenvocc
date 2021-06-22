@extends('layouts.guest.index')
@section('style')
<link href="{{ URL::asset('css/app.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/css/ionicons.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/multi_step_form.css') }}" rel="stylesheet">
<link href="{{ URL::asset('vendor/select2/css/select2.min.css') }}" rel="stylesheet">
<style>
.select2{width:100%!important;}
.select2-selection{overflow:hidden;}
.select2-selection__rendered{white-space:normal;word-break:break-all;}
.select2-selection__rendered{line-height:38px!important;}
.select2-container .select2-selection--single{height:37px!important;border:1px solid #e1e1e1;}
.select2-selection__arrow{height:36px!important;}
.custom-control-label {
	font-size: 1.175em;
}
</style>
@endsection
@section('content')
<article>
	<section class="multi_step_form">
		<form id="msform" class="w-full"> 
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
				<div class="mt-0 sm:mt-0">
					<div class="md:grid md:grid-cols-1">
						<div class="mt-2 md:mt-0 md:col-span-2">
							<div class="shadow overflow-hidden sm:rounded-md">
								<div class="px-4 py-5 bg-white sm:p-6">
									<div class="grid grid-cols-6 gap-6">
										<div class="col-span-6 sm:col-span-3 mb-4">
											<label for="simpleinput" class="block text-base font-medium text-gray-700">ประเภทหน่วยงาน <span class="text-red-600">*</span></label>
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
											</div>
										</div>
										<div class="col-span-6 sm:col-span-6">
											<label for="simpleinput" class="block text-base font-medium text-gray-700">ชนิดหน่วยงาน <span class="text-red-600">*</span></label>
											<div class="frame-wrap">
												<div class="custom-control custom-checkbox custom-control-inline">
													<input type="checkbox" class="custom-control-input" id="defaultInline4">
													<label class="custom-control-label" for="defaultInline4">สถานประกอบการ</label>
												</div>
											</div>
										</div>
										<div class="col-span-6 sm:col-span-3 md:ml-4">
											<label for="first_name" class="block text-sm font-medium text-gray-700">ชื่อหน่วยงาน</label>
											<input type="text" name="first_name" id="first_name" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
										</div>
										<div class="col-span-6 sm:col-span-3 md:mr-4">
											<label for="last_name" class="block text-sm font-medium text-gray-700">รหัสหน่วยงาน</label>
											<input type="text" name="last_name" id="last_name" autocomplete="family-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
										</div>
										<div class="col-span-6 sm:col-span-6">
											<div class="frame-wrap">
												<div class="custom-control custom-checkbox custom-control-inline">
													<input type="checkbox" class="custom-control-input" id="defaultInline5">
													<label class="custom-control-label" for="defaultInline5">สถานพยาบาล</label>
												</div>
											</div>
										</div>
										<div class="col-span-6 sm:col-span-6 md:mx-4">
											<label for="country" class="block text-sm font-medium text-gray-700">เลือกสถานพยาบาล</label>
											<select id="mySelect" name="country" autocomplete="country" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
												<option>-- โปรดเลือก --</option>
												<option>Canada</option>
											</select>
										</div>

										<div class="col-span-6 sm:col-span-6">
											<div class="frame-wrap">
												<div class="custom-control custom-checkbox custom-control-inline">
													<input type="checkbox" class="custom-control-input" id="defaultInline5">
													<label class="custom-control-label" for="defaultInline5">ด่านควบคุมโรค</label>
												</div>
											</div>
										</div>
										<div class="col-span-6 sm:col-span-6 md:mx-4">
											<label for="country" class="block text-sm font-medium text-gray-700">เลือกด่านควบคุมโรค</label>
											<select id="country" name="country" autocomplete="country" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
												<option>-- โปรดเลือก --</option>
												<option>Canada</option>
											</select>
										</div>

										<div class="col-span-6 sm:col-span-6">
											<div class="frame-wrap">
												<div class="custom-control custom-checkbox custom-control-inline">
													<input type="checkbox" class="custom-control-input" id="defaultInline5">
													<label class="custom-control-label" for="defaultInline5">อื่นๆ โปรดระบุ</label>
												</div>
											</div>
										</div>
										<div class="col-span-6 sm:col-span-6 md:mx-4">
											<label for="last_name" class="block text-sm font-medium text-gray-700">อื่นๆ ระบุ</label>
											<input type="text" name="last_name" id="last_name" autocomplete="family-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
										</div>

										<div class="col-span-6 sm:col-span-3">
											<label for="last_name" class="block text-sm font-medium text-gray-700">หมายเลขผู้เสียภาษี</label>
											<input type="text" name="last_name" id="last_name" autocomplete="family-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
										</div>

										
										<div class="col-span-6 sm:col-span-3">
											<label for="last_name" class="block text-sm font-medium text-gray-700">ที่อยู่</label>
											<input type="text" name="last_name" id="last_name" autocomplete="family-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
										</div>

										<div class="col-span-6 sm:col-span-3">
											<label for="country" class="block text-sm font-medium text-gray-700">จังหวัด</label>
											<select id="country" name="country" autocomplete="country" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
												<option>-- โปรดเลือก --</option>
												<option>Canada</option>
											</select>
										</div>
										<div class="col-span-6 sm:col-span-3">
											<label for="country" class="block text-sm font-medium text-gray-700">เขต/อำเภอ</label>
											<select id="country" name="country" autocomplete="country" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
												<option>-- โปรดเลือก --</option>
												<option>Canada</option>
											</select>
										</div>
										<div class="col-span-6 sm:col-span-3">
											<label for="country" class="block text-sm font-medium text-gray-700">แขวง/ตำบล</label>
											<select id="country" name="country" autocomplete="country" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
												<option>-- โปรดเลือก --</option>
												<option>Canada</option>
											</select>
										</div>
										<div class="col-span-6 sm:col-span-3 md:mr-4">
											<label for="last_name" class="block text-sm font-medium text-gray-700">รหัสไปรษณีย์</label>
											<input type="text" name="last_name" id="last_name" autocomplete="family-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<button type="button" class="action-button previous_button">ก่อนหน้า</button>
				<button type="button" class="next action-button">ถัดไป</button>
			</fieldset>

			<fieldset>
				<h3>ข้อมูลผู้รับบริการ</h3>
				<h4>2. ข้อมูลผู้รับบริการ</h4>
				<div class="mt-0 sm:mt-0">
					<div class="md:grid md:grid-cols-1">
						<div class="mt-2 md:mt-0 md:col-span-2">
							<div class="shadow overflow-hidden sm:rounded-md">
								<div class="px-4 py-5 bg-white sm:p-6">
									<div class="grid grid-cols-6 gap-6">
										<div class="col-span-6 sm:col-span-6">
											<label for="simpleinput" class="block text-base font-medium text-gray-700">คำนำหน้าชื่อ <span class="text-red-600">*</span></label>
											<div class="frame-wrap">
												<div class="custom-control custom-checkbox custom-control-inline">
													<input type="checkbox" class="custom-control-input" id="defaultInline1">
													<label class="custom-control-label" for="defaultInline1">นาย</label>
												</div>
												<div class="custom-control custom-checkbox custom-control-inline">
													<input type="checkbox" class="custom-control-input" id="defaultInline2">
													<label class="custom-control-label" for="defaultInline2">นาง</label>
												</div>
												<div class="custom-control custom-checkbox custom-control-inline">
													<input type="checkbox" class="custom-control-input" id="defaultInline3">
													<label class="custom-control-label" for="defaultInline3">นางสาว</label>
												</div>
											</div>
										</div>

										<div class="col-span-6 sm:col-span-3">
											<label for="last_name" class="block text-sm font-medium text-gray-700">ชื่อ</label>
											<input type="text" name="last_name" id="last_name" autocomplete="family-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
										</div>
										<div class="col-span-6 sm:col-span-3">
											<label for="last_name" class="block text-sm font-medium text-gray-700">นามสกุล</label>
											<input type="text" name="last_name" id="last_name" autocomplete="family-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
										</div>

										<div class="col-span-6 sm:col-span-3">
											<label for="last_name" class="block text-sm font-medium text-gray-700">ตำแหน่ง</label>
											<input type="text" name="last_name" id="last_name" autocomplete="family-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
										</div>
										<div class="col-span-6 sm:col-span-3">
											<label for="last_name" class="block text-sm font-medium text-gray-700">เบอร์โทรศัพท์มือถือ</label>
											<input type="text" name="last_name" id="last_name" autocomplete="family-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
										</div>
										<div class="col-span-6 sm:col-span-3 md:mr-4">
											<label for="last_name" class="block text-sm font-medium text-gray-700">อีเมล์</label>
											<input type="text" name="last_name" id="last_name" autocomplete="family-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<button type="button" class="action-button previous previous_button">ก่อนหน้า</button>
				<button type="button" class="next action-button">ถัดไป</button>  
			</fieldset> 

			<fieldset>
				<h3>ข้อมูลติดต่อ</h3>
				<h4>3. ข้อมูลติดต่อ</h4>
				<div class="mt-0 sm:mt-0">
					<div class="md:grid md:grid-cols-1">
						<div class="mt-2 md:mt-0 md:col-span-2">
							<div class="shadow overflow-hidden sm:rounded-md">
								<div class="px-4 py-5 bg-white sm:p-6">
									<div class="grid grid-cols-6 gap-6">
										<div class="col-span-6 sm:col-span-6">
											<label for="simpleinput" class="block text-base font-medium text-gray-700">ที่อยู่สำหรับส่งรายงานผลการตรวจ <span class="text-red-600">*</span></label>
											<div class="frame-wrap">
												<div class="custom-control custom-checkbox custom-control-inline">
													<input type="checkbox" class="custom-control-input" id="defaultInline4">
													<label class="custom-control-label" for="defaultInline4">ที่อยู่เดียวกับผู้รับบริการ</label>
												</div>
											</div>
										</div>
										<div class="col-span-6 sm:col-span-6">
											<div class="frame-wrap">
												<div class="custom-control custom-checkbox custom-control-inline">
													<input type="checkbox" class="custom-control-input" id="defaultInline5">
													<label class="custom-control-label" for="defaultInline5">ที่อยู่ใหม่</label>
												</div>
											</div>
										</div>

										<div class="col-span-6 sm:col-span-6 md:mx-4">
											<label for="simpleinput" class="block text-base font-medium text-gray-700">คำนำหน้าชื่อ <span class="text-red-600">*</span></label>
											<div class="frame-wrap">
												<div class="custom-control custom-checkbox custom-control-inline">
													<input type="checkbox" class="custom-control-input" id="defaultInline1">
													<label class="custom-control-label" for="defaultInline1">นาย</label>
												</div>
												<div class="custom-control custom-checkbox custom-control-inline">
													<input type="checkbox" class="custom-control-input" id="defaultInline2">
													<label class="custom-control-label" for="defaultInline2">นาง</label>
												</div>
												<div class="custom-control custom-checkbox custom-control-inline">
													<input type="checkbox" class="custom-control-input" id="defaultInline3">
													<label class="custom-control-label" for="defaultInline3">นางสาว</label>
												</div>
											</div>
										</div>

										<div class="col-span-6 sm:col-span-3 md:mx-4">
											<label for="last_name" class="block text-sm font-medium text-gray-700">ชื่อ</label>
											<input type="text" name="last_name" id="last_name" autocomplete="family-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
										</div>
										<div class="col-span-6 sm:col-span-3 md:mx-4">
											<label for="last_name" class="block text-sm font-medium text-gray-700">นามสกุล</label>
											<input type="text" name="last_name" id="last_name" autocomplete="family-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
										</div>

										<div class="col-span-6 sm:col-span-3 md:mx-4">
											<label for="last_name" class="block text-sm font-medium text-gray-700">ตำแหน่ง</label>
											<input type="text" name="last_name" id="last_name" autocomplete="family-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
										</div>
										<div class="col-span-6 sm:col-span-3 md:mx-4">
											<label for="last_name" class="block text-sm font-medium text-gray-700">เบอร์โทรศัพท์มือถือ</label>
											<input type="text" name="last_name" id="last_name" autocomplete="family-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
										</div>
										<div class="col-span-6 sm:col-span-3 md:mx-4">
											<label for="last_name" class="block text-sm font-medium text-gray-700">อีเมล์</label>
											<input type="text" name="last_name" id="last_name" autocomplete="family-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<button type="button" class="action-button previous previous_button">ก่อนหน้า</button>
				<button type="button" class="next action-button">ถัดไป</button>  
			</fieldset>

			<fieldset>
				<h3>บัญชีผู้ใช้</h3>
				<h4>4. บัญชีผู้ใช้</h4>
				<div class="mt-0 sm:mt-0">
					<div class="md:grid md:grid-cols-1">
						<div class="mt-2 md:mt-0 md:col-span-2">
							<div class="shadow overflow-hidden sm:rounded-md">
								<div class="px-4 py-5 bg-white sm:p-6">
									<div class="grid grid-cols-6 gap-6">
										<div class="col-span-6 sm:col-span-6">
											<label for="last_name" class="block text-sm font-medium text-gray-700">อีเมล์ (Email)</label>
											<input type="text" name="last_name" id="last_name" autocomplete="family-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
										</div>

										<div class="col-span-6 sm:col-span-6">
											<label for="last_name" class="block text-sm font-medium text-gray-700">รหัสผ่าน (Password)</label>
											<input type="text" name="last_name" id="last_name" autocomplete="family-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
										</div>

										
										<div class="col-span-6 sm:col-span-6">
											<label for="last_name" class="block text-sm font-medium text-gray-700">ยืนยันรหัสผ่าน (Confirm password)</label>
											<input type="text" name="last_name" id="last_name" autocomplete="family-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<button type="button" class="action-button previous previous_button">ก่อนหน้า</button> 
				<a href="#" class="action-button">ตรวจสอบข้อมูล</a> 
			</fieldset>
		</form>
	</section> 
</article>
@endsection
@section('script')
<script src="{{ URL::asset('vendor/select2/js/select2.min.js') }}"></script>
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
						$("html, body").animate({ scrollTop: 0 }, "slow");
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
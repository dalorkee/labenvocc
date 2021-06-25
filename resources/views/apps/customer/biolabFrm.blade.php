@extends('layouts.index')
@section('style')
<link href="{{ URL::asset('assets/css/ionicons.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/multi_step_form.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/css/formplugins/select2/select2.bundle.css') }}" rel="stylesheet">
<style>
.select2{width:100%!important;}
.select2-selection{overflow:hidden;}
.select2-selection__rendered{white-space:normal;word-break:break-all;}
.select2-selection__rendered{line-height:39px!important;}
.select2-container .select2-selection--single{height:38px!important;border:1px solid #cccccc;border-radius:0;}
.select2-selection__arrow{height:37px!important;}
.custom-control-label{font-size: 1.175em;}
</style>
@endsection
@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
    <li class="breadcrumb-item active">คำขอส่งตัวอย่าง</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title"><i class='fal fa-clipboard-list'></i> สร้างคำขอส่งตัวอย่างชีวภาพ<small></small></h1>
</div>
<div class="fs-lg fw-300 p-5 bg-white border-faded rounded mb-g">
  <article>
  	<section class="multi_step_form">
  		<form id="msform" class="w-full">
  			<ul id="progressbar">
  				<li class="active">ข้อมูลทั่วไป</li>
  				<li>พารามิเตอร์</li>
  				<li>ข้อมูลตัวอย่าง</li>
  				<li>ตรวจสอบข้อมูล</li>
  			</ul>
  			<fieldset>
  				{{-- <h3>ข้อมูลหน่วยงาน</h3> --}}
  				<h4>1. ข้อมูลทั่วไป</h4>
          <div class="mt-0 sm:mt-0">
            <div class="md:grid md:grid-cols-1">
              <div class="mt-2 md:mt-0 md:col-span-2">
                <div class="shadow overflow-hidden sm:rounded-md">
                  <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">
                      <div class="col-span-6 sm:col-span-3">
                        <label for="last_name" class="block text-sm font-medium text-gray-700">หน่วยงานที่ส่งตัวอย่าง</label>
                        <input type="text" name="last_name" id="last_name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-200">
                      </div>
                      <div class="col-span-6 sm:col-span-6">
                        <label for="simpleinput" class="block text-base font-medium text-gray-700">ประเภทงาน <span class="text-red-600">*</span></label>
                        <div class="frame-wrap">
                          <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" class="custom-control-input" id="defaultInline1">
                            <label class="custom-control-label" for="defaultInline1">บริการ</label>
                          </div>
                          <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" class="custom-control-input" id="defaultInline2">
                            <label class="custom-control-label" for="defaultInline2">วิจัย</label>
                          </div>
                          <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" class="custom-control-input" id="defaultInline3">
                            <label class="custom-control-label" for="defaultInline3">เฝ้าระวัง</label>
                          </div>
                          <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" class="custom-control-input" id="defaultInline4">
                            <label class="custom-control-label" for="defaultInline4">SRRT/สอบสวนโรค</label>
                          </div>
                          <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" class="custom-control-input" id="defaultInline5">
                            <label class="custom-control-label" for="defaultInline5">อื่นๆ ระบุ</label>
                          </div>
                        </div>
                      </div>

                      <div class="col-span-6 sm:col-span-3">
                        <label for="last_name" class="block text-sm font-medium text-gray-700">หนังสือนำส่งเลขที่ื</label>
                        <input type="text" name="last_name" id="last_name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-200">
                      </div>
                      <div class="col-span-6 sm:col-span-3">
                        <label for="last_name" class="block text-sm font-medium text-gray-700">ลงวันที่</label>
                        <input type="text" name="last_name" id="last_name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-200">
                      </div>

                      <div class="col-span-6 sm:col-span-3">
                        <label for="last_name" class="block text-sm font-medium text-gray-700">แนบไฟล์หนังสือนำส่ง</label>
                        <input type="text" name="last_name" id="last_name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-200">
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
  				{{-- <h3>ข้อมูลผู้รับบริการ</h3> --}}
  				<h4>2. ข้อมูลผู้รับบริการ</h4>
  				<div class="mt-0 sm:mt-0">
  					<div class="md:grid md:grid-cols-1">
  						<div class="mt-2 md:mt-0 md:col-span-2">
  							<div class="shadow overflow-hidden sm:rounded-md">
  								<div class="px-4 py-5 bg-white sm:p-6">
                    <table id="" class="table table-bordered table-hover table-striped w-100">
                        <thead>
                            <tr>
                                <th>รหัสตัวอย่าง</th>
                                <th>ชื่อ-สกุล</th>
                                <th>อายุ(ปี)</th>
                                <th>แผนก</th>
                                <th>อายุงาน(ปี)</th>
                                <th>วันที่เก็บตัวอย่าง</th>
                                <th>พารามิเตอร์</th>
                                <th>หน่วย</th>
                                <th>หมายเหตุ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>61</td>
                                <td>2011/04/25</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>61</td>
                                <td>2011/04/25</td>
                            </tr>
                            <tr>
                                <td>Garrett Winters</td>
                                <td>Accountant</td>
                                <td>Tokyo</td>
                                <td>63</td>
                                <td>2011/07/25</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>61</td>
                                <td>2011/04/25</td>
                            </tr>
                            <tr>
                                <td>Ashton Cox</td>
                                <td>Junior Technical Author</td>
                                <td>San Francisco</td>
                                <td>66</td>
                                <td>2009/01/12</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>61</td>
                                <td>2011/04/25</td>
                            </tr>
                            <tr>
                                <td>Cedric Kelly</td>
                                <td>Senior Javascript Developer</td>
                                <td>Edinburgh</td>
                                <td>22</td>
                                <td>2012/03/29</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>61</td>
                                <td>2011/04/25</td>
                            </tr>
                            <tr>
                                <td>Airi Satou</td>
                                <td>Accountant</td>
                                <td>Tokyo</td>
                                <td>33</td>
                                <td>2008/11/28</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>61</td>
                                <td>2011/04/25</td>
                            </tr>
                            <tr>
                                <td>Brielle Williamson</td>
                                <td>Integration Specialist</td>
                                <td>New York</td>
                                <td>61</td>
                                <td>2012/12/02</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>61</td>
                                <td>2011/04/25</td>
                            </tr>
                        </tbody>
                    </table>
  								</div>
  							</div>
  						</div>
  					</div>
  				</div>
  				<button type="button" class="action-button previous previous_button">ก่อนหน้า</button>
  				<button type="button" class="next action-button">ถัดไป</button>
  			</fieldset>

  			<fieldset>
  				{{-- <h3>ข้อมูลติดต่อ</h3> --}}
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
  											<input type="text" name="last_name" id="last_name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-200">
  										</div>
  										<div class="col-span-6 sm:col-span-3 md:mx-4">
  											<label for="last_name" class="block text-sm font-medium text-gray-700">นามสกุล</label>
  											<input type="text" name="last_name" id="last_name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-200">
  										</div>

  										<div class="col-span-6 sm:col-span-3 md:mx-4">
  											<label for="last_name" class="block text-sm font-medium text-gray-700">ตำแหน่ง</label>
  											<input type="text" name="last_name" id="last_name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-200">
  										</div>
  										<div class="col-span-6 sm:col-span-3 md:mx-4">
  											<label for="last_name" class="block text-sm font-medium text-gray-700">เบอร์โทรศัพท์มือถือ</label>
  											<input type="text" name="last_name" id="last_name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-200">
  										</div>
  										<div class="col-span-6 sm:col-span-3 md:mx-4">
  											<label for="last_name" class="block text-sm font-medium text-gray-700">อีเมล์</label>
  											<input type="text" name="last_name" id="last_name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-200">
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
  				{{-- <h3>บัญชีผู้ใช้</h3> --}}
  				<h4>4. บัญชีผู้ใช้</h4>
  				<div class="mt-0 sm:mt-0">
  					<div class="md:grid md:grid-cols-1">
  						<div class="mt-2 md:mt-0 md:col-span-2">
  							<div class="shadow overflow-hidden sm:rounded-md">
  								<div class="px-4 py-5 bg-white sm:p-6">
  									<div class="grid grid-cols-6 gap-6">
  										<div class="col-span-6 sm:col-span-6">
  											<label for="last_name" class="block text-sm font-medium text-gray-700">อีเมล์ (Email)</label>
  											<input type="text" name="last_name" id="last_name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-200">
  										</div>

  										<div class="col-span-6 sm:col-span-6">
  											<label for="last_name" class="block text-sm font-medium text-gray-700">รหัสผ่าน (Password)</label>
  											<input type="text" name="last_name" id="last_name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-200">
  										</div>
  										<div class="col-span-6 sm:col-span-6">
  											<label for="last_name" class="block text-sm font-medium text-gray-700">ยืนยันรหัสผ่าน (Confirm password)</label>
  											<input type="text" name="last_name" id="last_name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-200">
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
</div>
@endsection
@section('script')
<script src="{{ URL::asset('assets/js/datagrid/datatables/datatables.bundle.js') }}"></script>
<script>
(function($) {
	"use strict";
	function verificationForm() {
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

@extends('layouts.index')
@section('style')
<link href="{{ URL::asset('vendor/jquery-smartwizard/css/smart_wizard_arrows.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('assets/css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css') }}" rel="stylesheet" media="screen, print">
@endsection
@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
    <li class="breadcrumb-item">คำขอส่งตัวอย่าง</li>
    {{-- <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li> --}}
</ol>
<div class="subheader">
    <h1 class="subheader-title"><i class='fal fa-home'></i> สร้างคำขอส่งตัวอย่างชีวภาพ<small></small></h1>
</div>
<div class="fs-lg fw-300 p-5 bg-white border-faded rounded mb-g">
    <div id="smartwizard">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="#step-1">
                    <strong>ข้อมูลทั่วไป</strong>
                    {{-- <p>UX คืออะไร และอะไรคือ UX ที่ดีที่สุด</p> --}}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#step-2">
                    <strong>พารามิเตอร์</strong>
                    {{-- <p>อยากเปลี่ยนแนว มาทำ UX</p> --}}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#step-3">
                    <strong>ข้อมูลตัวอย่าง</strong>
                    {{-- <p>ถ้าเลือกได้ อย่า *, padding 0, margin 0</p> --}}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#step-4">
                    <strong>ตรวจสอบข้อมูล</strong>
                    {{-- <p>12 ข้อคิดสำหรับผู้ที่กลัว CSS และ Standards</p> --}}
                </a>
            </li>
        </ul>
        <article class="tab-content">
            <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                <h3>กรุณาระบุข้อมูลทั่วไป</h3>
                <section>
                    <div class="panel-content p-0">
                        <div class="panel-content">
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="validationCustom01">หน่วยงานที่ส่งตัวอย่าง <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" id="validationCustom01" placeholder="" autocomplete="off" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-xl-6">
                                    <label class="form-label" for="validationCustom01">ประเภทงาน <span class="text-danger">*</span> </label>
                                    <div class="frame-wrap">
                                        <div class="demo">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="defaultUncheckedRadio1" name="defaultExampleRadios" checked="">
                                                <label class="custom-control-label" for="defaultUncheckedRadio1">บริการ</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="defaultCheckedRadio2" name="defaultExampleRadios">
                                                <label class="custom-control-label" for="defaultCheckedRadio2">วิจัย</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="defaultUncheckedRadio3" name="defaultExampleRadios">
                                                <label class="custom-control-label" for="defaultUncheckedRadio3">เฝ้าระวัง</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="defaultUncheckedRadio4" name="defaultExampleRadios">
                                                <label class="custom-control-label" for="defaultUncheckedRadio4">SRRT/สอบสวนโรค</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="defaultUncheckedRadio5" name="defaultExampleRadios">
                                                <label class="custom-control-label" for="defaultUncheckedRadio5">อื่นๆ ระบุ</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="validationCustom01">หนังสือนำส่งเลขที่ื <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" id="validationCustom01" placeholder="" autocomplete="off" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="validationCustom02">ลงวันที่ <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control " readonly placeholder="ระบุวันที่" id="datepicker-biolab-1" autocomplete="off">
                                        <div class="input-group-append">
                                            <span class="input-group-text fs-xl">
                                                <i class="fal fa-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="validationCustom01">แนบไฟล์หนังสือนำส่ง <span class="text-danger">*</span> </label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile" autocomplete="off">
                                        <label class="custom-file-label" for="customFile"> ยังไม่มีไฟล์แนบ</label>
                                    </div>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                <h3>กรุณาระบุพารามิเตอร์</h3>
                <section>
                    <div class="panel-content p-0">
                        <div class="panel-content">
                            <div class="form-row">
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
                                            <td>
                                              <p class="demo">
                                                <a href="javascript:void(0);" class="btn btn-outline-success btn-icon">
                                                    <i class="fal fa-plus"></i>
                                                </a>
                                                <a href="javascript:void(0);" class="btn btn-outline-warning btn-icon">
                                                    <i class="fal fa-pen"></i>
                                                </a>
                                                <a href="javascript:void(0);" class="btn btn-outline-danger btn-icon">
                                                    <i class="fal fa-times"></i>
                                                </a>
                                            </p>
                                            </td>
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
                                            <td>
                                              <p class="demo">
                                                <a href="javascript:void(0);" class="btn btn-outline-success btn-icon">
                                                    <i class="fal fa-plus"></i>
                                                </a>
                                                <a href="javascript:void(0);" class="btn btn-outline-warning btn-icon">
                                                    <i class="fal fa-pen"></i>
                                                </a>
                                                <a href="javascript:void(0);" class="btn btn-outline-danger btn-icon">
                                                    <i class="fal fa-times"></i>
                                                </a>
                                            </p>
                                            </td>
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
                                            <td>
                                              <p class="demo">
                                                <a href="javascript:void(0);" class="btn btn-outline-success btn-icon">
                                                    <i class="fal fa-plus"></i>
                                                </a>
                                                <a href="javascript:void(0);" class="btn btn-outline-warning btn-icon">
                                                    <i class="fal fa-pen"></i>
                                                </a>
                                                <a href="javascript:void(0);" class="btn btn-outline-danger btn-icon">
                                                    <i class="fal fa-times"></i>
                                                </a>
                                            </p>
                                            </td>
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
                                            <td>
                                              <p class="demo">
                                                <a href="javascript:void(0);" class="btn btn-outline-success btn-icon">
                                                    <i class="fal fa-plus"></i>
                                                </a>
                                                <a href="javascript:void(0);" class="btn btn-outline-warning btn-icon">
                                                    <i class="fal fa-pen"></i>
                                                </a>
                                                <a href="javascript:void(0);" class="btn btn-outline-danger btn-icon">
                                                    <i class="fal fa-times"></i>
                                                </a>
                                            </p>
                                            </td>
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
                                            <td>
                                              <p class="demo">
                                                <a href="javascript:void(0);" class="btn btn-outline-success btn-icon">
                                                    <i class="fal fa-plus"></i>
                                                </a>
                                                <a href="javascript:void(0);" class="btn btn-outline-warning btn-icon">
                                                    <i class="fal fa-pen"></i>
                                                </a>
                                                <a href="javascript:void(0);" class="btn btn-outline-danger btn-icon">
                                                    <i class="fal fa-times"></i>
                                                </a>
                                            </p>
                                            </td>
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
                                            <td>
                                              <p class="demo">
                                                <a href="javascript:void(0);" class="btn btn-outline-success btn-icon">
                                                    <i class="fal fa-plus"></i>
                                                </a>
                                                <a href="javascript:void(0);" class="btn btn-outline-warning btn-icon">
                                                    <i class="fal fa-pen"></i>
                                                </a>
                                                <a href="javascript:void(0);" class="btn btn-outline-danger btn-icon">
                                                    <i class="fal fa-times"></i>
                                                </a>
                                            </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
                <h3>กรุณาระบุข้อมูลตัวอย่าง</h3>
                <section>
                    <div class="panel-content p-0">
                        <div class="panel-content">
                            <div class="form-row">
                                <div class="col-md-6 mb-6">
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
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6 mb-6">
                                    <div class="form-row">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="validationCustom01">ตัวอย่างที่ <span class="text-danger">*</span> </label>
                                            <input type="text" class="form-control" id="validationCustom01" placeholder="" autocomplete="off" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="validationCustom02">ถึง <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="text" class="form-control " readonly placeholder="ระบุวันที่" id="datepicker-biolab-1" autocomplete="off">
                                                <div class="input-group-append">
                                                    <span class="input-group-text fs-xl">
                                                        <i class="fal fa-calendar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="validationCustom01">ประเด็นมลพิษ <span class="text-danger">*</span> </label>
                                            <input type="text" class="form-control" id="validationCustom01" placeholder="" autocomplete="off" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="validationCustom01">สถานที่เก็บตัวอย่าง <span class="text-danger">*</span> </label>
                                            <input type="text" class="form-control" id="validationCustom01" placeholder="" autocomplete="off" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-4 mb-3">
                                            <div class="frame-wrap">
                                                <div class="demo">
                                                     <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="defaultIndeterminate11">
                                                        <label class="custom-control-label" for="defaultIndeterminate11">สถานที่เดียวกับหน่วยงานที่ส่งตัวอย่าง</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-2 mb-2">
                                            <div class="frame-wrap">
                                                <div class="demo">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" class="custom-control-input" id="defaultUncheckedRadio7" name="defaultExampleRadios" checked="">
                                                        <label class="custom-control-label" for="defaultUncheckedRadio7">สถานประกอบการ</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <input type="text" class="form-control" id="validationCustom01" placeholder="ชื่อหน่วยงาน" autocomplete="off" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <input type="text" class="form-control" id="validationCustom01" placeholder="รหัสสถานประกอบการ" autocomplete="off" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-2 mb-3">
                                            <div class="frame-wrap">
                                                <div class="demo">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" class="custom-control-input" id="defaultUncheckedRadio8" name="defaultExampleRadios">
                                                        <label class="custom-control-label" for="defaultUncheckedRadio8">สถานพยาบาล</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <input type="text" class="form-control" id="validationCustom01" placeholder="สถานพยาบาล" autocomplete="off" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-2 mb-3">
                                            <div class="frame-wrap">
                                                <div class="demo">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" class="custom-control-input" id="defaultUncheckedRadio9" name="defaultExampleRadios">
                                                        <label class="custom-control-label" for="defaultUncheckedRadio9">ด่านควบคุมโรค</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <input type="text" class="form-control" id="validationCustom01" placeholder="ด่านควบคุมโรค" autocomplete="off" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-2 mb-3">
                                            <div class="frame-wrap">
                                                <div class="demo">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" class="custom-control-input" id="defaultUncheckedRadio10" name="defaultExampleRadios">
                                                        <label class="custom-control-label" for="defaultUncheckedRadio10">อื่น ๆ ระบุ</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <input type="text" class="form-control" id="validationCustom01" placeholder="อื่น ๆ ระบุ" autocomplete="off" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div id="step-4" class="tab-pane" role="tabpanel" aria-labelledby="step-4">
                <h3>กรุณาตรวจสอบข้อมูล</h3>
                <section>
                    <div class="panel-content p-0">
                        <div class="panel-content">
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="validationCustom01">หน่วยงานที่ส่งตัวอย่าง <span class="text-danger">*</span> : </label>
                                </div>
                                <div class="col-xl-6">
                                    <label class="form-label" for="validationCustom01">ประเภทงาน <span class="text-danger">*</span> : บริการ</label>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="validationCustom01">หนังสือนำส่งเลขที่ื <span class="text-danger">*</span> : 00000000</label>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="validationCustom02">ลงวันที่ <span class="text-danger">*</span> : 28/06/2564</label>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="validationCustom01">แนบไฟล์หนังสือนำส่ง <span class="text-danger">*</span> : BioLab.pdf</label>
                                </div>
                            </div>
                            <div class="form-row">
                                <h3>2. ข้อมูลตัวอย่างและพารามิเตอร์</h3>
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
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-row">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="validationTooltipAgreement" required>
                                    <label class="custom-control-label" for="validationTooltipAgreement">Agree to terms and conditions <span class="text-danger">*</span></label>
                                    <div class="invalid-tooltip">
                                        You must agree before submitting.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </article>
    </div>
</div>
@endsection
@section('script')
<script src="{{ URL::asset('vendor/jquery-smartwizard/js/jquery.smartWizard.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/js/formplugins/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
<script>
    $(document).ready(function() {
        // Toolbar extra buttons
        var btnFinish = $('<button></button>').text('บันทึก')
            .addClass('btn btn-info')
            .on('click', function() {
                alert('Finish Clicked');
            });
        var btnCancel = $('<button></button>').text('ยกเลิก')
            .addClass('btn btn-danger')
            .on('click', function() {
                $('#smartwizard').smartWizard("reset");
            });

        // Step show event
        $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection, stepPosition) {
            $("#prev-btn").removeClass('disabled');
            $("#next-btn").removeClass('disabled');
            if (stepPosition === 'first') {
                $("#prev-btn").addClass('disabled');
            } else if (stepPosition === 'last') {
                $("#next-btn").addClass('disabled');
            } else {
                $("#prev-btn").removeClass('disabled');
                $("#next-btn").removeClass('disabled');
            }
        });

        // Smart Wizard
        $('#smartwizard').smartWizard({
            selected: 0,
            theme: 'arrows',
            justified: true,
            darkMode: false,
            autoAdjustHeight: true,
            cycleSteps: false,
            backButtonSupport: true,
            enableURLhash: true,
            transition: {
                animation: 'slide-horizontal',
            },
            toolbarSettings: {
                toolbarPosition: 'bottom',
                toolbarExtraButtons: [btnFinish, btnCancel]
            },
            lang: {
                next: 'ต่อไป',
                previous: 'ก่อนหน้า'
            },
        });

        // External Button Events
        $("#reset-btn").on("click", function() {
            $('#smartwizard').smartWizard("reset");
            return true;
        });
        $("#prev-btn").on("click", function() {
            $('#smartwizard').smartWizard("prev");
            return true;
        });
        $("#next-btn").on("click", function() {
            $('#smartwizard').smartWizard("next");
            return true;
        });
    });
    var controls = {
        leftArrow: '<i class="fal fa-angle-left" style="font-size: 1.25rem"></i>',
        rightArrow: '<i class="fal fa-angle-right" style="font-size: 1.25rem"></i>'
    }

    var runDatePicker = function() {

        // minimum setup
        $('#datepicker-1').datepicker({
            todayHighlight: true,
            orientation: "bottom left",
            templates: controls
        });


        // input group layout
        $('#datepicker-biolab-1').datepicker({
            todayHighlight: true,
            orientation: "bottom left",
            templates: controls
        });

        // input group layout for modal demo
        $('#datepicker-modal-2').datepicker({
            todayHighlight: true,
            orientation: "bottom left",
            templates: controls
        });

        // enable clear button
        $('#datepicker-3').datepicker({
            todayBtn: "linked",
            clearBtn: true,
            todayHighlight: true,
            templates: controls
        });

        // enable clear button for modal demo
        $('#datepicker-modal-3').datepicker({
            todayBtn: "linked",
            clearBtn: true,
            todayHighlight: true,
            templates: controls
        });

        // orientation
        $('#datepicker-4-1').datepicker({
            orientation: "top left",
            todayHighlight: true,
            templates: controls
        });

        $('#datepicker-4-2').datepicker({
            orientation: "top right",
            todayHighlight: true,
            templates: controls
        });

        $('#datepicker-4-3').datepicker({
            orientation: "bottom left",
            todayHighlight: true,
            templates: controls
        });

        $('#datepicker-4-4').datepicker({
            orientation: "bottom right",
            todayHighlight: true,
            templates: controls
        });

        // range picker
        $('#datepicker-5').datepicker({
            todayHighlight: true,
            templates: controls
        });

        // inline picker
        $('#datepicker-6').datepicker({
            todayHighlight: true,
            templates: controls
        });
    }

    $(document).ready(function() {
        runDatePicker();
    });
</script>
@endsection

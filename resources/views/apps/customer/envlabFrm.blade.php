@extends('layouts.index')
@section('style')
<link href="{{ URL::asset('vendor/jquery-smartwizard/css/smart_wizard_arrows.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('assets/css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css') }}" rel="stylesheet" media="screen, print">
<link href="{{ URL::asset('assets/css/formplugins/select2/select2.bundle.css') }}" rel="stylesheet">
@endsection
@section('content')
<div id="app">
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
    <li class="breadcrumb-item">คำขอส่งตัวอย่าง</li>
    {{-- <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li> --}}
</ol>
<div class="subheader">
    <h1 class="subheader-title"><i class='fal fa-home'></i> สร้างคำขอส่งตัวอย่างสิ่งแวดล้อม<small></small></h1>
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
            <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1" novalidate>
                <h3>กรุณาระบุข้อมูลทั่วไป</h3>
                <section>
                  <form class="needs-validation" novalidate>
                                                <div class="panel-content">
                                                    <div class="form-row">
                                                        <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="validationCustom01">หน่วยงานที่ส่งตัวอย่าง <span class="text-danger">*</span> </label>
                                                            <input type="text" class="form-control" id="validationCustom01" placeholder="" required>
                                                            <div class="invalid-feedback">
                                                                กรุณาระบุหน่วยงานที่ส่งตัวอย่าง
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label mb-2">ประเภทงาน <span class="text-danger">*</span></label>
                                                            <div class="custom-control custom-radio mb-2 custom-control-inline">
                                                                <input type="radio" class="custom-control-input" id="service" name="radio-stacked" required="">
                                                                <label class="custom-control-label" for="service">บริการ</label>
                                                            </div>
                                                            <div class="custom-control custom-radio mb-2 custom-control-inline">
                                                                <input type="radio" class="custom-control-input" id="research" name="radio-stacked" required="">
                                                                <label class="custom-control-label" for="research">วิจัย</label>
                                                            </div>
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" class="custom-control-input" id="surveillance" name="radio-stacked" required="">
                                                                <label class="custom-control-label" for="surveillance">เฝ้าระวัง</label>
                                                            </div>
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" class="custom-control-input" id="srrt" name="radio-stacked" required="">
                                                                <label class="custom-control-label" for="srrt">SRRT/สอบสวนโรค</label>
                                                            </div>
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" class="custom-control-input" id="other" name="radio-stacked" required="">
                                                                <label class="custom-control-label" for="other">อื่นๆ ระบุ</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row form-group">
                                                        <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="validationCustom03">หนังสือนำส่งเลขที่ <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="validationCustom03" required>
                                                            <div class="invalid-feedback">
                                                                กรุณาระบุหนังสือนำส่งเลขที่
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="validationCustom04">ลงวันที่ <span class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" id="validationCustom04" readonly placeholder="ระบุวันที่" id="datepicker-biolab-1" autocomplete="off">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text fs-xl">
                                                                        <i class="fal fa-calendar"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="validationCustom05">แนบไฟล์หนังสือนำส่ง <span class="text-danger">*</span></label>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" id="customFile" id="validationCustom05" autocomplete="off">
                                                                <label class="custom-file-label" for="customFile"> ยังไม่มีไฟล์แนบ</label>
                                                            </div>
                                                            <div class="invalid-feedback">
                                                                กรุณาระบุหนังสือนำส่งเลขที่
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- <div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex flex-row align-items-center">
                                                    <button class="btn btn-primary ml-auto" type="submit">Submit form</button>
                                                </div> --}}
                                            </form>
                    {{-- <div class="panel-content p-0">
                        <div class="panel-content">
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="validationCustom01">หน่วยงานที่ส่งตัวอย่าง <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" id="validationCustom01" placeholder="" autocomplete="off" required>
                                    <div class="invalid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-xl-6">
                                    <label class="form-label" for="validationCustom21">ประเภทงาน <span class="text-danger">*</span> </label>
                                    <div class="frame-wrap">
                                        <div class="demo">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input" id="defaultUncheckedRadio1" name="defaultExampleRadios" checked="">
                                                <label class="custom-control-label" for="defaultUncheckedRadio1">บริการ</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input" id="defaultCheckedRadio2" name="defaultExampleRadios">
                                                <label class="custom-control-label" for="defaultCheckedRadio2">วิจัย</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input" id="defaultUncheckedRadio3" name="defaultExampleRadios">
                                                <label class="custom-control-label" for="defaultUncheckedRadio3">เฝ้าระวัง</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input" id="defaultUncheckedRadio4" name="defaultExampleRadios">
                                                <label class="custom-control-label" for="defaultUncheckedRadio4">SRRT/สอบสวนโรค</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input" id="defaultUncheckedRadio5" name="defaultExampleRadios">
                                                <label class="custom-control-label" for="defaultUncheckedRadio5">อื่นๆ ระบุ</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="validationCustom02">หนังสือนำส่งเลขที่ <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" id="validationCustom02" placeholder="" autocomplete="off" required>
                                    <div class="invalid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="validationCustom03">ลงวันที่ <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="validationCustom03" readonly placeholder="ระบุวันที่" id="datepicker-biolab-1" autocomplete="off">
                                        <div class="input-group-append">
                                            <span class="input-group-text fs-xl">
                                                <i class="fal fa-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="invalid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="validationCustom04">แนบไฟล์หนังสือนำส่ง <span class="text-danger">*</span> </label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile" autocomplete="off">
                                        <label class="custom-file-label" for="customFile"> ยังไม่มีไฟล์แนบ</label>
                                    </div>
                                    <div class="invalid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </section>
            </div>
            <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                <h3>กรุณาระบุพารามิเตอร์</h3>
                <section>
                    <div class="panel-content p-0">
                        <div class="panel-content">
                            <div class="form-row">
                                <div class="col-md-2 mb-2">
                                </div>
                                <div class="col-md-2 mb-2">
                                </div>
                                <div class="col-md-2 mb-2">
                                </div>
                                <div class="col-md-2 mb-2">
                                </div>
                                <div class="col-md-2 mb-2">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add-sample-modal">
                                        <span class="fal fa-plus"></span>
                                        เพิ่มตัวอย่าง
                                    </button>
                                </div>
                                <table id="addpersonsampletable" class="table table-bordered table-hover table-striped w-100">
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
                                            <td>000000000000000</td>
                                            <td>นายสมโภช พุ่มกระโทก</td>
                                            <td>30</td>
                                            <td>ช่างเย็บ</td>
                                            <td>3</td>
                                            <td>11/11/2564</td>
                                            <td>
                                              <select class="paramiter_selector form-control" multiple="multiple" id="multiple-basic">
                                                  <optgroup label="Alaskan/Hawaiian Time Zone">
                                                      <option value="AK">Alaska</option>
                                                      <option value="HI">Hawaii</option>
                                                  </optgroup>
                                                  <optgroup label="Pacific Time Zone">
                                                      <option value="CA">California</option>
                                                      <option value="NV">Nevada</option>
                                                      <option value="OR">Oregon</option>
                                                      <option value="WA">Washington</option>
                                                  </optgroup>
                                                  <optgroup label="Mountain Time Zone">
                                                      <option value="AZ">Arizona</option>
                                                      <option value="CO">Colorado</option>
                                                      <option value="ID">Idaho</option>
                                                      <option value="MT">Montana</option>
                                                      <option value="NE">Nebraska</option>
                                                      <option value="NM">New Mexico</option>
                                                      <option value="ND">North Dakota</option>
                                                      <option value="UT">Utah</option>
                                                      <option value="WY">Wyoming</option>
                                                  </optgroup>
                                                  <optgroup label="Central Time Zone">
                                                      <option value="AL">Alabama</option>
                                                      <option value="AR">Arkansas</option>
                                                      <option value="IL">Illinois</option>
                                                      <option value="IA">Iowa</option>
                                                      <option value="KS">Kansas</option>
                                                      <option value="KY">Kentucky</option>
                                                      <option value="LA">Louisiana</option>
                                                      <option value="MN">Minnesota</option>
                                                      <option value="MS">Mississippi</option>
                                                      <option value="MO">Missouri</option>
                                                      <option value="OK">Oklahoma</option>
                                                      <option value="SD">South Dakota</option>
                                                      <option value="TX">Texas</option>
                                                      <option value="TN">Tennessee</option>
                                                      <option value="WI">Wisconsin</option>
                                                  </optgroup>
                                                  <optgroup label="Eastern Time Zone">
                                                      <option value="CT">Connecticut</option>
                                                      <option value="DE">Delaware</option>
                                                      <option value="FL">Florida</option>
                                                      <option value="GA">Georgia</option>
                                                      <option value="IN">Indiana</option>
                                                      <option value="ME">Maine</option>
                                                      <option value="MD">Maryland</option>
                                                      <option value="MA">Massachusetts</option>
                                                      <option value="MI">Michigan</option>
                                                      <option value="NH">New Hampshire</option>
                                                      <option value="NJ">New Jersey</option>
                                                      <option value="NY">New York</option>
                                                      <option value="NC">North Carolina</option>
                                                      <option value="OH">Ohio</option>
                                                      <option value="PA">Pennsylvania</option>
                                                      <option value="RI">Rhode Island</option>
                                                      <option value="SC">South Carolina</option>
                                                      <option value="VT">Vermont</option>
                                                      <option value="VA">Virginia</option>
                                                      <option value="WV">West Virginia</option>
                                                  </optgroup>
                                              </select>
                                            </td>
                                            <td>
                                              <select class="unit_selector form-control" multiple="multiple" id="unit_selector">
                                                  <optgroup label="Alaskan/Hawaiian Time Zone">
                                                      <option value="AK">Alaska</option>
                                                      <option value="HI">Hawaii</option>
                                                  </optgroup>
                                                  <optgroup label="Pacific Time Zone">
                                                      <option value="CA">California</option>
                                                      <option value="NV">Nevada</option>
                                                      <option value="OR">Oregon</option>
                                                      <option value="WA">Washington</option>
                                                  </optgroup>
                                                  <optgroup label="Mountain Time Zone">
                                                      <option value="AZ">Arizona</option>
                                                      <option value="CO">Colorado</option>
                                                      <option value="ID">Idaho</option>
                                                      <option value="MT">Montana</option>
                                                      <option value="NE">Nebraska</option>
                                                      <option value="NM">New Mexico</option>
                                                      <option value="ND">North Dakota</option>
                                                      <option value="UT">Utah</option>
                                                      <option value="WY">Wyoming</option>
                                                  </optgroup>
                                                  <optgroup label="Central Time Zone">
                                                      <option value="AL">Alabama</option>
                                                      <option value="AR">Arkansas</option>
                                                      <option value="IL">Illinois</option>
                                                      <option value="IA">Iowa</option>
                                                      <option value="KS">Kansas</option>
                                                      <option value="KY">Kentucky</option>
                                                      <option value="LA">Louisiana</option>
                                                      <option value="MN">Minnesota</option>
                                                      <option value="MS">Mississippi</option>
                                                      <option value="MO">Missouri</option>
                                                      <option value="OK">Oklahoma</option>
                                                      <option value="SD">South Dakota</option>
                                                      <option value="TX">Texas</option>
                                                      <option value="TN">Tennessee</option>
                                                      <option value="WI">Wisconsin</option>
                                                  </optgroup>
                                                  <optgroup label="Eastern Time Zone">
                                                      <option value="CT">Connecticut</option>
                                                      <option value="DE">Delaware</option>
                                                      <option value="FL">Florida</option>
                                                      <option value="GA">Georgia</option>
                                                      <option value="IN">Indiana</option>
                                                      <option value="ME">Maine</option>
                                                      <option value="MD">Maryland</option>
                                                      <option value="MA">Massachusetts</option>
                                                      <option value="MI">Michigan</option>
                                                      <option value="NH">New Hampshire</option>
                                                      <option value="NJ">New Jersey</option>
                                                      <option value="NY">New York</option>
                                                      <option value="NC">North Carolina</option>
                                                      <option value="OH">Ohio</option>
                                                      <option value="PA">Pennsylvania</option>
                                                      <option value="RI">Rhode Island</option>
                                                      <option value="SC">South Carolina</option>
                                                      <option value="VT">Vermont</option>
                                                      <option value="VA">Virginia</option>
                                                      <option value="WV">West Virginia</option>
                                                  </optgroup>
                                              </select>
                                            </td>
                                            <td>
                                                <p class="demo">
                                                  <a href="#" class="btn btn-warning">
                                                      <span class="fal fa-edit mr-1"></span>
                                                      แก้ไขข้อมูล
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
                                            <label class="form-label" for="validationCustom24">ตัวอย่างที่ <span class="text-danger">*</span> </label>
                                            <input type="text" class="form-control" id="validationCustom24" placeholder="" autocomplete="off" required>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="validationCustom02">ถึง <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="text" class="form-control " readonly placeholder="ระบุวันที่" id="datepicker-biolab-2" autocomplete="off">
                                                <div class="input-group-append">
                                                    <span class="input-group-text fs-xl">
                                                        <i class="fal fa-calendar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="validationCustom25">ประเด็นมลพิษ <span class="text-danger">*</span> </label>
                                            <input type="text" class="form-control" id="validationCustom25" placeholder="" autocomplete="off" required>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="validationCustom26">สถานที่เก็บตัวอย่าง <span class="text-danger">*</span> </label>
                                            <input type="text" class="form-control" id="validationCustom26" placeholder="" autocomplete="off" required>
                                            <div class="valid-tooltip">
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
                                            <input type="text" class="form-control" id="validationCustom27" placeholder="ชื่อหน่วยงาน" autocomplete="off" required>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <input type="text" class="form-control" id="validationCustom39" placeholder="รหัสสถานประกอบการ" autocomplete="off" required>
                                            <div class="valid-tooltip">
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
                                            <input type="text" class="form-control" id="validationCustom28" placeholder="สถานพยาบาล" autocomplete="off" required>
                                            <div class="valid-tooltip">
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
                                            <input type="text" class="form-control" id="validationCustom29" placeholder="ด่านควบคุมโรค" autocomplete="off" required>
                                            <div class="valid-tooltip">
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
                                            <input type="text" class="form-control" id="validationCustom30" placeholder="อื่น ๆ ระบุ" autocomplete="off" required>
                                            <div class="valid-tooltip">
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
                                    <label class="form-label" for="validationCustom31">หน่วยงานที่ส่งตัวอย่าง <span class="text-danger">*</span> : </label>
                                </div>
                                <div class="col-xl-6">
                                    <label class="form-label" for="validationCustom02">ประเภทงาน <span class="text-danger">*</span> : บริการ</label>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="validationCustom03">หนังสือนำส่งเลขที่ <span class="text-danger">*</span> : 00000000</label>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="validationCustom044">ลงวันที่ <span class="text-danger">*</span> : 28/06/2564</label>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="validationCustom055">แนบไฟล์หนังสือนำส่ง <span class="text-danger">*</span> : BioLab.pdf</label>
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
                                    <label class="custom-control-label" for="validationTooltipAgreement">ฉันได้ตรวจสอบความถูกต้องของข้อมูลแล้ว <span class="text-danger">*</span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </article>
    </div>
</div>
{{-- modal site --}}
<!-- add-sample-modal -->
<div class="modal fade" id="add-sample-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">สร้างตัวอย่างชีวภาพ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12 mb-12">
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="validationCustom06">รหัสตัวอย่าง <span class="text-danger">*</span> </label>
                            <input type="text" class="form-control" id="validationCustom06" placeholder="" autocomplete="off" required>
                            <div class="valid-tooltip">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="validationCustom07">ชื่อ <span class="text-danger">*</span> </label>
                            <input type="text" class="form-control" id="validationCustom07" placeholder="" autocomplete="off" required>
                            <div class="valid-tooltip">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="validationCustom02">นามสกุล <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="validationCustom08" placeholder="" autocomplete="off" required>
                                <div class="valid-tooltip">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="validationCustom09">อายุ (ปี) <span class="text-danger">*</span> </label>
                            <input type="text" class="form-control" id="validationCustom09" placeholder="" autocomplete="off" required>
                            <div class="valid-tooltip">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="validationCustom10">แผนก <span class="text-danger">*</span> </label>
                            <input type="text" class="form-control" id="validationCustom10" placeholder="" autocomplete="off" required>
                            <div class="valid-tooltip">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="validationCustom02">อายุงาน (ปี) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="validationCustom11" placeholder="" autocomplete="off" required>
                                <div class="valid-tooltip">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="validationCustom12">วันที่เก็บตัวอย่าง <span class="text-danger">*</span> </label>
                            <input type="text" class="form-control" id="validationCustom12" placeholder="" autocomplete="off" required>
                            <div class="valid-tooltip">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="validationCustom13">พารามิเตอร์ <span class="text-danger">*</span> </label>
                            <div class="form-group">
                                <select class="form-control" id="paramiter_selector">
                                    <optgroup label="Alaskan/Hawaiian Time Zone">
                                        <option value="AK">Alaska</option>
                                        <option value="HI">Hawaii</option>
                                    </optgroup>
                                    <optgroup label="Pacific Time Zone">
                                        <option value="CA" selected="">California</option>
                                        <option value="NV">Nevada</option>
                                        <option value="OR">Oregon</option>
                                        <option value="WA">Washington</option>
                                    </optgroup>
                                    <optgroup label="Mountain Time Zone">
                                        <option value="AZ">Arizona</option>
                                        <option value="CO" selected="">Colorado</option>
                                        <option value="ID">Idaho</option>
                                        <option value="MT">Montana</option>
                                        <option value="NE">Nebraska</option>
                                        <option value="NM">New Mexico</option>
                                        <option value="ND">North Dakota</option>
                                        <option value="UT">Utah</option>
                                        <option value="WY">Wyoming</option>
                                    </optgroup>
                                    <optgroup label="Central Time Zone">
                                        <option value="AL">Alabama</option>
                                        <option value="AR">Arkansas</option>
                                        <option value="IL">Illinois</option>
                                        <option value="IA">Iowa</option>
                                        <option value="KS">Kansas</option>
                                        <option value="KY">Kentucky</option>
                                        <option value="LA">Louisiana</option>
                                        <option value="MN">Minnesota</option>
                                        <option value="MS">Mississippi</option>
                                        <option value="MO">Missouri</option>
                                        <option value="OK">Oklahoma</option>
                                        <option value="SD">South Dakota</option>
                                        <option value="TX">Texas</option>
                                        <option value="TN">Tennessee</option>
                                        <option value="WI">Wisconsin</option>
                                    </optgroup>
                                    <optgroup label="Eastern Time Zone">
                                        <option value="CT">Connecticut</option>
                                        <option value="DE">Delaware</option>
                                        <option value="FL">Florida</option>
                                        <option value="GA">Georgia</option>
                                        <option value="IN">Indiana</option>
                                        <option value="ME">Maine</option>
                                        <option value="MD">Maryland</option>
                                        <option value="MA">Massachusetts</option>
                                        <option value="MI">Michigan</option>
                                        <option value="NH">New Hampshire</option>
                                        <option value="NJ">New Jersey</option>
                                        <option value="NY">New York</option>
                                        <option value="NC">North Carolina</option>
                                        <option value="OH">Ohio</option>
                                        <option value="PA">Pennsylvania</option>
                                        <option value="RI">Rhode Island</option>
                                        <option value="SC">South Carolina</option>
                                        <option value="VT">Vermont</option>
                                        <option value="VA">Virginia</option>
                                        <option value="WV">West Virginia</option>
                                    </optgroup>
                                </select>
                              </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="validationCustom14">หน่วย <span class="text-danger">*</span> </label>
                            <select class="form-control" id="unit_selector_modal">
                                <optgroup label="Alaskan/Hawaiian Time Zone">
                                    <option value="AK">Alaska</option>
                                    <option value="HI">Hawaii</option>
                                </optgroup>
                                <optgroup label="Pacific Time Zone">
                                    <option value="CA">California</option>
                                    <option value="NV">Nevada</option>
                                    <option value="OR">Oregon</option>
                                    <option value="WA">Washington</option>
                                </optgroup>
                                <optgroup label="Mountain Time Zone">
                                    <option value="AZ">Arizona</option>
                                    <option value="CO">Colorado</option>
                                    <option value="ID">Idaho</option>
                                    <option value="MT">Montana</option>
                                    <option value="NE">Nebraska</option>
                                    <option value="NM">New Mexico</option>
                                    <option value="ND">North Dakota</option>
                                    <option value="UT">Utah</option>
                                    <option value="WY">Wyoming</option>
                                </optgroup>
                                <optgroup label="Central Time Zone">
                                    <option value="AL">Alabama</option>
                                    <option value="AR">Arkansas</option>
                                    <option value="IL">Illinois</option>
                                    <option value="IA">Iowa</option>
                                    <option value="KS">Kansas</option>
                                    <option value="KY">Kentucky</option>
                                    <option value="LA">Louisiana</option>
                                    <option value="MN">Minnesota</option>
                                    <option value="MS">Mississippi</option>
                                    <option value="MO">Missouri</option>
                                    <option value="OK">Oklahoma</option>
                                    <option value="SD">South Dakota</option>
                                    <option value="TX">Texas</option>
                                    <option value="TN">Tennessee</option>
                                    <option value="WI">Wisconsin</option>
                                </optgroup>
                                <optgroup label="Eastern Time Zone">
                                    <option value="CT">Connecticut</option>
                                    <option value="DE">Delaware</option>
                                    <option value="FL">Florida</option>
                                    <option value="GA">Georgia</option>
                                    <option value="IN">Indiana</option>
                                    <option value="ME">Maine</option>
                                    <option value="MD">Maryland</option>
                                    <option value="MA">Massachusetts</option>
                                    <option value="MI">Michigan</option>
                                    <option value="NH">New Hampshire</option>
                                    <option value="NJ">New Jersey</option>
                                    <option value="NY">New York</option>
                                    <option value="NC">North Carolina</option>
                                    <option value="OH">Ohio</option>
                                    <option value="PA">Pennsylvania</option>
                                    <option value="RI">Rhode Island</option>
                                    <option value="SC">South Carolina</option>
                                    <option value="VT">Vermont</option>
                                    <option value="VA">Virginia</option>
                                    <option value="WV">West Virginia</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิดหน้าต่างเพิ่มตัวอย่าง</button>
                <button type="button" class="btn btn-primary">บันทึกข้อมูล</button>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('script')
<script src="{{ URL::asset('vendor/jquery-smartwizard/js/jquery.smartWizard.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/js/formplugins/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ URL::asset('assets/js/formplugins/select2/select2.bundle.js') }}"></script>
<script src="//unpkg.com/vue@2.5.13/dist/vue.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.5/lodash.min.js"></script>
<script>
    $(document).ready(function() {
        // Toolbar extra buttons
        var btnFinish = $('<button></button>')
            .text('บันทึก')
            .addClass('btn btn-info')
            .submit('click', function() {
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
        // input group layout
        $('#datepicker-biolab-2').datepicker({
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
    }
    $(document).ready(function() {
        runDatePicker();
    });
    $(document).ready(function()
    {
        $(function()
        {
            $('.paramiter_selector').select2();
            $('.unit_selector').select2();
            $('.paramiter_selector_modal').select2();
            $('.unit_selector_modal').select2();
        });
    });
</script>
<script type="text/javascript">

    var app = new Vue({
        el: '#app',
        data: {
            posts : '',
            search : '',
            count : 0,
            width: 0,
            menuItem : 'menu-item',
            activeClass : 'active',
            DataApi: {},
        },
        methods: {
            clearData: function() {
                //alert('Hello Vue!!!')
                console.log('Hello Vue!!!');
            },
            loadData(){
                axios.get("https://jsonplaceholder.typicode.com/todos/1")
                   .then(function (response) {
                      console.log(response.data.title);
                    })
                   .catch(function (error) {
                        console.log(error);
                    });
            }
        },
        created() {
            this.clearData();
            this.loadData();
        },
        mounted:function(){
        },
    });
</script>
@endsection

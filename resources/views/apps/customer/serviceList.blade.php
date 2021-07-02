@extends('layouts.index')
@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
    <li class="breadcrumb-item active">คำขอส่งตัวอย่าง</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title"><i class='fal fa-vial'></i> คำขอส่งตัวอย่าง<small></small></h1>
</div>
<div class="fs-lg fw-300 p-5 bg-white border-faded rounded mb-g">
    <h3 class="mb-g">รายการคำขอส่งตัวอย่างทั้งหมด</h3>
    {{-- <p>This is a contents</p> --}}
    <div class="panel-container show">
                                        <div class="panel-content">
                                            <div class="frame-wrap">
                                              <div class="btn-group" role="group">
                                                  <button id="btnGroupVerticalDrop1" type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      สร้างคำขอส่งตัวอย่าง
                                                  </button>
                                                  <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1">
                                                      <a class="dropdown-item" href="{{ route('biolabFrm.index') }}">ตัวอย่างชีวภาพ</a>
                                                      <a class="dropdown-item" href="{{ route('envlabFrm.index')}}">ตัวอย่างสิ่งแวดล้อม</a>
                                                  </div>
                                              </div>
                                            </div>
                                            <!-- datatable start -->
                                            <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
                                                <thead>
                                                    <tr>
                                                        <th>เลขที่</th>
                                                        <th>วันที่สร้าง</th>
                                                        <th>ส่งที่</th>
                                                        <th>สถานะ</th>
                                                        <th>รายละเอียด</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>00000000</td>
                                                        <td>03/07/64</td>
                                                        <td>ศูนย์ระยอง</td>
                                                        <td>
                                                          <li><code>รับตัวอย่างแล้ว</code></li>
                                                          <li><code>ชำระเงินแล้ว</code></li>
                                                        </td>
                                                        <td>
                                                          <p class="demo">
                                                            <a href="#" class="btn btn-info">
                                                                <span class="fal fa-print mr-1"></span>
                                                                ใบปะนำส่ง
                                                            </a>
                                                          </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>00000001</td>
                                                        <td>01/07/64</td>
                                                        <td>ศูนย์ระยอง</td>
                                                        <td>
                                                          <li><code>รับตัวอย่างแล้ว</code></li>
                                                          <li><code>ชำระเงินแล้ว</code></li>
                                                        </td>
                                                        <td>
                                                          <p class="demo">
                                                            <a href="#" class="btn btn-info">
                                                                <span class="fal fa-print mr-1"></span>
                                                                ใบปะนำส่ง
                                                            </a>
                                                          </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>00000002</td>
                                                        <td>01/07/64</td>
                                                        <td>ศูนย์ระยอง</td>
                                                        <td>
                                                          <li><code>เสร็จสิ้น</code></li>
                                                          <li><code>ชำระเงินแล้ว</code></li>
                                                        </td>
                                                        <td>
                                                          <p class="demo">
                                                            <a href="#" class="btn btn-info">
                                                                <span class="fal fa-print mr-1"></span>
                                                                รายงานผล
                                                            </a>
                                                          </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>00000003</td>
                                                        <td>22/06/64</td>
                                                        <td>ศูนย์ระยอง</td>
                                                        <td>
                                                          <li><code>รับตัวอย่างแล้ว</code></li>
                                                          <li><code>ชำระเงินแล้ว</code></li>
                                                        </td>
                                                        <td>
                                                          <p class="demo">
                                                            <a href="#" class="btn btn-info">
                                                                <span class="fal fa-print mr-1"></span>
                                                                ใบปะนำส่ง
                                                            </a>
                                                          </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>00000004</td>
                                                        <td>20/06/64</td>
                                                        <td>ศูนย์ระยอง</td>
                                                        <td>
                                                          <li><code>เสร็จสิ้น</code></li>
                                                          <li><code>ชำระเงินแล้ว</code></li>
                                                        </td>
                                                        <td>
                                                          <p class="demo">
                                                            <a href="#" class="btn btn-info">
                                                                <span class="fal fa-print mr-1"></span>
                                                                รายงานผล
                                                            </a>
                                                          </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>00000005</td>
                                                        <td>15/06/64</td>
                                                        <td>ศูนย์ระยอง</td>
                                                        <td>
                                                          <li><code>เสร็จสิ้น</code></li>
                                                          <li><code>ชำระเงินแล้ว</code></li>
                                                        </td>
                                                        <td>
                                                          <p class="demo">
                                                            <a href="#" class="btn btn-info">
                                                                <span class="fal fa-print mr-1"></span>
                                                                รายงานผล
                                                            </a>
                                                          </p>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <!-- datatable end -->
                                        </div>
                                    </div>
</div>
@endsection
@section('script')
<script src="{{ URL::asset('assets/js/datagrid/datatables/datatables.bundle.js') }}"></script>
<script>
    /* demo scripts for change table color */
    /* change background */


    $(document).ready(function()
    {
        $('#dt-basic-example').dataTable(
        {
            responsive: true
        });

        $('.js-thead-colors a').on('click', function()
        {
            var theadColor = $(this).attr("data-bg");
            console.log(theadColor);
            $('#dt-basic-example thead').removeClassPrefix('bg-').addClass(theadColor);
        });

        $('.js-tbody-colors a').on('click', function()
        {
            var theadColor = $(this).attr("data-bg");
            console.log(theadColor);
            $('#dt-basic-example').removeClassPrefix('bg-').addClass(theadColor);
        });

    });

</script>
@endsection

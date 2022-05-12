@extends('layouts.index')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/datagrid/datatables/datatables.bundle.css') }}">
<style>
.btn-group {margin:0;padding:0;}
.dt-buttons {display:flex;flex-direction:row;flex-wrap:wrap;justify-content:flex-end;}
.dataTables_filter label {margin-top: 8px;}
.dataTables_filter input:first-child {margin-top: -8px;}
#order-table thead {background-color:#297FB0;color: white;}
/* Extra small devices (phones, 600px and down) */
@media only screen and (max-width:600px) {.pj-btn{position:absolute;top:10px;z-index:1;}}
/* Small devices (portrait tablets and large phones, 600px and up) */
@media only screen and (min-width:600px) {.pj-btn {position:absolute;top:10px;z-index:1;}}
/* Medium devices (landscape tablets, 768px and up) */
@media only screen and (min-width:768px) {.pj-btn {position:absolute;top:16px;z-index:1;}}
/* Large devices (laptops/desktops, 992px and up) */
@media only screen and (min-width:992px) {.pj-btn{position:absolute;top:16px;z-index:1;}}
/* Extra large devices (large laptops and desktops, 1200px and up) */
@media only screen and (min-width:1200px) {.pj-btn{position:absolute;top:16px;z-index:1;}}
</style>
@endsection
@section('content')
<ol class="breadcrumb page-breadcrumb text-sm font-prompt">
	<li class="breadcrumb-item"><i class="fal fa-home mr-1"></i> <a href="{{ route('staff.index') }}">หน้าหลัก</a></li>
</ol>
<div class="row text-sm font-prompt">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
		<div class="border px-3 pt-3 pb-0 rounded">
			<ul class="nav nav-pills" role="tablist">
				<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#js_pill_border_icon-1"><i class="fal fa-user mr-1"></i>ข้อมูลส่วนตัว</a></li>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#js_pill_border_icon-2"><i class="fal fa-envelope mr-1"></i>กล่องข้อความ</a></li>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#js_pill_border_icon-3"><i class="fal fa-calendar-check mr-1"></i>ปฏิทินงาน</a></li>
			</ul>
			<div class="tab-content py-3">
				<div class="tab-pane fade show active" id="js_pill_border_icon-1" role="tabpanel">

					<div class="row">
						<div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
							<div class="card mb-g rounded-top">
								<div class="row no-gutters row-grid">
									<div class="col-12">
										<div class="d-flex flex-column align-items-center justify-content-center p-4">
											<img src="{{ URL::asset('images/small-moph-logo-32x32.png') }}" class="rounded-circle shadow-2 img-thumbnail" alt="">
											<h5 class="mb-0 fw-700 text-center mt-3">
												{{ auth()->user()->username }}
												<small class="text-muted mb-0">{{ auth()->user()->user_type }}, {{ auth()->user()->email }}</small>
											</h5>
											<div class="mt-4 text-center demo">
												<a href="javascript:void(0);" class="fs-xl" style="color:#3b5998">
													<i class="fal fa-circle"></i>
												</a>
												<a href="javascript:void(0);" class="fs-xl" style="color:#38A1F3">
                                                    <i class="fal fa-circle"></i>
												</a>
												<a href="javascript:void(0);" class="fs-xl" style="color:#db3236">
                                                    <i class="fal fa-circle"></i>
												</a>
												<a href="javascript:void(0);" class="fs-xl" style="color:#0077B5">
                                                    <i class="fal fa-circle"></i>
												</a>
												<a href="javascript:void(0);" class="fs-xl" style="color:#000000">
                                                    <i class="fal fa-circle"></i>
												</a>
												<a href="javascript:void(0);" class="fs-xl" style="color:#00AFF0">
                                                    <i class="fal fa-circle"></i>
												</a>
												<a href="javascript:void(0);" class="fs-xl" style="color:#0063DC">
                                                    <i class="fal fa-circle"></i>
												</a>
											</div>
										</div>
									</div>
									<div class="col-12">
										<div class="text-center py-3">

                                            <div class="ml-3">
                                                <strong>
                                                    ชื่อ-สกุล
                                                </strong>
                                                <br>
                                                {{ auth()->user()->userStaff->first_name.' '.auth()->user()->userStaff->last_name }}
                                            </div>
                                            <div class="mt-3 ml-3">
                                                <strong>
                                                    ตำแหน่ง
                                                </strong>
                                                <br>
                                                นักวิทยาศาสตร์การแพทย์
                                            </div>
                                            <div class="mt-3 ml-3">
                                                <strong>
                                                    สังกัด
                                                </strong>
                                                <br>
                                                ศูนย์อ้างอิงทางห้องปฏิบัติการและพิษวิทยา
                                            </div>
                                            <div class="mt-3 ml-3">
                                                <strong>
                                                    หน้าที่รับผิดชอบ
                                                </strong>
                                                <br>
                                                ผู้รับตัวอย่าง

                                            </div>
										</div>
									</div>
									<div class="col-12">
										<div class="p-3 text-center">
											<a href="javascript:void(0);" class="btn-link font-weight-bold">แก้ไขข้อมูล</a>
										</div>
									</div>
								</div>
							</div>
                        </div>

                    </div>


				</div>



				<div class="tab-pane fade" id="js_pill_border_icon-2" role="tabpanel">
					Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic.
				</div>
				<div class="tab-pane fade" id="js_pill_border_icon-3" role="tabpanel">
					Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork.
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script type="text/javascript" src="{{ URL::asset('assets/js/datagrid/datatables/datatables.bundle.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/buttons.server-side.js') }}"></script>
<script type="text/javascript">$(document).ready(function(){$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});});</script>
{{-- {{ $dataTable->scripts() }} --}}
@endsection

@extends('layouts.index')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/datagrid/datatables/datatables.bundle.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/miscellaneous/fullcalendar/fullcalendar.bundle.css') }}" media="screen, print">
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
<div class="row font-prompt">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
		<div class="border px-3 pt-3 pb-0 rounded">
			<ul class="nav nav-pills" role="tablist">
				<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#js_pill_border_icon-1"><i class="fal fa-user mr-1"></i>ข้อมูลส่วนตัว</a></li>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#js_pill_border_icon-2" id="jetkhe"><i class="fal fa-envelope mr-1"></i>กล่องข้อความ</a></li>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#js_pill_border_icon-3" id="isad"><i class="fal fa-calendar-check mr-1"></i>ปฏิทินงาน</a></li>
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
												<strong>ชื่อ-สกุล</strong>
												<p class="text-indigo-400">{{ auth()->user()->userStaff->first_name.' '.auth()->user()->userStaff->last_name }}</p>
											</div>
											<div class="mt-3 ml-3">
												<strong>ตำแหน่ง</strong>
												<p class="text-indigo-400">นักวิทยาศาสตร์การแพทย์</p>
											</div>
											<div class="mt-3 ml-3">
												<strong>สังกัด</strong>
												<p class="text-indigo-400">ศูนย์อ้างอิงทางห้องปฏิบัติการและพิษวิทยา</p>
											</div>
											<div class="mt-3 ml-3">
												<strong>หน้าที่รับผิดชอบ</strong>
												<p class="text-indigo-400">ผู้รับตัวอย่าง</p>
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
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
							<table id="talek_team" class="table table-bordered text-sm">
								<thead class="bg-gray-300">
									<tr>
										<th>Id</th>
										<th>order_no</th>
										<th>order_type</th>
									</tr>
								</thead>
								<tfoot></tfoot>
								<tbody></tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="js_pill_border_icon-3" role="tabpanel">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
                            <div id="panel-1" class="panel">
                                <div class="panel-hdr">
                                    <h2>
                                        Advanced <span class="fw-300"><i>Example</i></span>
                                    </h2>
                                    <div class="panel-toolbar">
                                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                                    </div>
                                </div>
                                <div class="panel-container">
                                    <div class="panel-content show" style="display: block;">
                                        <div id="calendar"></div>
                                        <!-- Modal : TODO -->
                                        <!-- Modal end -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script type="text/javascript" src="{{ URL::asset('assets/js/datagrid/datatables/datatables.bundle.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/dependency/moment/moment.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/miscellaneous/fullcalendar/fullcalendar.bundle.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/buttons.server-side.js') }}"></script>
<script>
    var todayDate = moment().startOf('day');
    var YM = todayDate.format('YYYY-MM');
    var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
    var TODAY = todayDate.format('YYYY-MM-DD');
    var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');

    document.addEventListener('DOMContentLoaded', function()
    {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl,
        {
            plugins: ['dayGrid', 'list', 'timeGrid', 'interaction', 'bootstrap'],
            themeSystem: 'bootstrap',
            timeZone: 'UTC',
            dateAlignment: "month", //week, month
            buttonText:
            {
                today: 'today',
                month: 'month',
                week: 'week',
                day: 'day',
                list: 'list'
            },
            eventTimeFormat:
            {
                hour: 'numeric',
                minute: '2-digit',
                meridiem: 'short'
            },
            navLinks: true,
            header:
            {
                left: 'prev,next today addEventButton',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
            },
            footer:
            {
                left: '',
                center: '',
                right: ''
            },
            customButtons:
            {
                addEventButton:
                {
                    text: '+',
                    click: function()
                    {
                        var dateStr = prompt('Enter a date in YYYY-MM-DD format');
                        var date = new Date(dateStr + 'T00:00:00'); // will be in local time

                        if (!isNaN(date.valueOf()))
                        { // valid?
                            calendar.addEvent(
                            {
                                title: 'dynamic event',
                                start: date,
                                allDay: true
                            });
                            alert('Great. Now, update your database...');
                        }
                        else
                        {
                            alert('Invalid date.');
                        }
                    }
                }
            },
            //height: 700,
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            events: [
            {
                title: 'All Day Event',
                start: YM + '-01',
                description: 'This is a test description', //this is currently bugged: https://github.com/fullcalendar/fullcalendar/issues/1795
                className: "border-warning bg-warning text-dark"
            },
            {
                title: 'Reporting',
                start: YM + '-14T13:30:00',
                end: YM + '-14',
                className: "bg-white border-primary text-primary"
            },
            {
                title: 'Company Trip',
                start: YM + '-02',
                end: YM + '-03',
                className: "bg-primary border-primary text-white"
            },
            {
                title: 'NextGen Expo 2019 - Product Release',
                start: YM + '-03',
                end: YM + '-05',
                className: "bg-info border-info text-white"
            },
            {
                title: 'Dinner',
                start: YM + '-12',
                end: YM + '-10'
            },
            {
                id: 999,
                title: 'Repeating Event',
                start: YM + '-09T16:00:00',
                className: "bg-danger border-danger text-white"
            },
            {
                id: 1000,
                title: 'Repeating Event',
                start: YM + '-16T16:00:00'
            },
            {
                title: 'Conference',
                start: YESTERDAY,
                end: TOMORROW,
                className: "bg-success border-success text-white"
            },
            {
                title: 'Meeting',
                start: TODAY + 'T10:30:00',
                end: TODAY + 'T12:30:00',
                className: "bg-primary text-white border-primary"
            },
            {
                title: 'Lunch',
                start: TODAY + 'T12:00:00',
                className: "bg-info border-info"
            },
            {
                title: 'Meeting',
                start: TODAY + 'T14:30:00',
                className: "bg-warning text-dark border-warning"
            },
            {
                title: 'Happy Hour',
                start: TODAY + 'T17:30:00',
                className: "bg-success border-success text-white"
            },
            {
                title: 'Dinner',
                start: TODAY + 'T20:00:00',
                className: "bg-danger border-danger text-white"
            },
            {
                title: 'Birthday Party',
                start: TOMORROW + 'T07:00:00',
                className: "bg-primary text-white border-primary text-white"
            },
            {
                title: 'Gotbootstrap Meeting',
                url: 'http://gotbootstrap.com/',
                start: YM + '-28',
                className: "bg-info border-info text-white"
            }],
            /*eventClick:  function(info) {
                $('#calendarModal .modal-title .js-event-title').text(info.event.title);
                $('#calendarModal .js-event-description').text(info.event.description);
                $('#calendarModal .js-event-url').attr('href',info.event.url);
                $('#calendarModal').modal();
                console.log(info.event.className);
                console.log(info.event.title);
                console.log(info.event.description);
                console.log(info.event.url);
            },*/
            /*viewRender: function(view) {
                localStorage.setItem('calendarDefaultView',view.name);
                $('.fc-toolbar .btn-primary').removeClass('btn-primary').addClass('btn-outline-secondary');
            },*/

        });

        calendar.render();
    });

</script>
<script type="text/javascript">
$(document).ready(function() {
    $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
	$('#jetkhe').on('click', function() {
		$('#talek_team').dataTable().fnClearTable();
		$('#talek_team').dataTable().fnDestroy();
		$('#talek_team').DataTable({
			processing: true,
			serverSide: true,
			ajax: "{{ route('staff.inbox') }}",
			columns: [
				{ data: 'id', name: 'id' },
				{ data: 'order_no', name: 'order_no' },
				{ data: 'order_type', name: 'order_type' }
			]
		});
	});
});
</script>

@endsection

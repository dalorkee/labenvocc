@extends('layouts.index')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/miscellaneous/fullcalendar/fullcalendar.bundle.css') }}" media="screen, print">
@section('content')
<ol class="breadcrumb page-breadcrumb text-sm font-prompt">
	<li class="breadcrumb-item"><i class="fal fa-home mr-1"></i> <a href="{{ route('staff.index') }}">หน้าหลัก</a></li>
</ol>
<div class="row font-prompt">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
		<div class="border px-3 pt-3 pb-0 rounded">
			<ul class="nav">
				<li class="nav-item"><a class="nav-link" href="{{ route('staff.index') }}"><i class="fal fa-user mr-1"></i>ข้อมูลส่วนตัว</a></li>
				<li class="nav-item"><a class="nav-link" href="{{ route('staff.inbox') }}"><i class="fal fa-envelope mr-1"></i>กล่องข้อความ</a></li>
				<li class="nav-item"><a class="nav-link btn btn-sm btn-danger" href="{{ route('staff.calendar') }}"><i class="fal fa-calendar-check mr-1"></i>ปฏิทินงาน</a></li>
			</ul>

                    <div class="row mt-3">
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
                                    <div class="panel-content show">
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
@endsection
@section('script')
<script type="text/javascript" src="{{ URL::asset('assets/js/dependency/moment/moment.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/miscellaneous/fullcalendar/fullcalendar.bundle.js') }}"></script>

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


@endsection

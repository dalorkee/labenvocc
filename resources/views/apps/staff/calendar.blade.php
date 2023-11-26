@extends('layouts.index')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('style')
<link href="{{ URL::asset('vendor/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/miscellaneous/fullcalendar/fullcalendar.bundle.css') }}" media="screen, print">
@endsection
@section('content')
<ol class="breadcrumb page-breadcrumb text-sm font-prompt">
	<li class="breadcrumb-item"><i class="fal fa-home mr-1"></i> <a href="{{ route('staff.index') }}">หน้าหลัก</a></li>
	<li class="breadcrumb-item">ปฏิทินงาน</li>
</ol>
<div class="row font-prompt">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
		<div class="border px-3 pt-3 pb-0 rounded">
			<ul class="nav">
				<li class="nav-item"><a class="nav-link" href="{{ route('staff.index') }}"><i class="fal fa-user mr-1"></i>ข้อมูลส่วนตัว</a></li>
				<li class="nav-item"><a class="nav-link" href="{{ route('staff.inbox') }}"><i class="fal fa-envelope mr-1"></i>กล่องข้อความ</a></li>
				<li class="nav-item"><a class="nav-link btn btn-sm btn-primary" href="{{ route('staff.calendar') }}"><i class="fal fa-calendar-check mr-1"></i>ปฏิทินงาน</a></li>
			</ul>
			<div class="row mt-3">
				<div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
					<div class="panel">
						<div class="panel-hdr">
							<h2>ปฏิทินงาน</span></h2>
							<div class="panel-toolbar">
								<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"><i class="fal fa-window-minimize"></i></button>
								<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"><i class="fal fa-expand"></i></button>
								<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"><i class="fal fa-times"></i></button>
							</div>
						</div>
						<div class="panel-container">
							<div class="panel-content">
								<div id="calendar"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modal_add" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content">
			<form name="store" action="{{ route('calendar.store') }}" method="POST">
				@csrf
				<div class="modal-header bg-primary text-white">
					<h5 class="modal-title">เพิ่มงานในปฏิทิน</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true"><i class="fal fa-times"></i></span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-row">
						<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
							<label class="form-label" for="title">หัวข้อ <span class="text-red-600">*</span></label>
							<input type="text" name="title" class="form-control @error('title') is-invalid @enderror">
							@error('title')<div class="text-danger text-xs pt-2" role="alert">{{ $message }}</div>@enderror
						</div>
						<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-6 col-lg-6 mb-3">
							<label class="form-label" for="start">เริ่ม <span class="text-red-600">*</span></label>
							<div class="input-group">
								<input type="text" name="start" placeholder="วันที่เริ่ม" class="form-control @error('start') is-invalid @enderror input-date" id="date_start">
								<div class="input-group-append">
									<span class="input-group-text fs-xl">
										<i class="fal fa-calendar-alt"></i>
									</span>
								</div>
							</div>
							@error('start')<div class="text-danger text-xs pt-2" role="alert">{{ $message }}</div>@enderror
						</div>
						<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-6 col-lg-6 mb-3">
							<label class="form-label" for="end">สิ้นสุด <span class="text-red-600">*</span></label>
							<div class="input-group">
								<input type="text" name="end" placeholder="วันที่สิ้นสุด" class="form-control @error('end') is-invalid @enderror input-date" id="date_end">
								<div class="input-group-append">
									<span class="input-group-text fs-xl">
										<i class="fal fa-calendar-alt"></i>
									</span>
								</div>
							</div>
							@error('end')<div class="text-danger text-xs pt-2" role="alert">{{ $message }}</div>@enderror
						</div>
						<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
							<label class="form-label" for="description">รายละเอียด</label>
							<textarea type="text" name="description" class="form-control"></textarea>
							@error('description')<div class="text-danger text-xs pt-2" role="alert">{{ $message }}</div>@enderror
						</div>
						<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
							<label class="form-label" for="color">เลือกสีพื้นหลัง</label>
							<select name="class_name" class="form-control">
								<option value="bg-white border-primary text-primary">สีขาว</option>
								<option value="bg-primary border-primary text-white">สีน้ำเงิน</option>
								<option value="bg-info border-info text-white">สีม่วง</option>
								<option value="bg-success border-success text-white">สีเขียว</option>
								<option value="bg-warning text-dark border-warning">สีส้ม</option>
								<option value="bg-danger border-danger text-white">สีแดง</option>
							</select>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
					<button type="submit" class="btn btn-primary">บันทึก</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="modal_show" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content">
			<form name="show" action="{{ route('calendar.show', ['calendar' => 1]) }}" method="POST">
				@csrf
				<div class="modal-header bg-warning text-dark">
					<h5 class="modal-title">แก้ไข/ลบ งานในปฏิทิน</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true"><i class="fal fa-times"></i></span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-row">
						<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
							<label class="form-label" for="etitle">หัวข้อ <span class="text-red-600">*</span></label>
							<input type="text" name="etitle" id="etitle" class="form-control @error('etitle') is-invalid @enderror">
							@error('etitle')<div class="text-danger text-xs pt-2" role="alert">{{ $message }}</div>@enderror
						</div>
						<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-6 col-lg-6 mb-3">
							<label class="form-label" for="date_estart">เริ่ม <span class="text-red-600">*</span></label>
							<div class="input-group">
								<input type="text" name="estart" id="date_estart" class="form-control @error('start') is-invalid @enderror input-date">
								<div class="input-group-append">
									<span class="input-group-text fs-xl">
										<i class="fal fa-calendar-alt"></i>
									</span>
								</div>
							</div>
							@error('start')<div class="text-danger text-xs pt-2" role="alert">{{ $message }}</div>@enderror
						</div>
						<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-6 col-lg-6 mb-3">
							<label class="form-label" for="end">สิ้นสุด <span class="text-red-600">*</span></label>
							<div class="input-group">
								<input type="text" name="end" placeholder="วันที่สิ้นสุด" class="form-control @error('end') is-invalid @enderror input-date" id="datepicker_end">
								<div class="input-group-append">
									<span class="input-group-text fs-xl">
										<i class="fal fa-calendar-alt"></i>
									</span>
								</div>
							</div>
							@error('end')<div class="text-danger text-xs pt-2" role="alert">{{ $message }}</div>@enderror
						</div>
						<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
							<label class="form-label" for="description">รายละเอียด</label>
							<textarea type="text" name="description" class="form-control"></textarea>
							@error('description')<div class="text-danger text-xs pt-2" role="alert">{{ $message }}</div>@enderror
						</div>
						<div class="form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
							<label class="form-label" for="color">เลือกสีพื้นหลัง</label>
							<select name="class_name" class="form-control">
								<option value="bg-white border-primary text-primary">สีขาว</option>
								<option value="bg-primary border-primary text-white">สีน้ำเงิน</option>
								<option value="bg-info border-info text-white">สีม่วง</option>
								<option value="bg-success border-success text-white">สีเขียว</option>
								<option value="bg-warning text-dark border-warning">สีส้ม</option>
								<option value="bg-danger border-danger text-white">สีแดง</option>
							</select>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
					<button type="submit" class="btn btn-primary">บันทึก</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
@section('script')
<script type="text/javascript" src="{{ URL::asset('assets/js/dependency/moment/moment.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('vendor/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/miscellaneous/fullcalendar/fullcalendar.bundle.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {
	$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
	$('#date_start').datetimepicker({
		allowInputToggle: true,
		showClose: true,
		showClear: true,
		showTodayButton: true,
		format: "DD/MM/YYYY HH:mm:ss",
	});
	$('#date_end').datetimepicker({
		allowInputToggle: true,
		showClose: true,
		showClear: true,
		showTodayButton: true,
		format: "DD/MM/YYYY HH:mm:ss",
	});
    $('#date_estart').datetimepicker({
		allowInputToggle: true,
		showClose: true,
		showClear: true,
		showTodayButton: true,
		format: "DD/MM/YYYY HH:mm:ss",
	});
});
</script>
<script type="text/javascript">
	document.addEventListener('DOMContentLoaded', function() {
		var calendarEl = document.getElementById('calendar');
		var calendar = new FullCalendar.Calendar(calendarEl,
		{
			plugins: ['dayGrid', 'list', 'timeGrid', 'interaction', 'bootstrap'],
			themeSystem: 'bootstrap',
			timeZone: 'Asia/Bangkok',
			dateAlignment: "month", //week, month
			buttonText: {
				today: 'วันนี้',
				month: 'เดือน',
				week: 'สัปดาห์',
				day: 'วัน',
				list: 'รายการ'
			},
			eventTimeFormat: {
				hour: 'numeric',
				minute: '2-digit',
				meridiem: 'short'
			},
			navLinks: false,
			header: {
				left: 'prev,next today addEventButton',
				center: 'title',
				right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
			},
			footer: {
				left: '',
				center: '',
				right: ''
			},
			customButtons: {
				addEventButton: {
					text: 'เพิ่มงานใหม่',
					className: 'btn btn-primary',
					click: function() {
						$('#modal_add').modal();
					}
				}
			},
			// height: 700,
			editable: true,
			eventLimit: true,
			events: [
			@foreach ($calendar as $key => $val)
			{
				id: {!! "'".$val->id."'" !!},
				title: {!! "'".$val->title."'" !!},
				start: {!! "'".$val->start."'" !!},
				end: {!! "'".$val->end."'" !!},
				description: {!! "'".$val->description."'" !!},
				className: {!! "'".$val->class_name."'" !!}
			},
			@endforeach
			],
			eventClick: function(info) {
				let id = info.event.id;
				let url = "{{ route('calendar.show', ['calendar' => ':id']) }}";
				url = url.replace(':id', id);
				$.ajax({
					method: "GET",
					url: url,
					dataType: "JSON",
					success: function(calendar) {
						$('#etitle').val(calendar.title);
						$('#date_estart').val(moment(calendar.start).format('DD/MM/YYYY HH:mm:ss'));
						$('#modal_show').modal({backdrop: 'static', keyboard: false});
					},
					error: function(data, status, error) {alert(error);}
				});
			},

		});
		calendar.render();
	});
</script>
@endsection

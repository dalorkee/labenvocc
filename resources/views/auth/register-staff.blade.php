@extends('layouts.guest.index')
@section('meta-token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('style')
<link rel="stylesheet" href="{{ URL::asset('css/register_staff.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/css/formplugins/select2/select2.bundle.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/css/notifications/sweetalert2/sweetalert2.bundle.css') }}" media="screen, print">
@endsection
@section('content')
<div class="wrapper">
	<form id="form" action="{{ route('registerStaff.store') }}" method="POST">
		@csrf
		<div id="wizard" class="font-prompt">
			<!-- SECTION 1 -->
			<h4></h4>
			<section>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label class="form-label" for="id_card">1.1 เลขบัตรประชาชน <span class="text-red-600">*</span></label>
						<input type="text" name="id_card" id="id_card" value="{{ old('id_card') }}" class="form-control @error('id_card') is-invalid @enderror" required>
						@error('id_card')
							<div class="invalid-feedback" role="alert">{{ $message }}</div>
						@enderror
					</div>
					<div class="form-group col-md-6">
						<label class="form-label" for="title_name">1.2 คำนำหน้าชื่อ <span class="text-red-600">*</span></label>
						<select name="title_name" id="title_name" class="select2-hide-search form-control @error('title_name') is-invalid @enderror" required>
							@if (old('title_name'))
								<option value="{{ old('title_name') }}">{{ $title_name[old('title_name')] }}</option>
							@endif
							<option value="">-- โปรดเลือก --</option>
							@foreach ($title_name as $key => $val)
								<option value="{{ $key }}">{{ $val }}</option>
							@endforeach
						</select>
						@error('id_card')
							<div class="invalid-feedback" role="alert">{{ $message }}</div>
						@enderror
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label class="form-label" for="firstname">1.3 ชื่อ <span class="text-red-600">*</span></label>
						<input type="text" name="firstname" value="{{ old('firstname') }}" class="form-control @error('firstname') is-invalid @enderror" required>
						@error('firstname')
							<div class="invalid-feedback" role="alert">{{ $message }}</div>
						@enderror
					</div>
					<div class="form-group col-md-6">
						<label class="form-label" for="lastname">1.4 นามสกุล <span class="text-red-600">*</span></label>
						<input type="text" name="lastname" value="{{ old('lastname') }}" class="form-control @error('lastname') is-invalid @enderror" required>
						@error('lastname')
							<div class="invalid-feedback" role="alert">{{ $message }}</div>
						@enderror
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label class="form-label" for="mobile">1.5 โทรศัพท์เคลื่อนที่ <span class="text-red-600">*</span></label>
						<input type="text" name="mobile" value="{{ old('mobile') }}" class="form-control @error('mobile') is-invalid @enderror" required>
						@error('moblie')
							<div class="invalid-feedback" role="alert">{{ $message }}</div>
						@enderror
					</div>
					<div class="form-group col-md-6">
						<label class="form-label" for="email">1.6 อีเมล์ <span class="text-red-600">*</span></label>
						<input type="email" name="email" value="{{ old('email') }}" id="email" class="form-control @error('email') is-invalid @enderror" required>
						@error('email')
							<div class="invalid-feedback" role="alert">{{ $message }}</div>
						@enderror
					</div>
				</div>
			</section>
			<!-- SECTION 2 -->
			<h4></h4>
			<section>
				<div class="form-row">
					<div class="form-group col-md-12">
						<label class="form-label" for="affiliation">2.1 สังกัด <span class="text-red-600">*</span></label>
						<select name="affiliation" class="select2-hide-search form-control" required>
							@if (old('affiliation'))
								<option value="{{ $affiliation[old('affiliation')] }}">-- โปรดเลือก --</option>
							@endif
							<option value="">-- โปรดเลือก --</option>
							@foreach ($affiliation as $key => $val)
								<option value="{{ $key }}">{{ $val }}</option>
							@endforeach
						</select>
						@error('affiliation')
							<div class="invalid-feedback" role="alert">{{ $message }}</div>
						@enderror
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label class="form-label" for="position">2.2 ตำแหน่ง <span class="text-red-600">*</span></label>
						<select name="position" id="position" class="select2 form-control" required>
							@if (old('position'))
								<option value="{{ $positions[old('position')] }}">-- โปรดเลือก --</option>
							@endif
							<option value="">-- โปรดเลือก --</option>
							@foreach ($positions as $key => $val)
								<option value="{{ $key }}">{{ $val }}</option>
							@endforeach
						</select>
						@error('position')
							<div class="invalid-feedback" role="alert">{{ $message }}</div>
						@enderror
					</div>
					<div class="form-group col-md-6">
						<label class="form-label" for="position_other">2.3 ตำแหน่งอื่นๆ ระบุ</label>
						<input type="text" name="position_other" id="position_other" class="form-control" disabled>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label class="form-label" for="position_level">2.4 ระดับตำแหน่ง</label>
						<select name="position_level" id="position_level" class="select2 form-control">
							<option value="">-- โปรดเลือก --</option>
						</select>
						<div class="invalid-feedback">โปรดเลือก ระดับตำแหน่ง</div>
					</div>
					<div class="form-group col-md-6">
						<label class="form-label" for="fname">2.5 หน้าที่ <span class="text-red-600">*</span></label>
						<select name="duty" id="duty" class="select2 form-control">
							@if (old('duty'))
								<option value="{{ $staffDuty[old('duty')] }}">-- โปรดเลือก --</option>
							@endif
							<option value="">-- โปรดเลือก --</option>
							@foreach ($staffDuty as $key => $val)
								<option value="{{ $key }}">{{ $val }}</option>
							@endforeach
						</select>
						@error('duty')
							<div class="invalid-feedback" role="alert">{{ $message }}</div>
						@enderror
					</div>
				</div>
			</section>
			<!-- SECTION 3 -->
			<h4></h4>
			<section>
				<div class="form-row">
					<div class="form-group col-md-12">
						<label class="form-label" for="username">3.1 ชื่อผู้ใช้ <span class="text-red-600">*</span></label>
						<input type="text" name="username" value="{{ old('username') }}" class="form-control" required>
						@error('username')
							<div class="invalid-feedback" role="alert">{{ $message }}</div>
						@enderror
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label class="form-label" for="password">3.2 รหัสผ่าน <span class="text-red-600">*</span></label>
						<div class="input-group">
							<input type="password" name="password" id="password" class="form-control" required>
							<div class="input-group-append">
								<span class="input-group-text"><i class="fal fa-eye toggle-password" toggle="#password"></i></span>
							</div>
						</div>
						@error('password')
							<div class="invalid-feedback" role="alert">{{ $message }}</div>
						@enderror
					</div>
					<div class="form-group col-md-6">
						<label class="form-label" for="password_confirmation">3.3 ยืนยันรหัสผ่าน <span class="text-red-600">*</span></label>
						<div class="input-group">
							<input type="password" name="password_confirmation" id="confirm_password" class="form-control" required>
							<div class="input-group-append">
								<span class="input-group-text"><i class="fal fa-eye toggle-confirm-password" toggle="#confirm_password"></i></span>
							</div>
						</div>
						@error('password_confirmation')
							<div class="invalid-feedback" role="alert">{{ $message }}</div>
						@enderror
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<div class="captcha inline-block">{!! captcha_img('flat') !!}</div>
						<button type="button" class="btn btn-sm btn-primary" id="refresh-captcha" style="margin-bottom:24px;">
							<span>&#x21bb;</span>
						</button>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<input type="text" name="captcha" id="captcha" class="form-control" placeholder="ป้อนรหัสที่ท่านเห็น">
					</div>
				</div>
			</section>
			<!-- SECTION 4 -->
			{{-- <h4></h4>
			<section> <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
					<circle class="path circle" fill="none" stroke="#73AF55" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1" />
					<polyline class="path check" fill="none" stroke="#73AF55" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 " /> </svg>
				<p class="success">Order placed successfully. Your order will be dispacted soon. meanwhile you can track your order in my order section.</p>
			</section> --}}
		</div>
	</form>
</div>

@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.1.0/jquery.steps.min.js"></script>
<script src="{{ URL::asset('assets/js/formplugins/select2/select2.bundle.js') }}"></script>
<script src="{{ URL::asset('assets/js/notifications/sweetalert2/sweetalert2.bundle.js') }}"></script>
<script>
$(document).ready(function() {
	$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
	$(function(){
		$('.select2').select2();
		$('.select2-hide-search').select2({
			minimumResultsForSearch: 1/0
		});

	});
});
</script>
<script>
$(function(){
	$("#wizard").steps({
		headerTag: "h4",
		bodyTag: "section",
		transitionEffect: "fade",
		enableAllSteps: true,
		transitionEffectSpeed: 500,
		onStepChanging: function (event, currentIndex, newIndex) {
			if ( newIndex === 1 ) {
				$('.steps ul').addClass('step-2');
			} else {
				$('.steps ul').removeClass('step-2');
			}
			if ( newIndex === 2 ) {
				$('.steps ul').addClass('step-3');
				//$('.actions ul').addClass('step-last');
			} else {
				$('.steps ul').removeClass('step-3');
				//$('.actions ul').removeClass('step-last');
			}
			// if ( newIndex === 3 ) {
			// 	$('.steps ul').addClass('step-4');
			// 	$('.actions ul').addClass('step-last');
			// } else {
			// 	$('.steps ul').removeClass('step-4');
			// 	$('.actions ul').removeClass('step-last');
			// }
			return true;
		},
		labels: {
			finish: "ลงทะเบียน",
			next: "ต่อไป",
			previous: "ก่อนหน้า",
		},
		onFinished: function (event, currentIndex) {
			Swal.fire({
				title: "ยืนยันข้อมูลของท่าน?",
				text: "โปรดตรวจสอบข้อมูลให้ถูกต้อง ก่อนบันทึกข้อมูลเสมอ!",
				type: "warning",
				showCancelButton: true,
				cancelButtonText: "ยกเลิก",
				confirmButtonText: "บันทึกข้อมูล"
			}).then(function(result){
				if (result.value){
					$("#form").submit();
				}
			});
		}
	});
	// Custom Steps Jquery Steps
	$('.wizard > .steps li a').click(function(){
		$(this).parent().addClass('checked');
		$(this).parent().prevAll().addClass('checked');
		$(this).parent().nextAll().removeClass('checked');
	});
	// Custom Button Jquery Steps
	$('.forward').click(function(){
	$("#wizard").steps('next');
	})
	$('.backward').click(function(){
		$("#wizard").steps('previous');
	})
	// Checkbox
	// $('.checkbox-circle label').click(function(){
	// 	$('.checkbox-circle label').removeClass('active');
	// 	$(this).addClass('active');
	// })
});
</script>
<script>
$(function(){
	$('#position').on('change', function() {
			let pid = $(this).val();
			if (pid === '81') {
				$('#position_other').prop('disabled', false);
				$('#position_other').val('');
				$('#position_other').focus();
			} else {
				$('#position_other').val('');
				$('#position_other').prop('disabled', true);
				$('#position').focus();
			}
		});
		$('#refresh-captcha').click(function () {
			$.ajax({
				type: "POST",
				url: "{{ route('register.refresh-captcha') }}",
				success: function (data) {
					$(".captcha").html(data.captcha);
				}
			});
		});

			$(".toggle-password").click(function() {
			$(this).toggleClass("fa-eye fa-eye-slash");
			var type = $($(this).attr("toggle"));
			if (type.attr("type") == "password") {
				type.attr("type", "text");
			} else {
				type.attr("type", "password");
			}
		});
		$(".toggle-confirm-password").click(function() {
			$(this).toggleClass("fa-eye fa-eye-slash");
			var type = $($(this).attr("toggle"));
			if (type.attr("type") == "password") {
				type.attr("type", "text");
			} else {
				type.attr("type", "password");
			}
		});
});
</script>
<script>
	$(document).ready(function() {
		$("#register").on("click", function() {
			Swal.fire({
				title: "Are you sure?",
				text: "You won't be able to revert this!",
				type: "warning",
				showCancelButton: true,
				confirmButtonText: "Yes, delete it!"
			}).then(function(result){
				if (result.value){
					Swal.fire("Deleted!", "Your file has been deleted.", "success");
				}
			});
		});
	});
	</script>
@endsection

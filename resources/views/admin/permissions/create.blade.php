@extends('layouts.index')
@section('custom-style')
<link type="text/css" href="{{ URL::asset('admindek/css/style.css') }}" rel="stylesheet" >
@endsection
@section('custom-style')
<!-- <link rel="stylesheet" href="{{ URL::asset('assets/libs/select2/dist/css/select2.min.css') }}"> -->
@endsection
@section('contents')
<div class="page-breadcrumb bg-light">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title"><span style="display:none;">Create Permission</span></h4>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ route('users.index') }}">Permission</a></li>
						<li class="breadcrumb-item active" aria-current="page"><a href="#">Create</a></li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="d-md-flex align-items-center" style="border-bottom:1px solid #EAEAEA">
						<div>
							<h4 class="card-title">บริหารจัดการผู้ใช้งานระบบ</h4>
							<h5 class="card-subtitle">เพิ่มสิทธิ์ผู้ใช้งาน</h5>
						</div>
					</div>
					<div class="my-4">
						@if (count($errors) > 0)
							<div class="alert alert-danger">
								<strong>Whoops!</strong> There were some problems with your input.<br><br>
								<ul>
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif
						{!! Form::open(array('route'=>'permissions.store', 'method'=>'POST', 'class'=>'mt-4 mb-3')) !!}
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
								<div class="form-group">
									<label for="otherTitleNameInput">ชื่อสิทธิ์</label>
									<input type="text" name="name" required class="form-control" placeholder="ชื่อสิทธิ์" >
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
								<div class="form-group">
									<label>กลุ่มผู้ใช้งาน:</label>
										<div class="custom-control custom-checkbox">
											<input class="custom-control-input" name="select_all" value="all" type="checkbox" id="selectAll">
											<label class="custom-control-label" for="selectAll">All</label>
											<br />
										</div>

											@foreach($roles as $role)
											<div class="custom-control custom-checkbox">
											<input class="custom-control-input" name="roles[]" value="{{ $role->id }}" type="checkbox" id="checkbox{{ $role->id }}">
											<label class="custom-control-label" for="checkbox{{ $role->id }}">{{ ucfirst($role->name) }}</label>
											<br />
											</div>
											@endforeach

								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 col-xl-3">
								<div class="form-group">
									<button type="submit" class="btn btn-primary">Create</button>
								</div>
							</div>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('bottom-script')
	<!-- <script src="{{ URL::asset('assets/libs/select2/dist/js/select2.min.js') }}"></script> -->
	<script>
	$(document).ready(function() {
	  /* ajax request */
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		//$('#select-roles').selectpicker();
	  $("#selectAll").click(function(){
	        $("input[type=checkbox]").prop('checked', $(this).prop('checked'));
	  });
	});
	</script>
@endsection

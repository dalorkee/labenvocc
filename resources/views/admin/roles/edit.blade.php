@extends('layouts.index')
@section('custom-style')
<link type="text/css" href="{{ URL::asset('admindek/css/style.css') }}" rel="stylesheet" >
@endsection
@section('custom-style')
<style>
	input:-moz-read-only { /* For Firefox */
		background-color: #fafafa !important;
	}
	input:read-only {
		background-color: #fafafa !important;
	}
	.select-custom select option {
		padding: 18px!important;
	}
	.font-fira {
		font-family: 'Fira-code' !important;
	}
	.input-group .bootstrap-select.form-control {
		z-index: 0;
	}
</style>
@endsection
@section('contents')
<div class="page-breadcrumb bg-light">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title"><span style="display:none;">Users</span></h4>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
						<li class="breadcrumb-item active" aria-current="page"><a href="#">Edit</a></li>
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
							<h5 class="card-subtitle">ID Flu-BOE</h5>
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
						{!! Form::model($role, ['method' => 'PATCH', 'route' => ['roles.update', $role->id]]) !!}
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12">
								<div class="form-group">
									<strong>Name:</strong>
									{!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
								</div>
							</div>

								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
									<div class="form-group">
										<label>Permission:</label>
											<div class="custom-control custom-checkbox">
												<input class="custom-control-input" name="select_all" value="all" type="checkbox" id="selectAll">
												<label class="custom-control-label" for="selectAll">All</label>
												<br />
											</div>

												@foreach($permission as $value)
												<div class="custom-control custom-checkbox">
												<input class="custom-control-input" name="permission[]" value="{{ $value->id }}" type="checkbox" id="checkbox{{ $value->id }}" <?php if(!empty($rolePermissions[$value->id])){ echo ' checked ';} ?>>
												<label class="custom-control-label" for="checkbox{{ $value->id }}">{{ ucfirst($value->name) }}</label>
												<br />
												</div>
												@endforeach

									</div>
								</div>

							<div class="col-xs-12 col-sm-12 col-md-12">
								<button type="submit" class="btn btn-primary">Submit</button>
							</div>
						</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('bottom-script')
<script>
$(document).ready(function() {
	$("#selectAll").click(function(){
				$("input[type=checkbox]").prop('checked', $(this).prop('checked'));
	});
});
</script>
@endsection

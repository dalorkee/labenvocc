@extends('layouts.index')
@section('custom-style')
<link type="text/css" href="{{ URL::asset('admindek/css/style.css') }}" rel="stylesheet" >
@endsection
@section('contents')
<div class="page-breadcrumb bg-light">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title"><span style="display:none;">Edit Permission</span></h4>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ route('permissions.index') }}">Permission</a></li>
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
						{!! Form::model($permission, ['method' => 'PATCH','route' => ['permissions.update', $permission->id]]) !!}
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
								<div class="form-group">
									<label for"name">ชื่อสิทธิ์</label>
									{!! Form::text('name', null, array('placeholder' => 'ชื่อสิทธิ์','class' => 'form-control')) !!}
								</div>
							</div>

							<div class="col-xs-12 col-sm-12 col-md-12">
								<button type="submit" class="btn btn-primary">Save</button>
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
@section('script')
<script>
$(document).ready(function() {
	$('.roles').select2();
});
</script>
@endsection

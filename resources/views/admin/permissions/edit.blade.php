@extends('layouts.admin.index')
@section('content')
<ol class="breadcrumb page-breadcrumb">
	<li class="breadcrumb-item"><a href="javascript:void(0);">Admin</a></li>
	<li class="breadcrumb-item"><a href="{{ route('permissions.index') }}">Permission</a></li>
	<li class="breadcrumb-item">Edit</li>
</ol>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="d-md-flex align-items-center" style="border-bottom:1px solid #EAEAEA">
						<div>
							<h4 class="card-title">Permission Management [Edit]</h4>
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
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-4">
								<div class="form-group">
									<label for"permission_name">Permission Name</label>
									{!! Form::text('name', null, array('placeholder' => 'ชื่อสิทธิ์','class' => 'form-control')) !!}
								</div>
							</div>

							<div class="col-xs-12 col-sm-12 col-md-12 mb-2">
								<button type="submit" class="btn btn-warning">Update</button>
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

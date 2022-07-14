@extends('layouts.index')
@section('content')
<ol class="breadcrumb page-breadcrumb">
	<li class="breadcrumb-item"><a href="javascript:void(0);">Admin</a></li>
	<li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
	<li class="breadcrumb-item">Edit</li>
</ol>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="d-md-flex align-items-center">
						<div>
							<h4 class="card-title">Role Management [Edit]</h4>
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
								<strong>Role:</strong>
								{!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
							<div class="form-group">
								<label>Permission:</label>
								<div class="custom-control custom-checkbox">
									<input class="custom-control-input" name="select_all" value="all" type="checkbox" id="select_all">
									<label class="custom-control-label" for="select_all">All</label>
									<br />
								</div>
								@foreach($permission as $value)
								<div class="custom-control custom-checkbox">
									<input class="custom-control-input" data-chk="chk" name="permission[]" value="{{ $value->id }}" type="checkbox" id="checkbox{{ $value->id }}" <?php if(!empty($rolePermissions[$value->id])){ echo ' checked ';} ?>>
									<label class="custom-control-label" for="checkbox{{ $value->id }}">{{ ucfirst($value->name) }}</label>
									<br />
								</div>
								@endforeach
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 mt-2">
							<button type="submit" class="btn btn-warning">Update</button>
						</div>
					</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script>
$(document).ready(function() {
	$("#select_all").click(function(){
		$("input[data-chk=chk]").prop('checked', $(this).prop('checked'));
	});
});
</script>
@endsection

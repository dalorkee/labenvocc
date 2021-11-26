@extends('layouts.admin.index')
@section('content')
<ol class="breadcrumb page-breadcrumb">
	<li class="breadcrumb-item"><a href="javascript:void(0);">Admin</a></li>
	<li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
	<li class="breadcrumb-item">Create</li>
</ol>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="d-md-flex align-items-center" style="border-bottom:1px solid #EAEAEA">
						<div>
							<h4 class="card-title">Role Management [Create]</h4>
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
					{!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 mb-2">
							<div class="form-group">
								<strong>Role name:</strong>
								{!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 mb-2">
							<div class="form-group">
								<strong>Permission:</strong>
								<br/>
								@foreach($permission as $value)
									<label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
									{{ $value->name }}</label>
									<br/>
								@endforeach
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 mb-2">
							<button type="submit" class="btn btn-success">Create</button>
						</div>
					</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@extends('layouts.index')
@section('content')
<ol class="breadcrumb page-breadcrumb">
	<li class="breadcrumb-item"><a href="javascript:void(0);">Admin</a></li>
	<li class="breadcrumb-item"><a href="{{ route('permissions.index') }}">Permission</a></li>
	<li class="breadcrumb-item">Create</li>
</ol>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="d-md-flex align-items-center">
						<div>
							<h4 class="card-title">Permission Management [Create]</h4>
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
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-4">
									<div class="form-group">
										<label for="permission">Permission Name</label>
										<input type="text" name="name" required class="form-control" placeholder="Permission" >
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-4">
									<div class="form-group">
										<label>กลุ่มผู้ใช้งาน:</label>
										<div class="custom-control custom-checkbox">
											<input class="custom-control-input" name="select_all" value="all" type="checkbox" id="select_all">
											<label class="custom-control-label" for="select_all">All</label>
											<br />
										</div>
										@foreach($roles as $role)
											<div class="custom-control custom-checkbox">
												<input class="custom-control-input" data-chk="chk" name="roles[]" value="{{ $role->id }}" type="checkbox" id="checkbox{{ $role->id }}">
												<label class="custom-control-label" for="checkbox{{ $role->id }}">{{ ucfirst($role->name) }}</label>
												<br />
											</div>
										@endforeach
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 col-xl-3 mb-2">
									<div class="form-group">
										<button type="submit" class="btn btn-success">Create</button>
									</div>
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
	$("#select_all").click(function(){
		$("input[data-chk='chk']").prop('checked', $(this).prop('checked'));
	});
});
</script>
@endsection

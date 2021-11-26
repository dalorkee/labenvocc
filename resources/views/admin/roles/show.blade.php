@extends('layouts.admin.index')
@section('content')
<ol class="breadcrumb page-breadcrumb">
	<li class="breadcrumb-item"><a href="javascript:void(0);">Admin</a></li>
	<li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
	<li class="breadcrumb-item">Show</li>
</ol>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="d-md-flex align-items-center" style="border-bottom:1px solid #EAEAEA">
						<div>
							<h4 class="card-title">Role Management [Show]</h4>
						</div>
					</div>
					<div class="my-4">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12">
								<div class="form-group">
									<strong>Roles:</strong>
									<span class="badge badge-info">{{ $role->name }}</span>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12">
								<div class="form-group">
									<strong>Permission:</strong>
									@if(!empty($rolePermissions))
										@foreach($rolePermissions as $v)
											<span class="badge badge-danger">{{ $v->name }},</span>
										@endforeach
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

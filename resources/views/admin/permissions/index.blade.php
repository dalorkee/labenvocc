@extends('layouts.admin.index')
@section('content')
<ol class="breadcrumb page-breadcrumb">
	<li class="breadcrumb-item"><a href="javascript:void(0);">Admin</a></li>
	<li class="breadcrumb-item"><a href="{{ route('users.index') }}">Permission</a></li>
	<li class="breadcrumb-item">Create</li>
</ol>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="d-md-flex align-items-center" style="border-bottom:1px solid #EAEAEA">
						<div>
							<h4 class="card-title">Permission Management [Create]</h4>
						</div>
					</div>
					@if (auth()->user()->can('permission-create'))
					<div class="my-4">
						<a class="btn btn-success" href="{{ route('permissions.create') }}"> Create Permission</a>
					</div>
					@endif
					@if ($message = Session::get('success'))
						<div class="alert alert-success">
							<p>{{ $message }}</p>
						</div>
					@endif
					<table class="table table-bordered">
						<tr>
							<th>Permission Name</th>
							<th>Manage</th>
						</tr>
						@foreach ($permissions as $key => $permission)
						<tr>
							<td>{{ $permission->name }}</td>
							<td>
								@if (auth()->user()->can('permission-edit'))
								<a class="btn btn-primary" href="{{ route('permissions.edit',$permission->id) }}">Edit</a>
								@endif
								@if (auth()->user()->can('permission-delete'))
								<form method="POST" action="{{ url('/acl/permissions', [$permission->id]) }}" style="display:inline">
									<input name="_method" type="hidden" value="DELETE" />
									{{ csrf_field() }}
								<input class="btn btn-danger" type="submit" value="Delete">
								</form>
								@endcan
							</td>
						</tr>
						@endforeach
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

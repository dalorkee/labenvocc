@extends('layouts.admin.index')
@section('content')
<ol class="breadcrumb page-breadcrumb">
	<li class="breadcrumb-item"><a href="javascript:void(0);">Admin</a></li>
	<li class="breadcrumb-item">Roles</li>
</ol>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="d-md-flex align-items-center">
						<div>
							<h4 class="card-title">Role Management</h4>
						</div>
					</div>
					<div class="my-4"><a class="btn btn-success" href="{{ route('roles.create') }}"><i class="fal fa-plus"></i> New role</a></div>
					@if ($message = Session::get('success'))
						<div class="alert alert-success">
							<p>{{ $message }}</p>
						</div>
					@endif
					<table class="table table-responsive-xl table-striped table-bordered">
						<thead class="bg-info text-white">
							<tr>
								<th>No</th>
								<th>Roles</th>
								<th width="280px">Action</th>
							</tr>
						</thead>
						<tfoot></tfoot>
						<tbody>
							@foreach ($roles as $key => $role)
							<tr>
								<td>{{ ++$i }}</td>
								<td>{{ $role->name }}</td>
								<td>
									<a class="btn btn-success btn-sm" href="{{ route('roles.show',$role->id) }}">Show</a>
									@if (auth()->user()->can('role-edit'))
										<a class="btn btn-warning btn-sm" href="{{ route('roles.edit',$role->id) }}">Edit</a>
									@endif
									@if (auth()->user()->can('role-delete'))
										{!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
										{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm text-primary']) !!}
										{!! Form::close() !!}
									@endif
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					{!! $roles->render() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

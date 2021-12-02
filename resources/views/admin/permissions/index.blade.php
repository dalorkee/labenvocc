@extends('layouts.admin.index')
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
					@if ($message = Session::get('success'))
						<div class="alert alert-success">
							<p>{{ $message }}</p>
						</div>
					 @endif
					@if (auth()->user()->can('permission-create'))
					<div class="my-4">
						<a class="btn btn-success" href="{{ route('permissions.create') }}"><i class="fal fa-plus"></i> New Permission</a>
					</div>
					@endif
					<table class="table table-striped table-bordered">
						<thead class="bg-info text-white">
							<tr>
								<th>Permission Name</th>
								<th width="280px">Action</th>
							</tr>
						</thead>
						<tfoot></tfoot>
						<tbody>
							@foreach ($permissions as $key => $permission)
							<tr>
								<td>{{ $permission->name }}</td>
								<td>
									<a class="btn btn-info btn-sm" href="{{ route('permissions.show',$permission->id) }}">Show</a>
									@if (auth()->user()->can('permission-edit'))
									<a class="btn btn-warning btn-sm" href="{{ route('permissions.edit',$permission->id) }}">Edit</a>
									@endif
									@if (auth()->user()->can('permission-delete'))
									<form method="POST" action="{{ route('permissions.destroy', $permission->id) }}" style="display:inline">
										<input name="_method" type="hidden" value="DELETE">
										{{ csrf_field() }}
									<button type="submit" class="btn btn-danger btn-sm">Delete</button>
									</form>
									@endcan
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

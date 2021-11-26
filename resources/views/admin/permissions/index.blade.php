@extends('layouts.index')
@section('custom-style')
<link type="text/css" href="{{ URL::asset('admindek/css/style.css') }}" rel="stylesheet" >
@endsection
@section('contents')
<div class="page-breadcrumb bg-light">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title"><span style="display:none;">List Permission</span></h4>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ route('users.index') }}">Permission</a></li>
						<li class="breadcrumb-item active" aria-current="page"><a href="#">List</a></li>
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
					@can('permission-create')
					<div class="my-4">
						<a class="btn btn-success" href="{{ route('permissions.create') }}"> Create Permission</a>
					</div>
					@endcan
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
								@can('permission-edit')
								<a class="btn btn-primary" href="{{ route('permissions.edit',$permission->id) }}">Edit</a>
								@endcan
								@can('permission-delete')
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

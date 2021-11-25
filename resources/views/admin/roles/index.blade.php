@extends('layouts.admin.index')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('vendor/jquery-smartwizard/css/smart_wizard_arrows.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('vendor/DataTables/DataTables-1.10.22/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('vendor/DataTables/Buttons-1.6.5/css/buttons.jqueryui.min.css') }}">
<link rel='stylesheet' type="text/css" href="{{ URL::asset('vendor/DataTables/Responsive-2.2.6/css/responsive.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('vendor/jquery-contextmenu/css/jquery.contextMenu.min.css') }}">
@endsection
@section('content')
<ol class="breadcrumb page-breadcrumb">
	<li class="breadcrumb-item"><a href="javascript:void(0);">Admin</a></li>
	<li class="breadcrumb-item">Users Customer Manage</li>
</ol>
<div class="subheader">
	<h1 class="subheader-title"><small>จัดการข้อมูลลูกค้า</small></h1>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="d-md-flex align-items-center" style="border-bottom:1px solid #EAEAEA">
						<div>
							<h4 class="card-title">บริหารจัดการผู้ใช้งานระบบ</h4>
							<h5 class="card-subtitle"></h5>
						</div>
					</div>
					<div class="my-4">
							<a class="btn btn-success" href="{{ route('roles.create') }}"> New Role</a>
					</div>
					@if ($message = Session::get('success'))
						<div class="alert alert-success">
							<p>{{ $message }}</p>
						</div>
					@endif
					<table class="table table-bordered">
						<tr>
							<th>No</th>
							<th>Name</th>
							<th width="280px">Action</th>
						</tr>
						@foreach ($roles as $key => $role)
						<tr>
							<td>{{ ++$i }}</td>
							<td>{{ $role->name }}</td>
							<td>
								<a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Show</a>
								@can('role-edit')
									<a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>
								@endcan
								@can('role-delete')
									{!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
									{!! Form::submit('Delete', ['class' => 'btn btn-danger text-primary']) !!}
									{!! Form::close() !!}
								@endcan
							</td>
						</tr>
						@endforeach
					</table>
					{!! $roles->render() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

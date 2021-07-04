@extends('layouts.admin.index')
@section('style')
<link href="{{ URL::asset('vendor/jquery-smartwizard/css/smart_wizard_arrows.min.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('content')
<ol class="breadcrumb page-breadcrumb">
	<li class="breadcrumb-item"><a href="javascript:void(0);">Admin</a></li>
	<li class="breadcrumb-item">Office Manage</li>
</ol>
<div class="subheader">
	<h1 class="subheader-title"><small>จัดการหน่วยงาน</small></h1>
</div>
@if (Session::get('success'))
	<div class="alert alert-success">
		<p>{{ Session::get('success') }}</p>
	</div>
@elseif (Session::get('error'))
	<div class="alert alert-danger">
		<p>{{ Session::get('error') }}</p>
	</div>
@endif
<div class="fs-lg fw-300 p-5 bg-white border-faded rounded mb-g">
	<div class="frame-wrap">
		<table class="table m-0">
			<thead>
				<tr>
					<th>#</th>
					<th>Office Code</th>
					<th>Office Name</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			@foreach ($office_data as $key=>$office)
				<tr>
					<th scope="row"></th>
					<td>{{$office['office_code']}}</td>
					<td>{{$office['office_name']}}</td>
					<td>
					@if($office['office_status'] == '0')
						<label class="badge badge-info">New</label>
					@elseif($office['office_status'] == '1')
						<label class="badge badge-success">Aollow</label>
					@elseif($office['office_status'] == '2')
						<label class="badge badge-warning">Close</label>
					@elseif($office['office_status'] == '3')
						<label class="badge badge-danger">Deny</label>
					@endif
					</td>
					<td>
						<a class="btn btn-info btn-sm" href="edit">Edit</a>
					</td>
				</tr>
			@endforeach					
			</tbody>
		</table>
		{{ $office_data->links() }}
	</div>	
</div>
@endsection
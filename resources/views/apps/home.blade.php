@extends('layouts.index')
@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
    <li class="breadcrumb-item">P1</li>
    <li class="breadcrumb-item active">P2</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title"><i class='fal fa-home'></i> หน้าหลัก<small>Sub title here!!</small></h1>
</div>
<div class="fs-lg fw-300 p-5 bg-white border-faded rounded mb-g">
    <h3 class="mb-g">Hi PJ</h3>
    <p>This is a contents</p>
</div>
@endsection
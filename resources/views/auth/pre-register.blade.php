@extends('layouts.guest.index')
@section('content')
<div class="row">
    <div class="col-xl-12">
        <h2 class="fs-xxl fw-500 mt-4 text-white text-center">ลงทะเบียนใช้งาน</h2>
    </div>
</div>
<div class="row">
    <div class="col-xl-6">
        <div class="card text-center mt-6">
            <div class="card-body">
                <h2>สำหรับบุคคลทั่วไป</h2>
                <p style="font-size:4rem"><i class="fal fa-user-plus mr-1"></i></p>
            </div>
            <button type="button" class="btn btn-lg btn-info">ลงทะเบียน</button>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card text-center mt-6">
            <div class="card-body">
                <h2>สำหรับหน่วยงาน</h2>
                <p style="font-size:4rem"><i class="fal fa-users mr-1"></i></p>
            </div>
            <a href="{{ route('register.create') }}" title="Register" class="btn btn-lg btn-primary">ลงทะเบียน</a>
        </div>
    </div>
</div>
@endsection
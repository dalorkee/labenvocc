@extends('layouts.guest.index')
@section('meta-token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('style')
<link rel="stylesheet" href="{{ URL::asset('css/register_staff.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/css/formplugins/select2/select2.bundle.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/css/notifications/sweetalert2/sweetalert2.bundle.css') }}" media="screen, print">
@endsection
@section('content')
<div class="wrapper">

</div>

@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.1.0/jquery.steps.min.js"></script>
<script src="{{ URL::asset('assets/js/formplugins/select2/select2.bundle.js') }}"></script>
<script src="{{ URL::asset('assets/js/notifications/sweetalert2/sweetalert2.bundle.js') }}"></script>
<script>
$(document).ready(function() {
	$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
});
</script>


@endsection


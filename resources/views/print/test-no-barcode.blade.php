@extends('layouts.print.index')
@section('token')<meta name="csrf-token" content="{{ csrf_token() }}">@endsection
@section('style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/print.css?v=1.0') }}" media="screen, print">
@endsection
@section('content')
	<div class="page1">
        <div class="mb-3">{!! DNS2D::getBarcodeHTML('4445645656', 'QRCODE') !!}</div>
        <div class="mb-3">{!! DNS1D::getBarcodeHTML('4445645656', 'PHARMA') !!}</div>
        <div class="mb-3">{!! DNS1D::getBarcodeHTML('4445645656', 'PHARMA2T') !!}</div>
        <div class="mb-3">{!! DNS1D::getBarcodeHTML('4445645656', 'CODABAR') !!}</div>
        <div class="mb-3">{!! DNS1D::getBarcodeHTML('4445645656', 'KIX') !!}</div>
        <div class="mb-3">{!! DNS1D::getBarcodeHTML('4445645656', 'RMS4CC') !!}</div>
        <div class="mb-3">{!! DNS1D::getBarcodeHTML('4445645656', 'UPCA') !!}</div>
	</div>
@endsection

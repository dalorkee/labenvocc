@extends('layouts.print.index')
@section('token')<meta name="csrf-token" content="{{ csrf_token() }}">@endsection
@section('style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/print.css?v=1.0') }}" media="screen, print">
@endsection
@section('content')
	<div class="page1">
		@foreach ($sample_no as $key => $value)
		<div style="margin: 0 0 4px 0; padding: 0;">
			{{-- <p class="name">{{$product->name}}</p>
			<p class="price">Price: {{$product->sale_price}}</p> --}}
			{!! DNS1D::getBarcodeHTML($value, "C128",1.4,22) !!}
			<p style="width:80px; margin:-10px 0 0 0; padding:0; text-align:center">{{ $value }}</p>
		</div>
		@endforeach
	</div>
@endsection

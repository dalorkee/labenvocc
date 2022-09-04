<link rel="icon" type="image/png" href="{{ URL::asset('assets/img/favicon/favicon-32x32.png') }}" sizes="32x32">
<link rel="mask-icon" href="{{ URL::asset('assets/img/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
<link rel="apple-touch-icon" href="{{ URL::asset('assets/img/favicon/apple-touch-icon.png') }}" sizes="180x180">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/fonts.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/app.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('fonts/fontawesome/font-awesome.css') }}">
@role('customer')
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/vendors.bundle.css') }}" media="screen, print">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/app.bundle.css') }}" media="screen, print">
@endrole
@role('staff')
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/vendors.bundle.for.staff.css') }}" media="screen, print">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/app.bundle.for.staff.css') }}" media="screen, print">
@endrole
@role('admin')
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/vendors.bundle.for.staff.css') }}" media="screen, print">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/app.bundle.for.staff.css') }}" media="screen, print">
@endrole
@role('root')
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/vendors.bundle.for.staff.css') }}" media="screen, print">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/app.bundle.for.staff.css') }}" media="screen, print">
@endrole
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/notifications/toastr/toastr.css') }}" media="screen, print">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/notifications/sweetalert2/sweetalert2.bundle.css') }}" media="screen, print">

<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="utf-8">
<title>{{ config('app.name', 'PJX') }}</title>
<meta name="description" content="Introduction">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="msapplication-tap-highlight" content="no">
@yield('token')
@include('layouts.style')
@yield('style')
</head>
<body class="mod-bg-1 ">
<script>
'use strict';
var classHolder = document.getElementsByTagName("BODY")[0],
themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) :
{},
themeURL = themeSettings.themeURL || '',
themeOptions = themeSettings.themeOptions || '';
if (themeSettings.themeOptions) {
	classHolder.className = themeSettings.themeOptions;
	console.log("%c✔ Theme settings loaded", "color: #148f32");
} else {
	console.log("Heads up! Theme settings is empty or does not exist, loading default settings...");
}
if (themeSettings.themeURL && !document.getElementById('mytheme')) {
	var cssfile = document.createElement('link');
	cssfile.id = 'mytheme';
	cssfile.rel = 'stylesheet';
	cssfile.href = themeURL;
	document.getElementsByTagName('head')[0].appendChild(cssfile);
}
var saveSettings = function() {
	themeSettings.themeOptions = String(classHolder.className).split(/[^\w-]+/).filter(function(item) {
	return /^(nav|header|mod|display)-/i.test(item);
	}).join(' ');
	if (document.getElementById('mytheme')) {
		themeSettings.themeURL = document.getElementById('mytheme').getAttribute("href");
	};
	localStorage.setItem('themeSettings', JSON.stringify(themeSettings));
}
var resetSettings = function() {
	localStorage.setItem("themeSettings", "");
}
</script>
<!-- BEGIN Page Wrapper -->
<div class="page-wrapper">
	<div class="page-inner">
		<aside class="page-sidebar">
			@include('layouts.aside')
		</aside>
		<div class="page-content-wrapper">
			<header class="page-header" role="banner">
				@include('layouts.header')
			</header>
			<main id="js-page-content" role="main" class="page-content">
				@yield('content')
			</main>
			<div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div>
			<footer class="page-footer" role="contentinfo">
				@include('layouts.footer')
			</footer>
			@include('components.modal-shortcut')
		</div>
	</div>
</div>
<!-- END Page Wrapper -->
@include('components.quick-menu')
@include('components.messenger')
@include('components.page-settings')
@include('layouts.script')
@yield('script')
</body>
</html>

@extends('layouts.print.index')
@section('token')<meta name="csrf-token" content="{{ csrf_token() }}">@endsection
@section('style')
<style type="text/css">
@charset "UTF-8";
@font-face {
	font-family: "THsarabunNew";
	src: url("{{ asset('fonts/THsarabunNew.ttf') }}") format('truetype');
	unicode-range: U+0E00–U+0E7F;
	font-weight: normal;
	font-style: normal;
}
@font-face {
	font-family: "DejaVuSansMono";
	src: url("{{ asset('fonts/DejaVuSansMono.ttf') }}") format('truetype');
	unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
	font-weight: normal;
	font-style: normal;
}
* {box-sizing:border-box;-moz-box-sizing:border-box;font-family:"THsarabunNew",sans-serif}
h1,h2,h3,h4,h5,h6 {font-family:"THsarabunNew",sans-serif}
 body{width:100%; height:100%; margin:0; padding:0; background-color:#fff; font-family:"THsarabunNew",sans-serif; font-size:1em}
.container {width:100%; height:100%; margin:10px auto; padding:10px}
.page {position:relative; width:297mm; min-height:210mm; padding:0; margin:0 auto; border:none; background:white}
.msg-left {position:absolute; top:6px; left:22px}
.msg-right {position:absolute; top:6px; right:22px}
.heading {width:100%; margin-top:16px; padding:10px 0; height:70px; text-align:center}
.heading p {font-size:1.275em; height:22px; line-height:22px; margin:0; padding: 4px 0}
.heading-detail {position:relative; width:100%; height:80px; padding:0}
.lab-no {position:absolute; top:6px; left:100px}
.sample-date {position:absolute; top:6px; left:420px}
.work-type {position:absolute; top:6px; left: 700px}
.sample-amount {position:absolute; top:42px; left:72px}
.sample-report-date {position:absolute; top:38px; left:374px}
.table-wrapper {width:98%; margin:0 auto; padding:10px}
table {border-collapse:collapse; font-size:16px; font-family:"THsarabunNew"}
table tr th, table tr td {height:30px; font-size:16px; border:1px solid #bbb}
.footer {
	position: relative;
	width: 100%;
	height: 60px;
    margin: 0;
    padding: 0;
}
.tester-name {position: absolute; top: 6px; left: 20px; height: 20px; line-height: 20px}
.test-date{position: absolute; top: 6px; left: 220px;  height: 20px; line-height: 20px}
.supervisor-name{position: absolute; top: 6px; left: 420px;  height: 20px; line-height: 20px}
.verify-date{position: absolute; top: 6px; left: 620px;  height: 20px; line-height: 20px}
#printBtn, #homeBtn {
  background: #5E5DF0;
  border-radius: 10px;
  box-shadow: #5E5DF0 0 10px 20px -10px;
  box-sizing: border-box;
  color: #FFFFFF;
  cursor: pointer;
  font-family:"Tahoma",sans-serif;;
  font-size: 16px;
  font-weight: 700;
  line-height: 24px;
  opacity: 1;
  outline: 0 solid transparent;
  padding: 8px 18px;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  width: fit-content;
  word-break: break-word;
  border: 0;
}
@page {size:A4 landscape; margin:0}
@media print {
	html, body {width:297mm; height:210mm}
	.page {margin:0; border:initial; border-radius:initial; width:initial; min-height:initial; box-shadow:initial; background:initial; page-break-after:always}
	#printBtn, #homeBtn {display:none}
}
</style>
@endsection
@section('content')
<div class="container">
	<div class="page">
		<div class="msg-left">วันที่ประกาศใช้ 2 มีนาคม 2563</div>
		<div class="msg-right">หน้า 1/1</div>
		<div class="heading">
			<p>แบบบันทึกรายงานผลทดสอบตัวอย่างสิ่งแวดล้อม</P>
			<p>ศูนย์อ้างอิงทางห้องปฏิบัติการและพิษวิทยา</p>
		</div>
		<div class="heading-detail">
			<p class="lab-no">Lab No : 1234</p>
			<p class="sample-date">วันที่รับตัวอย่าง : 20/03/2566</p>
			<p class="work-type">ประเภทงาน : [✔] บริการ [✔] วิจัย [✔] เฝ้าระวัง [✔] SRRT/สอบสวนโรค [✔] อื่นๆ</p>
			<p class="sample-amount">จำนวนตัวอย่าง : 20</p>
			<p class="sample-report-date">กำหนดส่งรายงานผลลูกค้า : 20/04/2566</p>
		</div>
		<div class="table-wrapper">
			<table>
				<tr>
					<th>ลำดับที่</th>
					<th>หมายเลขทดสอบ</th>
					<th>รหัสตัวอย่าง (ลูกค้า)</th>
					<th>วิธีเก็บตัวอย่าง</th>
					<th>ชนิดตัวอย่าง</th>
					<th>ลักษณะตัวอย่าง</th>
					<th>จุดที่เก็บ</th>
					<th>น้ำหนักตัวอย่าง (กรัม)</th>
					<th>ปริมาตรอากาศ (ลิตร)</th>
					<th>พารามิเตอร์ที่ทดสอบ</th>
					<th colspan="3">ผลการทดสอบ (หน่วย)</th>
				</tr>
				@for ($i = 1; $i <= 10; $i++)
					<tr>
					@for ($j = 1; $j <= 13; $j++)
						<td>{{ $j }}</td>
					@endfor
					</tr>
				@endfor
			</table>
		</div>
		<div class="footer">
			<p class="tester-name">ผู้ทดสอบ: นายมะกูดี สัมกะลัมปี</p>
			<p class="test-date">วันที่ทดสอบเสร็จ 20/04/2566</p>
			<p class="supervisor-name">ผู้ควบคุม พันเอก กำพล สนใจดี</p>
			<p class="verify-date">วันที่ตรวจสอบ 20/04/2566</p>
		</div>
		<div style="width: 100%; margin: 0 auto; text-align: center">
			<button type="button" id="printBtn" onClick="window.print();">พิมพ์หน้านี้</button>
			<button type="button" id="homeBtn" onClick="window.print();">กลับไปหน้าแรก</button>
		</div>
	</div>

</div>
@endsection

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
.page {position:relative; width:297mm; min-height:210mm; height: 210mm; padding:10px; margin:0 auto}
.page-no {width:100%; height:20px}
.page-no span {display:inline-block; width:100%; text-align:right}

.heading {width: 100%; height: 120px}
.border-top {border-top: 1px solid #585858}
.border-right {border-right: 1px solid #585858}
.border-bottom {border-bottom: 1px solid #585858}
.border-left {border-left: 1px solid #585858}

.heading-logo-left {width:20%; height:120px; padding-top: 10px; float:left;text-align: center}
.heading-title {width:60%; height:120px; float:left; text-align:center}
.heading-logo-right {width:20%; height:120px; float:left; padding-top: 10px; float:left;text-align: center}
.heading p {height:22px; line-height:22px; margin:0; padding: 4px 0}
.heading:after, .row:after {content:''; display:block; clear:both}

.heading-detail {width:100%;}

.font-bold {font-weight:400}
.font-14px {font-size:14px}
.font-16px {font-size:16px}
.font-18px {font-size:18px}
.font-20px {font-size:20px}
.mt-10px {margin-top: 10px}
.w-30 {width:30%}
.w-40 {width:40%}
.w-70 {width:70%}
.w-100 {width:100%}
.inline-block {display:inline-block}
.row {width:100%}
.float-left {float:left}
.text-center {text-align: center}

table {border-collapse:collapse; font-size:16px; font-family:"THsarabunNew"}
table tr th, table tr td {height:30px; font-size:16px; border:1px solid #585858}

.footer {
	position: absolute;
	width: 100%;
	height:120px;
	left: 0;
	bottom: 0;
}
.footer-detail {
	position: relative;
	width: 100%;
	height: 100px;
	margin: 0;
	padding: 0;
}
.footer-detail p {
	margin: 0;
	padding: 0;
}
.footer-note {
	position: absolute;
	top: 0;
	left: 10px;
	height: 16px;
}
.footer-tester {
	position: absolute;
	width: 300px;
	left: 0;
	bottom: 5px;
	text-align: center;
}
.footer-controller {
	position: absolute;
	width: 300px;
	right: 0;
	bottom: 5px;
	text-align: center;
}

#printBtn, #homeBtn {
	background: #5E5DF0;
	border-radius: 10px;
	box-sizing: border-box;
	color: #FFFFFF;
	cursor: pointer;
	font-family:"THsarabunNew",sans-serif;;
	font-size: 1.275em;
	padding: 8px 10px;
	border: 0;
	text-decoration: none;
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
		<div class="page-no">
			<span>หน้า 1/1</span>
		</div>
		<div class="heading border-top border-right border-left">
			<div class="heading-logo-left">
				<img src="{{ URL::asset('images/ddc-logo-90x90.png') }}" />
			</div>
			<div class="heading-title">
				<p class="font-20px font-bold">งานผลทดการสอบตัวอย่างสิ่งแวดล้อม</P>
				<p class="font-18px">ศูนย์อ้างอิงทางห้องปฏิบัติการและพิษวิทยา</p>
				<p class="font-18px">กองโรคจากการประกอบอาชีพและสิ่งแวดล้อม กรมควบคุมโรค</p>
				<p>อาคารศูนย์ห้องปฏิบัติการกรมอนามัย ชั้น 4 ซ.รพ.ศรีธัญญา ถ.ติวานนท์ ต.ตลาดขวัญ อ.เมือง จ.นนทบุรี 11000</p>
				<p class="font-14px">โทรศัพท์ 0 2968 7633 โทรสาร 0 2968 7631</p>
			</div>
			<div class="heading-logo-right">
				<img src="{{ URL::asset('images/ddc-logo-90x90.png') }}" />
				<img src="{{ URL::asset('images/ddc-logo-90x90.png') }}" />

			</div>
		</div>
		<div class="heading-detail">
			<div class="row border-top border-right border-left">
				<div class="w-30 float-left border-right">&nbsp;Lab No.: {{ $result['order']['lab_no'] }}</div>
				<div class="w-700 float-left">&nbsp;หน่วยงานที่ส่งตัวอย่าง: {{ $result['customer']['agency_name'] }}</div>
			</div>
			<div class="row border-top border-right border-left">
				<div class="w-30 float-left border-right">&nbsp;ประเภทโรงงาน:</div>
				<div class="w-700 float-left">&nbsp;ที่อยู่: {{ $result['customer']['address']." ".$result['customer']['sub_district']." ".$result['customer']['district']." ".$result['customer']['province'] }}</div>
			</div>
			<div class="row border-top border-right border-left">
				<div class="w-30 float-left border-right">&nbsp;วันที่รับตัวอย่าง: {{ $result['order_sample']['sample_receive_date'] }}</div>
				<div class="w-30 float-left border-right">&nbsp;วันที่ทดสอบเสร็จ: {{ $result['order_sample']['analys_complete_date'] }}</div>
				<div class="w-40 float-left">&nbsp;วันที่รายงานผล: {{ $result['order_sample']['report_result_date'] }}</div>
			</div>
			<div class="row border-top border-right border-left">
				<div class="w-30 float-left border-right">&nbsp;ชนิดตัวอย่าง: @foreach ($result['order_sample_paramet_unique']['sample_character_name'] as $val) {{ $val." " }} @endforeach</div>
				<div class="w-30 float-left border-right">&nbsp;ชนิดสารพิษ:</div>
				<div class="w-40 float-left">&nbsp;วิธีทดสอบ: @foreach ($result['order_sample_paramet_unique']['technical_name'] as $val) {{ $val." " }} @endforeach</div>
			</div>
			<div class="row border-top border-right border-left">
				<div class="w-100 text-center">ห้องปฏิบัติการได้รับการรับรองตามมาตรฐาน ISO/IEC 17025:2005 ในขอบข่ายที่แสดงเครื่องหมาย *</div>
			</div>
			<div class="row border-top border-right border-left">
				<div class="w-100">&nbsp;ตารางผลการทดสอบ</div>
			</div>
			<div class="row">
				<table>
					<thead>
						<tr>
							<th rowspan="3">ลำดับที่</th>
							<th rowspan="3">หมายเลขทดสอบ</th>
							<th rowspan="3">รหัสตัวอย่าง (ลูกค้า)</th>
							<th rowspan="3">ลักษณะตัวอย่าง</th>
							<th rowspan="3">จุดที่เก็บ</th>
							<th colspan="4">ผลการทดสอบ</th>
						</tr>
						<tr>
							<th rowspan="2">สารพิษ</th>
							<th colspan="3">ปริมาณที่พบ (หน่วย)</th>
						</tr>
						<tr>
							<th>&#181;g/sample</th>
							<th>mg/m<sup>3</sup></th>
							<th>ppm</th>
						</tr>
					</thead>
					<tfoot></tfoot>
					<tbody>
                        @foreach ($result['order_sample_paramet'] as $key => $val)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>2</td>
                                <td>{{ $val['order_no'] }}</td>
                                <td>4</td>
                                <td>5</td>
                                <td>6</td>
                                <td>7</td>
                                <td>8</td>
                                <td>9</td>
                            </tr>
                        @endforeach

					</tbody>
				</table>
			</div>
		</div>
		<footer class="footer">
			<div class="footer-detail">
				<p class="footer-note"><span class="text-bold">&nbsp;หมายเหตุ:</span> ปริมาณต่ำสุดที่ตรวจวิเคราะห์ได้เท่ากับ 0.800 &#181;g&#47;sample, &lt;0.0001 mg&#47;m<sup>3</sup>, &lt;0.001 ppm</p>
				<div class="footer-tester">
					<p>..................................................ผู้ทดสอบ</p>
					<p>นางสาวผการัตน์ รักษ์ย่อง</p>
					<p>ตำแหน่ง นักวิทยาศาสตร์การแพทย์ปฏิบัติการ</p>
				</div>
				<div class="footer-controller">

					<p>..................................................ผู้ควบคุม</p>
					<p>นายสรสมรรถ บุญทวีวุฒิ</p>
					<p>ตำแหน่ง นักวิทยาศาสตร์การแพทย์</p>
				</div>
			</div>
		</footer>
	</div>
</div>
@endsection

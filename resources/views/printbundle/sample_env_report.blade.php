<!doctype html>
<html>
<head>
    <meta charset="utf-8">
	<title>Env Sample Report</title>
	<style type="text/css">
		body {
			width: 100%;
			height: 100%;
			margin: 0;
			padding: 0;
			background-color: #fafafa;
			font: 10pt "Tahoma";
		}
		* {
			box-sizing: border-box;
			-moz-box-sizing: border-box;
		}
		.page {
			width: 297mm;
			min-height: 210mm;
			padding: 4mm;
			margin: 2mm auto;
			border: 1px #D3D3D3 solid;
			border-radius: 5px;
			background: white;
			box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
		}
		.head_payment {
			text-align: center;
			font: 14pt "Tahoma";
		}
		.msg_main {
			text-align: left;
			font: 10pt "Tahoma";
			padding-top: 2mm;
			clear: both;
			margin:0;
		}
		.msg_left {
			float: left;
			padding-bottom: 2mm;
		}
		.msg_right {
			float: right;
			padding-bottom: 2mm;
		}
		.space {
			padding-top: 0.5mm;
			clear: both;
		}
		.space_right {
			padding-right: 30mm;
		}
		ul.menu_inline li {
			display:inline;
		}
		p {
			margin: 2mm;
		}
		.main_table {
			width:100%;
			border-collapse: collapse;
			table-layout: fixed;
			border-style: solid;
			border-width: 0.5mm;
			font: 10pt "Tahoma";
			padding: 1mm;
			table-layout:fixed;
		}
		th {
			border-style: solid;
			border-width: 0.5mm;
			padding: 1mm;
			text-align: center;
			font: 10pt "Tahoma";
		}
		td {
			border-style: solid;
			border-width: 0.5mm;
			padding: 1mm;
			text-align: left;
			font: 10pt "Tahoma";
			word-wrap:break-word;
		}
		@page {
			size: A4 landscape;
			margin: 0;
		}
		@media print {
			html, body {
				width: 297mm;
				height: 210mm;
			}
			.page {
				margin: 0;
				border: initial;
				border-radius: initial;
				width: initial;
				min-height: initial;
				box-shadow: initial;
				background: initial;
				page-break-after: always;
			}
		}
	</style>
</head>

<body>
    <div class="page">
		<div class="msg_left">วันที่ประกาศใช้ 2 มีนาคม 2563</div>
		<div class="msg_right">หน้า 1/1</div>
		<div class="space"></div>
        <div class="head_payment">
            <p>แบบบันทึกรายงานผลทดสอบตัวอยอ่างสิ่งแวดล้อม</P>
			<p>ศูนย์อ้างอิงทางห้องปฏิบัติการและพิษวิทยา</p>
        </div>
		<div class="msg_main">
			<ul class="menu_inline">
				<li>Lab NO :__________________</li>
				<li class="space_right"></li>
				<li>วันที่รับตัวอย่าง :_______________________</li>
				<li>ประเภทงาน : [ ] บริการ [ ] วิจัย [ ] เฝ้าระวัง [ ] SRRT/สอบสวนโรค [ ] อื่นๆ</li>
			</ul>
			<ul class="menu_inline">
				<li>จำนวนตัวอย่าง______________</li>
				<li class="space_right"></li>
				<li>กำหนดส่งรายงานผลลูกค้า :_________________________</li>
			</ul> 
		</div>
		<table class="main_table">
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
			@for ($i = 1; $i <= 20; $i++)
				<tr>
				@for ($j = 1; $j <= 13; $j++)
					<td>{{ $j }}</td>
				@endfor
				</tr>
			@endfor
		</table>
	</div>
	<div class="page">
		<div class="msg_left">วันที่ประกาศใช้ 2 มีนาคม 2563</div>
		<div class="msg_right">หน้า 1/1</div>
		<div class="space"></div>
        <div class="head_payment">
            <p>แบบบันทึกรายงานผลทดสอบตัวอยอ่างสิ่งแวดล้อม</P>
			<p>ศูนย์อ้างอิงทางห้องปฏิบัติการและพิษวิทยา</p>
        </div>
		<div class="msg_main">
			<ul class="menu_inline">
				<li>Lab NO :__________________</li>
				<li class="space_right"></li>
				<li>วันที่รับตัวอย่าง :_______________________</li>
				<li>ประเภทงาน : [ ] บริการ [ ] วิจัย [ ] เฝ้าระวัง [ ] SRRT/สอบสวนโรค [ ] อื่นๆ</li>
			</ul>
			<ul class="menu_inline">
				<li>จำนวนตัวอย่าง______________</li>
				<li class="space_right"></li>
				<li>กำหนดส่งรายงานผลลูกค้า :_________________________</li>
			</ul> 
		</div>
		<table class="main_table">
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
			@for ($i = 1; $i <= 20; $i++)
				<tr>
				@for ($j = 1; $j <= 13; $j++)
					<td>{{ $j }}</td>
				@endfor
				</tr>
			@endfor
		</table>
	</div>
</body>
</html>

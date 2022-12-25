<!doctype html>
<html>
<head>
    <meta charset="utf-8">
	<title>Bank Payment</title>
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
			width: 210mm;
			min-height: 297mm;
			padding: 10mm;
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
		.hr_line {
			margin-top: 2mm ;
			margin-bottom: 2mm ;
		}
		.msg_right {
			float: right;
			padding-bottom: 2mm;
		}
		.msg_center {
			clear: right;
			text-align: center;
			font: 12pt "Tahoma";
			margin:0;
		}
		p {
			margin: 2mm;
		}
		.msg_main {
			text-align: left;
			font: 10pt "Tahoma";
			padding-top: 2mm;
			clear: right;
			margin:0;
		}
		.sub_msg_main {
			text-align: left;
			font: 10pt "Tahoma";
			padding-top: 10px;
			padding-left: 20px;
		}
		.sub_p {
			font: 9pt "Tahoma";
			padding-left: 15mm;
		}
		div.square {
			height: 10mm;
			width: 8mm;
			background-color: #fff;
			border: 1px #000 solid;
			display: inline-block;
			margin-right:0.3mm;
		}
		div.square:first-child {
			margin-left: 10mm;
		}
		.inline_div {
			display:inline-block;
		}
		.block_under {
			text-align: center;
			font: 8pt "Tahoma";
		}
		.text_mid {
			margin-top: 10mm;
			margin-bottom: 10mm;
		}
		.font_underline {
			font: 10pt "Tahoma";
			font-weight: 400;
			text-decoration: underline;
		}
		@page {
			size: A4;
			margin: 0;
		}
		@media print {
			html, body {
				width: 210mm;
				height: 297mm;
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
        <div class="head_payment">
            ใบแจ้งการชำระเงินผ่านทางธนาคาร
        </div>
		<hr class="hr_line">
		<div class="msg_right">(สำหรับลูกค้า)</div> 
		<div class="msg_center">
			<p>กองโรคจากการประกอบอาชีพและสิ่งแวดล้อม</p>
			<p>ศูนย์อ้างอิงทางห้องปฏิบัติการและพิษวิทยา</p>
			<p>(COMPANY CODE = 92134)</p>
		</div>
		<div class="msg_main">
			<p class="sub_msg_main">ชื่อ/ หน่วยงาน</p>
			<p class="sub_p">(ใบเสร็จรับเงินจะออกตามชื่อข้างบน กรุณาแก้ไขถ้าไม่ถูกต้อง และรับชำระเฉพาะเงินสด/ แคชเชียร์เช็ค)</p>
		</div>
		<div class="msg_main">
			<span class="text_mid">Reference No.1: รหัสลูกค้า</span>
			<div class="inline_div"> 
				<div class="square">&nbsp;</div>
				<div class="square">&nbsp;</div>
				<div class="square">&nbsp;</div>
				<div class="square">&nbsp;</div>
			</div>
		</div>
		<div class="block_under" style="margin-left:-45mm;">
			(รหัสลูกค้า 4 หลัก)
		</div>
		<div class="msg_main">
			<span class="text_mid">Reference No.2: รหัสลูกค้า</span>
			<div class="inline_div"> 
				<div class="square">&nbsp;</div>
				<div class="square">&nbsp;</div>
				<div class="square">&nbsp;</div>
				<div class="square">&nbsp;</div>
				<div class="square">&nbsp;</div>
				<div class="square">&nbsp;</div>
				<div class="square">&nbsp;</div>
			</div>
		</div>
		<div class="block_under">
			(ลำดับที่ของการรับตัวอย่าง 5 หลัก/ปีงบประมาณ 2 หลัก)
		</div>
		<div class="msg_main">
			<span class="font_underline">ข้อปฏิบัติและเงื่อนไขในการชำระเงินค่าบริการฯ</span>
			<p>1. ตรวจสอบข้อมูลในใบแจ้งการชำระเงินให้ถูกต้อง และนำไปติดต่อชำระเงินที่ธนาคารกรุงไทย จำกัด (มหาชน) ได้ทุกสาขาทั่วประเทศทางช่องทางเคาน์เตอร์ (รับชำระเฉพาะเงินสด/ แคชเชียร์เช็ค)</p>
			<p>2. ผู้ชำระเป็นผู้รับผิดชอบค่าธรรมเนียมในการโอนในอัตรา 25 บาทต่อรายการ สำหรับวงเงินไม่เกิน 50,000 บาท ถ้าเกินวงเงินที่กำหนดทางธนาคารจะคิดส่วนเกินในอัตราร้อยละ 0.1 แต่ไม่เกิน 1,000 บาท</p>
			<p>3. ผู้ชำระจะต้องนำใบเสร็จรับเงินสำหรับราชการ <span style="font: 12pt 'tahoma'; font-weight: 600;">(แถบสีส้ม รหัส ENG 004721)</span> ชำระเงินที่ธนาคาร ซึ่งสามารถใช้แทนใบเสร็จรับเงินจาก ศูนย์อ้างอิงทางห้องปฏิบัติการฯ กองโรคจากการประกอบอาชีพฯ ได้ (หนังสืออนุมัติกรมบัญชีกลาง ที่ กค 00427/22268 ลงวันที่ 14 ตุลาคม 2558)</p>
			<p>4. กรณีมีเหตุขัดข้องไม่สามารถโอนเงินได้ ติดต่อสอบถามได้ที่ สำนักงานใหญ่ ธ.กรุงไทย หมายเลข 02-208-8528, 02-208-7495 ในเวลาทำการ หรือ ศูนย์อ้างอิงทางห้องปฏิบัติการและพิษวิทยา หมายเลข 02-968-7633</p>
		</div>
		<div class="msg_right">
			<p>รวม จำนวนเงินที่ชำระ..............บาท</p>
			<p>ลงชื่อ..........................ผู้ชำระเงิน</p>
			<p>ผู้รับเงิน.........................เจ้าหน้าที่ธนาคาร</p>
		</div>
		<div class="msg_main"><hr style="border-top: 1px dashed;"></div>
		<div class="msg_right">
			(สำหรับธนาคาร)
		</div>
		<div class="msg_main">
			<p>แบบฟอร์มการชำระเงินผ่านธนาคารกรุงไทย</p>
			<p>Company Code: 92134 (พนักงานธนาคาร ประทับตราธนาคาร และออกใบเสร็จรับเงิน (END 004721) ตามที่แนบให้กับผู้ชำระเงิน)</p>
			<p>ชื่อ/หน่วยงาน ......................................................</p>
			<p>เบอร์โทรติดต่อ (สำหรับลูกค้า)....................................</p>
		</div>
		<div style="border: solid 1px;">
			Reference No. 1: รหัสลูกค้า
			<div class="inline_div"> 
				<div class="square">&nbsp;</div>
				<div class="square">&nbsp;</div>
				<div class="square">&nbsp;</div>
				<div class="square">&nbsp;</div>
			</div>
		</div>
		<div style="border: solid 1px;">
			Reference No. 2: Lab No.
			<div class="inline_div"> 
				<div class="square">&nbsp;</div>
				<div class="square">&nbsp;</div>
				<div class="square">&nbsp;</div>
				<div class="square">&nbsp;</div>
				<div class="square">&nbsp;</div>
				<div class="square">&nbsp;</div>
				<div class="square">&nbsp;</div>
			</div>
		</div>
		<div style="border: solid 1px;">
			<p>จำนวนเงิน (ตัวเลข)</p>
			<p>จำนวน (ตัวอักษร)</p>
			<p>ลงชื่อ....................................ผู้ชำระเงิน
				<span class="msg_right">ผู้รับเงิน........................................เจ้าหน้าที่ธนาคาร</span>
			</p>
		</div>
	</div>
</body>
</html>

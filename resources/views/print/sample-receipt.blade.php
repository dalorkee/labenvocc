@extends('layouts.print.index')
@section('token')<meta name="csrf-token" content="{{ csrf_token() }}">@endsection
@section('style')
<style type="text/css">
	* {box-sizing:border-box; -moz-box-sizing:border-box; font-family: "DejaVuSansMono", "THsarabunNew", "DejaVu Sans", sans-serif}
	body{width:100%; height:100%; margin:0; padding:0; background-color:#fff; font-size:.875em}
	.text-center{text-align:center !important;}
	.main-table{
		width: 100%;
		margin: 4px 0 0 0;
		padding: 4px;
		border-collapse: collapse;
		table-layout: fixed;
		border-style: solid;
		border-width: 1px;
		font-size: 1em;
	}
	p-0 {padding:0 !important}
	m-0 {margin:0 !important}
	td {
		border-style: solid;
		border-width: 1px;
		padding: 6px;
		text-align: left;
		font-size: 1em;
	}
	.chk-box {
		display: inline-block;
		position: relative;
		width: 14px;
		height: 14px;
		border: 1px solid #000;
	}
	.chk-mark {
		display: inline-block;
		position: absolute;
		top: -6px;
		left: 1px;
		font-family: "DejaVu Sans", monospace;

	}
	span.border-bottom {
		display: inline-block;
		padding: 0 5px;
		border-bottom: 1px dotted #000;
	}

	.font-center {
		text-align: center;
		font-size: 8pt;
		font-weight: 400;
		text-decoration: underline;
	}
	.font-underline {
		font-size: 8pt;
		font-weight: 400;
		text-decoration: underline;
	}
	.thin-font {
		font-size: 8pt;
		font-weight: 400;
	}
	/* @media print {
		@page {
			size: auto;
			margin: 0mm;
		}
	} */
</style>
@endsection
@section('content')
	<div class="page">
		<form name="printFrm">
			<div class="text-center">
				ศูนย์อ้างอิงทางห้องปฏิบัติการและพิษวิทยา กองโรคจากการประกอบอาชีพและสิ่งแวดล้อม
			</div>
			<table class="main-table">
				<tr>
					<td width="65%">แบบบันทึก: ใบรับตัวอย่าง</td>
					<td>
						<p class="m-0 p-0">แก้ไขครั้งที่: 00 หน้า: 1 ของ 1</p>
						<p class="m-0 p-0">วันที่ประกาศใช้: 2 มีนาคม 2563</p>
					</td>
				</tr>
			</table>

			<table class="main-table">
				<tr>
					<td>Lab NO.: {{ $lab_no ?? 'undefine' }}</td>
					<td>กำหนดส่งรายงานผลการทดสอบ {{ $report_due_date ?? 'date' }}</td>
				</tr>
				<tr>
					<td colspan="2">ประเภทตัวอย่าง:
						<div class="chk-box"><span class="chk-mark">{{ (!empty($type_of_work) && $type_of_work == 1) ? '✔' : '' }}</span></div><span style="margin-right: 22px"> บริการ</span>
						<div class="chk-box"><span class="chk-mark">{{ (!empty($type_of_work) && $type_of_work == 2) ? '✔' : '' }}</span></div><span style="margin-right: 22px"> วิจัย</span>
						<div class="chk-box"><span class="chk-mark">{{ (!empty($type_of_work) && $type_of_work == 3) ? '✔' : '' }}</span></div><span style="margin-right: 22px"> เฝ้าระวัง SSRT/สอบสวนโรค</span>
						<div class="chk-box"><span class="chk-mark">{{ (!empty($type_of_work) && $type_of_work == 4) ? '✔' : '' }}</span></div><span style="margin-right: 22px"> อื่นๆ</span>
						{{-- <div style="font-family: DejaVu Sans, sans-serif;">✗</div> --}}
					</td>
				</tr>
				<tr>
					<td>
						<div class="chk-box"><span class="chk-mark">{{ (!empty($order_type) && $order_type == 2) ? '✔' : '' }}</span></div>
						สิ่งแวดล้อม: จำนวน <span class="border-bottom">10</span> ตัวอย่าง <span class="border-bottom">30</span> พารามิเตอร์
					</td>
					<td>
						<div class="chk-box"><span class="chk-mark">{{ (!empty($order_type) && $order_type == 1) ? '✔' : '' }}</span></div>
						ชีวภาพ: จำนวน  <span class="border-bottom">20</span> ตัวอย่าง  <span class="border-bottom">60</span> พารามิเตอร์
					</td>
				</tr>
				<tr>
					<td><div class="text-center">ชนิดตัวอย่าง</div></td>
					<td><div class="text-center">ชนิดตัวอย่าง</div></td>
				</tr>
				<tr>
					<td>
						<div class="chk-box"><span class="chk-mark">{{ (!empty($order_type) && $order_type == 1) ? '✔' : '' }}</span></div>
						ตลับอากาศ จำนวน: 10
						<br>
						Parameter: 50
					</td>
					<td>
						<div class="chk-box"><span class="chk-mark">{{ (!empty($order_type) && $order_type == 1) ? '✔' : '' }}</div>
						เลือด จำนวน: 20
						<br>
						Parameter/จำนวน: 30
					</td>
				</tr>
				<tr>
					<td>
						<div class="chk-box"><span class="chk-mark">{{ (!empty($order_type) && $order_type == 1) ? '✔' : '' }}</div>
						หลอดเก็บอากาศ จำนวน: 30
						<br>
						Parameter: 40
					</td>
					<td>
						<div class="chk-box"><span class="chk-mark">{{ (!empty($order_type) && $order_type == 1) ? '✔' : '' }}</div>
						ปัสสาวะ จำนวน: 500
						<br>
						Parameter/จำนวน: 70
					</td>
				</tr>
				<tr>
					<td>
						<div class="chk-box"><span class="chk-mark">{{ (!empty($order_type) && $order_type == 1) ? '✔' : '' }}</div>
						Bag จำนวน: 300
					</td>
					<td rowspan="2">
						<div class="chk-box"><span class="chk-mark">{{ (!empty($order_type) && $order_type == 1) ? '✔' : '' }}</div>
						น้ำเหลือง จำนวน: 800
						<br>
						Parameter/จำนวน: 600
					</td>
				</tr>
				<tr>
					<td>
						<div class="chk-box"><span class="chk-mark">{{ (!empty($order_type) && $order_type == 1) ? '✔' : '' }}</div>
						น้ำ จำนวน: 900
					</td>
				</tr>
				<tr>
					<td>
						<div class="chk-box"><span class="chk-mark">{{ (!empty($order_type) && $order_type == 1) ? '✔' : '' }}</div>
						อื่นๆ จำนวน: 600
						<br>
						Parameter/จำนวน: 900
					</td>
					<td>
						<div class="chk-box"><span class="chk-mark">{{ (!empty($order_type) && $order_type == 1) ? '✔' : '' }}</div>
						อื่นๆ จำนวน: 944
						<br>
						Parameter/จำนวน: 555
					</td>
				</tr>
				<tr>
					<td colspan="2">กลุ่มงาน:
						<div class="chk-box"><span class="chk-mark">{{ (!empty($type_of_work) && $type_of_work == 1) ? '✔' : '' }}</span></div><span style="margin-right: 22px"> โลหะหนัก</span>
						<div class="chk-box"><span class="chk-mark">{{ (!empty($type_of_work) && $type_of_work == 1) ? '✔' : '' }}</span></div><span style="margin-right: 22px"> สารอินทรีย์ระเหย</span>
						<div class="chk-box"><span class="chk-mark">{{ (!empty($type_of_work) && $type_of_work == 1) ? '✔' : '' }}</span></div><span style="margin-right: 22px"> กรดด่างและไอออน</span>
						<div class="chk-box"><span class="chk-mark">{{ (!empty($type_of_work) && $type_of_work == 1) ? '✔' : '' }}</span></div><span style="margin-right: 22px"> จุลินทรีย์และเส้นใย</span>
						<div class="chk-box"><span class="chk-mark">{{ (!empty($type_of_work) && $type_of_work == 1) ? '✔' : '' }}</span></div><span style="margin-right: 22px"> สารกำจัดศัตรูพืช</span>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<span class="font-underline">เรื่องแจ้งเพิ่มเติม (ถ้ามี)</span>
						&nbsp;&nbsp;<div class="chk_box">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
						<span class="thin-font"> ยินยอม</span>
						&nbsp;&nbsp;<div class="chk_box">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
						<span class="thin-font"> ไม่ยินยอม</span>
						<br><br>
						<span class="thin-font">ชื่อผู้ติดต่อกรณีเกิดปัญหา</span>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<span class="thin-font">โทร</span>
						<br><br>
						<span class="thin-font">เรื่องแจ้ง</span>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<span class="font-underline">ข้อมูลลูกค้า</span>
						<br><br>
						<span class="thin-font">หน่วยงานที่ส่ง :</span>
						<br><br>
						<span class="thin-font">ที่อยู่ :</span>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<span class="thin-font">โทร</span>
						<br><br>
						<span class="thin-font">วิธีนำส่ง :</span>
						&nbsp;&nbsp;<div class="chk_box">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
						<span class="thin-font"> นำส่งเอง</span>
						&nbsp;&nbsp;<div class="chk_box">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
						<span class="thin-font"> ไปรษณีย์</span>
						&nbsp;&nbsp;<div class="chk_box">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
						<span class="thin-font"> อื่นๆ</span>
						<br><br>
						<span class="thin-font">หนังสือนำส่งเลขที่ :</span>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<span class="thin-font">ลงวันที่ :</span>
						<br><br>
						<span class="thin-font">ผู้นำส่งตัวอย่าง :</span>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;
						<span class="thin-font">โทร :</span>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<span class="thin-font">วันที่ :</span>
						<br><br>
						<span class="thin-font">
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							(
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							)
						</span>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<span class="font-underline">การจัดส่งรายงานผลการทดสอบ</span>
						&nbsp;&nbsp;<div class="chk_box">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
						<span class="thin-font"> รับด้วยตนเอง</span>
						&nbsp;&nbsp;<div class="chk_box">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
						<span class="thin-font"> ไปรษณีย์</span>
						<br><br>
						<span class="thin-font">1. ชื่อผู้รับ</span>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<span class="thin-font">โทร</span>
						<br><br>
						<span class="thin-font">2. ที่อยู่</span>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<span class="font-underline">ข้อมูลเพิ่มเติมในใบรายงานการทดสอบ</span>
						&nbsp;&nbsp;<div class="chk_box">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
						<span class="thin-font"> ค่าความไม่แน่นอนของการวัด (เฉพาะของข่ายที่ได้รับการรับรอง)</span>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<span class="font-underline">ผลการตรวจสอบสภาพตัวอย่าง</span>
						<br><br>
						<span class="thin-font">สภาพตัวอย่าง</span>
						&nbsp;&nbsp;<div class="chk_box">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
						<span class="thin-font"> สมบูรณ์ :</span>
						&nbsp;&nbsp;
						<span class="thin-font">จำนวน</span>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<span class="thin-font">ตัวอย่าง</span>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<span class="thin-font">พารามิเตอร์</span>
						<br><br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<div class="chk_box">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
						<span class="thin-font"> ไม่สมบูรณ์ :</span>
						<span class="thin-font">จำนวน</span>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<span class="thin-font">ตัวอย่าง</span>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<span class="thin-font">พารามิเตอร์ (ปฎิเสธการรีบตัวอย่าง)</span>
						<br><br>
						<span class="thin-font">เนื่องจาก</span>
						<br><br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<span class="thin-font">ผู้รับตัวอย่าง :</span>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<span class="thin-font">วันที่ :</span>
						<br><br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<span class="thin-font">ผู้ทบทวนคำขอ :</span>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<span class="thin-font">วันที่ :</span>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<span class="font-underline">ติดต่องานบริหารทั่วไป</span> คุณประสงค์ และ คุณทิพาพร โทรศัพท์ 02-968-7633 โทรสาร 02-968-7631 E-mail: toxiclab@outlook.com
					</td>
				</tr>
			</table>
			<br>
			<span class="thin-font">
				หมายเหตุ: 1.ลูกค้า จะทราบผลการตรวจวิเคราะห์ ด้วยอัตราไม่เกิน 15 วันทำการ ต่อ 50 ตัวอย่าง
				<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;
				2.ศูนย์อ้างอิงฯ จะเก็บรักษาตัวอย่างไว้หลังจากทดสอบเสร็จสิ้นแล้ว 45 วัน ยกเว้นตัวอย่างอากาศ
			</span>
			<br>
			<div class="space"></div>
			<br>
			<div style="float: right; padding-rignt: 10px;">
				FM-701-01 Rev.00
			</div>
		</form>
	</div>
@endsection

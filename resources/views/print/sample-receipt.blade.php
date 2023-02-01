@extends('layouts.print.index')
@section('token')<meta name="csrf-token" content="{{ csrf_token() }}">@endsection
@section('style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/print.css') }}" media="screen, print">
@endsection
@section('content')
	<div class="page">
		<form name="printFrm">
			<table>
				<caption>ศูนย์อ้างอิงทางห้องปฏิบัติการและพิษวิทยา กองโรคจากการประกอบอาชีพและสิ่งแวดล้อม</caption>
				<tr>
					<td width="65%">
						<div class="m-0 p-0">แบบบันทึก: ใบรับตัวอย่าง</div>
					</td>
					<td>
						<div class="m-0 p-0">แก้ไขครั้งที่: 00 หน้า: 1 ของ 1</div>
						<div class="m-0 p-0 mt-n10">วันที่ประกาศใช้: 2 มีนาคม 2563</div>
					</td>
				</tr>
			</table>

			<table>
				<tr>
					<td><div class="py-4 mt-n10">Lab NO.: {{ $lab_no ?? 'undefine' }}</div></td>
					<td><div class="py-4 mt-n10">กำหนดส่งรายงานผลการทดสอบ {{ $report_due_date ?? 'date' }}</div></td>
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
						สิ่งแวดล้อม: จำนวน&nbsp;
						<span class="border-bottom">{{ (!empty($order_type) && $order_type == 2) ? $order_samples_count : $order[0]['order_samples_count'] }}</span> ตัวอย่าง&nbsp;
						<span class="border-bottom">{{ (!empty($order_type) && $order_type == 2) ? $parameters_count : $order[0]['parameters_count'] }}</span> พารามิเตอร์
					</td>
					<td>
						<div class="chk-box"><span class="chk-mark">{{ (!empty($order_type) && $order_type == 1) ? '✔' : '' }}</span></div>
						ชีวภาพ: จำนวน&nbsp;
						<span class="border-bottom">{{ (!empty($order_type) && $order_type == 1) ? $order_samples_count : $order[0]['order_samples_count'] }}</span> ตัวอย่าง&nbsp;
						<span class="border-bottom">{{ (!empty($order_type) && $order_type == 1) ? $parameters_count : $order[0]['parameters_count'] }}</span> พารามิเตอร์
					</td>
				</tr>
				<tr>
					<td><div class="m-0 p-0 text-center">ชนิดตัวอย่าง</div></td>
					<td><div class="m-0 p-0 text-center">ชนิดตัวอย่าง</div></td>
				</tr>
				<tr>
					<td>
						<div class="chk-box"><span class="chk-mark">{{ (!empty($order_type) && $order_type == 1) ? '✔' : '' }}</span></div>
						<div class="d-inline-block m-0 p-0">ตลับอากาศ จำนวน: {{ $data->parameters_count_deep[2] }}</div>
						<div class="mt-n10 p-0">Parameter: 50</div>
					</td>
					<td>
						<div class="chk-box"><span class="chk-mark">{{ (!empty($order_type) && $order_type == 1) ? '✔' : '' }}</div>
							<div class="d-inline-block m-0 p-0">เลือด จำนวน: 20</div>
							<div class="mt-n10 p-0">Parameter/จำนวน: 30</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="chk-box"><span class="chk-mark">{{ (!empty($order_type) && $order_type == 1) ? '✔' : '' }}</div>
							<div class="d-inline-block m-0 p-0">หลอดเก็บอากาศ จำนวน: 30</div>
							<div class="mt-n10 p-0">Parameter: 40</div>
					</td>
					<td>
						<div class="chk-box"><span class="chk-mark">{{ (!empty($order_type) && $order_type == 1) ? '✔' : '' }}</div>
							<div class="d-inline-block m-0 p-0">ปัสสาวะ จำนวน: 500</div>
							<div class="mt-n10 p-0">Parameter/จำนวน: 70</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="chk-box"><span class="chk-mark">{{ (!empty($order_type) && $order_type == 1) ? '✔' : '' }}</div>
							<div class="d-inline-block m-0 p-0">Bag จำนวน: 300</div>
					</td>
					<td rowspan="2">
						<div class="chk-box"><span class="chk-mark">{{ (!empty($order_type) && $order_type == 1) ? '✔' : '' }}</div>
							<div class="d-inline-block m-0 p-0">น้ำเหลือง จำนวน: 800</div>
							<div class="mt-n10 p-0">Parameter/จำนวน: 600</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="chk-box"><span class="chk-mark">{{ (!empty($order_type) && $order_type == 1) ? '✔' : '' }}</div>
							<div class="d-inline-block m-0 p-0">น้ำ จำนวน: 900</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="chk-box"><span class="chk-mark">{{ (!empty($order_type) && $order_type == 1) ? '✔' : '' }}</div>
							<div class="d-inline-block m-0 p-0">อื่นๆ จำนวน: 600</div>
							<div class="mt-n10 p-0">Parameter/จำนวน: 900</div>
					</td>
					<td>
						<div class="chk-box"><span class="chk-mark">{{ (!empty($order_type) && $order_type == 1) ? '✔' : '' }}</div>
							<div class="d-inline-block m-0 p-0">อื่นๆ จำนวน: 944</div>
							<div class="mt-n10 p-0">Parameter/จำนวน: 555</div>
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
						<span class="d-inline-block underline mr-40">เรื่องแจ้งเพิ่มเติม (ถ้ามี)</span>
						<div class="chk-box"><span class="chk-mark">{{ (!empty($type_of_work) && $type_of_work == 1) ? '✔' : '' }} </span></div><span style="margin-right: 22px"> ยินยอม</span>
						<div class="chk-box"><span class="chk-mark">{{ (!empty($type_of_work) && $type_of_work == 1) ? '✔' : '' }} </span></div><span style="margin-right: 22px"> ไม่ยินยอม</span>
						<div class="w-100">
							<div class="d-inline-block w-50">ชื่อผู้ติดต่อกรณีเกิดปัญหา นายกำปุ่น ยกยอ</div>
							<div class="d-inline-block w-30">โทร. 09-9855-1222</div>
						</div>
						<div class="w-100 mt-n10 pb-4">เรื่องแจ้ง โปรดกรอกข้อตกลงการใช้สารเคมีอันตรายด่วน</div>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<div class="mt-n6 p-0 underline">ข้อมูลลูกค้า</div>
						<div class="w-100 mt-n6 p-0">
							<div class="d-inline-block w-100">หน่วยงานที่ส่ง: หน่วยตรวจเคลื่อนที่เร็ว</div>
							<div class="d-inline-block w-80">ที่อยู่: บริษัท เอกชน จำกัด มหาชน 12/54 ถ.มะงำเปา ต.ในนา อ.จอมยี จ.กำแพงเพชร 11120</div>
							<div class="d-inline-block">โทร. 09-5511-1111</div>
						</div>
						<div class="w-100 mt-n6 p-0">วิธีนำส่ง:
							<div class="chk-box"><span class="chk-mark">{{ (!empty($type_of_work) && $type_of_work == 1) ? '✔' : '' }}</span></div><span style="margin-right: 22px"> นำส่งเอง</span>
							<div class="chk-box"><span class="chk-mark">{{ (!empty($type_of_work) && $type_of_work == 1) ? '✔' : '' }}</span></div><span style="margin-right: 22px"> ไปรษณีย์</span>
							<div class="chk-box"><span class="chk-mark">{{ (!empty($type_of_work) && $type_of_work == 1) ? '✔' : '' }}</span></div><span style="margin-right: 22px">  อื่นๆ</span>
						</div>
						<div class="w-100">
							<div class="d-inline-block w-30">หนังสือนำส่งเลขที่: sl 1102/2236</div>
							<div class="d-inline-block w-30">ลงวันที่: 30/01/2023</div>
						</div>
						<div class="w-100 mt-n4">
							<div class="d-inline-block w-30">ผู้นำส่งตัวอย่าง: คุณกำเนิด ระเบิดศรี</div>
							<div class="d-inline-block w-20">โทร: 09-8884-5511</div>
							<div class="d-inline-block w-30">วันที่: 20/12/2022</div>
							<div class="d-inline-block w-60 mt-n4" style="margin-left: 62px;">&#40;............................................................&#41;</div>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<span class="d-inline-block underline mr-40">การจัดส่งรายงานผลการทดสอบ</span>
						<div class="chk-box"><span class="chk-mark">{{ (!empty($type_of_work) && $type_of_work == 1) ? '✔' : '' }} </span></div><span style="margin-right: 22px"> รับด้วยตนเอง</span>
						<div class="chk-box"><span class="chk-mark">{{ (!empty($type_of_work) && $type_of_work == 1) ? '✔' : '' }} </span></div><span style="margin-right: 22px"> ไปรษณีย์</span>
						<div class="w-100">
							<div class="d-inline-block w-50 m-0 p-0">1. ชื่อผู้รับ นายองุ่นดง มงเจริญ</div>
							<div class="d-inline-block w-30 m-0 p-0">โทร. 09-7778-8887</div>
						</div>
						<div class="w-100 mt-n10">
							<div class="d-inline-block">2. ที่อยู่: 125/88 หมู่ 16 ต.นาตาปูด อ.กุดมุ้ม จ.นครสวรรค์ 11542</div>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<span class="d-inline-block underline mr-40">ข้อมูลเพิ่มเติมในใบรายงานการทดสอบ</span>
						<div class="chk-box"><span class="chk-mark">{{ (!empty($type_of_work) && $type_of_work == 1) ? '✔' : '' }} </span></div><span style="margin-right: 22px"> ค่าความไม่แน่นอนของการวัด (เฉพาะของข่ายที่ได้รับการรับรอง)</span>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<span class="d-inline-block underline mr-40">ผลการตรวจสอบสภาพตัวอย่าง</span>
						<div class="w-100 pt-4">
							<div class="d-inline-block mr-40">สภาพตัวอย่าง</div>
							<div class="d-inline-block mr-40 mt-8">
								<div class="chk-box"><span class="chk-mark">{{ (!empty($type_of_work) && $type_of_work == 1) ? '✔' : '' }} </span></div><span style="display: inline-block; margin-right: 22px; width: 120px;">&nbsp;สมบูรณ์:</span>
								<span>จำนวน 500 ตัวอย่าง 6000 พารามิเตอร์</span>
							</div>
							<div style="padding: 0 0 4px 100px;">
								<div class="chk-box"><span class="chk-mark">{{ (!empty($type_of_work) && $type_of_work == 1) ? '✔' : '' }} </span></div><span style="display: inline-block; margin-right: 22px; width: 120px;">&nbsp;ไม่สมบูรณ์:</span>
								<span>จำนวน 60 ตัวอย่าง 200 พารามิเตอร์ (ปฎิเสธการรับตัวอย่าง)</span>
							</div>
						</div>
						<div class="w-100">เนื่องจาก: หมดอายุการใช้งาน</div>
						<div class="w-100">
							<div class="d-inline-block w-30">ผู้รับตัวอย่าง: นางสุรีศรี มะขาวเปรี้ยว</div>
							<div class="d-inline-block w-30">วันที่: 2/12/2022</div>
						</div>
						<div class="w-100 mt-n4">
							<div class="d-inline-block w-30">ผู้ทบทวนคำขอ: มนุษย์ ยักษ์เขียว</div>
							<div class="d-inline-block w-30">วันที่: 13/11/2022</div>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<span class="underline">ติดต่องานบริหารทั่วไป</span> คุณประสงค์ และ คุณทิพาพร โทรศัพท์ 02-968-7633 โทรสาร 02-968-7631 E-mail: toxiclab@outlook.com
					</td>
				</tr>
			</table>
			<div class="w-100 mt-4">
				<div class="d-inline-block"><span class="d-inline-block" style="width: 60px">หมายเหตุ:</span> 1. ลูกค้า จะทราบผลการตรวจวิเคราะห์ ด้วยอัตราไม่เกิน 15 วันทำการ ต่อ 50 ตัวอย่าง</div>
				<div class="d-inline-block mt-n4"><span class="d-inline-block" style="width: 60px">&nbsp;</span> 2. ศูนย์อ้างอิงฯ จะเก็บรักษาตัวอย่างไว้หลังจากทดสอบเสร็จสิ้นแล้ว 45 วัน ยกเว้นตัวอย่างอากาศ</div>
			</div>
			<div style="float: right; padding-rignt: 10px;">FM-701-01 Rev.00</div>
		</form>
	</div>
@endsection

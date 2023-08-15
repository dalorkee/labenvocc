@extends('layouts.print.index')
@section('token')<meta name="csrf-token" content="{{ csrf_token() }}">@endsection
@section('style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/print.css?v=1.0') }}" media="screen, print">
@endsection
@section('content')
	<div class="page1">
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
					<td><div class="py-4 mt-n10">Lab NO.: {{ $lab_no ?? 'Your lab no here!' }}</div></td>
					<td><div class="py-4 mt-n10">กำหนดส่งรายงานผลการทดสอบ {{ $report_due_date ?? '' }}</div></td>
				</tr>
				<tr>
					<td colspan="2">ประเภทตัวอย่าง:
						<div class="chk-box"><span class="chk-mark">{{ ($type_of_work == 1) ? '✔' : '' }}</span></div><span style="margin-right: 22px"> บริการ</span>
						<div class="chk-box"><span class="chk-mark">{{ ($type_of_work == 2) ? '✔' : '' }}</span></div><span style="margin-right: 22px"> วิจัย</span>
						<div class="chk-box"><span class="chk-mark">{{ ($type_of_work == 3 || $type_of_work == 4) ? '✔' : '' }}</span></div><span style="margin-right: 22px"> เฝ้าระวัง SSRT/สอบสวนโรค</span>
						<div class="chk-box"><span class="chk-mark">{{ ($type_of_work == 5) ? '✔' : '' }}</span></div><span style="margin-right: 22px"> อื่นๆ</span>
					</td>
				</tr>
				<tr>
					<td>
						<div class="chk-box"><span class="chk-mark">{{ ($order_type == "env") ? '✔' : '' }}</span></div>
						สิ่งแวดล้อม: จำนวน&nbsp;
						<span class="border-bottom">{{ ($order_type == "env") ? $order_samples_count : '' }}</span> ตัวอย่าง&nbsp;
						<span class="border-bottom">{{ ($order_type == "env") ? $parameters_count : '' }}</span> พารามิเตอร์
					</td>
					<td>
						<div class="chk-box"><span class="chk-mark">{{ ($order_type == "bio") ? '✔' : '' }}</span></div>
						ชีวภาพ: จำนวน&nbsp;
						<span class="border-bottom">{{ ($order_type == "bio") ? $order_samples_count : '' }}</span> ตัวอย่าง&nbsp;
						<span class="border-bottom">{{ ($order_type == "bio") ? $parameters_count : '' }}</span> พารามิเตอร์
					</td>
				</tr>
				<tr>
					<td><div class="m-0 p-0 text-center">ชนิดตัวอย่าง</div></td>
					<td><div class="m-0 p-0 text-center">ชนิดตัวอย่าง</div></td>
				</tr>
				<tr>
					<td>
						<div class="chk-box"><span class="chk-mark">{{ (array_key_exists(7, $parameters_count_deep)) ? '✔' : '' }}</span></div>
						<div class="d-inline-block m-0 p-0">ตลับอากาศ จำนวน: {{ (array_key_exists(7, $parameters_count_deep)) ? $parameters_count_deep[7] : '' }}</div>
						<div class="mt-n10 p-0">Parameter: {{ (array_key_exists(7, $parameters_count_deep)) ? $parameters_count_deep[7] : '' }}</div>
					</td>
					<td>
						<div class="chk-box"><span class="chk-mark">{{ (array_key_exists(8, $parameters_count_deep))  ? '✔' : '' }}</div>
							<div class="d-inline-block m-0 p-0">เลือด จำนวน: {{ (array_key_exists(8, $parameters_count_deep)) ? $parameters_count_deep[8] : '' }}</div>
							<div class="mt-n10 p-0">Parameter/จำนวน: {{ (array_key_exists(8, $parameters_count_deep)) ? $parameters_count_deep[8] : '' }}</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="chk-box"><span class="chk-mark">{{ (array_key_exists(999, $parameters_count_deep)) ? '✔' : '' }}</div>
							<div class="d-inline-block m-0 p-0">หลอดเก็บอากาศ จำนวน: {{ (array_key_exists(999, $parameters_count_deep)) ? $parameters_count_deep[999] : '' }}</div>
							<div class="mt-n10 p-0">Parameter: {{ (array_key_exists(999, $parameters_count_deep)) ? $parameters_count_deep[999] : '' }}</div>
					</td>
					<td>
						<div class="chk-box"><span class="chk-mark">{{ (array_key_exists(5, $parameters_count_deep)) ? '✔' : '' }}</div>
							<div class="d-inline-block m-0 p-0">ปัสสาวะ จำนวน: {{ (array_key_exists(5, $parameters_count_deep)) ? $parameters_count_deep[5] : '' }}</div>
							<div class="mt-n10 p-0">Parameter/จำนวน: {{ (array_key_exists(5, $parameters_count_deep)) ? $parameters_count_deep[5] : '' }}</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="chk-box"><span class="chk-mark">{{ (array_key_exists(999, $parameters_count_deep)) ? '✔' : '' }}</div>
							<div class="d-inline-block m-0 p-0">Bag จำนวน: {{ (array_key_exists(999, $parameters_count_deep)) ? $parameters_count_deep[999] : '' }}</div>
					</td>
					<td rowspan="2">
						<div class="chk-box"><span class="chk-mark">{{ (array_key_exists(9, $parameters_count_deep)) ? '✔' : '' }}</div>
							<div class="d-inline-block m-0 p-0">น้ำเหลือง จำนวน: {{ (array_key_exists(9, $parameters_count_deep)) ? $parameters_count_deep[9] : '' }}</div>
							<div class="mt-n10 p-0">Parameter/จำนวน: {{ (array_key_exists(9, $parameters_count_deep)) ? $parameters_count_deep[9] : '' }}</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="chk-box"><span class="chk-mark">{{ (array_key_exists(3, $parameters_count_deep)) ? '✔' : '' }}</div>
							<div class="d-inline-block m-0 p-0">น้ำ จำนวน: {{ (array_key_exists(3, $parameters_count_deep)) ? $parameters_count_deep[3] : '' }}</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="chk-box"><span class="chk-mark">{{ (array_key_exists(999, $parameters_count_deep)) ? '✔' : '' }}</div>
							<div class="d-inline-block m-0 p-0">อื่นๆ จำนวน: {{ (array_key_exists(999, $parameters_count_deep)) ? $parameters_count_deep[999] : '' }}</div>
							<div class="mt-n10 p-0">Parameter/จำนวน: {{ (array_key_exists(999, $parameters_count_deep)) ? $parameters_count_deep[999] : '' }}</div>
					</td>
					<td>
						<div class="chk-box"><span class="chk-mark">{{ (array_key_exists(999, $parameters_count_deep)) ? '✔' : '' }}</div>
							<div class="d-inline-block m-0 p-0">อื่นๆ จำนวน: {{ (array_key_exists(999, $parameters_count_deep)) ? $parameters_count_deep[999] : '' }}</div>
							<div class="mt-n10 p-0">Parameter/จำนวน: {{ (array_key_exists(999, $parameters_count_deep)) ? $parameters_count_deep[999] : '' }}</div>
					</td>
				</tr>
				<tr>
					<td colspan="2">กลุ่มงาน:
						<div class="chk-box"><span class="chk-mark">{{ ($origin_threat_id == 3) ? '✔' : '' }}</span></div><span style="margin-right: 22px"> โลหะหนัก</span>
						<div class="chk-box"><span class="chk-mark">{{ ($origin_threat_id == 999) ? '✔' : '' }}</span></div><span style="margin-right: 22px"> สารอินทรีย์ระเหย</span>
						<div class="chk-box"><span class="chk-mark">{{ ($origin_threat_id == 999) ? '✔' : '' }}</span></div><span style="margin-right: 22px"> กรดด่างและไอออน</span>
						<div class="chk-box"><span class="chk-mark">{{ ($origin_threat_id == 999) ? '✔' : '' }}</span></div><span style="margin-right: 22px"> จุลินทรีย์และเส้นใย</span>
						<div class="chk-box"><span class="chk-mark">{{ ($origin_threat_id == 999) ? '✔' : '' }}</span></div><span style="margin-right: 22px"> สารกำจัดศัตรูพืช</span>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<span class="d-inline-block underline mr-40">เรื่องแจ้งเพิ่มเติม (ถ้ามี)</span>
						<div class="chk-box"><span class="chk-mark">&nbsp;</span></div><span style="margin-right: 22px"> ยินยอม</span>
						<div class="chk-box"><span class="chk-mark">&nbsp;</span></div><span style="margin-right: 22px"> ไม่ยินยอม</span>
						<div class="w-100">
							<div class="d-inline-block w-50">ชื่อผู้ติดต่อกรณีเกิดปัญหา</div>
							<div class="d-inline-block w-30">โทร.</div>
						</div>
						<div class="w-100 mt-n10 pb-4">เรื่องแจ้ง</div>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<div class="mt-n6 p-0 underline">ข้อมูลลูกค้า</div>
						<div class="w-100 mt-n6 p-0">
							<div class="d-inline-block w-100">หน่วยงานที่ส่ง: {{ $customer_agency_name }}</div>
							<div class="d-inline-block w-80">ที่อยู่: {{ $customer_address }}</div>
							<div class="d-inline-block">โทร. {{ $customer_mobile }}</div>
						</div>
						<div class="w-100 mt-n6 p-0">วิธีนำส่ง:
							<div class="chk-box"><span class="chk-mark">{{ (!is_null($deliver_method) && $deliver_method == 'self') ? '✔' : '' }}</span></div><span style="margin-right: 22px"> นำส่งเอง</span>
							<div class="chk-box"><span class="chk-mark">{{ (!is_null($deliver_method) && $deliver_method == 'post') ? '✔' : '' }}</span></div><span style="margin-right: 22px"> ไปรษณีย์</span>
							<div class="chk-box"><span class="chk-mark">{{ (!is_null($deliver_method) && $deliver_method == 'other') ? '✔' : '' }}</span></div><span style="margin-right: 22px">  อื่นๆ</span>
						</div>
						<div class="w-100">
							<div class="d-inline-block w-30">หนังสือนำส่งเลขที่: {{ $book_no }}</div>
							<div class="d-inline-block w-30">ลงวันที่: {{ $book_date }}</div>
						</div>
						<div class="w-100 mt-n4">
							<div class="d-inline-block w-30">ผู้นำส่งตัวอย่าง: {{ $first_name." ".$last_name }}</div>
							<div class="d-inline-block w-20">โทร: {{ $mobile }}</div>
							<div class="d-inline-block w-30">วันที่: {{ $order_created_at }}</div>
							<div class="d-inline-block w-60 mt-n4" style="margin-left: 62px;">&#40;............................................................&#41;</div>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<span class="d-inline-block underline mr-40">การจัดส่งรายงานผลการทดสอบ</span>
						<div class="chk-box"><span class="chk-mark">{{ (!is_null($report_result_receive_method) && $report_result_receive_method == 'self') ? '✔' : '' }} </span></div><span style="margin-right: 22px"> รับด้วยตนเอง</span>
						<div class="chk-box"><span class="chk-mark">{{ (!is_null($report_result_receive_method) && $report_result_receive_method == 'post') ? '✔' : '' }} </span></div><span style="margin-right: 22px"> ไปรษณีย์</span>
						<div class="w-100">
							<div class="d-inline-block w-50 m-0 p-0">1. ชื่อผู้รับ {{ $report_result_receive_first_name." ".$report_result_receive_last_name }}</div>
							<div class="d-inline-block w-30 m-0 p-0">โทร. {{ $report_result_receive_mobile }}</div>
						</div>
						<div class="w-100 mt-n10">
							<div class="d-inline-block">2. ที่อยู่: {{ $report_result_receive_addr }}</div>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<span class="d-inline-block underline mr-40">ข้อมูลเพิ่มเติมในใบรายงานการทดสอบ</span>
						<div class="chk-box"><span class="chk-mark"></span></div><span style="margin-right: 22px"> ค่าความไม่แน่นอนของการวัด (เฉพาะของข่ายที่ได้รับการรับรอง)</span>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<span class="d-inline-block underline mr-40">ผลการตรวจสอบสภาพตัวอย่าง</span>
						<div class="w-100 pt-4" style="height: 96px; position: relative;">
							<div style="position: absolute; top: 12px; left: 2px">สภาพตัวอย่าง</div>
							<div style="position: absolute; top: 20px; left: 120px;">
								<div class="chk-box"><span class="chk-mark">{{ ($sample_sumary['sample_completed'] > 0) ? '✔' : '' }} </span></div><span style="display: inline-block; margin-right: 22px; width: 120px;">&nbsp;สมบูรณ์:</span>
							</div>
							<div style="position: absolute; top: 16px; left: 220px;">
								<span>จำนวน {{ $sample_sumary['sample_completed'] }} ตัวอย่าง {{ $sample_sumary['sample_completed_amount'] }} พารามิเตอร์</span>
							</div>
							<div style="position: absolute; top: 44px; left: 120px;">
								<div class="chk-box"><span class="chk-mark">{{ ($sample_sumary['sample_not_completed'] > 0) ? '✔' : '' }} </span></div><span style="display: inline-block; margin-right: 22px; width: 120px;">&nbsp;ไม่สมบูรณ์:</span>
							</div>
							<div style="position: absolute; top: 42px; left: 220px;">
								<span>จำนวน {{ $sample_sumary['sample_not_completed'] }} ตัวอย่าง {{ $sample_sumary['sample_not_completed_amount'] }} พารามิเตอร์ (ปฎิเสธการรับตัวอย่าง)</span>
							</div>
						</div>
						<div class="w-100">เนื่องจาก: {{ $sample_verify_desc }}</div>
						<div class="w-100">
							<div class="d-inline-block w-30">ผู้รับตัวอย่าง: {{ $received_order_name }}</div>
							<div class="d-inline-block w-30">วันที่: {{ $received_order_date }}</div>
						</div>
						<div class="w-100 mt-n4">
							<div class="d-inline-block w-30">ผู้ทบทวนคำขอ: {{ $review_order_name }}</div>
							<div class="d-inline-block w-30">วันที่: {{ $review_order_date }}</div>
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
			<div class="page1-foot-name" style="float: right; padding-rignt: 10px;">FM-701-01 Rev.00</div>

			<div class="page2">
				<div class="w-100 page2-header">
					<div style="text-align:center;font-size:1.10em;border-bottom:1px solid #bbb">ใบแจ้งการชำระเงินผ่านทางธนาคาร</div>
					<span>(สำหรับลูกค้า)</span>
					<div class="mt-8 w-100 text-center">
						<p>กองโรคจากการประกอบอาชีพและสิ่งแวดล้อม</p>
						<p>ศูนย์อ้างอิงทางห้องปฏิบัติการและพิษวิทยา</p>
						<p>(COMPANY CODE = 92134)</p>
					</div>
				</div>
				<div class="w-100 page2-customer-data mt-40">
					<div class="customer-name">
						<p class="m-0 p-0" style="height: 1em; line-height: 1em">ชื่อ/หน่วยงาน</p>
						<p class="m-0 p-0" style="height: 1em; line-height: 1em">(ใบเสร็จรับเงินจะออกตามชื่อข้างบน กรุณาแก้ไขถ้าไม่ถูกต้อง และรับชำระเฉพาะเงินสด/แคชเชียร์เช็ค)</p>
					</div>
					<div class="customer-id mt-8">
						<div style="position:absolute; top:5px; left:4px">Reference No.1: รหัสลูกค้า</div>
						<div style="position:absolute; top:14px; left:150px; width:20px; height:18px; line-height: 10px; margin:0; padding:0; text-align: center; border:1px solid black;">{{ $user_id_arr[0] }}</div>
						<div style="position:absolute; top:14px; left:174px; width:20px; height:18px; line-height: 10px; margin:0; padding:0; text-align: center; border:1px solid black;">{{ $user_id_arr[1] }}</div>
						<div style="position:absolute; top:14px; left:198px; width:20px; height:18px; line-height: 10px; margin:0; padding:0; text-align: center; border:1px solid black;">{{ $user_id_arr[2] }}</div>
						<div style="position:absolute; top:14px; left:222px; width:20px; height:18px; line-height: 10px; margin:0; padding:0; text-align: center; border:1px solid black;">{{ $user_id_arr[3] }}</div>
						<div style="position:absolute; top:30px; left: 150px">(รหัสลูกค้า 4 หลัก)</div>
					</div>
					<div class="customer-lab-no mt-8">
						<div style="position:absolute; top:5px; left:4px">Reference No.2: Lab No.</div>
						<div style="position:absolute; top:14px; left:150px; width:20px; height:18px; line-height: 10px; margin:0; padding:0; text-align: center; border:1px solid black;">{{ $lab_no_arr[0] }}</div>
						<div style="position:absolute; top:14px; left:174px; width:20px; height:18px; line-height: 10px; margin:0; padding:0; text-align: center; border:1px solid black;">{{ $lab_no_arr[1] }}</div>
						<div style="position:absolute; top:14px; left:198px; width:20px; height:18px; line-height: 10px; margin:0; padding:0; text-align: center; border:1px solid black;">{{ $lab_no_arr[2] }}</div>
						<div style="position:absolute; top:14px; left:222px; width:20px; height:18px; line-height: 10px; margin:0; padding:0; text-align: center; border:1px solid black;">{{ $lab_no_arr[3] }}</div>
						<div style="position:absolute; top:14px; left:246px; width:20px; height:18px; line-height: 10px; margin:0; padding:0; text-align: center; border:1px solid black;">{{ $lab_no_arr[4] }}</div>
						<div style="position:absolute; top:14px; left:270px; width:20px; height:18px; line-height: 10px; margin:0; padding:0; text-align: center; border:1px solid black;">{{ $lab_no_arr[5] }}</div>
						<div style="position:absolute; top:14px; left:294px; width:20px; height:18px; line-height: 10px; margin:0; padding:0; text-align: center; border:1px solid black;">{{ $lab_no_arr[6] }}</div>
						<div style="position:absolute; top:30px; left: 150px">(ลำดับที่ของการรับตัวอย่าง 5 หลัก/ปีงบประมาณ 2 หลัก)</div>
					</div>
					<div class="customer-condition">
						<div><span style="border-bottom:1px solid #bbb;">ข้อปฏิบัติและเงื่อนไขในการชำระเงินค่าบริการฯ</span></div>
						<p style="margin:0; padding:0 20px;">1. ตรวจสอบข้อมูลในใบแจ้งการชำระเงินให้ถูกต้อง และนำไปติดต่อชำระเงินที่ธนาคารกรุงไทย จำกัด (มหาชน) ได้ทุกสาขาทั่วประเทศทางช่องทางเคาน์เตอร์ (รับชำระเฉพาะเงินสด/ แคชเชียร์เช็ค)</p>
						<p style="margin:0; padding:0 20px;">2. ผู้ชำระเป็นผู้รับผิดชอบค่าธรรมเนียมในการโอนในอัตรา 25 บาทต่อรายการ สำหรับวงเงินไม่เกิน 50,000 บาท ถ้าเกินวงเงินที่กำหนดทางธนาคารจะคิดส่วนเกินในอัตราร้อยละ 0.1 แต่ไม่เกิน 1,000 บาท</p>
						<p style="margin:0; padding:0 20px;">3. ผู้ชำระจะต้องนำใบเสร็จรับเงินสำหรับราชการ (แถบสีส้ม รหัส ENG 004721) ชำระเงินที่ธนาคาร ซึ่งสามารถใช้แทนใบเสร็จรับเงินจาก ศูนย์อ้างอิงทางห้องปฏิบัติการฯ กองโรคจากการประกอบอาชีพฯ ได้ (หนังสืออนุมัติกรมบัญชีกลาง ที่ กค 00427/22268 ลงวันที่ 14 ตุลาคม 2558)</p>
						<p style="margin:0; padding:0 20px;">4. กรณีมีเหตุขัดข้องไม่สามารถโอนเงินได้ ติดต่อสอบถามได้ที่ สำนักงานใหญ่ ธ.กรุงไทย หมายเลข 02-208-8528, 02-208-7495 ในเวลาทำการ หรือ ศูนย์อ้างอิงทางห้องปฏิบัติการและพิษวิทยา หมายเลข 02-968-7633</p>
					</div>
					<div class="customer-sign" style="height:140px; padding:0 0 10px 0; border-bottom:1px dashed #000">
						<div style="position:absolute; top:10px; left:300px">
							<p>รวม จำนวนเงินที่ชำระ {{ number_format($parameters_total_price, 2) }} บาท</p>
							<p>ลงชื่อ..................................................................................ผู้ชำระเงิน</p>
							<p>ผู้รับเงิน..............................................................................เจ้าหน้าที่ธนาคาร</p>
						</div>
					</div>
					<div class="bank-form">
						<span style="position:absolute; top:4px; right:0">(สำหรับธนาคาร)</span>
						<div style="position:absolute; top:20px; left:0; width: 100%; height:120px">
							<p style="margin:0; padding:0;">แบบฟอร์มการชำระเงินผ่านธนาคารกรุงไทย</p>
							<p style="margin:0; padding:0">Company Code: 92134 (พนักงานธนาคาร ประทับตราธนาคาร และออกใบเสร็จรับเงิน (END 004721) ตามที่แนบให้กับผู้ชำระเงิน)</p>
							<p style="margin:0; padding:0">ชื่อ/หน่วยงาน .....................................................................................................................</p>
							<p style="margin:0; padding:0">เบอร์โทรติดต่อ (สำหรับลูกค้า).............................................................................................</p>
						</div>
						<div style="position:absolute; top:150px; left:0; width: 100%; height:200px; border: 1px solid #000">
							<div style="position: relative; width: 100%; height: 38px; border-bottom: 1px solid #bbb">
								<div style="position:absolute; top:5px; left:4px">Reference No.1: รหัสลูกค้า</div>
								<div style="position:absolute; top:12px; left:150px; width:20px; height:18px; line-height: 10px; margin:0; padding:0; text-align: center; border:1px solid black;">{{ $user_id_arr[0] }}</div>
								<div style="position:absolute; top:12px; left:174px; width:20px; height:18px; line-height: 10px; margin:0; padding:0; text-align: center; border:1px solid black;">{{ $user_id_arr[1] }}</div>
								<div style="position:absolute; top:12px; left:198px; width:20px; height:18px; line-height: 10px; margin:0; padding:0; text-align: center; border:1px solid black;">{{ $user_id_arr[2] }}</div>
								<div style="position:absolute; top:12px; left:222px; width:20px; height:18px; line-height: 10px; margin:0; padding:0; text-align: center; border:1px solid black;">{{ $user_id_arr[3] }}</div>
							</div>
							<div style="position: relative; width: 100%; height: 38px; border-bottom: 1px solid #bbb">
								<div style="position:absolute; top:5px; left:4px">Reference No.2: Lab No.</div>
								<div style="position:absolute; top:12px; left:150px; width:20px; height:18px; line-height: 10px; margin:0; padding:0; text-align: center; border:1px solid black;">{{ $lab_no_arr[0] }}</div>
								<div style="position:absolute; top:12px; left:174px; width:20px; height:18px; line-height: 10px; margin:0; padding:0; text-align: center; border:1px solid black;">{{ $lab_no_arr[1] }}</div>
								<div style="position:absolute; top:12px; left:198px; width:20px; height:18px; line-height: 10px; margin:0; padding:0; text-align: center; border:1px solid black;">{{ $lab_no_arr[2] }}</div>
								<div style="position:absolute; top:12px; left:222px; width:20px; height:18px; line-height: 10px; margin:0; padding:0; text-align: center; border:1px solid black;">{{ $lab_no_arr[3] }}</div>
								<div style="position:absolute; top:12px; left:246px; width:20px; height:18px; line-height: 10px; margin:0; padding:0; text-align: center; border:1px solid black;">{{ $lab_no_arr[4] }}</div>
								<div style="position:absolute; top:12px; left:270px; width:20px; height:18px; line-height: 10px; margin:0; padding:0; text-align: center; border:1px solid black;">{{ $lab_no_arr[5] }}</div>
								<div style="position:absolute; top:12px; left:294px; width:20px; height:18px; line-height: 10px; margin:0; padding:0; text-align: center; border:1px solid black;">{{ $lab_no_arr[6] }}</div>
							</div>
							<div style="position:relative; width: 100%; height:120px">
								<p style="position:absolute; top:0px; left:4px; width:100%;">จำนวนเงิน (บาท)<span style="padding-left: 10px">...........................................................................................................................</span></p>
								<p style="position:absolute; top:30px; left:4px; width:100%;">จำนวนเงิน (ตัวอักษร)<span style="padding-left: 10px">....................................................................................................................</span></p>
								<span style="position:absolute; top:80px; left:4px; width:40%; display:inline-block">ลงชื่อ..............................................................................................................ผู้ชำระเงิน</span>
								<span style="position:absolute; top:80px; left:336px; width:40% display:inline-block">ผู้รับเงิน............................................................................................................เจ้าหน้าที่ธนาคาร</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
@endsection

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
	<title>Sample Receipt Form</title>
	<style type="text/css">
	* {
		margin:auto;
		padding:0;
		font-family:Arial, "times New Roman", tahoma;
		font-size:12px;
	}
	html {
		font-family:Arial, "times New Roman", tahoma;
		font-size:12px;
		color:#000000;
	}
	body {
		font-family:Arial, "times New Roman", tahoma;
		font-size:12px;
		padding:0;
		margin:0;
		color:#000000;
	}
	.head-office {
		font-size:16px;
		width:750px;
		text-align: center;
	}
	.main-table {
		width:750px;
		border-collapse: collapse;
		table-layout: fixed;
	}
	td {
		border-style: solid;
		border-width: 1px;
		padding: 10px;
  		text-align: left;
		font-size:14px;
		font-weight: 400;
	}
	span {
		font-size:14px;
		font-weight: 50;
	}
	.space {
		padding: 2px;
	}
	.headerTitle01 {
		border:1px solid #333333;
		border-left:2px solid #000;
		border-bottom-width:2px;
		border-top-width:2px;
		font-size:11px;
	}
	.headerTitle01_r {
		border:1px solid #333333;
		border-left:2px solid #000;
		border-right:2px solid #000;
		border-bottom-width:2px;
		border-top-width:2px;
		font-size:11px;
	}
	/* สำหรับช่องกรอกข้อมูล  */
	.box_data1 {
		font-family:Arial, "times New Roman", tahoma;
		height:18px;
		border:0px dotted #333333;
		border-bottom-width:1px;
	}
	/* กำหนดเส้นบรรทัดซ้าย  และด้านล่าง */
	.left_bottom {
		border-left:2px solid #000;
		border-bottom:1px solid #000;
	}
	/* กำหนดเส้นบรรทัดซ้าย ขวา และด้านล่าง */
	.left_right_bottom {
		border-left:2px solid #000;
		border-bottom:1px solid #000;
		border-right:2px solid #000;
	}
	/* สร้างช่องสี่เหลี่ยมสำหรับเช็คเลือก */
	.chk_box {
		display:inline;
		width:10px;
		height:10px;
		overflow:hidden;
		border:1px solid #000;
	}
	/* css ส่วนสำหรับการแบ่งหน้าข้อมูลสำหรับการพิมพ์ */
	@media all
	{
		.page-break { display:none; }
		.page-break-no{ display:none; }
	}
	@media print
	{
		.page-break { display:block;height:1px; page-break-before:always; }
		.page-break-no{ display:block;height:1px; page-break-after:avoid; } 
	}
	</style>
</head>
 
<body>

	<div class="page-break">&nbsp;</div>
		<div class="head-office">
			ศูนย์อ้างอิงทางห้องปฏิบัติการและพิษวิทยา กองโรคจากการประกอบอาชีพและสิ่งแวดล้อม
		</div>
		<table class="main-table">
			<tr>
				<td width="65%">แบบบันทึก: ใบรับตัวอย่าง</td>
				<td>แก้ไขครั้งที่: 00 หน้า: 1 ของ 1<br>
					วันที่ประกาศใช้: 2 มีนาคม 2563
				</td>
			</tr>
		</table>
		<div class="space"></div>
		<table class="main-table">
			<tr>
				<td>Lab NO.:</td>
				<td>กำหนดส่งรายงานผลการทดสอบ <span>test</span></td>
			</tr>
		</table>
		<div class="space"></div>
		<table class="main-table">
			<tr>
				<td>ประเภทตัวอย่าง :</td>
				<td><div class="chk_box">&nbsp;&nbsp;&nbsp;</div> บริการ </td>
				<td><div class="chk_box">&nbsp;&nbsp;&nbsp;</div> วิจัย </td> 
				<td><div class="chk_box">&nbsp;&nbsp;&nbsp;</div> เฝ้าระวัง SSRT/สอบสวนโรค </td>
				<td><div class="chk_box">&nbsp;&nbsp;&nbsp;</div> อื่นๆ </td>
			</tr>
		</table>
</body>
</html>
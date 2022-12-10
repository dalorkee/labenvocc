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
        padding: 20mm;
        margin: 10mm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }
    .subpage {
        padding: 1cm;
        border: 1px black solid;
        height: 257mm;
        outline: 2cm #FFEAEA solid;
    }
    br {
        display: block;
        margin: 2px 0;
    }
    .head-payment {
		text-align: center;
		font: 14pt "Tahoma";
	}
	.hr_line {
		margin-top: 12px ;
		margin-bottom: 12px ;
	}
	.msg_right {
		float: right;
		padding-bottom: 15px;
	}
	.msg_center {
		clear: right;
		text-align: center;
		font: 12pt "Tahoma";
	}
	p {
		margin: 10px;
	}
	.msg_main {
		text-align: left;
		font: 10pt "Tahoma";
		padding-top: 10px;
	}
	.sub_p {
		font: 9pt "Tahoma";
	}
    .main-table {
		width:100%;
		border-collapse: collapse;
		table-layout: fixed;
        border-style: solid;
		border-width: 1px;
        font: 8pt "Tahoma";
        padding: 4px;
	}
    td {
		border-style: solid;
		border-width: 1px;
		padding: 6px;
  		text-align: left;
        font: 8pt "Tahoma";
	}
    .space {
		padding: 2px;
	}
    .chk_box {
		display:inline;
		width:10px;
		height:10px;
		overflow:hidden;
		border:1px solid #000;
	}
    .font-center {
		text-align: center;
		font: 8pt "Tahoma";
		font-weight: 400;
		text-decoration: underline;
	}
	.font-underline {
		font: 8pt "Tahoma";
		font-weight: 400;
		text-decoration: underline;
	}
    .thin-font {
		font: 8pt "Tahoma";
		font-weight: 100;
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
        <div class="subpage">
            <div class="head-payment">
                ใบแจ้งการชำระเงินผ่านทางธนาคาร
            </div>
			<hr class="hr_line">
			<div class="msg_right">(สำหรับลูกจ้าง)</div> 
			<div class="msg_center">
				<p>กองโรคจากการประกอบอาชีพและสิ่งแวดล้อม</p>
				<p>ศูนย์อ้างอิงทางห้องปฏิบัติการและพิษวิทยา</p>
				<p>(COMPANY CODE = 92134)</p>
			</div>
			<div class="msg_main">
				<p>ชื่อ/ หน่วยงาน</p>
				<p class="sub_p">(ใบเสร็จรับเงินจะออกตามชื่อข้างบน กรุณาแก้ไขถ้าไม่ถูกต้อง และรับชำระเฉพาะเงินสด/ แคชเชียร์เช็ค)</p>
			</div>
		</div>
	</div>
</body>
</html>

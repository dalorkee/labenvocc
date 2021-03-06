@extends('layouts.index')
@section('style')
<link href="{{ URL::asset('vendor/jquery-smartwizard/css/smart_wizard_arrows.min.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('content')
<ol class="breadcrumb page-breadcrumb">
	<li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
	<li class="breadcrumb-item">หน้าหลัก</li>
	{{-- <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li> --}}
</ol>
<div class="subheader">
	<h1 class="subheader-title"><i class='fal fa-home'></i> หน้าหลัก<small>Sub title here!!</small></h1>
</div>
<div class="fs-lg fw-300 p-5 bg-white border-faded rounded mb-g">
	<div id="smartwizard">
		<ul class="nav">
			<li class="nav-item">
				<a class="nav-link" href="#step-1">
					<strong>Aung</strong>
					<p>UX คืออะไร และอะไรคือ UX ที่ดีที่สุด</p>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#step-2">
					<strong>Phat</strong>
					<p>อยากเปลี่ยนแนว มาทำ UX</p>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#step-3">
					<strong>I Yim</strong>
					<p>ถ้าเลือกได้ อย่า *, padding 0, margin 0</p>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#step-4">
					<strong>Care Rai</strong>
					<p>12 ข้อคิดสำหรับผู้ที่กลัว CSS และ Standards</p>
				</a>
			</li>
		</ul>
		<article class="tab-content">
			<div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
				<h3>UX คืออะไรและอะไรคือ UX ที่ดีที่สุด</h3>
				<section>
					ผมมีสองคำถามแต่มีหลายคำตอบอยู่ในคำถามนั้น คำว่า UX คืออะไร หรือ “User Experience” คืออะไรคงไม่ต้องอธิบายให้ยืดยาว เพราะว่าทุกๆ คนแถวๆ นี้คงรู้จักกันเป็นอย่างดีอยู่แล้ว แต่ผมจะขอเพิ่มเติมเข้าไปอีกสักอย่างคือ “ประสบการณ์การใช้งานของผู้ใช้” ที่เรากำลังจะกล่าวถึงนี้ ไม่ได้เฉพาะเจาะจงแค่เรื่อง เว็บไซท์หรือว่า แอปพลิเคชั่นเท่านั้น เราควรคำนึงถึงทุกเรื่องราว ทุกอย่างตั้งแต่สากกระเบือยันเรือรบที่เราได้สัมผัสกับมันทุกวัน อยากให้คิดเสียว่ามันคือ “ประสบการณ์ชีวิต” ที่ผ่านพ้นไปในแต่ละวันก็ว่าได้ เพราะว่าสุดท้ายแล้วมันเกี่ยวข้องกันจนแยกออกได้ยาก				มีแฟนคบกันได้แปดเดือนแล้วเลิกกัน ฝ่ายหญิงบอกเลิกเพราะอยู่กับฝ่ายชายแล้วรู้สึกไม่ดี นั่นก็คืออาการ “Bad UX” สาเหตุอาจจะมาจากลีลาบนเตียงไม่เร้าใจหรือไปไหนมาไหนไม่ช่วยถือของ ทำให้ผู้หญิงหรือ User เปลี่ยนไปหาของใหม่
					บางครั้งเวลาเราหยิบจับสิ่งของเครื่องใช้ไม่ว่าอะรก็ตาม เราโคตรจะหงุดหงิดกับความไม่พอดีของมัน ไม่เข้ากันของมือ นั่นคืออาการ “Bad UX” มันเกิดกับเราทุกวัน
					แทนที่เราจะบ่นกับมันอย่างเดียว ถึงเวลาแล้วที่เราต้องทำความเข้าใจมันเสียที แล้วหาทางแก้ไขมันซะจะได้เลิกบ่น
					วกกลับมาถึงเรื่องที่ใกล้ตัวพวกเราบ้าง หลายครั้งที่เรา “รู้สึกว่า” App หน้าตามันใช้ยาก Web หน้าตามันห่วย Platform มันกากส์ ทั้งหมดทั้งมวลนั้นเกิดจาก “ความรู้สึก” ของเราเองทั้งนั้นซึ่งไม่ได้เกี่ยวกับโรคฟันผุอะไรเลย ทั้งๆ ที่เรายังไม่ได้ลองใช้งานมันเลยด้วยซ้ำ ส่วนใหญ่ที่เราบอกว่า “มันไม่ดี” นั้นเกิดมาจากการที่เรามองเห็นครั้งแรกเท่านั้น ซึ่งนั่นก็การได้เห็น “UI” ไม่ได้ลอง “UX” แต่ของบางอย่างทั้ง UI และ UX แม่งก็ห่วยพอกัน ของบางชิ้นหน้าตาดูพะอืดพะอมมากแต่ใช้งานได้ดีฉิบหอย คนติดงอมแงมและบางครั้งกลุ่มคนที่ใช้มันดันไม่ใช่เรา ทำให้ตัวเราเองไม่เข้าใจว่ามันดียังไง จึงจำเป็นต้องลองเพราะของอย่างนี้มันแล้วแต่ความชอบแล้วแต่กลุ่มเป้าหมาย
					ถ้ายังจำหน้าตาเว็บของ Google ในช่วงขวบปีแรกๆ ได้ ก็ไม่ใช่เรื่องยากที่เราจะแยกแยะระหว่าง UX กับ UI ว่ามันต่างกันตรงไหน
					เพราะฉะนั้นแล้วในเรื่องยาวหลายๆ ตอนที่ผมกำลังจะเขียนนี้ขอให้ทุกท่านมองข้ามเรื่อง UI ไปก่อน มาว่ากันที่ UX (ใครยังไม่เห็นว่าผมจะเขียนเรื่องอะไรไปจนครบ 16 ตอนก็ตามไปอ่านบทความก่อนหน้าครับ)
				</section>
				<section>
					<h4>แล้วอะไรคือ UX ที่ดีที่สุด</h4>
					ที่ดีที่สุดในที่นี้คือที่สุดของใคร ที่สุดของแจ้ หรือที่สุดของเรา ที่สุดของเขา ที่สุดของเธอ ใช้งานดีกับใช้งานได้มันต่างกันกับใช้งานได้ดีเลยทีเดียว ซึ่งนั่นก็จะไม่มีครั้งที่สองอีกเพราะมันดีทีเดียว อ่ะแฮ่มถุยส์
					พูดง่ายๆ แบบตรงๆ คือมันไม่มีอะไร “ดีที่สุด” ให้เราได้เชยชมหรอก เขาบอกว่าอย่าเอาคำว่า “ดีที่สุด”​ มาปิดกั้นโอกาสที่จะดีขึ้นไปอีก จงมองหาของที่เราจะสามารถเข้าไปช่วยทำให้มันดีขึ้น เพราะนั่นคือโอกาสที่เราจะได้เรียนรู้หาประสบการณ์ แต่ถ้าเรามองหาอะไรดีดี เพื่อที่จะได้ทำอะไรได้ ก็อย่าหวังว่าเราจะได้ทำอะไรให้มันดีขึ้น เพราะว่ามันดีอยู่แล้ว
					มนุษย์ชอบเป็นเจ้าของอะไรสักอย่าง ต้องครอบครองเอาไว้ มนุษย์วิวัฒนาการมาเพื่อที่จะเป็นใหญ่เหนือสิ่งใดบนโลก สิ่งหนึ่งที่ทำให้คนเรารู้สึกปลอดภัยนั่นคือเมื่อเราสามารถ “ควบคุม” ทุกอย่างเอาไว้ได้ ภาษาง่ายๆ คือ “เอาอยู่” ทำให้เรารู้สึกปลอดภัย ถ้าเมื่อไหร่ก็ตามที่เราพบเจออะไรที่เรารู้สึกว่าควบคุมมันไม่ได้ เราจะไม่อยากเข้าใกล้มันเพราะมันอันตราย
					ไม่ใช่ว่าควบคุมไม่ได้แล้วคนเราจะหนี ในขณะเดียวกันมนุษย์ก็ชอบเรียนรู้ที่จะเอาชนะให้ได้อยู่เสมอ การเรียนรู้เพื่อที่จะกุมอำนาจจึงเกิดขึ้น บางที่เราไม่จำเป็นต้องถือปืนเราก็เป็นคนกุมอำนาจได้ ผู้ที่อ่อนแอมักจะใช้อาวุธปืนเป็นเครื่องทุ่นแรงสู้กับคนชูสามนิ้วเสมอ อ้าวเฮ้ย กลับมา กลับมา
				</section>
			</div>
			<div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
				<h3>อยากเปลี่ยนแนว มาทำ UX</h3>
				<section>
					ผมหายไปนานและไม่ได้เขียนเรื่องราวที่เกี่ยวกับ CSS HTML อีกเลยตลอด 20 เดือนที่ผ่านมา มีโผล่มาบ้างก็เป็นช่วงแวะเวียนมาเพราะอาการเมาค้าง
					อาจเป็นเพราะการงานที่เปลี่ยนไป ผมต้องทำอย่างอื่นที่ไม่ใช่แค่มานั่งเขียน CSS HTML หรือ ไปหา Plug-in JavaScript มาใช้งาน ผมหันมารับผิดชอบงานในเรื่องของ UX/UI รวมไปถึง Front-end หรือแม้กระทั่งต้องคอยตอบคำถามประเภทลด http request อีกสัก 3 อันได้ไหม หรือ ทำให้หน้าเว็บโดยรวมโหลดเร็วขึ้นกว่าเดิมอีก 500 มิลลิเซกกัน ได้ไหม หรือ พื้นหลังตรงนั้นเอาออกไปเลย มีอยู่มันก็ไม่ได้ช่วยให้ user ยอมจ่ายเงินเพิ่มอีก 10 บาทหรอก Front-end เองทั้งในเรื่อง Performance ของเว็บก็มีความเกี่ยวพันกับประสบการณ์ของผู้ใช้ทั้งหมด					
					ผมจึงหายไป หายไปเพื่อที่จะเรียนรู้อะไรใหม่ๆ เข้าใจอะไรใหม่ๆ ระหว่างทาง มันไม่ใช่แค่เรื่องงาน มันคือเรื่องวิธีการทำงาน ทีมงาน คือทุกอย่างที่ประกอบร่างกันจนออกมาเป็น Product หนึ่งชิ้นที่ไม่มีวันจะเสร็จสมบูรณ์ได้ Design is Never done มันก็เหมือนการเลี้ยงควายแหละครับ ถ้าเราไม่ขายไปหรือมันไม่ตาย เราก็ต้องเอามันออกจากคอกไปกินหญ้าทุกวัน ตกเย็นก็เอากลับบ้าน
					คนเราไม่สามารถที่จะเขียนอะไรในสิ่งที่ตัวเองไม่รู้ได้หรอก จะเอาอะไรมาเขียนหละ จริงๆ มันคือการเขียนอะไรก็ตามที่อยากเขียน ความอยากนั้นก็เกิดมาจากสิ่งที่รู้และเข้าใจ บางครั้งและบ่อยครั้งมันก็เกิดจากการที่เราคิดว่าเรารู้ แบบนั้นก็สามารถเขียนได้เหมือนกัน ในทีมที่ออฟฟิศเรามีคำเรียกอาการอย่างหลังว่า “CSS” หรือ Candle Sitting Study หรือพวก “นั่งเทียนเขียน” มันไม่ได้เลวร้าย อย่างน้อยมันก็เป็นจุดเริ่มต้นเพื่อให้เราเริ่มทำอะไรสักอย่าง เพืื่อที่จะนำไปสู่อะไรสักอย่าง เอ่อ… ที่ดี บางทีก็เป็นการทำร้ายตัวเอง
					กว่าสองปีที่ผมได้เริ่มจับต้องการทำ UX จริงๆ จังๆ แต่ก็ยังเป็นการทำ UX ในแบบฉบับของเรา เพราะว่าเราทำเพื่อผู้ใช้งานของเรา ไม่มีความจำเป็นอันใดที่ต้องเราต้องทำตามสิ่งที่คนอื่นบอก หรือตามหนังสือต่างๆ ที่เขาแนะนำมาร้อยเปอร์เซ็นเป๊ะ การปรับปรุงให้เข้ากับสภาพแวดล้อมในการทำงานของเราเองถือเป็นทางเลือกที่ง่ายในการเริ่มต้นเรียนรู้พร้อมๆ กันเป็นทีม UX ไม่ใช่แค่ทำ Wireframe ทุกคนก็รู้ การทำ Wireframe เป็นเพียงแค่ขั้นตอนหนึ่งที่ถูกเพิ่มเข้ามาขั้นกลางระหว่าง UI Designer กับ UXer ทุกวันนี้สำหรับคนที่สามารถเข้าใจทั้ง UX ทำได้ทั้ง UI สามารถออกแบบและนำออกไป Test ได้อย่างรวดเร็วเพื่อประหยัดเวลาได้อยู่แล้ว แล้วเราจะหาคนอย่างนั้นได้จากที่ไหนหละ
					ผมมีความตั้งใจเมื่อหลายเดือนก่อน ว่าผมอยากจะบอกเล่า บันทึกเรื่องราวการเข้าสู่โลกแปลกประหลาดที่ได้พบเจอเอาไว้ใน ThaiCSS แห่งนี้ แต่ก็อย่างว่า ชีวิตมันมักไม่ได้เป็นไปตามที่เราวางแผนเอาไว้เท่าไหร่หรอก เมื่อไหร่ก็เมื่อนัั้นแหละ ตอนนี้ก็คงถึงเวลาที่จะเอาเรื่องราวเหล่านั้นออกมาเขียนสู่กันฟังแล้ว
					เมืองไทยตอนนี้ คนที่มีความรู้เรื่อง UX ยังขาดตลาด คนเก่งๆ ก็ขาดแคลน แม้นมีเงินก็ซื้อไม่ได้ เนื้อหา ตัวอย่าง วิธีการที่เรานักพัฒนาชาวไทยทำกันเองจริงๆ จังๆ กับผู้ใช้คนไทยยังมีน้อย ผมจึงอยากจะเอาสิ่งที่ได้ทำเอาไว้ตลอดเกือบสองปีที่ผ่านมานั้นมาเขียน บางเรื่องหลายๆ ท่านอาจจะนำไปปรับใช้ต่อได้ แต่อย่าเลียนแบบ จงขโมยไปและทำให้มันดีขึ้น UX Designer ดีๆ ไม่มีขาย ถ้าอยากได้ต้องร่วมสร้าง
					มารอบนี้ พร้อมกับชีวิตที่เปลี่ยนไป ผมขอวางแผนประเด็นเรื่องราวที่จะเขียนเอาไว้เสียแต่เนิ่นๆ ว่าสามช่ารอบนี้ผมจะเล่าเรื่องอะไรบ้าง  ถ้าเป็นไปได้ผมจะปล่อยสองถึงสามวันต่อหนึ่งเรื่อง ให้มันจบทั้ง 16 เรื่องในรอบเดียว มันจะได้ต่อเนื่องกันแล้วก็เอาเวลาที่เหลือไปคิดถึงเรื่องอื่น	
				</section>
			</div>
			<div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
				<h3>ถ้าเลือกได้ อย่าดอกจัน แผดดิ้งศูนย์ มาร์จิ้นศูนย์</h3>
				<section>
					ThaiCSS Direct วันนี้ขอเสนอ Tips เล็กๆ น้อยๆ เท่าหำแมงสาบ เอาไว้ให้นักเลงคีย์บอร์ด CSS ได้เก็บไว้ใช้งานเมื่อยามจำเป็น เรื่องพื้นๆ กาก กากส์ ในวันนี้ไม่ใช่เรื่องใหญ่อะไรเป็นเพียงแค่เทคนิคการสังเกตกระบวนการ render css ของบราวเซอร์ที่เราสามารถช่วยบราวเซอร์ประหยัดพลังงานและเพิ่มความเร็วในการแสดงผลหน้าเว็บขึ้นไปอีก 0.0046 มิลลิเซคคั่น ถ้าทำได้พยายามอย่า Reset ค่าโรงงานของ CSS
					ถ้าเป็นไปได้ อย่า Reset padding และ margin ซึ่งเป็นค่าโรงงานของ CSS ที่ติดมากับ HTML หรือ CSS ที่เป็นค่ามาตรฐานของบราวเซอร์ ถ้าใครสังเกตจะเห็นว่า Element ที่อยู่ในหมวดหมู่ Grouping Contents และ Headings นั้นมักจะมีค่า Default เหล่านี้ติดมาด้วย รวมไปถึง List Style ต่างๆ ของ li ใน ul และ ol ด้วย
					หลายท่านถ้าเป็น CSS คาวบอยสมัยก่อนที่ต้องเขียนทุกอย่างเองชอบใช้นี่เลยครับ * { padding: 0; margin: 0; list-style-type: none; } 
					<p>ถ้าเราเขียน Stylesheet Override หรือเขียนทับกันไปบ่อยแค่ไหน จะทำไห้บราวเซอร์ต้อง Re-Render บ่อยเท่านั้น ซีึ่งเป็นสาเหตุหนึ่งที่ทำให้กระบวนการ Render หน้าเว็บเราช้าไปด้วย แม้ว่าไม่ถึงขั้นทำให้บราวเซอร์เช็ดน้ำตา แต่เพื่อความสง่างามเราควรตระหนักและทำอย่างไรก็ได้เพื่อที่จะไม่ให้เกิดการ Re-Render บ่อยๆ
					อีกอย่างที่เราไม่ควรทำการ Override ทั้งหมดเพราะว่า ค่าพื้นฐานที่โรงงานให้มานั้นได้รับการทดสอบและวิจัยมาแล้วว่าเหมาะสมต่อระยะห่างระหว่างวัตถุกับสายตามวลมนุษยชาติ เราจึงไม่จำเป็นต้องไปแก้ไขเพิ่มเติมให้มากนัก ยกเว้นเสียว่าเรามี Designer เทพๆ ที่ว่างเว้นจากการกินมะม่วงดองและผลไม้ยามบ่ายจะบอกเราว่า ระยะห่างจาก h1 ไปยัง p ต้อง 9px เท่านั้น (9 พ่อง padding อันก่อนมึงยังใช้ 7 อยู่เลย) ถ้าใช้ Framework หล่ะ
					สำหรับเทพองค์ใดที่ใช้ Frameworks ที่เกลื่อนกลาดอยู่ตามตลาดไทหรือสี่มุมเมืองซึ่งเจ้าของตลาดเขา Reset มาให้เรียบร้อยแล้ว บอกคำเดียวครับว่า “ช่างแม่ม” เพราะเรื่องนี้ไม่ใช่เรื่องใหญ่อะไร เป็นแค่เรื่องพื้นๆ ที่คนทำงานต้องเข้าใจ อธิบายลูกค้าหรือเล่าให้ทีม คนอื่นๆ ที่ทำงานด้วยกันฟังได้ว่า ที่มาและที่ไปมันเป็นยังไง นอกเหนือจากนี้เป็นเรื่องที่เราไม่สามารถควบคุมมันได้ อย่าไปเครียด เครียดไปก็เยี่ยวเหนียว</p>
				</section>
			</div>
			<div id="step-4" class="tab-pane" role="tabpanel" aria-labelledby="step-4">
				<h3>12 ข้อคิดสำหรับผู้ที่กลัว CSS และ Standards</h3>
				<section>
					ย้อนกลับไปเมื่อ 1 ปีเกือบ ๆ สองปี ที่แล้วที่ผมยังใหม่สำหรับ CSS-XHTML อยู่ มีอะไรหลายอย่าง ๆ ที่ต้องปรับตัวปรับระบบความคิดต่าง ๆ หลาย ๆ อย่าง ด้วยความคุ้นชินกับการ design ในแบบ old school อยู่ ปัญหาของผมมันมีหลายอย่างมากมายมโหระทึกเลย จะเอาเจ้านี่ไว้ตรงนั้น แล้วจะเอาเจ้านั่นลอยไว้ตรงนี้ มันอะไรของมันนักหนาฟะ …
					สารพัดจะสบถตามประสาคนปากจัดน่ะนะ เวลาคร่าว ๆ ในการปรับตัวให้คุ้นชินกับมันก็ประมาณเกือบ ๆ 5 เดือนเลยทีเดียว และ อีกประมาณ 2 – 3 เดือนสำหรับการปรับตัวให้หลุดพ้นจากการคิด การออกแบบในแบบเดิม ๆ (เป็นอิสรภาพจากตาราง) ถึงกระนั้นเวลา 1 ปี ผมก็ยังไม่ได้เข้าถึงขั้น advance coding เท่าไรนัก เพิ่งเริ่ม hand coding รวบรัดตัดตอนก็เมื่อ 4 เดือนที่ผ่านนี้เท่านั้นเอง
					มองไปยังสิ่งแวดล้อมที่เป็นอยู่ ณ ปัจจุบัน คุณจะเห็นว่า มีนักเขียนเก่ง ๆ หลาย ๆ ท่านที่มีประสบการณ์เขียนหนังสือดีดีเกี่ยวกับเรื่องนี้ (แต่ยังไม่ใช่ในบ้านเรา) เขียนเกี่ยวกับ CSS เขียนเกี่ยวกับการออกแบบ การลำดับความคิด เกี่ยวกับการทำงานอย่างไรให้ถูกต้องเป็นไปตาม Standards จะมีใครบ้างที่เห็นว่าเรื่องนี้มันเป็นเรื่องท้าทาย และ น่าทดลองทำในบ้านเราบ้าง (แต่เป็นเรื่องน่ายินดี ที่ตอนนี้ website ใหญ่ ๆ ในไทยเริ่มเคลื่อนไหวกันแล้ว เช่น sanook.com (เฝ้ารอวัน debut ในเร็ววันนี้อย่างใจจดใจจ่อ), kapook.com, mThai.com, pantip.com และ อื่น ๆ ที่ผมยังไม่ได้ตรวจทานทั้งหมด
					แม้ว่า 3 site หลังนั้นยังเป็นการเขียนแบบกระท่อนกระแท่น แต่ผมก็เอาใจช่วยครับ ถือว่าคุณนั้นได้เล็งเห็นความสำคัญของ Standards แล้ว พยายามเพื่อ Standards ที่คุณคาดหวังไว้ครับ ต่อไปนี้มันคงจะไม่เป็นแบบเดิมแน่นอนเมื่อมีการแข่งขันนี้เกิดขึ้นในไทยแล้ว แต่ผมขอแนะนำอะไรซักอย่างหนึ่ง คือ การคิดใหม่ทำใหม่ตั้งแต่การคิด การจัดเตรียม content การ design การจัดลำดับความสำคัญไม่ใช่แค่ design เพียงผิวเผินเท่านั้น design ความคิดของคุณด้วย อะไรที่ไม่จำเป็นก็ควรตัดออกไปเสียบ้างใช้เท่าที่จำเป็น และ ไม่เป็นพิษเป็นภัยต่อผู้บริโภค
					มันอาจจะดูสามหาวสำหรับมดตัวเล็ก ๆ อย่างผมที่เสนอความคิดเห็นนี้ออกมาก็ได้ (ตัวอย่าง portal site ยุคใหม่ที่นำ standard เข้ามาใช้ในการปรับปรุงออกแบบ MSN และ Yahoo) anyway กลับมาสู่เรื่องราวของเรา ประสบการณ์ทั้งหมดในการทำงานใน field นี้มันทำให้ผมพอมองเห็นประเด็นที่ควรเก็บมาคิดคำนึงเป็นข้อคิด หรือ บทเรียนสำหรับคนที่ยังมี “ความกลัว” หรือ “เกลียดชัง” คำว่า “CSS” และ “Web Standards” อยู่ผมก็เขียนจากเรื่องน่าเบื่อ น่าบ่นจากตัวของผมเอง และ เพื่อน ๆ designer ในสิ่งแวดล้อมรอบตัวผมนี่ล่ะ หวังว่าคงเป็นประโยชน์ไม่มากก็น้อยวะ (ป่านนี้คงจะมีคนด่า ว่าไอ้ห่า เมื่อไหร่มันจะเข้าเรื่องซักทีฟระ) โอเคลุยกันเลย
					ข้อที่1: ทุกสิ่งทุกอย่างที่คุณรู้มันผิดหมด … เช่น
					ครั้งแรกเลยผมต้องโยนทุกสิ่งทุกอย่างที่ผมเคยทำ เคยเรียนออกไปจากหัวเลย ไม่ว่าจะเป็นการ design การวางแผนที่จะ slice layout ออกมา เราเคย design แบบต้อง layout ด้วย table แต่เมื่อมาใช้ CSS ในการควบคุม layout แล้วเราสามารถ design อะไรได้แตกต่างไป ทีแรกผมก็ติดที่ว่า เฮ้ยยย !!! มันต้องมีที่มันทำไม่ได้มั่งแหละน่าทีแรก ๆ มันก็ใช่ แต่พอรู้ลึก ๆ ไปแล้วมันก็ทำได้เหมือนกัน และ ยืดหยุ่นกว่าด้วยซ้ำ ผลที่ได้ออกมาคือ ผมไม่จำเป็นต้องมานั่งหั่นนั่งซอยบรรจงให้ รูปภาพมันเล็กเพื่อลด bandwidth ในการโหลด หรือ ผมต้องมานั่งทำ table cell เพื่อเอาไอ้ภาพเหล่านั้นที่ผมหั่นอย่างกับเนื้อหมูมานั่งต่อเรียงกันเป็นตัวต่ออีก
					ทีแรก ๆ ผมก็หั่นเหมือนอย่างเคยแล้วก็มานั่ง div ตะพึดตะพือ เรือหาย (ship หาย) วายป่วง แล้วเป็นไงล่ะ ผมก็ต้องสบถว่า แง่งเอ้ย ไมมันออกมางี้ฟะ ด้วยความโง่ของผมแหละครับเดาสุ่มสี่สุ่มหกไป ทั้ง ๆ ที่ site ฝรั่งที่เป็นตัวอย่างมีเยอะแยะ ขอโทษกูหยิ่งกูไม่เปิดดู กูจะดันทุรังทำของกูจะทำไมฟะ สุดท้ายผมก็ต้องมาเปิดดูมานั่งแกะ code เค้า มานั่งดูว่าเค้าหั่นกันยังไง ก็แปลกใจ อะไรฟะ ทำไมหั่นภาพใหญ่ ๆ เป้ง ๆ แบบนั้นมาเลยมันไม่หนักมันไม่โหลดช้ากว่าเดิมรึ … ไม่เลย เราตัดมาแต่ส่วนที่จำเป็นจะใช้จริง ๆ ไม่ต้องติดพ่วงไอ้ส่วนที่เราไม่ต้องการ หรือเล่นกับมันด้วยการซ้อนทับได้อีกต่างหาก ถ้าคุณเขียนได้เก๋าเกมจริง ๆ ไอ้เรื่องพวกนี้เราก็เอาไปประยุคใช้กับการ layout content ได้อีก เช่นข้อความนี้อยากให้อยู่ตำแหน่งไหน มันได้สบายบุรีเลยไม่ว่าจะ “อยาก” อะไร นี่เป็น ตัวอย่างในหลาย ๆ ความแตกต่างที่ผมยกมาให้ดู ลองมาเปรียบเทียบ ความแตกต่างระหว่าง การ code ด้วย TABLE MARKUP และ SEMENTIC MARKUP (CSS XHTML) กันดู
					TABLE MARKUP
					– เรียงกันเป็นแถว
					– ดำเนินเป็นระบบระเบียบ
					– ที่อยู่ของ content ต่าง ๆ ขึ้นอยู่กับลำดับของตาราง ที่ใส่มันลงไป
					-เมื่อแก้ไข แทบจะต้องมานั่งไล่แก้ไปทีละตัว
					SEMANTIC MARKUP
					– ความยืดหยุ่นสูง
					– ดำเนินเป็น object
					-ที่อยู่ของ content ต่าง ๆ เรียงเป็นลำดับได้ไม่ว่าเราจะวางมันไว้ตรงไหน
					-เมื่อแก้ไข ไม่ต้องมานั่งไล่แก้ทีละตัว ให้มันปวดหัวจะเห็นได้ว่า ข้อแตกต่างข้างบนมันก็โขอยู่ใช่มั้ยครับ มาเปรียบเทียบไปทีละข้อละกัน จากข้อแรก (เรียงกันเป็นแถว กับ ความยืดหยุ่นสูง)
					ลองคิดดูว่า ถ้าเรา design ตามหลักการเขียน ไม่ได้ตาม content หรือ สิ่งที่เราต้องการจะสื่อนั้นมันจะรู้สึกอึดอัดอย่างไร คุณจะต้องบรรจุทุก ๆ อย่างของคุณลงไปตามช่องตารางเหล่านั้นเป็นลำดับ กับ คุณจะสั่งให้อะไรอยู่ตรงไหนก็ได้มันจะรู้สึกอย่างไร?
					ข้อที่สอง (ดำเนินการเป็นระเบียบ กับ ดำเนินการเป็น object)
					ใน CSS ทุกอย่างถูกมองเป็น “กล่อง” คุณอยากให้กล่องนั้นมันบรรจุอะไรก็ได้ และ อยู่ตรงไหนก็ได้ แต่กับ Table นั้นคุณต้องค่อย ๆ ลำดับบรรจุมันลงไปอย่างเป็นระเบียบ ลองทำไม่เป็นระเบียบดูสิ ความหายนะจะมาหาคุณ
					ข้อที่สาม (ที่อยู่ต่าง ๆ ของ content ขึ้นอยู่กับลำดับของตารางที่คุณใส่มันลงไป กับ ที่อยู่ของ content ต่าง ๆ เรียงเป็นลำดับตามความสำคัญได้ ไม่ว่าในการ design  นั้นคุณจะเอามันวางไว้ตรงไหน)
					อย่างที่ผมบอก การคิดแบบและมอง อย่างนักเขียน การที่คุณต้องการจะทำตาม Standard นั้นคุณจำเป็นจะต้องเรียงลำดับการ coding content ตามลำดับความสำคัญด้วย ซึ่ง table นั้นทำไม่ได้ เพราะเราต้องเอาข้อมูลใส่ไปในช่องตารางตามลำดับการ design ไม่ใช่ การเขียน content ตามลำดับ แล้ว กำหนดให้เป็นไปตามที่ design ด้วย CSS
					ข้อสุดท้าย (เมื่อมีการแก้ไข แทบจะต้องมานั่งไล่แก้ไปทีละตัว กับ เมื่อมีการแก้ไข เราแค่ไปแก้ที่ CSS เพียงไฟล์เดียว)
					จำได้สินะครับว่าเมื่อก่อนถ้ามีการปรับแก้ layout หรืออะไรบางอย่างมันแทบจะพูดเป็นเสียงเดียวกันว่า “ทำใหม่ เลยดีกว่ามั้ย” แต่กับ CSS แล้วไม่จำเป็นต้องถึงขนาดนั้นเราก็แค่เพียงแก้ ที่ไฟล์ CSS ที่เป็นตัว mock up layout ทุก ๆ อย่างเพียงไฟล์เดียวก็พอแล้ว
					แต่อย่างไรก็จงจำไว้ว่า มีบางอย่างที่ Table can do และบางอย่างที่ CSS can do เพราะฉะนั้นก็ใช้วิจารณญาณกันไปแล้วแต่ใครจะคิดหรืออย่างไร แต่ผมว่ามันก็ไม่ได้ทำให้ CSS จะต้องด้อยกว่า หรือ ต้องเลิกใช้มันไปอย่างแน่นอน
					เรื่องแรกอาจจะยาวไปหน่อยครับขอบคุณที่ พี่ ๆ เพื่อน ๆ น้อง ๆ หรือ ผู้แวะเวียนมาเยี่ยมชมอ่านกันจนจบครับ ข้อต่อ ๆ ไปจะมีสั้นบ้างยาวบ้างคละ ๆ กันไปครับ สุดท้ายก็ขอบคุณ ที่ให้ความสนใจในบทความนี้ครับ
					ข้อที่2: ทุกอย่างมันก็ไม่ได้เหมือนกันหมดไปเลยทีเดียว (ทั้ง ๆ ที่มันดูว่าเหมือนจะเหมือน) แล้วแต่ว่าคุณจะเผชิญกับปัญหาอะไร ที่เข้ามา
					รู้กันใช่มั้ยครับว่าพอเราเริ่มทำเป็นแล้วมันมีเรื่องที่น่าเบื่อตามมาอีกอย่างหนึ่ง ก็คือ ปัญหาการ render การแสดงผลของในแต่ละ browser อีกซึ่งแต่ละ browser นั้นมีผู้พัฒนา และ มาตรฐานไม่เหมือนกันอีก เจอทีแรกผมก็สบถเลย แสดด … ทำไมมันไม่ทำมาให้มันเหมือน ๆ กันฟะ และ นั่นแหละที่ผมได้รู้จัก W3C และความฮิ … ของ browser บาง browser จุดเด่นความเก่งกาจของบาง browser ด้วย แม้นว่า W3C จะพยายามบัญญัติอะไรขึ้นมา มันก็พยายามทำอะไรที่เป็นตัวมันให้ได้สิน่า นั่นแหละ เหตุผลที่คุณต้องมานั่งเชค นั่ง hack นั่งปวดขมับปวดกบาล เพื่อให้มันแสดงผลได้เหมือนกันที่สุด (แต่ก็นะ ใช้ CSS Layout จะทำให้งานของเราแสดงผลได้แทบจะเหมือนกันเกือบ ๆ ทุก Modern Browser ฝรั่งเค้าบอกว่า 98% เชียวนะ ไม่รู้โม้ป่ะ) ทีนี้มันก็อยู่ที่เรา และ ลูกค้าของเราแล้วล่ะครับว่า requirement กันมาอย่างไร เพราะฉะนั้นคุณเองก็ต้องรอบคอบด้วยไม่ใช่ฆ่าตัวตาย เพราะงานตัวเอง
					ข้อที่3: คุณต้องเลือกให้ได้ระหว่าง มโนภาพ และ ความเป็นจริง
					การทำงานกับการใช้ชีวิต มันก็คล้าย ๆ กัน การดำเนินของมันก็ละม้ายคล้ายคลึง เมื่อทุก ๆ อย่างอยู่บนความไม่แน่นอน หรือ ช่วงหัวเลี้ยวหัวต่อ เราก็ต้องใช้ชีวิต และ ความคิดของเราอย่างระมัดระวัง ต้องไตร่ตรองให้ดีถี่ถ้วน และ รอบคอบ ต้องเริ่มต้นจากการวางแผนเสมอ
					เช่น เดียวกับการทำ site ขึ้นมาหนึ่ง ๆ เราต้องคิดให้ดีดี จุดเริ่มต้น จุดจบ หรือ ทางที่จะเดิน หรือ เติบโต มันจะไม่เหมือนเมื่อก่อนที่เรา เพิ่ม ๆ พูน ๆ อะไรลงไปเรื่อย ๆ มันคงขัดแย้งกับ ความคิดหรือความคาดหวังเดิม ๆ ของเรา ถ้าเราเดินไปโดยไม่มีกรอบ หรือ จุดหมาย มันก็จบถ้าคิดจะมี standard เป็นของตัวเองสักอันใน site ของคุณ คุณจะต้องตัดสิ่งที่ไม่จำเป็น คงไว้เพียงที่ใช้จริง ๆ เท่านั้น คุณต้องหมั่นเอาใจใส่ในทุก ๆ รายละเอียดจะเพิกเฉยไม่ได้ ต้องคิดถึงการเข้าถึงข้อมูลของผู้ใช้ (คิดถึงตัวเอง แล้วก็ต้องคิดถึงคนอื่น ๆ ด้วย) ต้องกลั่นกรองสิ่งที่จะเข้ามา และ สิ่งที่จะออกไป การdesign ไม่ใช่เพียงแต่ ออกแบบขึ้นมาจากหน้าตาก่อนเท่านั้น คุณต้องเริ่มตั้งแต่ content การลำดับความสำคัญ แล้วถึงลงมือ design หน้าตาออกมา เหมือนกับบทความก่อนหน้านี้ของผม รู้จัก และ เข้าใจใน web standard 1, 2 และ 3 คุณต้องเป็นอิสระจากปิศาจสองตัวในตัวคุณ นั่นคือ ใจของคุณเอง และ ความโลภ (มีบ้างแต่อย่าให้มันมากจนเกินไป ใช่ว่าจะหากินเพื่อตัวเองมีความสุขแต่อย่างเดียว) เมื่อทุกอย่างเรียบร้อยก็อย่าลืม validate ตรวจทานความถูกต้องแก้ไขอะไรที่ผิดพลาด แต่บางครั้งเราก็ต้องเลือกระหว่าง การที่จะเป็นคนเก่ง มีหน้ามีตา หรือ ความถูกต้องเดินไปอย่างราบเรียบ สงบ ถ้าเราแยกแยะ หรือ ประสานมันได้อย่างลงตัวมันก็เป็นเรื่องดี เลือกหาจุดยืนของตัวคุณเองให้เจอ
				</section>
				<section>
					ข้อที่4: ความสุดยอดไม่ใช่ Desgin จนไม่มีอะไรจะใส่ลงไปแล้ว หากแต่ความสุดยอดนั้น คือ ไม่มีอะไรจะตัดออกไปแล้วต่างหาก
					การที่จะเขียน code markup ขึ้นมาให้สนับสนุนกับมาตรฐานเต็ม ๆ นั้นมันขัดแย้งกับการที่เราใช้ table ที่เป็น container elements บรรจุทุก ๆ สิ่ง ทุก ๆ อย่าง แบบเมื่อก่อนโดยสิ้นเชิง เราจะใช้ container elements ให้เหมาะสมกับข้อมูล และ ไม่เอามาบรรจุ content ของเรามากมายซับซ้อนเหมือนแต่ก่อน คิดง่าย ๆ เลยให้คิดว่าเราจะเขียนหนังสือสักเล่มเราจะจัดระบบ content ของเราอย่างไรเริ่มและจบด้วยอะไร
					อย่าเพิ่งคิดว่าจะปรุงเสริมเติมแต่งมันอย่างไร ให้เริ่มที่ content ของเราก่อน ดูว่าเราจะใช้อะไรร่วมกัน อะไรที่ต้องใช้แยกกัน (หมายถึง CSS properties ของ elements ต่าง ๆ)  ใช้เท่าที่จำเป็น และ ประหยัด (design อย่างพอเพียง) อย่ากลัวที่จะต้องใช้ divs  หรือ spans หรือ p หรือ อื่น ๆ ที่มี class ร่วมกันให้คิดเสียว่ามันเป็นการจัดหมวดหมู่ข้อมูล ก็เหมือนกับที่คุณจัดเอกสาร หรือ จัดรูปเล่มหนังสือนั่นแหละ เรียงลำดับ priority ของข้อมูลเริ่ม coding จากสิ่งที่สำคัญที่สุดไปหาสิ่งที่สำคัญน้อยที่สุด (เลือก tag ให้เหมาะสม) ตัด tag ที่ไม่จำเป็นออกไป ใช้เท่าที่ควรจะใช้ (ผมเริ่มอย่างนี้น่ะนะ) แล้วก็มาคิดว่าเราจะ design หน้าตาออกมาอย่างไร ข้อนี้มันจะเกี่ยวเนื่องไปถึงข้อต่อไป …
					ข้อที่5: สำหรับ site ใหญ่ ๆ ที่มีทีมดูแล หรือ สร้างหลายคน (website องค์กรใหญ่ ๆ หรือ web portal ต่าง ๆ หรืออะไรก็ตามแต่)
					website ขององค์กรใหญ่ ๆ หรือ website ที่มีความหนาแน่นของข้อมูลมาก ๆ หรือ บริษัทที่มีการแยกแยะหน้าที่เป็นระบบเป็นหมวดหมู่ บางที designer อาจจะยังไม่เข้าใจถึง content ที่เราต้องการจะใช้ หรือ โครงสร้างลำดับขั้นของข้อมูลอาจจะทำให้ design ที่ออกแบบออกมานั้นไม่เอื้อต่อการที่จะทำเป็น มาตรฐานเท่าไหร่ (ปัญหานี้เคยประสบกันบ้างไหมครับ) เพราะฉะนั้นทุก ๆ ครั้งก่อนจะเริ่มลงมือทำอะไรให้ทีมพัฒนานั้นมีการประชุมตกลงกันก่อน คุยกันให้แล้วเสร็จในทุก ๆ สิ่งทุก ๆ อย่าง เพราะการคิดไปเรื่อยโดยไม่มีการกำหนดขอบเขต หรือ การกำหนดแนวทางเดิน และ/หรือ การเจริญเติบโตของ site ทำไปเพียงวันวันนั้น จะเกิดการสะสมของข้อมูลที่ใช้ไม่ได้ หรือ Link ที่เสียก็ได้ รวมไปถึงการสิ้นเปลือง class หรือ tag ที่ไม่จำเป็นต้องใช้ก็ได้
					เพราะฉะนั้นควรกำหนด และ วางแผนอย่างรอบคอบกันก่อนครับ (ถ้าคุณแคร์ standard นะถ้าคุณไม่แคร์ก็เอาเลยเดินหน้าฆ่ามัน อยากทำอะไรก็ทำ เหอ ๆ)
					ข้อที่6: เราไม่สามารถหลีกเลี่ยง browser ที่ครองตลาดมานานได้
					Browser ชั้นนำหลาย ๆ ตัว ในหลาย ๆ ปีที่ผ่านมาต่างแข่งกันพัฒนาอย่างบ้าคลั่ง ให้ render การแสดงผลด้วย Table Layout ให้ละเอียดและสวยงามที่สุด เรื่อง Standard หรือ CSS Layout ยังไม่เป็นประเด็นหลัก ๆ ที่ทำให้พวกเหล่าผู้พัฒนาสนใจกันมากเท่าไรนัก จนกระทั่งได้มีการเปิดตัว Gecko และ KHTML ขึ้นค่าย Browser ยักษ์ ๆ จึงเริ่มเล็งเห็นความสำคัญตรงนี้ การพัฒนาการ rendering ในแบบ CSS Layout นั้นเริ่มขึ้นในปี 1998 และก็เริ่มพัฒนาเรื่อยมาจนถึงปัจจุบัน
					ในการทำงานจริง ๆ แล้วเราไม่สามารถละเลยตรงนี้ได้เลย เพราะเราต้องมองถึง User ของเราที่ไม่รู้อิโหน่อิเหน่ด้วยเพราะบางคนนั้นไม่ได้มีความรู้ทางด้านเทคนิคพวกนี้เลย เพราะฉะนั้นก็ต้องดูหลาย ๆ อย่างด้วยเหมือนกันใช่ว่าจะตามใจเราอย่างเดียวมันก็ไม่ได้ ตรงนี้เลยเป็นต้นกำเนิดของการ hack CSS! เพื่อให้การแสดงผลเหมือนกันทั้งหมดในทุก ๆ browser ให้ได้มากที่สุด (แต่อย่างที่ผมบอก พยายามแก้ไขปัญหาด้วย standard หรือ hack แบบตาม standard ให้มากที่สุดเท่าที่จะทำได้ หมดทางเลือกแล้วถึง hack แบบฝ่าฝืนกฏจะดีกว่าครับ)
					ข้อที่7: code และ เนื้อหา ที่เรียงกันเป็นลำดับและเป็นเหตุเป็นผล เป็นสิ่งที่ดีที่สุดที่ควรจะมีใน website ที่ออกแบบตาม Standard
					เคยลองปลด style sheets ออกจากเวปของคุณหรือไม่ครับ เมื่อปลดออกแล้วลำดับการเรียงข้อมูลเป็นไปตามเนื้อหาที่อยากจะสื่อถึง user ของคุณหรือไม่ การไล่ระดับสายตา การเรียงลำดับความสำคัญของข้อมูล เนื้อหาก่อนหลัง อันนี้เป็นสิ่งที่น่าลองฝึกฝนดู
				</section>
			</div>
		</article>
	</div>
</div>
@endsection
@section('script')
<script src="{{ URL::asset('vendor/jquery-smartwizard/js/jquery.smartWizard.min.js') }}" type="text/javascript"></script>
<script>
$(document).ready(function() {
	// Toolbar extra buttons
	var btnFinish = $('<button></button>').text('บันทึก')
		.addClass('btn btn-info')
		.on('click', function(){ alert('Finish Clicked'); });
	var btnCancel = $('<button></button>').text('ยกเลิก')
		.addClass('btn btn-danger')
		.on('click', function(){ $('#smartwizard').smartWizard("reset"); });

	// Step show event
	$("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection, stepPosition) {
		$("#prev-btn").removeClass('disabled');
		$("#next-btn").removeClass('disabled');
		if (stepPosition === 'first') {
			$("#prev-btn").addClass('disabled');
		} else if (stepPosition === 'last') {
			$("#next-btn").addClass('disabled');
		} else {
			$("#prev-btn").removeClass('disabled');
			$("#next-btn").removeClass('disabled');
		}
	});

	// Smart Wizard
	$('#smartwizard').smartWizard({
		selected: 0,
		theme: 'arrows',
		justified: true,
		darkMode:false,
		autoAdjustHeight: true, 
		cycleSteps: false, 
		backButtonSupport: true,
		enableURLhash: true,
		transition: {
			animation: 'slide-horizontal',
		},
		toolbarSettings: {
			toolbarPosition: 'bottom',
			toolbarExtraButtons: [btnFinish, btnCancel]
		},
		lang: {
			next: 'ต่อไป',
			previous: 'ก่อนหน้า'
		},
	});

	// External Button Events
	$("#reset-btn").on("click", function() {
		$('#smartwizard').smartWizard("reset");
		return true;
	});
	$("#prev-btn").on("click", function() {
		$('#smartwizard').smartWizard("prev");
		return true;
	});
	$("#next-btn").on("click", function() {
		$('#smartwizard').smartWizard("next");
		return true;
	});
});
</script>
@endsection
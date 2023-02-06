@extends('layouts.index')
@section('token')<meta name="csrf-token" content="{{ csrf_token() }}">@endsection
@section('content')
<ol class="breadcrumb page-breadcrumb text-sm font-prompt">
	<li class="breadcrumb-item"><i class="fal fa-home mr-1"></i> <a href="{{ route('staff.index') }}">หน้าหลัก</a></li>
	<li class="breadcrumb-item">ดึงข้อมูล</li>
</ol>
<div class="row font-prompt">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
		<div class="border px-3 pt-3 pb-0 rounded">
			<div class="row mt-3">
				<div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3">
					<div class="panel">
						<div class="panel-hdr">
							<h2>ข้อมูลผลการวิเคราะห์ทางห้องปฏิบัติการ สำหรับการเฝ้าระวัง</h2>
							<div class="panel-toolbar">
								<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"><i class="fal fa-window-minimize"></i></button>
								<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"><i class="fal fa-expand"></i></button>
								<button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"><i class="fal fa-times"></i></button>
							</div>
						</div>
						<div class="panel-container">
							<div class="panel-content">
                            <form name="received_step01_frm" action="{{ route('sample.received.step01.post') }}" method="POST" enctype="multipart/form-data">
								<div class="row">
									<div class="col-4">
                                        <div class="form-group">
                                            <label for="sample_type">ระบุประเภทตัวอย่าง</label>
                                            <select name="sample_type_id" class="select2 form-control" id="sample_type_id" required>
                                                <option value="">--- เลือก ---</option>
                                                    <option value="1">ชีวภาพ</option>
                                                    <option value="2">สิ่งแวดล้อม</option>
                                                    <option value="0">เลือกทั้งหมด</option>
                                            </select>
                                        </div>
									</div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="sample_type">ระบุประเภทตัวอย่าง</label>
                                            <select name="sample_type_id" class="select2 form-control" id="sample_type_id" required>
                                                <option value="">--- เลือก ---</option>
                                                    <option value="1">ชีวภาพ</option>
                                                    <option value="2">สิ่งแวดล้อม</option>
                                                    <option value="0">เลือกทั้งหมด</option>
                                            </select>
                                        </div>
									</div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="sample_type">ระบุประเภทตัวอย่าง</label>
                                            <select name="sample_type_id" class="select2 form-control" id="sample_type_id" required>
                                                <option value="">--- เลือก ---</option>
                                                    <option value="1">ชีวภาพ</option>
                                                    <option value="2">สิ่งแวดล้อม</option>
                                                    <option value="0">เลือกทั้งหมด</option>
                                            </select>
                                        </div>
									</div>
								</div>
                            </form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script type="text/javascript">
$(document).ready(function() {
	$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
});
</script>
@endsection

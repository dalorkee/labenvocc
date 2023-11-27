<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth,Log};
use Illuminate\Http\RedirectResponse;
use App\Models\Calendar;
use App\Traits\ColorTrait;

class CalendarController extends Controller
{
	use ColorTrait;

	private object $user;

	public function __construct() {
		$this->middleware('auth');
		$this->middleware(['role:root|admin|staff']);
		$this->middleware(function($request, $next) {
			$this->user = Auth::user();
			return $next($request);
		});
	}

	public function index() {
		//
	}

	public function create() {
		//
	}

	public function store(Request $request): RedirectResponse {
		$calendar = new Calendar;
		$calendar->user_id = $this->user->id;
		$calendar->title = $request->title;
		$calendar->start = $request->start;
		$calendar->end = $request->end;
		$calendar->description = $request->description;
		$calendar->color = $request->color;
		$calendar->save();
		return redirect()->back()->with('success', 'บันทึกข้อมูลสำเร็จ');
	}

	public function show($id) {
		$color = $this->colorClass();
		$calendar = Calendar::find($id);
		// $htm = "
		// <form name=\"edit\" action=\"".route('calendar.edit', ['calendar' => 1])."\" method=\"POST\">
		// 	<div class=\"modal-header bg-warning text-dark\">
		// 		<h5 class=\"modal-title\">แก้ไข/ลบ งานในปฏิทิน</h5>
		// 		<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
		// 			<span aria-hidden=\"true\"><i class=\"fal fa-times\"></i></span>
		// 		</button>
		// 	</div>
		// 	<div class=\"modal-body\">
		// 		<div class=\"form-row\">
		// 			<div class=\"form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3\">
		// 				<label class=\"form-label\" for=\"edit_title\">หัวข้อ <span class=\"text-red-600\">*</span></label>
		// 				<input type=\"hidden\" name=\"_token\" value=\"".csrf_token()."\">
		// 				<input type=\"text\" name=\"edit_title\" id=\"edit_title\" class=\"form-control @error('edit_title') is-invalid @enderror\">
		// 				@error('edit_title')<div class=\"text-danger text-xs pt-2\" role=\"alert\">{{$message}}</div>@enderror
		// 			</div>
		// 			<div class=\"form-group col-xs-12 col-sm-12 col-md-12 col-xl-6 col-lg-6 mb-3\">
		// 				<label class=\"form-label\" for=\"date_edit_start\">เริ่ม <span class=\"text-red-600\">*</span></label>
		// 				<div class=\"input-group\">
		// 					<input type=\"text\" name=\"date_edit_start\" id=\"date_edit_start\" class=\"form-control @error('date_edit_start') is-invalid @enderror\">
		// 					<div class=\"input-group-append\">
		// 						<span class=\"input-group-text fs-xl\">
		// 							<i class=\"fal fa-calendar-alt\"></i>
		// 						</span>
		// 					</div>
		// 				</div>
		// 				@error('date_edit_start')<div class=\"text-danger text-xs pt-2\" role=\"alert\">".$message."</div>@enderror
		// 			</div>
		// 			<div class=\"form-group col-xs-12 col-sm-12 col-md-12 col-xl-6 col-lg-6 mb-3\">
		// 				<label class=\"form-label\" for=\"date_edit_end\">สิ้นสุด <span class=\"text-red-600\">*</span></label>
		// 				<div class=\"input-group\">
		// 					<input type=\"text\" name=\"date_edit_end\" id=\"date_edit_end\" class=\"form-control @error('date_edit_end') is-invalid @enderror\">
		// 					<div class=\"input-group-append\">
		// 						<span class=\"input-group-text fs-xl\">
		// 							<i class=\"fal fa-calendar-alt\"></i>
		// 						</span>
		// 					</div>
		// 				</div>
		// 				@error('date_edit_end')<div class=\"text-danger text-xs pt-2\" role=\"alert\">".$message."</div>@enderror
		// 			</div>
		// 			<div class=\"form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3\">
		// 				<label class=\"form-label\" for=\"edit_description\">รายละเอียด</label>
		// 				<textarea type=\"text\" name=\"edit_description\" id=\"edit_description\" class=\"form-control\"></textarea>
		// 				@error('edit_description')<div class=\"text-danger text-xs pt-2\" role=\"alert\">".$message."</div>@enderror
		// 			</div>
		// 			<div class=\"form-group col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-3\">
		// 				<label class=\"form-label\" for=\"edit_color\">สีพื้นหลัง</label>
		// 				<select name=\"edit_color\" id=\"edit_color\" class=\"form-control\"></select>
		// 			</div>
		// 		</div>
		// 	</div>
		// 	<div class=\"modal-footer\">
		// 		<button type=\"submit\" class=\"btn btn-warning\">แก้ไข</button>
		// 		<a type=\"\" class=\"btn btn-danger\">ลบ</a>
		// 		<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">ปิด</button>
		// 	</div>
		// </form>";
		// return $htm;
		$htm = "";
		foreach ($color as $key => $val) {
			if ($key == $calendar->color) {
				$htm .= "<option value=\"".$key."\" selected>".$key."</option>";
			} else {
				$htm .= "<option value=\"".$key."\">".$key."</option>";
			}
		}
		$calendar->color = $htm;
		return response()->json($calendar);

	}

	public function edit($id) {
		//
	}

	public function update(Request $request): ?bool {
		try {
			$data = $request->all();
			$calendar = Calendar::findOr((int)$data['edit_idx'], fn() => throw new \Exception('ไม่พบข้อมูลรหัส: '.$data['edit_idx']));
			$calendar->title = $data['edit_title'];
			$calendar->start = $data['date_edit_start'];
			$calendar->end = $data['date_edit_end'];
			$calendar->description = $data['edit_description'];
			$calendar->color = $data['edit_color'];
			$calendar->save();
			return true;
		} catch (\Exception $e) {
			Log::error($e->getMessage());
			return false;
		}
	}

	public function destroy($id) {
		//
	}
}

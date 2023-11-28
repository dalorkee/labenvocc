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

	public function index() {}
	public function create() {}

	protected function store(Request $request): RedirectResponse {
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

	protected function show($id): ?object {
		$color = $this->colorClass();
		$calendar = Calendar::find($id);
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

	protected function edit($id) {}

	protected function update(Request $request): ?bool {
		try {
			$data = $request->all();
			$event = Calendar::findOr((int)$data['edit_idx'], fn() => throw new \Exception('ไม่พบข้อมูลรหัส: '.$data['edit_idx']));
			$event->title = $data['edit_title'];
			$event->start = $data['date_edit_start'];
			$event->end = $data['date_edit_end'];
			$event->description = $data['edit_description'];
			$event->color = $data['edit_color'];
			$event->save();
			session(['success' => 'แก้ไขข้อมูลในปฏิทินแล้ว']);
			return true;
		} catch (\Exception $e) {
			Log::error($e->getMessage());
			session(['error' => 'แก้ไขข้อมูลปฏิทินไม่ได้ '.$e->getMessage()]);
			return false;
		}
	}

	protected function destroy($id): ?bool {
		try {
			$event = Calendar::find((int)$id);
			$event->delete();
			if ($event->trashed()) {
				session(['success' => 'ลบข้อมูลในปฏิทินแล้ว']);
				return true;
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
			session(['error' => 'ลบข้อมูลปฏิทินไม่สำเร็จ '.$e->getMessage()]);
			return false;
		}
	}
}

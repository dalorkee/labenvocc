<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth,Log};
use Illuminate\Http\RedirectResponse;
use App\Models\Calendar;

class CalendarController extends Controller
{
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
		$calendar->class_name = $request->class_name;
        $calendar->save();
		return redirect()->back()->with('success', 'บันทึกข้อมูลสำเร็จ');
	}

	public function show($id) {
        $calendar = Calendar::find($id);
		return response()->json($calendar);

	}

	public function edit($id) {
		//
	}

	public function update(Request $request, $id) {
		//
	}

	public function destroy($id) {
		//
	}
}

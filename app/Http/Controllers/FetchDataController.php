<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Log};
use App\Models\{Order, User, SampleCharacter, RefParameter};

class FetchDataController extends Controller
{
	private object $user;
	private string $user_role;

	public function __construct() {
		$this->middleware('auth');
		$this->middleware(['role:root|admin|staff']);
		$this->middleware('is_order_confirmed');
		$this->middleware(function($request, $next) {
			$this->user = Auth::user();
			$user_role_arr = $this->user->roles->pluck('name')->all();
			$this->user_role = $user_role_arr[0];
			return $next($request);
		});
	}

	public function index(): object {
		return view(view: 'fetchdata.index');
	}

	public function sampletype(Request $request, SampleCharacter $sample_type): string {
		$sample_type = $sample_type
			->select('id', 'sample_character_name')
				->when($request->id == "1", function($c) use ($request){
					return $c->where('sample_type_id', $request->id);
				})
				->when($request->id == "2", function($c) use ($request){
					return $c->where('sample_type_id', $request->id);
				})
			->get()
			->keyBy('id');
		if($request->id == "0"){
			$html = "<option value=\"\">เลือกทั้งหมด</option>";
		}
		elseif($request->id > "0"){
			$html = "<option value=\"\">เลือก</option>";
			foreach ($sample_type as $key => $val) {
				$html .= "<option value=\"".$key."\">".$val['sample_character_name']."</option>";
			}
		}		
		return $html;
	}

	public function parameter(Request $request, RefParameter $parameter): string {
		return view(view: 'fetchdata.index');
	}
}

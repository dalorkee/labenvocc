<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{Auth,Log};
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private object $user;

	public function __construct() {
		$this->middleware('auth');
		$this->middleware(['role:root|admin']);
		$this->middleware('is_order_confirmed');
		$this->middleware(function($request, $next) {
			$this->user = Auth::user();
			$user_role_arr = $this->user->roles->pluck('name')->all();
			$this->user_role = $user_role_arr[0];
			return $next($request);
		});
	}
	protected function index(): object {
		return view('admin.index');
	}
}

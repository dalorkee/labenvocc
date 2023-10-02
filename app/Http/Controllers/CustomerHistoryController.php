<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth,Log};
use App\Models\UserCustomer;
use App\Enums\{CustomerType};
use App\Traits\{DbBoundaryTrait,CommonTrait};

class CustomerHistoryController extends Controller
{
	private object $user;
	private string $user_role;

	use DbBoundaryTrait, CommonTrait;

	public function __construct() {
		$this->middleware('auth');
		$this->middleware(['role:root|customer']);
		$this->middleware(function($request, $next) {
			$this->user = Auth::user();
			$user_role_arr = $this->user->roles->pluck('name')->all();
			$this->user_role = $user_role_arr[0];
			return $next($request);
		});
	}

	protected function index(): ?object {
		$customer = UserCustomer::whereUser_id($this->user->id)->get()->toArray();
		$title_name = $this->titleName();
		$data['customer_name'] = $customer[0]['first_name']." ".$customer[0]['last_name'];
		$data['customer_type'] = match ($customer[0]['customer_type']) {
			'government' => CustomerType::GOVERNMENT,
			'private' => CustomerType::PRIVATE,
			'personal' => CustomerType::PERSONAL,
		};
		$data['mobile'] = $customer[0]['mobile'];
		$data['email'] = $customer[0]['email'];
		$data['address'] = $customer[0]['address'];
		$data['sub_district'] = $this->subDistrictNameBySubDistId($customer[0]['sub_district']);
		$data['district'] = $this->districtNameByDistId($customer[0]['district']);
		$data['province'] = $this->provinceNameByProvId($customer[0]['province']);
		$data['postcode'] = $customer[0]['postcode'];
		$data['contact_name'] = $title_name[$customer[0]['contact_title_name']].$customer[0]['contact_first_name']." ".$customer[0]['contact_last_name'];
		$data['contact_mobile'] = $customer[0]['contact_mobile'];
		$data['contact_email'] = $customer[0]['contact_email'];
		$data['contact_addr'] = $customer[0]['contact_addr'];
		$data['contact_sub_district'] = $this->subDistrictNameBySubDistId($customer[0]['contact_sub_district']);
		$data['contact_district'] = $this->districtNameByDistId($customer[0]['contact_district']);
		$data['contact_province'] = $this->provinceNameByProvId($customer[0]['contact_province']);
		$data['contact_postcode'] = $customer[0]['contact_postcode'];

		return view(view: 'apps.customers.history.index', data: compact('data'));
	}

	public function create() {
		//
	}

	public function store(Request $request) {
		//
	}

	public function show($id) {
		//
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

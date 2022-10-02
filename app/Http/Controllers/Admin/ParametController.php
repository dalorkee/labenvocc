<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{
    Parameter,
    RefParameter,
    SampleCharecter,
    RefThreatType,RefUnit,
    RefUnitCustomer,
    RefUnitChoice1,
    UserStaff,
    RefTechnical,
    RefMethodAnalys,
    RefMachine
};
use Illuminate\Http\Request;
use App\DataTables\ParameterAdminDataTable;
use Illuminate\Support\Facades\{DB,Auth,Log};

class ParametController extends Controller
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ParameterAdminDataTable $dataTable)
    {
        return $dataTable->render('admin.paramet.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parameters = RefParameter::all();
        $sample_characters = SampleCharecter::all();
        $threat_types = RefThreatType::all();
        $units = RefUnit::all();
        $unit_customers = RefUnitCustomer::all();
        $unit_choice1 = RefUnitChoice1::all();
        $user_stuffs = UserStaff::all();
        $technicals = RefTechnical::all();
        $method_analys = RefMethodAnalys::all();
        $machines = RefMachine::all();
        return view('admin.paramet.create',
            compact(
                'parameters',
                'sample_characters',
                'threat_types',
                'units',
                'unit_customers',
                'unit_choice1',
                'user_stuffs',
                'technicals',
                'method_analys',
                'machines'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Parameter $parameter)
    {
        $parameter_name = RefParameter::where('id',$request->parameter_id)->get(['id','parameter_name']);
        $sample_character = SampleCharecter::where('id',$request->sample_character_id)->get(['id','parameter_name']);
        $sample_type = $request->sample_type_id === '1' ? 'ชีวภาพ' : 'สิ่งแวดล้อม' ;
        $threat_type = RefThreatType::where('id',$request->threat_type_id)->get(['id','parameter_name']);
        $unit = RefUnit::where('id',$request->unit_id)->get(['id','parameter_name']);
        $unit_customer = RefUnitCustomer::where('id',$request->unit_customer_id)->get(['id','parameter_name']);
        $unit_choice1 = RefUnitChoice1::where('id',$request->unit_choice1_id)->get(['id','parameter_name']);
        $unit_choice2 = $request->unit_choice2_id === '1' ? 'ppm' : null;
        $price = $request->price;
        $main_analys = UserStaff::where('user_id',$request->main_analys_id)->get(['id','parameter_name']);
        $sub_analys = UserStaff::where('user_id',$request->sub_analys_id)->get(['id','parameter_name']);
        $main_control = UserStaff::where('user_id',$request->main_control_id)->get(['id','parameter_name']);
        $sub_control = UserStaff::where('user_id',$request->sub_control_id)->get(['id','parameter_name']);
        $technical = RefTechnical::where('id',$request->technic_id)->get(['id','parameter_name']);
        $method_analy = RefMethodAnalys::where('id',$request->method_id)->get(['id','parameter_name']);
        $machine = RefMachine::where('id',$request->machine_id)->get(['id','parameter_name']);
        $office_name = $request->offfice_id === '130' ? 'ศูนย์อ้างอิงทางห้องปฏิบัติการและพิษวิทยา' : 'ห้องปฏิบัติการ ศูนย์พัฒนาวิชาการอาชีวอนามัยและสิ่งแวดล้อม จังหวัดระยอง';
        dd($parameter_name[0]);
        $parameter->parameter_name = $parameter_name[0]['parameter_name'];
        $parameter->parameter_id = $parameter_name[0]['id'];
        $parameter->sample_character_name[0]['id'];
        $parameter->sample_character_type_id[0]['id'];
        $parameter->sample_type_name[0]['id'];
        $parameter->sample_type_id[0]['id'];
        $parameter->threat_type_name[0]['id'];
        $parameter->threat_type_id[0]['id'];
        $parameter->unit_name[0]['id'];
        $parameter->unit_id[0]['id'];
        $parameter->unit_customer_name[0]['id'];
        $parameter->unit_customer_id[0]['id'];
        $parameter->unit_choice1_name[0]['id'];
        $parameter->unit_choice1_id[0]['id'];
        $parameter->unit_choice2_name[0]['id'];
        $parameter->unit_choice2_id[0]['id'];
        $parameter->price[0]['id'];
        $parameter->main_analys[0]['id'];
        $parameter->main_analys_user_id[0]['id'];
        $parameter->sub_analys[0]['id'];
        $parameter->sub_analys_user_id[0]['id'];
        $parameter->main_control[0]['id'];
        $parameter->main_control_user_id[0]['id'];
        $parameter->sub_control[0]['id'];
        $parameter->sub_control_user_id[0]['id'];
        $parameter->technic_name[0]['id'];
        $parameter->technic_id[0]['id'];
        $parameter->method_name[0]['id'];
        $parameter->method_analys_id[0]['id'];
        $parameter->machine_name[0]['id'];
        $parameter->machine_id[0]['id'];
        $parameter->office[0]['id'];
        $parameter->office_id[0]['id'];


        $z_para_save = $parameter->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Paramet  $paramet
     * @return \Illuminate\Http\Response
     */
    public function show(Parameter $Parameter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Paramet  $paramet
     * @return \Illuminate\Http\Response
     */
    public function edit(Parameter $Parameter)
    {
        return view('admin.paramet.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Paramet  $paramet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Parameter $Parameter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Paramet  $paramet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Parameter $Parameter)
    {
        //
    }
}

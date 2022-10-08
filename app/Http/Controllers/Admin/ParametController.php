<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{
    Parameter,
    RefParameter,
    SampleCharacter,
    RefThreatType,RefUnit,
    RefUnitCustomer,
    RefUnitChoice1,
    RefPrice,
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
        $sample_characters = SampleCharacter::all();
        $threat_types = RefThreatType::all();
        $units = RefUnit::all();
        $unit_customers = RefUnitCustomer::all();
        $unit_choice1 = RefUnitChoice1::all();
        $prices = RefPrice::all();
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
                'prices',
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
    public function store(Request $request, Parameter $z_parameter)
    {
        $parameter = RefParameter::select('id', 'parameter_name')->where('id', $request->parameter_id)->get();
        $sample_character = SampleCharacter::select('id','sample_character_name')->where('id', $request->sample_character_id)->get();
        $sample_type = $request->sample_type_id === '1' ? 'ชีวภาพ' : 'สิ่งแวดล้อม' ;
        $threat_type = RefThreatType::select('id','threat_type_name')->where('id',$request->threat_type_id)->get();
        $unit = RefUnit::select('id','unit_name')->where('id',$request->unit_id)->get();
        $unit_customer = RefUnitCustomer::select('id','unit_customer_name')->where('id',$request->unit_customer_id)->get();
        $unit_choice1 = RefUnitChoice1::select('id','unit_choice1_name')->where('id',$request->unit_choice1_id)->get();
        $unit_choice2 = $request->unit_choice2_id === '1' ? 'ppm' : null;
        $price = RefPrice::select('id','price_name')->where('id',$request->price_id)->get();
        $main_analys = UserStaff::select('user_id','first_name','last_name')->where('user_id',$request->main_analys_id)->get();
        $sub_analys = UserStaff::select('user_id','first_name','last_name')->where('user_id',$request->sub_analys_id)->get();
        $main_control = UserStaff::select('user_id','first_name','last_name')->where('user_id',$request->main_control_id)->get();
        $sub_control = UserStaff::select('user_id','first_name','last_name')->where('user_id',$request->sub_control_id)->get();
        $technical = RefTechnical::select('id','technic_name')->where('id',$request->technic_id)->get();
        $method_analy = RefMethodAnalys::select('id','method_name')->where('id',$request->method_id)->get();
        $machine = RefMachine::select('id','machine_name')->where('id',$request->machine_id)->get();
        $office_name = $request->offfice_id === '130' ? 'ศูนย์อ้างอิงทางห้องปฏิบัติการและพิษวิทยา' : 'ห้องปฏิบัติการ ศูนย์พัฒนาวิชาการอาชีวอนามัยและสิ่งแวดล้อม จังหวัดระยอง';

        $z_parameter->parameter_name = $parameter[0]['parameter_name'];
        $z_parameter->parameter_id = $parameter[0]['id'];
        $z_parameter->sample_character_name = $sample_character[0]['sample_character_name'];
        $z_parameter->sample_character_type_id = $sample_character[0]['id'];
        $z_parameter->sample_type_name = $sample_type;
        $z_parameter->sample_type_id = $request->sample_type_id;
        $z_parameter->threat_type_name = $threat_type[0]['threat_type_name'];
        $z_parameter->threat_type_id = $threat_type[0]['id'];
        $z_parameter->unit_name = $unit[0]['unit_name'];
        $z_parameter->unit_id = $unit[0]['id'];
        $z_parameter->unit_customer_name = $unit_customer[0]['unit_customer_name'];
        $z_parameter->unit_customer_id = $unit_customer[0]['id'];
        $z_parameter->unit_choice1_name = $unit_choice1[0]['unit_choice1_name'];
        $z_parameter->unit_choice1_id = $unit_choice1[0]['id'];
        $z_parameter->unit_choice2_name = $unit_choice2;
        $z_parameter->unit_choice2_id = $request->unit_choice2_id;
        $z_parameter->price_name = $price[0]['price_name'];
        $z_parameter->price_id = $price[0]['id'];
        $z_parameter->main_analys = $main_analys[0]['first_name'].' '.$main_analys[0]['last_name'];
        $z_parameter->main_analys_user_id = $main_analys[0]['user_id'];
        $z_parameter->sub_analys = $sub_analys[0]['first_name'].' '.$sub_analys[0]['last_name'];
        $z_parameter->sub_analys_user_id = $sub_analys[0]['user_id'];
        $z_parameter->main_control = $main_control[0]['first_name'].' '.$main_control[0]['last_name'];
        $z_parameter->main_control_user_id = $main_control[0]['user_id'];
        $z_parameter->sub_control = $sub_control[0]['first_name'].' '.$sub_control[0]['last_name'];
        $z_parameter->sub_control_user_id = $sub_control[0]['user_id'];
        $z_parameter->technic_name = $technical[0]['technic_name'];
        $z_parameter->technic_id = $technical[0]['id'];
        $z_parameter->method_name = $method_analy[0]['method_name'];
        $z_parameter->method_analys_id = $method_analy[0]['id'];
        $z_parameter->machine_name = $machine[0]['machine_name'];
        $z_parameter->machine_id = $machine[0]['id'];
        $z_parameter->office_name = $office_name;
        $z_parameter->office_id = $request->office_id;

        $z_para_save = $z_parameter->save();
        if($z_para_save == true){
            return redirect()->route('paramet.index')->with('success', 'insert successfully');
        }
        else{
            return redirect()->route('paramet.create')->with('error', 'unsuccessfully');
        }
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
    public function edit(Request $request)
    {
        // $parameters = Parameter::find($request->id);
        // return view('admin.paramet.edit', compact('parameters'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Paramet  $paramet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Parameter $parameter)
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

    public function allow(Request $request)
    {
        //$parameters = Parameter::find($request->id)->update(['deleted_at'=> null]);
        $parameters = Parameter::withTrashed()->find($request->id)->restore();
        if($parameters == true){
            return redirect()->route('paramet.index')->with('success', 'allow successfully');
        }
        else{
            return redirect()->route('paramet.index')->with('error', 'unsuccessfully');
        }
    }

    public function deny(Request $request)
    {
        $parameters = Parameter::find($request->id)->delete();
        if($parameters == true){
            return redirect()->route('paramet.index')->with('success', 'deny successfully');
        }
        else{
            return redirect()->route('paramet.index')->with('error', 'unsuccessfully');
        }
    }
}

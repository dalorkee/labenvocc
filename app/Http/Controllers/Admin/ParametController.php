<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{
    Parameter,
    RefParameter,
    SampleCharecter,
    RefThreatType,RefUnit,
    RefUnitCustomer,
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
    public function store(Request $request)
    {   
        $parameter_name = RefParameter::where('id',$request->parameter_id)->get();        
        dd($request);
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

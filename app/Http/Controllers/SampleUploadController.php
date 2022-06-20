<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SampleUploadImport;
use App\Models\{SampleUpload, Order};
use App\Http\Requests\biouploadRequest;
// use App\DataTables\UploadBioDataTable;

class SampleUploadController extends Controller
{
    private object $user;
	private string $user_role;

	public function __construct() {
		$this->middleware('auth');
		$this->middleware(['role:root|admin|customer']);
		$this->middleware(function($request, $next) {
			$this->user = Auth::user();
			$user_role_arr = $this->user->roles->pluck('name')->all();
			$this->user_role = $user_role_arr[0];
			return $next($request);
		});
	}
    /**
    * @return \Illuminate\Support\Collection
    */
    public function index(){
        $auth =$this->user->load(['userCustomer']);
        return view('user.bioupload',compact('auth'));
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function bioimport(biouploadRequest $request){
        $auth = $this->user->load(['userCustomer']);
        switch($request->type_of_work){
            case('1');
                $type_of_work_name = 'บริการ';
            break;
            case('2');
                $type_of_work_name = 'วิจัย';
            break;
            case('3');
                $type_of_work_name = 'เฝ้าระวัง';
            break;
            case('4');
                $type_of_work_name = 'SRRT/สอบสวนโรค';
            break;
            case('5');
                $type_of_work_name = 'อื่นๆ';
            break;
        }
        $requestForm = new Order;
        $requestForm->order_type = $request->order_type;
        $requestForm->order_type_name = $request->order_type_name;
        $requestForm->user_id = $auth->userCustomer->user_id;
        $requestForm->customer_type = $auth->userCustomer->customer_type;
        $requestForm->customer_agency_code = $auth->userCustomer->agency_code;
        $requestForm->customer_agency_name = $request->customer_name;
        $requestForm->type_of_work = $request->type_of_work;
        $requestForm->type_of_work_name = $type_of_work_name;
        $requestForm->type_of_work_other = $request->type_of_work_other;
        $result = $requestForm->save();
        if($result){
            $lastId = $requestForm->id;
            Excel::import(new SampleUploadImport($lastId),$request->file('uploadbio'));
            // return redirect('import-excel-csv')->with('status', 'The file has been imported in laravel 8');
            return redirect('/customer')->with('success','upload OK');
        }
        else{
            return redirect()->back()->with('error','Upload Unsuccessfully');
        }
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function env(){
       return view('user.envupload');
    }
}

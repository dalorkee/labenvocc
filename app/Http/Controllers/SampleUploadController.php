<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SampleUploadImport;
use App\Models\SampleUpload;
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
    public function bioimport(Request $request){
        $validatedData = $request->validate([
           'uploadbio' => 'required'
        ],[
            'uploadbio' => 'โปรดแนบไฟล์ Xls,Xlsx'
        ]);
        Excel::import(new SampleUploadImport,$request->file('uploadbio'));
        // return redirect('import-excel-csv')->with('status', 'The file has been imported in laravel 8');
        return redirect()->back()->with('success','upload OK');
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function env(){
       return view('user.envupload');
    }
}

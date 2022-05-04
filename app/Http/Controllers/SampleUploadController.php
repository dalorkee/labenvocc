<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SampleUploadImport;
use App\Models\SampleUpload;
use App\DataTables\UploadBioDataTable;

class SampleUploadController extends Controller
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function index(UploadBioDataTable $dataTable)
    {
        return $dataTable->render('user.bioupload');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function bioimport(Request $request)
    {
        $validatedData = $request->validate([
           'uploadbio' => 'required',
        ]);
        Excel::import(new SampleUploadImport,$request->file('uploadbio'));
        // return redirect('import-excel-csv')->with('status', 'The file has been imported in laravel 8');
        return redirect()->back()->with('success','upload OK');
    }
    public function biocreate(Request $request)
    {
        $validatedData = $request->validate([
           'biobox' => 'required'
        ]);
        $dataReceive = $request->biobox;
       foreach($dataReceive AS $val){
           $bioId[] = $val;
       }
       $bioId = implode(',',$bioId);
       echo $bioId;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function env()
    {
       return view('user.envupload');
    }
}

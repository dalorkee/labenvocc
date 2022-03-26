<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SampleUploadImport;
use App\Models\SampleUpload;

class SampleUploadController extends Controller
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function index()
    {
        //
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function import(Request $request)
    {
        $validatedData = $request->validate([
           'file' => 'required',
        ]);
        Excel::import(new SampleUploadImport,$request->file('file'));

        return redirect('import-excel-csv')->with('status', 'The file has been imported in laravel 8');
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function bio()
    {
       return view('user.bioupload');
    }
    public function env()
    {
       return view('user.envupload');
    }
}

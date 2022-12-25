<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PrintBundle;
use Illuminate\Support\Facades\DB;
use App\Traits\CommonTrait;

class PrintBundleController extends Controller
{
    use CommonTrait;
    public function receipt(){
        return view('printbundle.sample_receipt');
    }
    public function payment(){
        return view('printbundle.bank_payment');
    }
    public function envreport(){
        return view('printbundle.sample_env_report');
    }
}

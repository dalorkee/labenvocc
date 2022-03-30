<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin\Advertise;
use Illuminate\Http\Request;
use App\DataTables\UserAdvertiseDataTable;
use Illuminate\Support\Facades\DB;
use App\Traits\CommonTrait;

class UserAdvertiseController extends Controller
{
    use CommonTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserAdvertiseDataTable $dataTable){

        //return $dataTable->render('user.advertise.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Advertise $advertise){

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Advertise  $office
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Advertise $advertise){

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Advertise  $office
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Advertise $advertise){

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Advertise  $office
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Advertise $advertise){

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Advertise  $office
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Advertise $advertise){

    }
    public function detail(Request $request, Advertise $advertise){
        $advertise = $advertise->find($request->id);
        return view('user.detail',compact('advertise'));
    }
    public function listall(Request $request, UserAdvertiseDataTable $dataTable){
        if($request->listall == "public"){
            $adv_type = "ประชาสัมพันธ์";
        }
        else{
            $adv_type = "มาตราฐานคุณภาพ";
        }
        // $advertise = $advertise->where('advertise_type',$adv_type)->get();
        return $dataTable->with('adv_type',$adv_type)->render('user.advlist',compact('adv_type'));
        // view('user.advlist',compact('advertise'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Advertise;
use Illuminate\Http\Request;
use App\DataTables\AdvertiseDataTable;
use Illuminate\Support\Facades\DB;
use App\Traits\CommonTrait;

class AdvertiseController extends Controller
{
    use CommonTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AdvertiseDataTable $dataTable){

        return $dataTable->render('admin.advertise.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('admin.advertise.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Advertise $advertise){
        $this->validate($request,[
            'advertise_type'=>'required',
            'advertise_detail'=>'required'
        ]);
        $advertise->advertise_type = $request->advertise_type;
        $advertise->advertise_detail = $request->advertise_detail;
        $adv_up = $advertise->save();
        if($adv_up == true){
            return redirect()->route('advertise.index')->with('success', 'insert successfully');
        }
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
        $advertise = $advertise->find($request->id); 
        return view('admin.advertise.edit',compact('advertise'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Advertise  $office
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Advertise $advertise){
        $this->validate($request,[
            'adv_id'=>'required',
            'advertise_type'=>'required',
            'advertise_detail'=>'required'
        ]);
        $adv_find = $advertise->find($request->adv_id);
        $adv_find->advertise_type = $request->advertise_type;
        $adv_find->advertise_detail = $request->advertise_detail;
        $adv_up = $adv_find->save();
        if($adv_up == true){
            return redirect()->route('advertise.index')->with('success', 'updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Advertise  $office
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Advertise $advertise){
        $adv_find = $advertise->find($request->id)->delete();
        if($adv_find == true){
            return redirect()->route('advertise.index')->with('success', 'Deleted successfully');
        }
    }
    public function detail(Request $request, Advertise $advertise){
        $advertise = $advertise->find($request->id); 
        return view('user.detail',compact('advertise'));
    }
    public function listall(Request $request, Advertise $advertise){
        if($request->listall == "public"){
            $adv_type = "ประชาสัมพันธ์";
        }
        else{
            $adv_type = "มาตราฐานคุณภาพ";
        }
        $advertise = $advertise->where('advertise_type',$adv_type)->get();
        return view('user.advlist',compact('advertise'));
    }
}

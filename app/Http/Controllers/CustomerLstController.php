<?php

namespace App\Http\Controllers;

use App\Models\SendSampleReq;
use Illuminate\Http\Request;

class CustomerLstController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('apps.customer.serviceList');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SendSampleReq  $sendSampleReq
     * @return \Illuminate\Http\Response
     */
    public function show(SendSampleReq $sendSampleReq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SendSampleReq  $sendSampleReq
     * @return \Illuminate\Http\Response
     */
    public function edit(SendSampleReq $sendSampleReq)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SendSampleReq  $sendSampleReq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SendSampleReq $sendSampleReq)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SendSampleReq  $sendSampleReq
     * @return \Illuminate\Http\Response
     */
    public function destroy(SendSampleReq $sendSampleReq)
    {
        //
    }
}

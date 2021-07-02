<?php

namespace App\Http\Controllers;

use App\Models\EnvLabCustomer;
use Illuminate\Http\Request;

class CustomerEnvLabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('apps.customer.envlabFrm');
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
     * @param  \App\Models\BioLabCustomer  $bioLabCustomer
     * @return \Illuminate\Http\Response
     */
    public function show(BioLabCustomer $bioLabCustomer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BioLabCustomer  $bioLabCustomer
     * @return \Illuminate\Http\Response
     */
    public function edit(BioLabCustomer $bioLabCustomer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BioLabCustomer  $bioLabCustomer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BioLabCustomer $bioLabCustomer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BioLabCustomer  $bioLabCustomer
     * @return \Illuminate\Http\Response
     */
    public function destroy(BioLabCustomer $bioLabCustomer)
    {
        //
    }
}

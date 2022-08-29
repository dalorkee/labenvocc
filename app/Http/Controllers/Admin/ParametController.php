<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Parameter;
use Illuminate\Http\Request;
use App\DataTables\ParametDataTable;
use Illuminate\Support\Facades\DB;

class ParametController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.paramet.index');
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
        //
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

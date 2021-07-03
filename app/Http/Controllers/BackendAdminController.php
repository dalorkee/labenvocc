<?php

namespace App\Http\Controllers;

use App\Models\BackendAdmin;
use Illuminate\Http\Request;

class BackendAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = BackendAdmin::latest()->paginate(5);

        return view('admin.index',compact('data'))
            ->with('i',(request()->input('page',1)-1)*5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'office_code'=>'required',
            'office_status'=>'required',
        ]);
        BackendAdmin::create($request->all());
        return redirect()->route('admin.index')
            ->with('success','Created Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BackendAdmin  $backendAdmin
     * @return \Illuminate\Http\Response
     */
    public function show(BackendAdmin $backendAdmin)
    {
        return view('admin.show',compact('backendAdmin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BackendAdmin  $backendAdmin
     * @return \Illuminate\Http\Response
     */
    public function edit(BackendAdmin $backendAdmin)
    {
        return view('admin.edit',compact('backendAdmin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BackendAdmin  $backendAdmin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BackendAdmin $backendAdmin)
    {
        $request->validate([
            'office_code'=>'required',
            'office_status'=>'required',
        ]);

        $backendAdmin->update($request->all());
        return redirect()->route('admin.index')
            ->with('success','Update Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BackendAdmin  $backendAdmin
     * @return \Illuminate\Http\Response
     */
    public function destroy(BackendAdmin $backendAdmin)
    {
        $backendAdmin->delete();
        return redirect()->route('admin.index')
            ->with('success','Deleted Success');
    }
}

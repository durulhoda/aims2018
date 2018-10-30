<?php

namespace App\Http\Controllers\settings;
use App\Http\Controllers\Controller;

use App\settings\ProgramLevel;
use Illuminate\Http\Request;

class ProgramLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result=ProgramLevel::all();
        return view('settings.programLevle.index',compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.programLevle.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $aObj=new ProgramLevel();
        $aObj->name=$request->name;
        $aObj->save();
        return redirect('programLevel');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\settings\ProgramLevel  $programLevel
     * @return \Illuminate\Http\Response
     */
    public function show(ProgramLevel $programLevel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\settings\ProgramLevel  $programLevel
     * @return \Illuminate\Http\Response
     */
    public function edit(ProgramLevel $programLevel)
    {
        return view('settings.programLevle.edit',['bean'=>$programLevel]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\settings\ProgramLevel  $programLevel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProgramLevel $programLevel)
    {
        $programLevel = ProgramLevel::findOrfail($programLevel->id);
        $programLevel->name=$request->name;
        $programLevel->update();
        return redirect('programLevel');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\settings\ProgramLevel  $programLevel
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProgramLevel $programLevel)
    {
        //
    }
}

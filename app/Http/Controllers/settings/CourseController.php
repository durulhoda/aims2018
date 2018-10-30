<?php

namespace App\Http\Controllers\settings;
use App\Http\Controllers\Controller;

use App\settings\Course;
use App\settings\ProgramLevel;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result=Course::all();
        return view('settings.course.index',compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.course.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $aCourse=new Course();
        $aCourse->name=$request->name;
        $aCourse->save();
        return redirect('course');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\settings\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\settings\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $aCourse = Course::findOrfail($id);
         return view('settings.course.edit',['bean'=>$aCourse]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\settings\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $aCourse = Course::findOrfail($id);
        $aCourse->name=$request->name;
        $aCourse->update();
        return redirect('course');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\settings\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\settings;

use App\Role;
use App\Http\Controllers\Controller;

use App\settings\Course;
use App\settings\ProgramLevel;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function __construct()
{
    $this->middleware('auth');
}
    public function index()
    {
        $accessStatus=Role::getAccessStatus();
        $result=Course::all();
        return view('settings.course.index',compact('result','accessStatus'));
    }

    public function create()
    {
        $accessStatus=Role::getAccessStatus();
        if($accessStatus[2]==1){
            return view('settings.course.create');
        }else{
            return redirect('course');
        }
        
    }
    public function store(Request $request)
    {
        $aBean=new Course();
        $aBean->name=$request->name;
        $aBean->save();
        return redirect('course');
    }
    public function edit($id)
    {
         $accessStatus=Role::getAccessStatus();
         if($accessStatus[4]==1){
            $aBean = Course::findOrfail($id);
            return view('settings.course.edit',['bean'=>$aBean]);
         }else{
            return redirect('course');
         }
        
    }
    public function update(Request $request,$id)
    {
        $aBean = Course::findOrfail($id);
        $aBean->name=$request->name;
        $aBean->update();
        return redirect('course');
    }
}

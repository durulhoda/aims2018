<?php

namespace App\Http\Controllers\settings;

use App\role\RoleHelper;
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
        $rh=new RoleHelper();
        $menuid=$rh->getMenuId('course');
        $sidebarMenu=$rh->getMenu();
        $permission=$rh->getPermission($menuid);
        $result=Course::all();
        return view('settings.course.index',compact('result','permission','sidebarMenu'));
    }

    public function create()
    {
        $rh=new RoleHelper();
        $menuid=$rh->getMenuId('course');
        $sidebarMenu=$rh->getMenu();
        $permission=$rh->getPermission($menuid);
        if($permission[2]==1){
            return view('settings.course.create',['sidebarMenu'=>$sidebarMenu]);
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
          $rh=new RoleHelper();
          $menuid=$rh->getMenuId('course');
         $sidebarMenu=$rh->getMenu();
         $permission=$rh->getPermission($menuid);
         if($permission[4]==1){
            $aBean = Course::findOrfail($id);
            return view('settings.course.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aBean]);
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

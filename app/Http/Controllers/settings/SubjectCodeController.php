<?php

namespace App\Http\Controllers\settings;
use App\Role;
use App\settings\ProgramLevel;
use App\settings\Group;
use App\settings\SubjectCode;
use App\settings\Program;
use App\settings\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubjectCodeController extends Controller
{
  public function __construct()
{
    $this->middleware('auth');
}
   public function index(){
    $accessStatus=Role::getAccessStatus();
    $result=\DB::select('SELECT subjectcodes.*,programlevels.name as levelName,groups.name as groupName,programs.name as programName,courses.name as courseName FROM `subjectcodes` 
        INNER JOIN courses ON subjectcodes.courseid=courses.id 
        INNER join programs on subjectcodes.programid=programs.id
        INNER join groups on programs.groupid=groups.id
        INNER join programlevels on groups.programLevelid=programlevels.id');
    return view('settings.subjectcode.index',['result'=>$result,'accessStatus'=>$accessStatus]);
}
public function create(){
    $accessStatus=Role::getAccessStatus();
    if($accessStatus[2]==1){
        $levels=ProgramLevel::all();
        $courses=Course::all();
        return view('settings.subjectcode.create',['levels'=>$levels,'courses'=>$courses]);
    }else{
        return redirect('subjectcode');
    }
    
}
public function store(Request $request){
    $aBean=new SubjectCode();
    $aBean->name=$request->name;
    $aBean->courseid=$request->courseid;
    $aBean->programid=$request->programid;
    $aBean->save();
    return redirect('subjectcode');
}
public function edit($id)
{
    $accessStatus=Role::getAccessStatus();
    if($accessStatus[4]==1){
       $result=\DB::select('SELECT subjectcodes.*,programlevels.id as programLevelid,groups.id as groupid,programs.id as programid,courses.id as courseid FROM `subjectcodes` 
        INNER JOIN courses ON subjectcodes.courseid=courses.id 
        INNER join programs on subjectcodes.programid=programs.id
        INNER join groups on programs.groupid=groups.id
        INNER join programlevels on groups.programLevelid=programlevels.id
        where subjectcodes.id=?',[$id]);
       $aBean=$result[0];
       $levels=ProgramLevel::all();
       $groups=\DB::select('SELECT groups.* FROM groups where programLevelid=?',[$aBean->programLevelid]);
       $programs=\DB::select('SELECT programs.* FROM programs where groupid=?',[$aBean->groupid]);
       $courses=Course::all();
       return view('settings.subjectcode.edit',['bean'=>$aBean,'levels'=>$levels,'groups'=>$groups,'programs'=>$programs,'courses'=>$courses]);
   }else{
    return redirect('subjectcode');
}

}
public function update(Request $request, $id)
{
    $aObj=SubjectCode::findOrfail($id);
    $aObj->name=$request->name;
    $aObj->courseid=$request->courseid;
    $aObj->programid=$request->programid;
    $aObj->update();
    return redirect('subjectcode');
}
}

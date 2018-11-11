<?php

namespace App\Http\Controllers\studentsettings;
use App\Role;
use App\studentsettings\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
   public function index(){
      $dmenu=Role::getMenu();
      $accessStatus=Role::getAccessStatus();
      $result=Student::all();
      return view('studentsettings.student.index',['dmenu'=>$dmenu,'result'=>$result,'accessStatus'=>$accessStatus]);
  }
  public function create(){
    $accessStatus=Role::getAccessStatus();
    if($accessStatus[2]==1){
      $dmenu=Role::getMenu();
       return view('studentsettings.student.create',['dmenu'=>$dmenu]);
   }else{
       return redirect('student');
   }

}
public function store(Request $request){
    $aBean=new Student();
    $aBean->name=$request->name;
    $aBean->studentid=$request->studentid;
    $aBean->save();
    return redirect('student');
}
public function edit($id){
    $accessStatus=Role::getAccessStatus();
    if($accessStatus[4]==1){
      $dmenu=Role::getMenu();
      $aBean=Student::findOrfail($id);
      return view('studentsettings.student.edit',['dmenu'=>$dmenu,'bean'=>$aBean]);
  }else{
   return redirect('student');
}

}
public function update(Request $request, $id){
    $aBean=Student::findOrfail($id);
    $aBean->name=$request->name;
    $aBean->studentid=$request->studentid;
    $aBean->update();
    return redirect('student');
}
}

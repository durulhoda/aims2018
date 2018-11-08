<?php

namespace App\Http\Controllers\studentsettings;
use App\studentsettings\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
     public function index(){
        $result=Student::all();
        return view('studentsettings.student.index',['result'=>$result]);
    }
    public function create(){
         return view('studentsettings.student.create');
    }
    public function store(Request $request){
        $aBean=new Student();
        $aBean->name=$request->name;
        $aBean->studentid=$request->studentid;
        $aBean->save();
        return redirect('student');
    }
    public function edit($id){
        $aBean=Student::findOrfail($id);
        return view('studentsettings.student.edit',['bean'=>$aBean]);
    }
    public function update(Request $request, $id){
        $aBean=Student::findOrfail($id);
        $aBean->name=$request->name;
        $aBean->studentid=$request->studentid;
        $aBean->update();
        return redirect('student');
    }
}

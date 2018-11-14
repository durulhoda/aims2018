<?php

namespace App\Http\Controllers\studentsettings;
use App\Role;
use App\studentsettings\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
class StudentController extends Controller
{
  public function __construct()
{
    $this->middleware('auth');
}

   public function index(){
      $sidebarMenu=Role::getMenu();
      $accessStatus=Role::getAccessStatus();
      $result=Student::all();
      return view('studentsettings.student.index',['sidebarMenu'=>$sidebarMenu,'result'=>$result,'accessStatus'=>$accessStatus]);
  }
  public function create(){
    $accessStatus=Role::getAccessStatus();
    if($accessStatus[2]==1){
      $sidebarMenu=Role::getMenu();
       return view('studentsettings.student.create',['sidebarMenu'=>$sidebarMenu]);
   }else{
       return redirect('student');
   }

}
public function store(Request $request){
    $name = $request->name;
    $registrationid=$request->studentid;
    $email=$request->email;
    $password=bcrypt($registrationid);
    \DB::transaction(function() use ($name,$registrationid,$email,$password) {
       $username=$name;
       $newUserId=\DB::table('users')->insertGetId(['name'=>$username,'email'=>$email,'password'=>$password]);
       $user_id=$newUserId;
       \DB::table('students')->insert(['name'=>$name,'registrationid'=>$registrationid,'user_id'=>$user_id]);
       $role_id=2;
       \DB::table('user_role')->insert(['user_id'=>$user_id,'role_id'=>$role_id]);
    });
    return redirect('student');
}
public function edit($id){
    $accessStatus=Role::getAccessStatus();
    if($accessStatus[4]==1){
      $sidebarMenu=Role::getMenu();
      $aBean=Student::findOrfail($id);
      return view('studentsettings.student.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aBean]);
  }else{
   return redirect('student');
}

}
public function update(Request $request, $id){
    $aBean=Student::findOrfail($id);
    $aBean->name=$request->name;
    $aBean->registrationid=$request->studentid;
    $aBean->update();
    return redirect('student');
  }
}

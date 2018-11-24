<?php

namespace App\Http\Controllers\studentsettings;
use App\studentsettings\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\role\RoleHelper;
class StudentController extends Controller
{
  public function __construct()
{
    $this->middleware('auth');
}

   public function index(){
      $rh=new RoleHelper();
      $menuid=$rh->getMenuId('student');
      $sidebarMenu=$rh->getMenu();
      $permission=$rh->getPermission($menuid);
      $result=Student::all();
      return view('studentsettings.student.index',['sidebarMenu'=>$sidebarMenu,'result'=>$result,'permission'=>$permission]);
  }
  public function create(){
    $rh=new RoleHelper();
      $menuid=$rh->getMenuId('student');
      $sidebarMenu=$rh->getMenu();
      $permission=$rh->getPermission($menuid);
    if($permission[2]==1){
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

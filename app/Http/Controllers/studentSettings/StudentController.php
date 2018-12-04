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
      $aMenu=$rh->getMenuId('student');
      if($aMenu==null){
        return redirect('error');
      }
      $menuid=$aMenu->id;
      $hasMenu=$rh->hasMenu($menuid);
      if($hasMenu==false){
        return redirect('error');
      }
      $sidebarMenu=$rh->getMenu();
      $permission=$rh->getPermission($menuid);
      $result=Student::all();
      return view('studentsettings.student.index',['sidebarMenu'=>$sidebarMenu,'result'=>$result,'permission'=>$permission]);
  }
  public function create(){
     $rh=new RoleHelper();
      $aMenu=$rh->getMenuId('student');
      if($aMenu==null){
        return redirect('error');
      }
      $menuid=$aMenu->id;
      $hasMenu=$rh->hasMenu($menuid);
      if($hasMenu==false){
        return redirect('error');
      }
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
       $userid=$newUserId;
       \DB::table('students')->insert(['name'=>$name,'registrationid'=>$registrationid,'userid'=>$userid]);
       $roleid=2;
       \DB::table('user_role')->insert(['userid'=>$userid,'roleid'=>$roleid]);
    });
    return redirect('student');
}
public function edit($id){
    $rh=new RoleHelper();
      $aMenu=$rh->getMenuId('student');
      if($aMenu==null){
        return redirect('error');
      }
      $menuid=$aMenu->id;
      $hasMenu=$rh->hasMenu($menuid);
      if($hasMenu==false){
        return redirect('error');
      }
      $sidebarMenu=Role::getMenu();
      $permission=$rh->getPermission($menuid);
    if($permission[4]==1){
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

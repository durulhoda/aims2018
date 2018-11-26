<?php

namespace App\Http\Controllers\employee;
use App\role\RoleHelper;
use App\employee\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class EmployeeController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
    public function index(){
        $rh=new RoleHelper();
        $menuid=$rh->getMenuId('employee');
        $hasMenu=$rh->hasMenu($menuid);
        if($hasMenu==false){
              return redirect('error');
         }
        $sidebarMenu=$rh->getMenu();
        $permission=$rh->getPermission($menuid);
       $result=\DB::table('employees')
       ->join('employeetypes','employees.employeetypeid','=','employeetypes.id')
       ->select('employees.*','employeetypes.name as employeeType')
       ->get();
       return view('employeesettings.employee.index',['sidebarMenu'=>$sidebarMenu,'result'=>$result,'permission'=>$permission]);
   }
   public function create(){
     $rh=new RoleHelper();
        $menuid=$rh->getMenuId('employee');
        $hasMenu=$rh->hasMenu($menuid);
        if($hasMenu==false){
              return redirect('error');
         }
        $sidebarMenu=$rh->getMenu();
        $permission=$rh->getPermission($menuid);
    if($permission[2]==1){
        $employeetypes=\DB::table('employeetypes')->get();
        return view('employeesettings.employee.create',['sidebarMenu'=>$sidebarMenu,'employeetypes'=>$employeetypes]);
    }else{
        return redirect('employee');
    }
    
}
public function store(Request $request){
    $aBean=new Employee();
    $aBean->name=$request->name; 
    $aBean->employeeid=$request->employeeid;
    $aBean->employeetypeid=$request->employeetypeid;
    $aBean->save();
    return redirect('employee');
}
public function edit($id){
    $rh=new RoleHelper();
    $menuid=$rh->getMenuId('employee');
    $hasMenu=$rh->hasMenu($menuid);
    if($hasMenu==false){
         return redirect('error');
      }
    $sidebarMenu=$rh->getMenu();
    $permission=$rh->getPermission($menuid);
    if($permission[4]==1){
       $aBean=Employee::findOrfail($id);
       $employeetypes=\DB::table('employeetypes')->get();
       return view('employeesettings.employee.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aBean],['employeetypes'=>$employeetypes]);
   }else{
    return redirect('employee');
}

}
public function update(Request $request, $id){
    $aBean=Employee::findOrfail($id);
    $aBean->name=$request->name;
    $aBean->employeeid=$request->employeeid;
    $aBean->employeetypeid=$request->employeetypeid;
    $aBean->update();
    return redirect('employee');
}
}

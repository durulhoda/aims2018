<?php

namespace App\Http\Controllers\employee;
use App\Role;
use App\employee\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class EmployeeController extends Controller
{
    public function index(){
       $accessStatus=Role::getAccessStatus();
       $result=\DB::table('employees')
       ->join('employeetypes','employees.employeetypeid','=','employeetypes.id')
       ->select('employees.*','employeetypes.name as employeeType')
       ->get();
       return view('employeesettings.employee.index',['result'=>$result,'accessStatus'=>$accessStatus]);
   }
   public function create(){
    $accessStatus=Role::getAccessStatus();
    if($accessStatus[2]==1){
        $employeetypes=\DB::table('employeetypes')->get();
        return view('employeesettings.employee.create',['employeetypes'=>$employeetypes]);
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
    $accessStatus=Role::getAccessStatus();
    if($accessStatus[4]==1){
       $aBean=Employee::findOrfail($id);
       $employeetypes=\DB::table('employeetypes')->get();
       return view('employeesettings.employee.edit',['bean'=>$aBean],['employeetypes'=>$employeetypes]);
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

<?php

namespace App\Http\Controllers\employee;

use App\employee\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class EmployeeController extends Controller
{
    public function index(){
    	$result=\DB::table('employees')
        ->join('employeetypes','employees.employeetypeid','=','employeetypes.id')
        ->select('employees.*','employeetypes.name as employeeType')
        ->get();
        return view('employeesettings.employee.index',['result'=>$result]);
    }
    public function create(){
        $employeetypes=\DB::table('employeetypes')->get();
        return view('employeesettings.employee.create',['employeetypes'=>$employeetypes]);
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
    $aBean=Employee::findOrfail($id);
    $employeetypes=\DB::table('employeetypes')->get();
    return view('employeesettings.employee.edit',['bean'=>$aBean],['employeetypes'=>$employeetypes]);
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

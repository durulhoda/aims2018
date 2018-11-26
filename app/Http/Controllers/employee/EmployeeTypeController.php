<?php

namespace App\Http\Controllers\employee;
use App\role\RoleHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\employee\EmployeeType;
class EmployeeTypeController extends Controller
{
	public function __construct()
	{
	    $this->middleware('auth');
	}
	public function index(){
		$rh=new RoleHelper();
	    $menuid=$rh->getMenuId('employeeType');
	    $hasMenu=$rh->hasMenu($menuid);
	    if($hasMenu==false){
	         return redirect('error');
	     }
	    $sidebarMenu=$rh->getMenu();
	    $permission=$rh->getPermission($menuid);
		$result=EmployeeType::all();
		return view('employeesettings.employeeType.index',['sidebarMenu'=>$sidebarMenu,'result'=>$result,'permission'=>$permission]);
	}
	public function create(){
		$rh=new RoleHelper();
	    $menuid=$rh->getMenuId('employeeType');
	    $hasMenu=$rh->hasMenu($menuid);
	    if($hasMenu==false){
	         return redirect('error');
	      }
	    $sidebarMenu=$rh->getMenu();
	    $permission=$rh->getPermission($menuid);
		if($permission[2]==1){
			return view('employeesettings.employeeType.create',['sidebarMenu'=>$sidebarMenu]);
		}else{
			return redirect('employeeType');
		}
		
	}
	public function store(Request $request){
		$aBean=new EmployeeType();
		$aBean->name=$request->name;
		$aBean->save();
		return redirect('employeeType');
	}
	public function edit($id)
	{
		$rh=new RoleHelper();
	    $menuid=$rh->getMenuId('employeeType');
	    $hasMenu=$rh->hasMenu($menuid);
	    if($hasMenu==false){
	         return redirect('error');
	      }
	    $sidebarMenu=$rh->getMenu();
	    $permission=$rh->getPermission($menuid);
		if($permission[4]==1){
			$aBean=EmployeeType::findOrfail($id);
			return view('employeesettings.employeeType.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aBean]);
		}else{
			return redirect('employeeType');
		}
		
	}
	public function update(Request $request, $id)
	{
		$aBean=EmployeeType::findOrfail($id);
		$aBean->name=$request->name;
		$aBean->update();
		return redirect('employeeType');
	}
}

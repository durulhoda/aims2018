<?php

namespace App\Http\Controllers\settings;
use App\role\RoleHelper;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\settings\Shift;
use App\settings\Section;
class ShiftController extends Controller
{
	public function __construct()
{
    $this->middleware('auth');
}
	public function index(){
		$rh=new RoleHelper();
        $menuid=$rh->getMenuId('shift');
        $sidebarMenu=$rh->getMenu();
        $permission=$rh->getPermission($menuid);
		$result=Shift::all();
		foreach ($result as $aBean) {
			$aBean->startTime=date("g:i a", strtotime($aBean->startTime));
			$aBean->endTime=date("g:i a", strtotime($aBean->endTime));
		}
		return view('settings.shift.index',['sidebarMenu'=>$sidebarMenu,'result'=>$result,'permission'=>$permission]);
	}
	public function create(){
		$rh=new RoleHelper();
        $menuid=$rh->getMenuId('shift');
        $sidebarMenu=$rh->getMenu();
        $permission=$rh->getPermission($menuid);
		if($permission[2]==1){
			return view('settings.shift.create',['sidebarMenu'=>$sidebarMenu]);
		}else{
			return redirect('shift');
		}
		
	}
	public function store(Request $request){
		$aBean=new Shift();
		$aBean->name=$request->name;
		$aBean->startTime=$request->startTime;
		$aBean->endTime=$request->endTime;
		$aBean->startTime=date("H:i", strtotime($aBean->startTime));
		$aBean->endTime=date("H:i", strtotime($aBean->endTime));
		echo $aBean->endTime;
		$aBean->save();
		return redirect('shift');
	}
	public function edit($id)
	{
		$rh=new RoleHelper();
        $menuid=$rh->getMenuId('shift');
        $sidebarMenu=$rh->getMenu();
        $permission=$rh->getPermission($menuid);
		if($permission[4]==1){
			$aBean=Shift::findOrfail($id);
			$aBean->startTime=date("g:i a", strtotime($aBean->startTime));
			$aBean->endTime=date("g:i a", strtotime($aBean->endTime));
			return view('settings.shift.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aBean]);
		}else{
			return redirect('shift');
		}
		
	}
	public function update(Request $request, $id)
	{
		$aBean=Shift::findOrfail($id);
		$aBean->name=$request->name;
		$aBean->startTime=$request->startTime;
		$aBean->endTime=$request->endTime;
		$aBean->startTime=date("H:i", strtotime($aBean->startTime));
		$aBean->endTime=date("H:i", strtotime($aBean->endTime));
		$aBean->update();
		return redirect('shift');
	}
}

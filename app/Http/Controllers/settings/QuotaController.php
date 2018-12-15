<?php

namespace App\Http\Controllers\settings;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\role\RoleHelper;
use App\settings\Quota;
class QuotaController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	public function index(){
		$rh=new RoleHelper();
		$aMenu=$rh->getMenuId('quota');
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
		$result=Quota::all();
		return view('settings.quota.index',['sidebarMenu'=>$sidebarMenu,'permission'=>$permission,'result'=>$result]);
	}
	public function create(){
		$rh=new RoleHelper();
		$aMenu=$rh->getMenuId('quota');
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
			return view('settings.quota.create',['sidebarMenu'=>$sidebarMenu]);
		}else{
			return redirect('quota');
		}
	}
	public function store(Request $request){
		\DB::transaction(function() use ($request) {
			$rh=new RoleHelper();
			$newQuotaId=\DB::table('quotas')->insertGetId(['name'=>$request->name]);
			\DB::table('role_quota')->insert(['roleid'=>$rh->getRoleId(),'quotaid'=>$newQuotaId]);
		});
		return redirect('quota');
	}
	public function edit($id){
		$rh=new RoleHelper();
		$aMenu=$rh->getMenuId('quota');
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
		if($permission[4]==1){
			$aQuota=Quota::findOrfail($id);
			return view('settings.quota.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aQuota]);
		}else{
			return redirect('quota');
		}
	}
	public function update(Request $request, $id){
		$aQuota=Quota::findOrfail($id);
		$aQuota->name=$request->name;
		$aQuota->update();
		return redirect('quota');
	}
}

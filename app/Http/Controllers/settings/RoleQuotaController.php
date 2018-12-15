<?php

namespace App\Http\Controllers\settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\role\RoleHelper;
use App\settings\RoleQuota;
class RoleQuotaController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	public function index(){
		$rh=new RoleHelper();
		$aMenu=$rh->getMenuId('rolequota');
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
		$aRoleQuota=new RoleQuota();
		$result=$aRoleQuota->getIncludeSuccessorQuota();
		return view('settings.rolequota.index',['sidebarMenu'=>$sidebarMenu,'result'=>$result,'permission'=>$permission]);
	}
	public function create(){
		$rh=new RoleHelper();
		$aMenu=$rh->getMenuId('rolequota');
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
		$successorRole=$rh->getExcludeSuccessorRole();
		$quotaListByRoleId=\DB::select('SELECT quotas.name AS quotaName,role_quota.* FROM `quotas`
			INNER JOIN
			role_quota ON quotas.id=role_quota.quotaid
			WHERE role_quota.roleid=?',[$rh->getRoleId()]);
		if($permission[2]==1){
			return view('settings.rolequota.create',['sidebarMenu'=>$sidebarMenu,'successorRole'=>$successorRole,'quotaListByRoleId'=>$quotaListByRoleId]);
		}else{
			return redirect('rolequota');
		}
	}
	public function store(Request $request){
		$rh=new RoleHelper();
		$roleid=$request->roleid;
		$selectquota=$request->quotaid;
		$aRoleQuota=new RoleQuota();
		if($selectquota!=null){
			foreach ($selectquota as $item){
				$isTure=$aRoleQuota->hasItem($roleid,$item);
				\DB::table('role_quota')->insert(['roleid'=>$roleid,'quotaid'=>$item]);
			}
		}
		return redirect('rolequota');
	}
	public function edit($id){

	}
	public function update(Request $request, $id){

	}
}

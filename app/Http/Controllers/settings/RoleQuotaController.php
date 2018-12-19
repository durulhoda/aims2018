<?php

namespace App\Http\Controllers\settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\role\RoleHelper;
use App\settings\RoleQuota;
use App\role\Role;
class RoleQuotaController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	public function index(){
		$rh=new RoleHelper();
		$aRoleQuota=new RoleQuota();
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
		$roleList=$rh->getExcludeSuccessorRole();
		$list=$aRoleQuota->successorQuotaRole($rh->getRoleId());
		return view('settings.rolequota.index',['sidebarMenu'=>$sidebarMenu,'result'=>$list,'permission'=>$permission]);
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
		$fromRole=$rh->getIncludeSuccessorRole();
		$toRole=$rh->getExcludeSuccessorRole();
		$quotaListByRoleId=\DB::select('SELECT quotas.name AS quotaName,role_quota.* FROM `quotas`
			INNER JOIN
			role_quota ON quotas.id=role_quota.quotaid
			WHERE role_quota.roleid=?',[$rh->getRoleId()]);
		if($permission[2]==1){
			return view('settings.rolequota.create',['sidebarMenu'=>$sidebarMenu,'fromRole'=>$fromRole,'toRole'=>$toRole,'quotaListByRoleId'=>$quotaListByRoleId]);
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
				$isTure=$aRoleQuota->checkItem($roleid,$item);
				if($isTure!=true){
					\DB::table('role_quota')->insert(['roleid'=>$roleid,'quotaid'=>$item]);
				}
			}
		}
		return redirect('rolequota');
	}
	public function edit($id){
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
		$aRole=Role::findOrfail($id);
		$fromRole=$rh->getIncludeSuccessorRole();
		$toRole=$rh->successorRole($aRole->id);
		$quotaListByRoleId=\DB::select('SELECT t1.id AS quotaid,
t1.name as quotaName,
IFNULL(t2.id,0) AS checkquotaid 
from (SELECT role_quota.*,quotas.id,quotas.name FROM `role_quota`
INNER JOIN
quotas on quotas.id=role_quota.quotaid
WHERE role_quota.roleid=?) as t1
LEFT JOIN
(SELECT role_quota.*,quotas.id,quotas.name FROM `role_quota`
INNER JOIN
quotas on quotas.id=role_quota.quotaid
WHERE role_quota.roleid=?) as t2 on t1.id=t2.id',[$aRole->rolecreatorid,$aRole->id]);
		// dd($quotaListByRoleId);
		if($permission[2]==1){
			return view('settings.rolequota.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aRole,'fromRole'=>$fromRole,'toRole'=>$toRole,'quotaListByRoleId'=>$quotaListByRoleId]);
		}else{
			return redirect('rolequota');
		}
	}
	public function update(Request $request, $id){

	}
}

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
		// dd($list);
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
		$roleid=$request->roleid;
		$selectquota=$request->quotaid;
		$this->saveQuotadata($roleid,$selectquota);
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
		$toRole=$rh->ownAndSuccessorRole($aRole->id);
		$aRoleQuota=new RoleQuota();
		$quotaListBetweenRole=$aRoleQuota->getQuotaListBetweenRole($aRole->rolecreatorid,$aRole->id);
		if($permission[2]==1){
			return view('settings.rolequota.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aRole,'fromRole'=>$fromRole,'toRole'=>$toRole,'quotaListBetweenRole'=>$quotaListBetweenRole]);
		}else{
			return redirect('rolequota');
		}
	}
	public function update(Request $request, $id){
		$roleid=$request->roleid;
		$selectquota=$request->quotaid;
		// dd($selectquota);
		$aRoleQuota=new RoleQuota();
		$vresult=\DB::select('SELECT role_quota.roleid FROM role_quota  WHERE roleid=? GROUP BY role_quota.roleid',[$roleid]);
		// dd($vresult);
		if($selectquota!=null){
			if($vresult!=null){
			if($vresult[0]->roleid==$id){
				\DB::select('DELETE  FROM role_quota WHERE roleid=?',[$id]);
				$this->saveQuotadata($roleid,$selectquota);
			}else{
				// This role Already Assign
			}
			}else{
				\DB::select('DELETE  FROM role_quota WHERE roleid=?',[$id]);
				$this->saveQuotadata($roleid,$selectquota);
			}
		}else{
			// Please select Quota 
		}
    	return redirect('rolequota');
	}
	private function saveQuotadata($roleid,$selectquota){
		$aRoleQuota=new RoleQuota();
		$isTure=$aRoleQuota->checkItem($roleid);
		if(!$isTure){
			if($selectquota!=null){
				foreach ($selectquota as $item){
					\DB::table('role_quota')->insert(['roleid'=>$roleid,'quotaid'=>$item]);
				}
			}else{
				// Please select Quota
			}
		}else{
			// This role Already Assign
		}
	}
}

// \DB::select('DELETE  FROM role_quota WHERE roleid=?',[$id]);

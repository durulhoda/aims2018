<?php

namespace App\settings;

use Illuminate\Database\Eloquent\Model;
use App\role\RoleHelper;
class RoleQuota extends Model
{
	protected $table='role_quota';
	public $timestamps = false;
	protected $fillable = ['roleid','quotaid'];

	public function getExcludeSuccessorQuota(){
		$rh=new RoleHelper();
		$quotaList=array();
		$roleList=$rh->getExcludeSuccessorRole();
		$i=0;
		foreach ($roleList as $aItem) {
			$result=\DB::select('SELECT quotas.name AS quotaName,role_quota.* FROM `quotas`
				INNER JOIN
				role_quota ON quotas.id=role_quota.quotaid
				WHERE role_quota.roleid=?',[$aItem->id]);
			foreach ($result as $aQuota) {
				$quotaList[$i]=$aQuota;
				$i++;
			}
		}
		return $quotaList;
	}
	public function getIncludeSuccessorWithOutLastOne(){
		$rh=new RoleHelper();
		$roleid=$rh->getRoleId();
		$list=array();
		$list=$this->getList($list,$roleid,0);
		return $list;
	}
	private function getList($list,$roleid,$i){
		$isTrue=true;
		while ($isTrue) {
			$isTrue=false;
		}
		return $list;
	}
	private function getItem($id){
		$result=\DB::select('select * from roles where id=?',[$id]);
		return $result[0];
	}
	private  function hasItem($roleid){
		$result=\DB::select('select * from roles where rolecreatorid=?',[$roleid]);
		if($result){
			return true;
		}else{
			return false;
		}
	}
}

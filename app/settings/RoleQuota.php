<?php

namespace App\settings;

use Illuminate\Database\Eloquent\Model;
use App\role\RoleHelper;
class RoleQuota extends Model
{
	protected $table='role_quota';
	public $timestamps = false;
	protected $fillable = ['roleid','quotaid'];
	public function checkItem($roleid){
		$result=\DB::select("SELECT * FROM `role_quota`
			WHERE roleid=?",[$roleid]);
		if($result!=null){
			return true;
		}
		return false;
	}
	public function successorQuotaRole($id){
		return $this->getQuotaRoleList($id,0);
	}
	private function getQuotaRoleList($roleid,$i){
		$result=\DB::select('SELECT t2.*,roles.name AS pName,roles.id AS pid FROM (SELECT * FROM roles
INNER JOIN
(SELECT role_quota.roleid FROM `role_quota` 
GROUP BY role_quota.roleid) AS t1 ON t1.roleid=roles.id
WHERE roles.rolecreatorid=?) AS t2
INNER JOIN roles ON t2.rolecreatorid=roles.id', [$roleid]);
		if(count($result)>0){
			foreach ($result as $item) {
				$list[$i]=$item;
				$i++;
				$hasItem=$this->hasItem($item->id);
				if($hasItem){
					$iresult=$this->getQuotaRoleList($item->id,$i);
					foreach ($iresult as $value) {
						$list[$i]=$value;
						$i++;
					}
				}
			}
			return $list;
		}
		return $result;
	}
	private  function hasItem($roleid){
		$result=\DB::select('SELECT * FROM roles
			INNER JOIN
			(SELECT role_quota.roleid FROM `role_quota` 
			GROUP BY role_quota.roleid) AS t1 ON t1.roleid=roles.id
			WHERE roles.rolecreatorid=?',[$roleid]);
		if($result){
			return true;
		}else{
			return false;
		}
	}
	public function getQuotaListBetweenRole($rolecreatorid,$roleid){
		$quotaListBetweenRole=\DB::select('SELECT t1.id AS quotaid,
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
			WHERE role_quota.roleid=?) as t2 on t1.id=t2.id',[$rolecreatorid,$roleid]);
		return $quotaListBetweenRole;
	}

}

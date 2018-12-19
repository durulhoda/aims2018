<?php

namespace App\settings;

use Illuminate\Database\Eloquent\Model;
use App\role\RoleHelper;
class RoleQuota extends Model
{
	protected $table='role_quota';
	public $timestamps = false;
	protected $fillable = ['roleid','quotaid'];
	public function checkItem($roleid,$quotaid){
		$result=\DB::select("SELECT * FROM `role_quota`
WHERE roleid=? AND quotaid=?",[$roleid,$quotaid]);
		if($result!=null){
			return true;
		}
		return false;
	}
	public function successorQuotaRole($id){
		return $this->getQuotaRoleList($id,0);
	}
	private function getQuotaRoleList($roleid,$i){
		$result=\DB::select('SELECT * FROM roles
			INNER JOIN
			(SELECT role_quota.roleid FROM `role_quota` 
			GROUP BY role_quota.roleid) AS t1 ON t1.roleid=roles.id
			WHERE roles.rolecreatorid=?', [$roleid]);
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

}

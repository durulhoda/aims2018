<?php

namespace App\settings;

use Illuminate\Database\Eloquent\Model;
use App\role\RoleHelper;
class RoleQuota extends Model
{
    protected $table='role_quota';
    public $timestamps = false;
   	protected $fillable = ['roleid','quotaid'];
   	
   	public function getIncludeSuccessorQuota(){
   		$rh=new RoleHelper();
   		$quotaList=array();
   		$roleList=$rh->getIncludeSuccessorRole();
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
   	public function hasItem($roleid,$quotaid){
   		$result=\DB::select("SELECT * FROM `role_quota` WHERE role_quota.roleid=? AND role_quota.quotaid=?",[$roleid,10]);
   		if($result==null){
   			// dd($result);
   			return true;
   		}
   		return false;
   	}
}

<?php

namespace App\role;
use App\role\Permission;
use Illuminate\Database\Eloquent\Model;
use Auth;
class RoleHelper extends Model
{
    public function getLastItem($table){
    	 $lastitem=\DB::table($table)
        ->orderBy('id','desc')
        ->first();
        return $lastitem;
    }
    public function getPermissionValue(){
    	$totalValue=0;
    	$permissionList=Permission::all();
    	foreach ($permissionList as $item) {
    	   		$totalValue=$totalValue+$item->level;
    	} 
    	return $totalValue;  	
    }
    public function getRoleId(){
         $userid = Auth::user()->id;
         $aRole=\DB::select('SELECT roles.id ,roles.name FROM users
    INNER JOIN user_role ON users.id=user_role.user_id
    INNER JOIN roles ON user_role.role_id=roles.id
    WHERE users.id=?',[$userid])[0];
         return $aRole->id;
    }
    public function getMenuId($url){
       $aMenus = \DB::table('menus')->where('url',$url)->first();
       return $aMenus->id;
    }
    public function getRolePower($roleid){
        
    }
}

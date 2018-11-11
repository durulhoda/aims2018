<?php

namespace App;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table='roles';
   	protected $fillable = ['name','accesspower','status'];

   	public static function getAccessStatus(){
   		$userid = Auth::user()->id;
   		$result=\DB::select('SELECT user_role.user_id,user_role.role_id,roles.name AS roleName,roles.accesspower FROM `user_role` 
INNER JOIN `roles` on user_role.role_id=roles.id
WHERE user_role.user_id=?',[$userid])[0];
   		$bina=base_convert($result->accesspower,10,2);
        $i=0;
        $access=array();
        while($bina>0) {
           $mr=$bina%10;
           $bina=$bina-$mr;
           $dr=$mr;
             $access[$i]=$dr;
           $bina=$bina/10;
           $i++;
        }
        $accessStatus[1]=(isset($access[0])? $access[0]:0);
        $accessStatus[2]=(isset($access[1])? $access[1]:0);
        $accessStatus[4]=(isset($access[2])? $access[2]:0);
        $accessStatus[8]=(isset($access[3])? $access[3]:0);
        $accessStatus[16]=(isset($access[4])? $access[4]:0);
        $accessStatus[32]=(isset($access[5])? $access[5]:0);
   		return $accessStatus;
   	}
    public static function getMenu(){
       return Role::menucreate(0);
    }
    private static function menucreate($parentid){
    $userid = Auth::user()->id;
    $menu = "";
    $result=\DB::select('select * From (SELECT menus.id,menus.name as menuName,menus.parentid,menus.url,role_menu.menu_id,role_menu.role_id,roles.name as roleName
from menus
INNER JOIN role_menu on role_menu.menu_id=menus.id
INNER JOIN roles on role_menu.role_id=roles.id) as rolemenu
INNER join (SELECT users.name,user_role.user_id,user_role.role_id
FROM users
INNER JOIN user_role on users.id=user_role.user_id
INNER JOIN roles on user_role.role_id=roles.id) as userrole on userrole.role_id=rolemenu.role_id
WHERE userrole.user_id=? and rolemenu.parentid=?',[$userid,$parentid]);
    foreach ($result as $key => $value) {
        $isTrue=Role::hasChild($value->id);
        if($isTrue){
           $menu .="<li class='sub-menu'><a href='javascript:;'>".$value->menuName."</a>";
           $menu .= "<ul class='sub'>".Role::menucreate($value->id)."</ul>";
       }else{
        $s="{{URL::to('/')}}";
        $menu .="<li class=''><a href='".$value->url."'>".$value->menuName."</a>";
    }
    $menu .= "</li>";
}
return $menu;
}
// {{URL::to('/')}}
private static function hasChild($parentid){
    $result=\DB::select('SELECT * FROM `menus` where parentid=?',[$parentid]);
    if($result){
        return true;
    }else{
        return false;
    }
}
}


<?php

namespace App;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
  protected $table='roles';
  protected $fillable = ['name','rolecreatorid','instituteid','accesspower','status'];
  
  public static function getAllRole(){
   $userid = Auth::user()->id;
   $result=\DB::select();
   return $result;
 }
 public static function getAccessStatus(){
   $userid = Auth::user()->id;
   $result=\DB::select('SELECT user_role.user_id,user_role.role_id,roles.name AS roleName,roles.accesspower FROM `user_role` 
    INNER JOIN `roles` on user_role.role_id=roles.id
    WHERE user_role.user_id=?',[$userid]);
   if(count($result)==0){
    $accesspower=0;
  }else{
    $aRow=$result[0];
    $accesspower=$aRow->accesspower;
  }
  $bina=base_convert($accesspower,10,2);
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
 return Role::adminmenu(0);
}
private static function adminmenu($parentid){
  $userid = Auth::user()->id;
  $menu = "";
  $result=\DB::select('SELECT menus.id,menus.name as menuName,menus.parentid,menus.url,menus.menuorder
    FROM `role_menu`
    INNER JOIN menus on role_menu.menu_id=menus.id
    WHERE role_menu.role_id=? AND menus.parentid=?
    ORDER by menus.menuorder ASC',[Role::getRoleid(),$parentid]);
  foreach ($result as $key => $value) {
    $isTrue=Role::hasChild($value->id);
    if($isTrue){
     $menu .="<li class='sub-menu'><a href='javascript:;'>".$value->menuName."</a>";
     $menu .= "<ul class='sub'>".Role::adminmenu($value->id)."</ul>";
   }else{
    $s="{{URL::to('/')}}";
    $menu .="<li class=''><a href='".$value->url."'>".$value->menuName."</a>";
  }
  $menu .= "</li>";
}
return $menu;
}
private static function hasChild($parentid){
  $result=\DB::select('SELECT * FROM `menus` where parentid=?',[$parentid]);
  if($result){
    return true;
  }else{
    return false;
  }
}
public static function getRoleid(){
  $userid = Auth::user()->id;
  $result=\DB::select('SELECT users.id,users.name AS userName,roles.id as role_id,roles.name as roleName FROM users
    INNER JOIN user_role ON users.id=user_role.user_id
    INNER JOIN roles ON user_role.role_id=roles.id
    WHERE users.id=?',[$userid]);
  return $result[0]->role_id;
}
public static function roleCreator(){
  $userid = Auth::user()->id;
  $result=\DB::select('SELECT users.id,users.name,roles.name roleName,roles.rolecreatorid FROM `users`  
    INNER JOIN user_role ON users.id=user_role.user_id
    INNER JOIN roles ON user_role.role_id=roles.id
    WHERE users.id=?',[$userid]);
  return $result[0]->rolecreatorid;
  }
}


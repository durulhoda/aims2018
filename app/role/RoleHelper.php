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
public function getUserId(){
  return Auth::user()->id;
}
public function getRoleId(){
 $aRole=\DB::select('SELECT roles.id ,roles.name FROM users
  INNER JOIN user_role ON users.id=user_role.userid
  INNER JOIN roles ON user_role.roleid=roles.id
  WHERE users.id=?',[$this->getUserId()])[0];
 return $aRole->id;
}
public function getInstituteId(){
 $aRole=\DB::select('SELECT * FROM institute WHERE userid=?',[$this->getUserId()])[0];
 return $aRole->id;
}
public function getRoleCreatorId(){
 $aRole=\DB::select('select * from roles where id=?',[$this->getRoleId()])[0];
 return $aRole->rolecreatorid;
}
public function getOwnRoleList(){
  $result=\DB::select('select * from roles where rolecreatorid=?', [$this->getRoleId()]);
  return $result;
}
public function getExcludeSuccessorRole(){
 return $this->getRoleList($this->getRoleId(),0);
}
public function getIncludeSuccessorRole(){
  return $this->ownAndSuccessorRole($this->getRoleId());
}
private function ownAndSuccessorRole($id){
  $result=\DB::select('select * from roles where id=?', [$id]);
  $list[0]=$result[0];
  $items=$this->getRoleList($id,0);
  $i=1;
  foreach ($items as $item){
    $list[$i]=$item;
    $i++;
  }
  return $list;
}
public function getPredecessorRole($id){
  $list1=$this->getIncludeSuccessorRole();
  $list2=$this->ownAndSuccessorRole($id);
  $isExist=true;
  $i=0;
  $list=array();
  foreach ($list1 as $item) {
     $isExist=$this->check($list2,$item->id);
     if($isExist==false){
         $list[$i]=$item;
         $i++;
     }
  }
  return $list;
}
private function check($list,$id){
   foreach ($list as $item) {
     if($item->id==$id){
       return true;
     }
   }
   return false;
}
private function getRoleList($roleid,$i){
  $result=\DB::select('select * from roles where rolecreatorid=?', [$roleid]);
  if(count($result)>0){
    foreach ($result as $item) {
      $list[$i]=$item;
      $i++;
      $hasItem=$this->hasItem($item->id);
      if($hasItem){
        $iresult=$this->getRoleList($item->id,$i);
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
  $result=\DB::select('select * from roles where rolecreatorid=?',[$roleid]);
  if($result){
    return true;
  }else{
    return false;
  }
}
public function getMenuId($url){
 $aMenu = \DB::table('menus')->where('url',$url)->first();
 return $aMenu;
}
public function hasMenu($munuid){
  $result=\DB::select('SELECT * FROM role_menu WHERE roleid=? AND menuid=?',[$this->getRoleId(),$munuid]);
  if($result){
    return true;
  }else{
    return false;
  }
}
public function getMenuListByRole(){
  $menuListByRole=\DB::select("SELECT menus.id,menus.name AS menuName,menus.url,menus.parentid,menus.menuorder,role_menu.permissionvalue
    FROM `role_menu`
    INNER JOIN menus ON role_menu.menuid=menus.id
    WHERE role_menu.roleid=? ORDER BY menus.menuorder",[$this->getRoleId()]);
  $menuitemList=array();
  $i=0;
  foreach ($menuListByRole as $x) {
    if($x->parentid==0){
      $binaryPositionValue=$this->getBinaryPositionValue($x->permissionvalue);
      $menuitemList[$i]=['item'=>$x,'binaryPositionValue'=>$binaryPositionValue];
      $i++;
      foreach ($menuListByRole as $y) {
       if($x->id==$y->parentid){
        $binaryPositionValue=$this->getBinaryPositionValue($y->permissionvalue);
        $menuitemList[$i]=['item'=>$y,'binaryPositionValue'=>$binaryPositionValue];
        $i++;
      }
    }
  }
}
return $menuitemList;
}

public function getFilterMenuListByRole($id){
  $menuListByRole=\DB::select("SELECT menus.id,menus.name AS menuName,menus.url,menus.parentid,menus.menuorder,role_menu.permissionvalue
    FROM `role_menu`
    INNER JOIN menus ON role_menu.menuid=menus.id
    WHERE role_menu.roleid=? ORDER BY menus.menuorder",[$id]);
  $menuitemList=array();
  $i=0;
  foreach ($menuListByRole as $x) {
    if($x->parentid==0){
      $binaryPositionValue=$this->getBinaryPositionValue($x->permissionvalue);
      $menuitemList[$i]=['item'=>$x,'binaryPositionValue'=>$binaryPositionValue];
      $i++;
      foreach ($menuListByRole as $y) {
       if($x->id==$y->parentid){
        $binaryPositionValue=$this->getBinaryPositionValue($y->permissionvalue);
        $menuitemList[$i]=['item'=>$y,'binaryPositionValue'=>$binaryPositionValue];
        $i++;
      }
    }
  }
}
return $menuitemList;
}
public function getRoleEditMenuList($parentroleid,$chileroleid){
  $result=\DB::select("SELECT parentrole.id,
parentrole.name AS menuName,
parentrole.parentid,
parentrole.permissionvalue,
IFNULL(childrole.id,0) AS cmenuid,
IFNULL(childrole.permissionvalue,0) AS cpermissionvalue
FROM(SELECT menus.*,role_menu.permissionvalue FROM role_menu
INNER JOIN menus ON role_menu.menuid=menus.id
WHERE roleid=?) AS parentrole
LEFT JOIN 
(SELECT menus.*,role_menu.permissionvalue FROM role_menu
INNER JOIN menus ON role_menu.menuid=menus.id
WHERE roleid=?) AS childrole ON childrole.id=parentrole.id ORDER BY parentrole.menuorder",[$parentroleid,$chileroleid]);
  $menuitemList=array();
  $i=0;
  foreach ($result as $x) {
    if($x->parentid==0){
      $parentPositionValue=$this->getBinaryPositionValue($x->permissionvalue);
      $childPositionValue=$this->getBinaryPositionValue($x->cpermissionvalue);
      $meargeResult=$this->meargechildPositionValue($parentPositionValue,$childPositionValue);
      $menuitemList[$i]=['item'=>$x,'parentPositionValue'=>$parentPositionValue,'meargeResult'=>$meargeResult];
      $i++;
      foreach ($result as $y) {
       if($x->id==$y->parentid){
        $parentPositionValue=$this->getBinaryPositionValue($y->permissionvalue);
        $childPositionValue=$this->getBinaryPositionValue($y->cpermissionvalue);
        $meargeResult=$this->meargechildPositionValue($parentPositionValue,$childPositionValue);
        $menuitemList[$i]=['item'=>$y,'parentPositionValue'=>$parentPositionValue,'meargeResult'=>$meargeResult];
        $i++;
      }
    }
  }
}
return $menuitemList;
}
private function meargechildPositionValue($parentPositionValue,$childPositionValue){
  $meargeResult=array();
  foreach ($parentPositionValue as $item) {
    $meargeResult[$item]=isset($childPositionValue[$item])?$childPositionValue[$item]:0;
  }
  return $meargeResult;
}
public function getPermitedMenus(){
  $permitedMenus=\DB::select("SELECT role_menu.menuid FROM `role_menu`
    WHERE roleid=?",[$this->getRoleId()]);
  return $permitedMenus;
}
private function getMenuPermissionValue($menuid){
  $aItem = \DB::table('role_menu')
  ->where('roleid',$this->getRoleId())
  ->where('menuid',$menuid)
  ->first();
  return $aItem->permissionvalue;
}
public function getPermission($menuid){
  $permissionValue=$this->getMenuPermissionValue($menuid);
  $bina=base_convert($permissionValue,10,2);
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
 $i=0;
 $permissionList=Permission::all();
 foreach ($permissionList as $aObj) {
  $permission[$aObj->level]=(isset($access[$i])? $access[$i]:0);
  $i++;
}
return $permission;
}
public function getPermissionNamebyLevel(){
 $permissionList=Permission::all();
 foreach ($permissionList as $aObj) {
  $permissionNameList[$aObj->level]=$aObj->name;
}
return $permissionNameList;
}
private function getBinaryPositionValue($permissionvalue){
  $bina=base_convert($permissionvalue,10,2);
  $m=1;
  $access=array();
  while($bina>0) {
   $mr=$bina%10;
   $bina=$bina-$mr;
   $dr=$mr*$m;
   if($dr){
     $access[$dr]=$dr;
   }
   $m=$m*2;
   $bina=$bina/10;
 }
 return $access;
}
// For Dynamic Sidebar Menu=======================================
public function getMenu(){
  return $this->adminmenu(0);
}
private function adminmenu($parentid){
  $userid = Auth::user()->id;
  $menu = "";
  $result=\DB::select('SELECT menus.id,menus.name as menuName,menus.parentid,menus.url,menus.menuorder
    FROM `role_menu`
    INNER JOIN menus on role_menu.menuid=menus.id
    WHERE role_menu.roleid=? AND menus.parentid=?
    ORDER by menus.menuorder ASC',[$this->getRoleId(),$parentid]);

  foreach ($result as $key => $value) {
    $isTrue=$this->hasChild($value->id);
    if($isTrue){
     $menu .="<li class='sub-menu'><a href='javascript:;'>".$value->menuName."</a>";
     $menu .= "<ul class='sub'>".$this->adminmenu($value->id)."</ul>";
   }else{
    $menu .="<li class=''><a href='/".$value->url."'>".$value->menuName."</a>";
  }
  $menu .= "</li>";
}
return $menu;
}
private  function hasChild($parentid){
  $result=\DB::select('SELECT * FROM menus where parentid=?',[$parentid]);
  if($result){
    return true;
  }else{
    return false;
  }
}
}

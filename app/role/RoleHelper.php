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
public function getRoleCreatorId(){
 $aRole=\DB::select('select * from roles where id=?',[$this->getRoleId()])[0];
 return $aRole->rolecreatorid;
}
public function getSuccessorRole(){
     return $this->getRoleCreator($this->getRoleCreatorId(),0);
}
private function getRoleCreator($roleid,$i){
    $result=\DB::select('select * from roles where rolecreatorid=?', [$roleid]);
    if(count($result)){
        foreach ($result as $item) {
            $list[$i]=$item;
            $i++;
            $iresult=$this->getRoleCreator($item->id,$i);
            foreach ($iresult as $value) {
               $list[$i]=$value;
               $i++;
           }
       }
       return $list;
   }else{
    return $result;
  }
}
public function getMenuId($url){
   $aMenus = \DB::table('menus')->where('url',$url)->first();
   return $aMenus->id;
}
public function getMenuListByRole(){
    $menuListByRole=\DB::select("SELECT menus.id as menu_id,menus.name menuName,role_menu.permissionvalue
FROM `role_menu`
INNER JOIN menus ON role_menu.menu_id=menus.id
WHERE role_menu.role_id=?",[$this->getRoleId()]);
    $menuitems=array();
    $i=0;
    foreach ($menuListByRole as $item) {
      $binaryPositionValue=$this->getBinaryPositionValue($item->permissionvalue);
      $menuitems[$i]=['item'=>$item,'binaryPositionValue'=>$binaryPositionValue];
        $i++;
    }
    return $menuitems;
}
public function getPermitedMenus(){
    $permitedMenus=\DB::select("SELECT role_menu.menu_id FROM `role_menu`
WHERE role_id=?",[$this->getRoleId()]);
    return $permitedMenus;
}
private function getMenuPermissionValue($menuid){
    $aItem = \DB::table('role_menu')
    ->where('role_id',$this->getRoleId())
    ->where('menu_id',$menuid)
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
public function getRolePower(){

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
        INNER JOIN menus on role_menu.menu_id=menus.id
        WHERE role_menu.role_id=? AND menus.parentid=?
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
  $result=\DB::select('SELECT * FROM `menus` where parentid=?',[$parentid]);
  if($result){
    return true;
}else{
    return false;
}
}
}

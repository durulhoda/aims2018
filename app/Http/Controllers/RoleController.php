<?php

namespace App\Http\Controllers;
use App\Role;
use App\menusettings\Menu;
use App\role\RoleMenu;
use App\role\RoleHelper;
use Illuminate\Http\Request;
class RoleController extends Controller
{
  public function __construct(){
      $this->middleware('auth');
  }
  public function index(){
    $rh=new RoleHelper();
    $menuid=$rh->getMenuId('menu');
    $sidebarMenu=$rh->getMenu();
    $permission=$rh->getPermission($menuid);
    $roleid=$rh->getRoleId();
    $result=$this->getRoleByCretor($roleid);
    return view('roleconfig.role.index',['sidebarMenu'=>$sidebarMenu,'permission'=>$permission,'result'=>$result]);
}

public function create(){
    $rh=new RoleHelper();
    $menuid=$rh->getMenuId('menu');
    $sidebarMenu=$rh->getMenu();
    $permission=$rh->getPermission($menuid);
    $roleid=$rh->getRoleId();
    $rolepower=$this->getRolePower($roleid);
    if($permission[2]==1){
        $roleCreators=$this->getRoleByCretor(2); //All Successor
        return view('roleconfig.role.create',['sidebarMenu'=>$sidebarMenu,'rolecreatorid'=>$roleid,'roleCreators'=>$roleCreators,'rolepower'=>$rolepower]);
    }else{
     return redirect('role');
 }
}
public function store(Request $request){
    if(isset($request->accesspower)){
        $accesspower=$request->accesspower;
        $sum=0;
        foreach ($accesspower as $key => $value) {
           $sum=$sum+$value;
       }
       $aBean=new Role();
       $aBean->name=$request->name;
       $aBean->accesspower=$sum;
       $aBean->rolecreatorid=$request->rolecreatorid;
       $aBean->instituteid=0;
       $aBean->save();
       $lastRecord=\DB::select('SELECT * FROM `roles` ORDER BY ID DESC LIMIT 1')[0];
       $selectmenu=$request->menu_id;
       foreach ($selectmenu as $item) {
        $aRoleMenu=new RoleMenu();
        $aRoleMenu->role_id=$lastRecord->id;
        $aRoleMenu->menu_id=$item;
        $aRoleMenu->save();
    }
}else{
}
return redirect('role');
}
public function edit($id){
    $accessStatus=Role::getAccessStatus();
    $sidebarMenu=Role::getMenu();
    $roleid=Role::getRoleid();
    $rolecreatorid=$this->getRoleCreatorID($id);
    $rolepower=$this->getRolePower($rolecreatorid);
    if($accessStatus[4]==1){
         $list[0]=\DB::table('roles')->where('id', $roleid)->first();
         $roleCreators=$this->getRoleCreator($roleid,$list);
        $aBean=Role::findOrfail($id);
        $accesspowers=$aBean->accesspower;
        $access=$this->getBinaryPositionValue($accesspowers);
        $result=\DB::select("select parentrolemenu.menu_id, IFNULL(childrolemenu.menu_id,0) AS id, parentrolemenu.menuName, parentrolemenu.url, parentrolemenu.parentid, parentrolemenu.menuorder FROM(SELECT roles.id as parentroleid,roles.name AS roleName,roles.rolecreatorid,roles.instituteid,roles.accesspower,menus.id AS menu_id,menus.name AS menuName,menus.url,menus.parentid,menus.menuorder from roles INNER JOIN role_menu on roles.id=role_menu.role_id INNER JOIN menus ON role_menu.menu_id=menus.id WHERE roles.id=?) AS parentrolemenu left JOIN (SELECT roles.id as childroleid,roles.name AS roleName,roles.rolecreatorid,roles.instituteid,roles.accesspower,menus.id AS menu_id,menus.name AS menuName from roles INNER JOIN role_menu on roles.id=role_menu.role_id INNER JOIN menus ON role_menu.menu_id=menus.id WHERE roles.id=?) AS childrolemenu ON parentrolemenu.menu_id=childrolemenu.menu_id",[$rolecreatorid,$id]);
     return view('roleconfig.role.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aBean,'access'=>$access,'result'=>$result,'roleCreators'=>$roleCreators,'rolepower'=>$rolepower]);
 }
 return redirect('role');
}
public function update(Request $request, $id){
    if(isset($request->accesspower)){
        $accesspower=$request->accesspower;
        $selectmenu=$request->menu_id;
        $sum=0;
        foreach ($accesspower as $key => $value) {
           $sum=$sum+$value;
       }
       $aBean=Role::findOrfail($id);
       $aBean->name=$request->name;
       $aBean->rolecreatorid=$request->rolecreatorid;
       $aBean->accesspower=$sum;
       $aBean->update();
       \DB::select('DELETE  FROM `role_menu` WHERE role_id=?',[$id]);
       foreach ($selectmenu as $item) {
           $aBean=new RoleMenu();
           $aBean->role_id=$id;
           $aBean->menu_id=$item;
           $aBean->save();  
   }
}
return redirect('role');
}
private function getRoleByCretor($roleid){
    $result=\DB::select("SELECT roles.id,roles.name,roles.rolecreatorid,vroles.roleCreatorName,IFNULL(roles.instituteid,0) as instituteid,IFNULL(institute.name,'No Institute') as institueName FROM `roles`
        left JOIN institute ON roles.instituteid=institute.id
        left JOIN (SELECT roles.id,roles.name as roleCreatorName,roles.rolecreatorid,roles.instituteid FROM `roles`) AS vroles ON vroles.id=roles.rolecreatorid
        WHERE roles.rolecreatorid=?",[$roleid]);
    $i=0;
    if(count($result)){
        foreach ($result as $item) {
            $list[$i]=$item;
            $i++;
            $iresult=$this->getRoleByCretor($item->id);
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
private function getRoleCreator($roleid,$list){
    $result=\DB::select('select * from roles where rolecreatorid=?', [$roleid]);
    $i=1;
    if(count($result)){
        foreach ($result as $item) {
            $list[$i]=$item;
            $i++;
            $iresult=$this->getRoleByCretor($item->id);
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
private function getCretor($roleid){
    $result=\DB::select("SELECT roles.rolecreatorid,vroles.roleCreatorName FROM `roles`
        INNER JOIN (SELECT roles.id,roles.name as roleCreatorName,roles.rolecreatorid FROM `roles`) AS vroles ON vroles.id=roles.rolecreatorid
        group by  roles.rolecreatorid");
    return $result;
  }
  private function getRolePower($roleid){
    $rolepower=array();
    $accessPower=\DB::select("SELECT roles.id,roles.name AS roleName,roles.accesspower
FROM roles
WHERE roles.id=?",[$roleid])[0]->accesspower;
    $menusAccess=\DB::select("SELECT roles.id,roles.name AS roleName,roles.accesspower,
IFNULL(vmenus.menu_id,0) as menu_id,
IFNULL(vmenus.menuName,'No Selected') as menuName
FROM roles
left JOIN (SELECT role_menu.role_id,role_menu.menu_id,menus.name AS menuName from role_menu
INNER JOIN menus ON role_menu.menu_id=menus.id) as vmenus on vmenus.role_id=roles.id
WHERE roles.id=?",[$roleid]);
    $accessPower=$this->getBinaryPositionValue($accessPower);
    $rolepower['accessPower']=$accessPower;
    $rolepower['menusAccess']=$menusAccess;
    // dd($rolepower);
    return $rolepower;
  }
  private function getRoleCreatorID($id){
     $aRow=\DB::table('roles')->where('id', $id)->first();
    return $aRow->rolecreatorid;
  }
  private function getBinaryPositionValue($accesspowers){
      $bina=base_convert($accesspowers,10,2);
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
}


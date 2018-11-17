<?php

namespace App\Http\Controllers;
use App\Role;
use App\menusettings\Menu;
use App\menusettings\RoleMenu;
use Illuminate\Http\Request;
class RoleController extends Controller
{
    public function __construct(){
      $this->middleware('auth');
  }
    public function index(){
      $accessStatus=Role::getAccessStatus();
     if(Role::checkAdmin()==1){
        $sidebarMenu=Role::getAllMenu();
     }else{
        $sidebarMenu=Role::getMenu();
     }
     $result=\DB::select('SELECT roles.id,roles.name,roles.rolecreatorid,roles.instituteid,institute.name as institueName,vroles.roleCreatorName FROM `roles`
INNER JOIN institute ON roles.instituteid=institute.id
INNER JOIN (SELECT roles.id,roles.name as roleCreatorName,roles.rolecreatorid,roles.instituteid FROM `roles`) AS vroles ON vroles.id=roles.rolecreatorid
WHERE roles.rolecreatorid=?',[Role::getRoleid()]);
     return view('roleconfig.role.index',['sidebarMenu'=>$sidebarMenu,'result'=>$result,'accessStatus'=>$accessStatus]);
   }
   public function create(){
    $accessStatus=Role::getAccessStatus();
    if(Role::checkAdmin()==1){
        $sidebarMenu=Role::getAllMenu();
     }else{
        $sidebarMenu=Role::getMenu();
     }
    if($accessStatus[2]==1){
        $menus=Menu::all();
        return view('roleconfig.role.create',['sidebarMenu'=>$sidebarMenu,'accessStatus'=>$accessStatus,'menus'=>$menus]);
    }else{
       return redirect('role');
   }
}
public function store(Request $request){
    if(isset($request->accesspower) && isset($request->menu_id)){
        $accesspower=$request->accesspower;
        $selectmenu=$request->menu_id;
        $sum=0;
        foreach ($accesspower as $key => $value) {
         $sum=$sum+$value;
        }
         $aBean=new Role();
         $aBean->name=$request->name;
         $aBean->accesspower=$sum;
         $aBean->save();
         $lastRecord=\DB::select('SELECT * FROM `roles` ORDER BY ID DESC LIMIT 1')[0];
        foreach ($selectmenu as $item) {
            $aBean=new RoleMenu();
            $aBean->role_id=$lastRecord->id;
            $aBean->menu_id=$item;
            $aBean->save();
        }
    }else{
    }
    return redirect('role');
}
public function edit($id){
    $accessStatus=Role::getAccessStatus();
    if(Role::checkAdmin()==1){
        $sidebarMenu=Role::getAllMenu();
     }else{
        $sidebarMenu=Role::getMenu();
     }
    if($accessStatus[2]==1){
        $aBean=Role::findOrfail($id);
        $accesspowers=$aBean->accesspower;
        $result=\DB::select('SELECT menus.id,
menus.name AS menuName,
menus.url,
IFNULL(vrolemenu.role_id,0) AS role_id
FROM menus
LEFT JOIN (SELECT role_menu.role_id,role_menu.menu_id
FROM role_menu
INNER JOIN roles on role_menu.role_id=roles.id
WHERE roles.id=?) as vrolemenu ON menus.id=vrolemenu.menu_id',[$id]);
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
   return view('roleconfig.role.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aBean,'access'=>$access,'result'=>$result]);
}else{

}
return redirect('role');
}
public function update(Request $request, $id){
    if(isset($request->accesspower) && isset($request->menu_id)){
        $accesspower=$request->accesspower;
        $selectmenu=$request->menu_id;
        $sum=0;
        foreach ($accesspower as $key => $value) {
         $sum=$sum+$value;
     }
     $aBean=Role::findOrfail($id);
     $aBean->name=$request->name;
     $aBean->accesspower=$sum;
     $aBean->update();
    foreach ($selectmenu as $item) {
        $hasRecord=\DB::select('SELECT * FROM `role_menu` WHERE role_id=? AND menu_id=?',[$id,$item]);
      if(count($hasRecord)<1){
         $aBean=new RoleMenu();
         $aBean->role_id=$id;
         $aBean->menu_id=$item;
         $aBean->save();
      }     
    }
 }
 return redirect('role');
}
}


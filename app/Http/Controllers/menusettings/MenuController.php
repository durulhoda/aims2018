<?php
namespace App\Http\Controllers\menusettings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\menusettings\Menu;
use App\role\RoleHelper;
use App\role\RoleMenu;
class MenuController extends Controller
{
  public function __construct()
{
    $this->middleware('auth');
}
    public function index(){
       $rh=new RoleHelper();
       $menuid=$rh->getMenuId('menu');
       $sidebarMenu=$rh->getMenu();
       $permission=$rh->getPermission($menuid);
       $result=\DB::select("SELECT vmenus.id as childid,vmenus.name as child,menus.name as parent,vmenus.url,vmenus.menuorder 
from menus 
INNER JOIN (SELECT * FROM `menus`) as vmenus ON vmenus.parentid=menus.id 
union ALL 
SELECT 
menus.id as childid,
menus.name AS child,
(CASE
WHEN menus.parentid=0 THEN 'No Parent'
END) as parent,
menus.url,
menus.menuorder 
FROM `menus` 
WHERE menus.parentid=0 order by childid");
       return view('menusettings.menu.index',['sidebarMenu'=>$sidebarMenu,'permission'=>$permission,'result'=>$result]);
   }
   public function create(){
       $rh=new RoleHelper();
       $menuid=$rh->getMenuId('menu');
       $sidebarMenu=$rh->getMenu();
       $permission=$rh->getPermission($menuid);
    if($permission[2]==1){
       $parents=Menu::all();
       return view('menusettings.menu.create',['sidebarMenu'=>$sidebarMenu,'permission'=>$permission,'parents'=>$parents]);
   }else{
    return redirect('menu');
}

}
public function store(Request $request){
    $rh=new RoleHelper();
    $aMenu=new Menu();
    $aMenu->name=$request->name;
    $aMenu->parentid=$request->parentid;
    $aMenu->url=$request->url;
    $aMenu->menuorder=$request->menuorder;
    if($aMenu->menuorder==''){
      $aMenu->menuorder=100;
    }
    $aMenu->save();
    // last inserted value is avilable in $aMenu
    // if($aMenu->url!=null){
        $aRoleMenu=new RoleMenu();
        $aRoleMenu->role_id=$rh->getRoleId();
        $aRoleMenu->menu_id=$aMenu->id;
        $aRoleMenu->permissionvalue=$rh->getPermissionValue();
        $aRoleMenu->save();
    // }
    return redirect('menu');
}
public function edit($id){
       $rh=new RoleHelper();
       $menuid=$rh->getMenuId('menu');
       $sidebarMenu=$rh->getMenu();
       $permission=$rh->getPermission($menuid);
    if($permission[4]==1){
        $aMenu=Menu::findOrfail($id);
        $parents=\DB::table('menus')
        ->where('id','!=', $id)
        ->get();
        return view('menusettings.menu.edit',['sidebarMenu'=>$sidebarMenu,'permission'=>$permission,'bean'=>$aMenu,'parents'=>$parents]);
    }else{
        return redirect('menu');
    }

}
public function update(Request $request, $id){
   $aBean=Menu::findOrfail($id);
   $aBean->name=$request->name;
   $aBean->parentid=$request->parentid;
   $aBean->url=$request->url;
   $aBean->menuorder=$request->menuorder;
   if($aBean->menuorder==''){
      $aBean->menuorder=100;
    }
   $aBean->update();
   return redirect('menu');
}
}
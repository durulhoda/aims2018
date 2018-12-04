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
       $aMenu=$rh->getMenuId('menu');
        if($aMenu==null){
          return redirect('error');
        }
        $menuid=$aMenu->id;
       $hasMenu=$rh->hasMenu($menuid);
       if($hasMenu==false){
              return redirect('error');
        }
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
IFNULL(menus.url,'No Url') AS url,
menus.menuorder 
FROM `menus` 
WHERE menus.parentid=0 order by childid");
       return view('menusettings.menu.index',['sidebarMenu'=>$sidebarMenu,'permission'=>$permission,'result'=>$result]);
   }
   public function create(){
       $rh=new RoleHelper();
        $aMenu=$rh->getMenuId('menu');
        if($aMenu==null){
          return redirect('error');
        }
        $menuid=$aMenu->id;
       $hasMenu=$rh->hasMenu($menuid);
       if($hasMenu==false){
              return redirect('error');
        }
       $sidebarMenu=$rh->getMenu();
       $permission=$rh->getPermission($menuid);
       $parents=Menu::all();
       return view('menusettings.menu.create',['sidebarMenu'=>$sidebarMenu,'permission'=>$permission,'parents'=>$parents]);
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
    // $aMenu->save();
    $aRoleMenu=new RoleMenu();
    $aRoleMenu->roleid=$rh->getRoleId();
    $aRoleMenu->menuid=$aMenu->id;
    $aRoleMenu->permissionvalue=$rh->getPermissionValue();
    // $aRoleMenu->save();
    \DB::transaction(function() use($aMenu,$aRoleMenu) {
      $aMenu->save();
      $aRoleMenu->menuid=$aMenu->id;
      $aRoleMenu->save();
    });
    return redirect('menu');
}
public function edit($id){
       $rh=new RoleHelper();
       $aMenu=$rh->getMenuId('menu');
        if($aMenu==null){
          return redirect('error');
        }
        $menuid=$aMenu->id;
       $hasMenu=$rh->hasMenu($menuid);
       if($hasMenu==false){
              return redirect('error');
        }
       $sidebarMenu=$rh->getMenu();
       $permission=$rh->getPermission($menuid);
        $aMenu=Menu::findOrfail($id);
        $parents=\DB::table('menus')
        ->where('id','!=', $id)
        ->get();
        return view('menusettings.menu.edit',['sidebarMenu'=>$sidebarMenu,'permission'=>$permission,'bean'=>$aMenu,'parents'=>$parents]);
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
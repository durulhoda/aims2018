<?php
namespace App\Http\Controllers\menusettings;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\menusettings\Menu;
use App\menusettings\RoleMenu;
class MenuController extends Controller
{
  public function __construct()
{
    $this->middleware('auth');
}
    public function index(){
      $accessStatus=Role::getAccessStatus();
      $sidebarMenu=Role::getMenu();
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
       return view('menusettings.menu.index',['sidebarMenu'=>$sidebarMenu,'result'=>$result,'accessStatus'=>$accessStatus]);
   }
   public function create(){
    $sidebarMenu=Role::getMenu();
    $accessStatus=Role::getAccessStatus();
    if($accessStatus[2]==1){
       $parents=Menu::all();
       return view('menusettings.menu.create',['sidebarMenu'=>$sidebarMenu,'parents'=>$parents]);
   }else{
    return redirect('menu');
}

}
public function store(Request $request){
    $aBean=new Menu();
    $aBean->name=$request->name;
    $aBean->parentid=$request->parentid;
    $aBean->url=$request->url;
    $aBean->menuorder=$request->menuorder;
    if($aBean->menuorder==''){
      $aBean->menuorder=100;
    }
    $aBean->save();
    $aRoleMenu=new RoleMenu();
    $aRoleMenu->role_id=Role::getRoleid();
    $aRoleMenu->menu_id=$aBean->id;
    $aRoleMenu->save();
    return redirect('menu');
}
public function edit($id){
    $sidebarMenu=Role::getMenu();
    $accessStatus=Role::getAccessStatus();
    if($accessStatus[4]==1){
        $aBean=Menu::findOrfail($id);
        $parents=\DB::table('menus')
        ->where('id','!=', $id)
        ->get();
        return view('menusettings.menu.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aBean,'parents'=>$parents]);
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
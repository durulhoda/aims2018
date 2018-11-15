<?php
namespace App\Http\Controllers\menusettings;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\menusettings\Menu;
class MenuController extends Controller
{
  public function __construct()
{
    $this->middleware('auth');
}
    public function index(){
      if(Role::checkAdmin()==1){
            $sidebarMenu=Role::getAllMenu();
       }else{
          $sidebarMenu=Role::getMenu();
       }
       $accessStatus=Role::getAccessStatus();
       $result=\DB::select('SELECT vmenus.id as childid,vmenus.name as child,menus.name as parent,vmenus.url,vmenus.menuorder from menus INNER JOIN (SELECT * FROM `menus`) as vmenus ON vmenus.parentid=menus.id union ALL SELECT menus.id as childid,menus.name AS child,menus.name AS parent,menus.url,menus.menuorder FROM `menus` WHERE parentid=0 order by childid');
       return view('menusettings.menu.index',['sidebarMenu'=>$sidebarMenu,'result'=>$result,'accessStatus'=>$accessStatus]);
   }
   public function create(){
    $accessStatus=Role::getAccessStatus();
    if($accessStatus[2]==1){
      $sidebarMenu=Role::getMenu();
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
    return redirect('menu');
}
public function edit($id){
    $accessStatus=Role::getAccessStatus();
    if($accessStatus[4]==1){
        $sidebarMenu=Role::getMenu();
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
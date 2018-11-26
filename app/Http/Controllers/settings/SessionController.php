<?php
namespace App\Http\Controllers\settings;
use App\role\RoleHelper;
use App\Http\Controllers\Controller;
use App\settings\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{
  public function __construct()
{
    $this->middleware('auth');
}
    public function index(){
        $rh=new RoleHelper();
        $menuid=$rh->getMenuId('session');
        $sidebarMenu=$rh->getMenu();
        $permission=$rh->getPermission($menuid);
        $sessionList=Session::all();
        return view('settings.session.index',['sidebarMenu'=>$sidebarMenu,'permission'=>$permission,'result'=>$sessionList]);
    }
    public function create(){
        $rh=new RoleHelper();
        $menuid=$rh->getMenuId('session');
        $sidebarMenu=$rh->getMenu();
        $permission=$rh->getPermission($menuid);
        if($permission[2]==1){
            return view('settings.session.create',['sidebarMenu'=>$sidebarMenu]);
        }else{
           return redirect('session');
       }


   }
   public function store(Request $request){
    $aSession=new Session();
    $aSession->name=$request->name;
    $aSession->save();
    return redirect('session');
}
public function edit($id)
{
    $rh=new RoleHelper();
    $menuid=$rh->getMenuId('session');
    $sidebarMenu=$rh->getMenu();
    $permission=$rh->getPermission($menuid);
    if($permission[4]==1){
       $aSession=Session::findOrfail($id);
       return view('settings.session.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aSession]);
   }else{
      return redirect('session');
  }

}
public function update(Request $request, $id)
{
    $aSession=Session::findOrfail($id);
    $aSession->name=$request->name;
    $aSession->update();
    return redirect('session');
}
}
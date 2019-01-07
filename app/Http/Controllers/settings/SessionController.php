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
    $aMenu=$rh->getMenuId('session');
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
    if($rh->getRoleId()==1){
       $sessionList=\DB::table('sessions')
       ->join('institute', 'sessions.instituteid', '=', 'institute.id')
       ->select('sessions.id','institute.name AS instituteName','sessions.name')
       ->get();
    }else{
       $instituteId=$rh->getInstituteId($rh->getRoleId());
       $sessionList=$sessionList=\DB::table('sessions')
       ->join('institute', 'sessions.instituteid', '=', 'institute.id')
       ->select('sessions.id','institute.name AS instituteName','sessions.name')
       ->where('instituteid',$instituteId)
       ->get();
    }
    return view('settings.session.index',['sidebarMenu'=>$sidebarMenu,'permission'=>$permission,'result'=>$sessionList,'roleid'=>$rh->getRoleId()]);
  }
  public function create(){
     $rh=new RoleHelper();
    $aMenu=$rh->getMenuId('session');
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
    if($permission[2]==1){
      if($rh->getRoleId()==1){
        $instituteList=\DB::table('institute')
        ->select('id','name')
        ->get();
        return view('settings.session.create',['sidebarMenu'=>$sidebarMenu,'roleid'=>$rh->getRoleId(),'instituteList'=>$instituteList]);
      }else{
        $aInstitute=\DB::table('institute')
        ->select('id','name')
        ->where('userid',$rh->getUserId())
        ->first();
        return view('settings.session.create',['sidebarMenu'=>$sidebarMenu,'roleid'=>$rh->getRoleId(),'aInstitute'=>$aInstitute]);
      }
    }else{
     return redirect('session');
   }


 }
 public function store(Request $request){
    $aSession=new Session();
    $aSession->instituteid=$request->instituteid;
    $aSession->name=$request->name;
    $hasItem=\DB::table('sessions')
    ->select('sessions.*')
    ->where('instituteid',$aSession->instituteid)
    ->where('name',$aSession->name)
    ->exists();
    if(!$hasItem){
      $aSession->save();
    }else{
        // This item already assign
    }
  return redirect('session');
}
public function edit($id)
{
   $rh=new RoleHelper();
    $aMenu=$rh->getMenuId('session');
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
  if($permission[4]==1){
   $aSession=Session::findOrfail($id);
   if($rh->getRoleId()==1){
        $instituteList=\DB::table('institute')
        ->select('id','name')
        ->get();
        return view('settings.session.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aSession,'roleid'=>$rh->getRoleId(),'instituteList'=>$instituteList]);
      }else{
        $aInstitute=\DB::table('institute')
        ->select('id','name')
        ->where('userid',$rh->getUserId())
        ->first();
        return view('settings.session.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aSession,'roleid'=>$rh->getRoleId(),'aInstitute'=>$aInstitute]);
      }
 }else{
  return redirect('session');
}

}
public function update(Request $request, $id)
{
  $aSession=Session::findOrfail($id);
  $aSession->name=$request->name;
  $hasItem=\DB::table('sessions')
    ->select('sessions.*')
    ->where('instituteid',$aSession->instituteid)
    ->where('name',$aSession->name)
    ->exists();
    if(!$hasItem){
       $aSession->update();
    }else{
        // This item already assign
    }
  return redirect('session');
}
}
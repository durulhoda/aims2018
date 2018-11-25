<?php

namespace App\Http\Controllers\institutesettings;
use App\role\RoleHelper;
use App\institutesettings\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UnitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $rh=new RoleHelper();
        $menuid=$rh->getMenuId('unit');
        $sidebarMenu=$rh->getMenu();
        $permission=$rh->getPermission($menuid);
        $result=\DB::table('units')
        ->join('institute','units.instituteid','=','institute.id')
        ->select('units.*','institute.name as instituteName')->get();
        return view('institutesettings.unit.index',['sidebarMenu'=>$sidebarMenu,'result'=>$result,'permission'=>$permission]);
    }
    public function create(){
        $rh=new RoleHelper();
        $menuid=$rh->getMenuId('unit');
        $sidebarMenu=$rh->getMenu();
        $permission=$rh->getPermission($menuid);
        if($permission[2]==1){
            $institutes=\DB::table('institute')->get();
            return view('institutesettings.unit.create',['sidebarMenu'=>$sidebarMenu,'institutes'=>$institutes]);
        }else{
            return redirect('unit');
        }
        
    }
    public function store(Request $request){
    	$aBean=new Unit();
        $aBean->name=$request->name;
        $aBean->code=$request->code;
        $aBean->instituteid=$request->instituteid;
        $aBean->save();
        return redirect('unit');
    }
    public function edit($id){
      $rh=new RoleHelper();
        $menuid=$rh->getMenuId('unit');
        $sidebarMenu=$rh->getMenu();
        $permission=$rh->getPermission($menuid);
    if($permission[4]==1){
     $aBean=Unit::findOrfail($id);
     $institutes=\DB::table('institute')->get();
     return view('institutesettings.unit.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aBean,'institutes'=>$institutes]);
 }else{
    return redirect('unit');
}
}
public function update(Request $request, $id){
   $aBean=Unit::findOrfail($id);
   $aBean->name=$request->name;
   $aBean->code=$request->code;
   $aBean->instituteid=$request->instituteid;
   $aBean->update();
   return redirect('unit');
}
}

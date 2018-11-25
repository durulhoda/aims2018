<?php

namespace App\Http\Controllers\institutesettings;
use App\role\RoleHelper;
use App\institutesettings\Division;
use App\institutesettings\LocalGov;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LocalGovController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $rh=new RoleHelper();
        $menuid=$rh->getMenuId('localgov');
        $sidebarMenu=$rh->getMenu();
        $permission=$rh->getPermission($menuid);
        $result=\DB::table('localgovs')
        ->join('thanas','localgovs.thanaid','=','thanas.id')
        ->join('districts','thanas.districtid','=','districts.id')
        ->join('divisions','districts.divisionid','=','divisions.id')
        ->select('localgovs.*','divisions.name as divisionName','districts.name as districtName','thanas.name as thanaName')
        ->get();
        return view('institutesettings.localgov.index',['sidebarMenu'=>$sidebarMenu,'result'=>$result,'permission'=>$permission]);
    }
    public function create(){
       $rh=new RoleHelper();
        $menuid=$rh->getMenuId('localgov');
        $sidebarMenu=$rh->getMenu();
        $permission=$rh->getPermission($menuid);
    if($permission[2]==1){
        $divisions=\DB::table('divisions')->get();
        return view('institutesettings.localgov.create',['sidebarMenu'=>$sidebarMenu,'divisions'=>$divisions]);
    }else{
       return redirect('localgov');
   }
   
}
public function store(Request $request){
    $aBean=new LocalGov();
    $aBean->name=$request->name;
    $aBean->thanaid=$request->thanaid;
    $aBean->save();
    return redirect('localgov');
}
public function edit($id)
{
    $rh=new RoleHelper();
        $menuid=$rh->getMenuId('localgov');
        $sidebarMenu=$rh->getMenu();
        $permission=$rh->getPermission($menuid);
    if($permission[4]==1){
        $result=\DB::table('localgovs')
        ->join('thanas','localgovs.thanaid','=','thanas.id')
        ->join('districts','thanas.districtid','=','districts.id')
        ->join('divisions','districts.divisionid','=','divisions.id')
        ->select('localgovs.*','divisions.id as divisionid','districts.id as districtid','thanas.id as thanaid')
        ->where('localgovs.id','=',$id)
        ->get();
        $aBean=$result[0];
        $divisions=\DB::table('divisions')
        ->select('divisions.*')
        ->get();
        $districts=\DB::table('districts')
        ->where('districts.divisionid','=',$aBean->divisionid)
        ->get();
        $thanas=\DB::table('thanas')
        ->where('thanas.districtid','=',$aBean->districtid)
        ->get();
        return view('institutesettings.localgov.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aBean,'divisions'=>$divisions,'districts'=>$districts,'thanas'=>$thanas]);
    }else{
        return redirect('localgov');
    }
    
}
public function update(Request $request, $id)
{
 
    $aBean=LocalGov::findOrfail($id);
    $aBean->name=$request->name;
    $aBean->thanaid=$request->thanaid;
    $aBean->update();
    return redirect('localgov');
}
}

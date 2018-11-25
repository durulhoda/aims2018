<?php

namespace App\Http\Controllers\institutesettings;
use App\role\RoleHelper;
use App\institutesettings\District;
use App\institutesettings\Thana;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ThanaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
      $rh=new RoleHelper();
      $menuid=$rh->getMenuId('thana');
      $sidebarMenu=$rh->getMenu();
      $permission=$rh->getPermission($menuid);
    $result=\DB::table('thanas')
    ->join('districts','thanas.districtid','=','districts.id')
    ->join('divisions','districts.divisionid','=','divisions.id')
    ->select('thanas.*','divisions.name as divisionName','districts.name as districtName')->get();
    return view('institutesettings.thana.index',['sidebarMenu'=>$sidebarMenu,'result'=>$result,'permission'=>$permission]);
}
public function create(){
      $rh=new RoleHelper();
      $menuid=$rh->getMenuId('thana');
      $sidebarMenu=$rh->getMenu();
      $permission=$rh->getPermission($menuid);
    if($permission[2]==1){
        $divisions=\DB::table('divisions')->get();
        return view('institutesettings.thana.create',['sidebarMenu'=>$sidebarMenu,'divisions'=>$divisions]);
    }else{
        return redirect('thana');
    }
    
}
public function store(Request $request){
    $aBean=new Thana();
    $aBean->name=$request->name;
    $aBean->districtid=$request->districtid;
    $aBean->save();
    return redirect('thana');
}
public function edit($id)
{
     $rh=new RoleHelper();
      $menuid=$rh->getMenuId('thana');
      $sidebarMenu=$rh->getMenu();
      $permission=$rh->getPermission($menuid);
    if($permission[4]==1){
       $result=\DB::table('thanas')
       ->join('districts','thanas.districtid','=','districts.id')
       ->join('divisions','districts.divisionid','=','divisions.id')
       ->where('thanas.id','=',$id)
       ->select('thanas.*','divisions.id as divisionid')->get();
       $aBean=$result[0];
       $divisions=\DB::table('divisions')->get();
       $districts=\DB::table('districts')
       ->where('districts.divisionid','=',$aBean->divisionid)
       ->get();
       return view('institutesettings.thana.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aBean,'divisions'=>$divisions,'districts'=>$districts]);
   }else{
    return redirect('thana');
}

}
public function update(Request $request, $id)
{
    $aBean=Thana::findOrfail($id);
    $aBean->name=$request->name;
    $aBean->districtid=$request->districtid;
    $aBean->update();
    return redirect('thana');
}
}

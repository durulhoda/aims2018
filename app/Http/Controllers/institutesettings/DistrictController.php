<?php

namespace App\Http\Controllers\institutesettings;
use App\role\RoleHelper;
use App\institutesettings\Division;
use App\institutesettings\District;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
class DistrictController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $rh=new RoleHelper();
        $menuid=$rh->getMenuId('district');
        $hasMenu=$rh->hasMenu($menuid);
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$rh->getMenu();
        $permission=$rh->getPermission($menuid);
        $result=\DB::table('districts')
        ->join('divisions','districts.divisionid','=','divisions.id')
        ->select('districts.*','divisions.name as divisionName')->get();
        return view('institutesettings.district.index',['sidebarMenu'=>$sidebarMenu,'result'=>$result,'permission'=>$permission]);
    }
    public function create(){
        $rh=new RoleHelper();
        $menuid=$rh->getMenuId('district');
        $hasMenu=$rh->hasMenu($menuid);
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$rh->getMenu();
        $permission=$rh->getPermission($menuid);
    if($permission[2]==1){
        $divisions=\DB::table('divisions')->get();
        return view('institutesettings.district.create',['sidebarMenu'=>$sidebarMenu,'divisions'=>$divisions]);
    }else{
        return redirect('district');
    }
}
public function store(Request $request){
    $aBean=new District();
    $aBean->name=$request->name;
    $aBean->divisionid=$request->divisionid;
    $aBean->save();
    return redirect('district');
}
public function edit($id)
{
        $rh=new RoleHelper();
        $menuid=$rh->getMenuId('district');
        $hasMenu=$rh->hasMenu($menuid);
        if($hasMenu==false){
            return redirect('error');
        }
        $sidebarMenu=$rh->getMenu();
        $permission=$rh->getPermission($menuid);
    if($permission[4]==1){
       $aBean=District::findOrfail($id);
       $divisions=\DB::table('divisions')->get();
       return view('institutesettings.district.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aBean,'divisions'=>$divisions]);
   }else{
    return redirect('district');
}

}
public function update(Request $request, $id)
{
    $aBean=District::findOrfail($id);
    $aBean->name=$request->name;
    $aBean->divisionid=$request->divisionid;
    $aBean->update();
    return redirect('district');
}
}

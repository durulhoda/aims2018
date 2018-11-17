<?php

namespace App\Http\Controllers\institutesettings;
use App\Role;
use App\institutesettings\InstituteType;
use App\institutesettings\InstituteCatagory;
use App\institutesettings\InstituteSubCatagory;
use App\institutesettings\Institute;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InstituteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
       if(Role::checkAdmin()==1){
        $sidebarMenu=Role::getAllMenu();
    }else{
        $sidebarMenu=Role::getMenu();
    }
    $accessStatus=Role::getAccessStatus();
    $result=\DB::table('institute')
    ->join('institutetype','institute.institutetypeid','=','institutetype.id')
    ->join('institutecategory','institute.institutecategoryid','=','institutecategory.id')
    ->join('institutesubcategory','institute.institutesubcategoryid','=','institutesubcategory.id')
    ->join('thanas','institute.thanaid','=','thanas.id')
    ->join('postoffices','institute.postofficeid','=','postoffices.id')
    ->join('localgovs','institute.localgovid','=','localgovs.id')
    ->select('institute.*','institutetype.name as typeName','institutecategory.name as categoryName','institutesubcategory.name as subcatName','thanas.name as thanaName','postoffices.name as postofficeName','localgovs.name as localgovsName')
    ->get();
    return view('institutesettings.institute.index',['sidebarMenu'=>$sidebarMenu,'result'=>$result,'accessStatus'=>$accessStatus]);
}
public function create(){
    if(Role::checkAdmin()==1){
        $sidebarMenu=Role::getAllMenu();
    }else{
        $sidebarMenu=Role::getMenu();
    }
    $accessStatus=Role::getAccessStatus();
    if($accessStatus[2]==1){
        $instituteTypes=InstituteType::all();
        $instituteCategory=InstituteCatagory::all();
        $instituteSubCategory=InstituteSubCatagory::all();
        $divisions=\DB::table('divisions')->get();
        return view('institutesettings.institute.create',['sidebarMenu'=>$sidebarMenu,'instituteTypes'=>$instituteTypes,'instituteCategory'=>$instituteCategory,'instituteSubCategory'=>$instituteSubCategory,'divisions'=>$divisions]);
    }else{
        return redirect('institute');
    }
    
}
public function store(Request $request){
    $aBean=new Institute();
    $aBean->name=$request->name;
    $aBean->institutetypeid=$request->institutetypeid;
    $aBean->institutecategoryid=$request->institutecategoryid;
    $aBean->institutesubcategoryid=$request->institutesubcategoryid;
    $aBean->thanaid=$request->thanaid;
    $aBean->postofficeid=$request->postofficeid;
    $aBean->localgovid=$request->localgovid;
    $aBean->wordno=$request->wordno;
    $aBean->cluster=$request->cluster;
    $aBean->ein=$request->ein;
    $aBean->save();
    return redirect('institute');
}
public function edit($id){
    if(Role::checkAdmin()==1){
        $sidebarMenu=Role::getAllMenu();
    }else{
        $sidebarMenu=Role::getMenu();
    }
    $accessStatus=Role::getAccessStatus();
    if($accessStatus[4]==1){
        $result=\DB::table('institute')
        ->join('institutetype','institute.institutetypeid','=','institutetype.id')
        ->join('institutecategory','institute.institutecategoryid','=','institutecategory.id')
        ->join('institutesubcategory','institute.institutesubcategoryid','=','institutesubcategory.id')
        ->join('thanas','institute.thanaid','=','thanas.id')
        ->join('districts','thanas.districtid','=','districts.id')
        ->join('divisions','districts.divisionid','=','divisions.id')
        ->join('postoffices','institute.postofficeid','=','postoffices.id')
        ->join('localgovs','institute.localgovid','=','localgovs.id')
        ->select('institute.*','divisions.id as divisionid','districts.id as districtid')
        ->where('institute.id','=',$id)
        ->get();
        $aBean=$result[0];
        $instituteTypes=InstituteType::all();
        $instituteCategory=InstituteCatagory::all();
        $instituteSubCategory=InstituteSubCatagory::all();
        $divisions=\DB::table('divisions')
        ->select('divisions.*')
        ->get();
        $districts=\DB::table('districts')
        ->where('districts.divisionid','=',$aBean->divisionid)
        ->get();
        $thanas=\DB::table('thanas')
        ->where('thanas.districtid','=',$aBean->districtid)
        ->get();
        $postoffices=\DB::table('postoffices')
        ->where('postoffices.thanaid','=',$aBean->thanaid)
        ->get();

        $localgovs=\DB::table('localgovs')
        ->where('localgovs.thanaid','=',$aBean->thanaid)
        ->get();
        return view('institutesettings.institute.edit',['sidebarMenu'=>$sidebarMenu,'bean'=>$aBean,'instituteTypes'=>$instituteTypes,'instituteCategory'=>$instituteCategory,'instituteSubCategory'=>$instituteSubCategory,'divisions'=>$divisions,'districts'=>$districts,'thanas'=>$thanas,'postoffices'=>$postoffices,'localgovs'=>$localgovs]);
    }else{
        return redirect('institute');
    }
    
}
public function update(Request $request, $id)
{
    $aBean=Institute::findOrfail($id);
    $aBean->name=$request->name;
    $aBean->institutetypeid=$request->institutetypeid;
    $aBean->institutecategoryid=$request->institutecategoryid;
    $aBean->institutesubcategoryid=$request->institutesubcategoryid;
    $aBean->thanaid=$request->thanaid;
    $aBean->postofficeid=$request->postofficeid;
    $aBean->localgovid=$request->localgovid;
    $aBean->wordno=$request->wordno;
    $aBean->cluster=$request->cluster;
    $aBean->ein=$request->ein;
    $aBean->update();
    return redirect('institute');
}
}

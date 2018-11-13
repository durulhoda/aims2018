<?php

namespace App\Http\Controllers\institutesettings;
use App\Role;
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
         $dmenu=Role::getMenu();
        $accessStatus=Role::getAccessStatus();
     	$result=\DB::table('units')
        ->join('institute','units.instituteid','=','institute.id')
        ->select('units.*','institute.name as instituteName')->get();
        return view('institutesettings.unit.index',['dmenu'=>$dmenu,'result'=>$result,'accessStatus'=>$accessStatus]);
    }
    public function create(){
        $accessStatus=Role::getAccessStatus();
        if($accessStatus[2]==1){
            $dmenu=Role::getMenu();
            $institutes=\DB::table('institute')->get();
            return view('institutesettings.unit.create',['dmenu'=>$dmenu,'institutes'=>$institutes]);
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
          $accessStatus=Role::getAccessStatus();
        if($accessStatus[4]==1){
            $dmenu=Role::getMenu();
           $aBean=Unit::findOrfail($id);
           $institutes=\DB::table('institute')->get();
           return view('institutesettings.unit.edit',['dmenu'=>$dmenu,'bean'=>$aBean,'institutes'=>$institutes]);
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
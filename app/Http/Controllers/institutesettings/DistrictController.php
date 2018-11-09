<?php

namespace App\Http\Controllers\institutesettings;
use App\Role;
use App\institutesettings\Division;
use App\institutesettings\District;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DistrictController extends Controller
{
   public function index()
    {
        $accessStatus=Role::getAccessStatus();
    	$result=\DB::table('districts')
        ->join('divisions','districts.divisionid','=','divisions.id')
        ->select('districts.*','divisions.name as divisionName')->get();
        return view('institutesettings.district.index',['result'=>$result,'accessStatus'=>$accessStatus]);
    }
    public function create(){

         $accessStatus=Role::getAccessStatus();
        if($accessStatus[2]==1){
            $divisions=\DB::table('divisions')->get();
            return view('institutesettings.district.create',['divisions'=>$divisions]);
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
        $accessStatus=Role::getAccessStatus();
        if($accessStatus[4]==1){
         $aBean=District::findOrfail($id);
         $divisions=\DB::table('divisions')->get();
         return view('institutesettings.district.edit',['bean'=>$aBean,'divisions'=>$divisions]);
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

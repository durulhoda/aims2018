<?php

namespace App\Http\Controllers\institutesettings;

use App\institutesettings\Division;
use App\institutesettings\District;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DistrictController extends Controller
{
   public function index()
    {
    	$result=\DB::table('districts')
        ->join('divisions','districts.divisionid','=','divisions.id')
        ->select('districts.*','divisions.name as divisionName')->get();
        return view('institutesettings.district.index',['result'=>$result]);
    }
    public function create(){
        $divisions=\DB::table('divisions')->get();
    	return view('institutesettings.district.create',['divisions'=>$divisions]);
    }
    public function store(Request $request){
        $aObj=new District();
        $aObj->name=$request->name;
        $aObj->divisionid=$request->divisionid;
        $aObj->save();
        return redirect('district');
    }
    public function edit($id)
    {
         $aObj=District::findOrfail($id);
         $divisions=\DB::table('divisions')->get();
         return view('institutesettings.district.edit',['bean'=>$aObj,'divisions'=>$divisions]);
    }
     public function update(Request $request, $id)
    {
        $aObj=District::findOrfail($id);
        $aObj->name=$request->name;
        $aObj->divisionid=$request->divisionid;
        $aObj->update();
        return redirect('district');
    }
}

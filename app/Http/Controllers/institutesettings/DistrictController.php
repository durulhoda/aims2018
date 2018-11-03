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
        $aBean=new District();
        $aBean->name=$request->name;
        $aBean->divisionid=$request->divisionid;
        $aBean->save();
        return redirect('district');
    }
    public function edit($id)
    {
         $aBean=District::findOrfail($id);
         $divisions=\DB::table('divisions')->get();
         return view('institutesettings.district.edit',['bean'=>$aBean,'divisions'=>$divisions]);
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

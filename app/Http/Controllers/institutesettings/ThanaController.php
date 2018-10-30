<?php

namespace App\Http\Controllers\institutesettings;

use App\institutesettings\District;
use App\institutesettings\Thana;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ThanaController extends Controller
{
   public function index()
    {
        $result=\DB::table('thanas')
        ->join('districts','thanas.districtid','=','districts.id')
        ->join('divisions','districts.divisionid','=','divisions.id')
        ->select('thanas.*','divisions.name as divisionName','districts.name as districtName')->get();
        // dd($result);
        return view('institutesettings.thana.index',['result'=>$result]);
    }
    public function create(){
        $divisions=\DB::table('divisions')->get();
        return view('institutesettings.thana.create',['divisions'=>$divisions]);
    }
    public function store(Request $request){
        $aObj=new Thana();
        $aObj->name=$request->name;
        $aObj->districtid=$request->districtid;
        $aObj->save();
        return redirect('thana');
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

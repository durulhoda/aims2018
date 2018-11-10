<?php

namespace App\Http\Controllers\institutesettings;
use App\role;
use App\institutesettings\Division;
use App\institutesettings\PostOffice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostOfficeController extends Controller
{
     public function index()
    {
        $accessStatus=Role::getAccessStatus();
        $result=\DB::table('postoffices')
         ->join('thanas','postoffices.thanaid','=','thanas.id')
        ->join('districts','thanas.districtid','=','districts.id')
        ->join('divisions','districts.divisionid','=','divisions.id')
        ->select('postoffices.*','divisions.name as divisionName','districts.name as districtName','thanas.name as thanaName')
        ->get();
        return view('institutesettings.postoffice.index',['result'=>$result,'accessStatus'=>$accessStatus]);
    }
    public function create(){
         $accessStatus=Role::getAccessStatus();
         if($accessStatus[2]==1){
             $divisions=\DB::table('divisions')->get();
            return view('institutesettings.postoffice.create',['divisions'=>$divisions]);
         }else{
            return redirect('postoffice');
         }
        
    }
    public function store(Request $request){
        $aBean=new PostOffice();
        $aBean->name=$request->name;
        $aBean->thanaid=$request->thanaid;
        $aBean->save();
        return redirect('postoffice');
    }
    public function edit($id)
    {
         $accessStatus=Role::getAccessStatus();
         if($accessStatus[4]==1){
            $result=\DB::table('postoffices')
             ->join('thanas','postoffices.thanaid','=','thanas.id')
            ->join('districts','thanas.districtid','=','districts.id')
            ->join('divisions','districts.divisionid','=','divisions.id')
            ->select('postoffices.*','divisions.id as divisionid','districts.id as districtid','thanas.id as thanaid')
            ->where('postoffices.id','=',$id)
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
             return view('institutesettings.postoffice.edit',['bean'=>$aBean,'divisions'=>$divisions,'districts'=>$districts,'thanas'=>$thanas]);
         }else{
            return redirect('postoffice');
         }
    }
     public function update(Request $request, $id)
    {
       
        $aBean=PostOffice::findOrfail($id);
        $aBean->name=$request->name;
        $aBean->thanaid=$request->thanaid;
        $aBean->update();
        return redirect('postoffice');
    }
}

<?php

namespace App\Http\Controllers\institutesettings;
use App\Role;
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
        $dmenu=Role::getMenu();
        $accessStatus=Role::getAccessStatus();
        $result=\DB::table('thanas')
        ->join('districts','thanas.districtid','=','districts.id')
        ->join('divisions','districts.divisionid','=','divisions.id')
        ->select('thanas.*','divisions.name as divisionName','districts.name as districtName')->get();
        return view('institutesettings.thana.index',['dmenu'=>$dmenu,'result'=>$result,'accessStatus'=>$accessStatus]);
    }
    public function create(){
        $accessStatus=Role::getAccessStatus();
        if($accessStatus[2]==1){
            $dmenu=Role::getMenu();
            $divisions=\DB::table('divisions')->get();
            return view('institutesettings.thana.create',['dmenu'=>$dmenu,'divisions'=>$divisions]);
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
        $accessStatus=Role::getAccessStatus();
        if($accessStatus[4]==1){
            $dmenu=Role::getMenu();
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
             return view('institutesettings.thana.edit',['dmenu'=>$dmenu,'bean'=>$aBean,'divisions'=>$divisions,'districts'=>$districts]);
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

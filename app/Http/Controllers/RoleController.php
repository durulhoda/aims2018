<?php

namespace App\Http\Controllers;
use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(){
    	$result=Role::all();
 		return view('roleconfig.role.index',['result'=>$result]);
    }
    public function create(){
    	return view('roleconfig.role.create');
    }
    public function store(Request $request){
        if(isset($request->accesspower)){
            $accesspower=$request->accesspower;
            $sum=0;
            foreach ($accesspower as $key => $value) {
               $sum=$sum+$value;
            }
            // $hasSamePower=\DB::table('roles')
            // ->select('roles.*')
            // ->where('roles.accesspower','=',$sum)
            // ->get()->count();
            // if($hasSamePower==0){
                $aBean=new Role();
                $aBean->name=$request->name;
                $aBean->accesspower=$sum;
                $aBean->save();
            // }else{
            //     // dd($hasSamePower);
            // }
        }else{

        }
        return redirect('role');
    }
    public function edit($id){
    	$aBean=Role::findOrfail($id);
        $accesspowers=$aBean->accesspower;
        $bina=base_convert($accesspowers,10,2);
        $m=1;
        $access=array();
        while($bina>0) {
           $mr=$bina%10;
           $bina=$bina-$mr;
           $dr=$mr*$m;
           if($dr){
             $access[$dr]=$dr;
           }
           $m=$m*2;
           $bina=$bina/10;
        }
        // dd($access);
        return view('roleconfig.role.edit',['bean'=>$aBean,'access'=>$access]);
    }
    public function update(Request $request, $id){
        if(isset($request->accesspower)){
            $accesspower=$request->accesspower;
            $sum=0;
            foreach ($accesspower as $key => $value) {
               $sum=$sum+$value;
            }
            // $hasSamePower=\DB::table('roles')
            // ->select('roles.*')
            // ->where('roles.accesspower','=',$sum)
            // ->get()->count();
            // if($hasSamePower==0){
               $aBean=Role::findOrfail($id);
                $aBean->name=$request->name;
                $aBean->accesspower=$sum;
                $aBean->update();
            // }else{
            //     // dd($hasSamePower);
            // }
        }
        return redirect('role');
    }
}
                 

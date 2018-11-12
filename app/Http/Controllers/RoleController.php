<?php

namespace App\Http\Controllers;
use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct()
{
    $this->middleware('auth');
}
    public function index(){
         $dmenu=Role::getMenu();
       $accessStatus=Role::getAccessStatus();
       $result=Role::all();
       return view('roleconfig.role.index',['dmenu'=>$dmenu,'result'=>$result,'accessStatus'=>$accessStatus]);
   }
   public function create(){
    $accessStatus=Role::getAccessStatus();
    // dd($accessStatus);
    if($accessStatus[2]==1){
        $dmenu=Role::getMenu();
        return view('roleconfig.role.create',['dmenu'=>$dmenu,'accessStatus'=>$accessStatus]);
    }else{
       return redirect('role');
   }
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
    $accessStatus=Role::getAccessStatus();
    if($accessStatus[2]==1){
        $dmenu=Role::getMenu();
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
   return view('roleconfig.role.edit',['dmenu'=>$dmenu,'bean'=>$aBean,'access'=>$access]);
}else{

}
return redirect('role');
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


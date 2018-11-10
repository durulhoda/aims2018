<?php
namespace App\Http\Controllers\settings;
use App\Role;
use App\Http\Controllers\Controller;
use App\settings\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function index(){
        $accessStatus=Role::getAccessStatus();
        $result=Session::all();
        return view('settings.session.index',['result'=>$result,'accessStatus'=>$accessStatus]);
    }
    public function create(){
        $accessStatus=Role::getAccessStatus();
        if($accessStatus[2]==1){
            return view('settings.session.create');
        }else{
           return redirect('session');
       }


   }
   public function store(Request $request){
    $aBean=new Session();
    $aBean->name=$request->name;
    $aBean->save();
    return redirect('session');
}
public function edit($id)
{

    $accessStatus=Role::getAccessStatus();
    if($accessStatus[4]==1){
       $aBean=Session::findOrfail($id);
       return view('settings.session.edit',['bean'=>$aBean]);
   }else{
      return redirect('session');
  }

}
public function update(Request $request, $id)
{
    $aBean=Session::findOrfail($id);
    $aBean->name=$request->name;
    $aBean->update();
    return redirect('session');
}
}
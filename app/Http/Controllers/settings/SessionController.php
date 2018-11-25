<?php
namespace App\Http\Controllers\settings;
use App\role\RoleHelper;
use App\Http\Controllers\Controller;
use App\settings\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{
  public function __construct()
{
    $this->middleware('auth');
}
    public function index(){
        $dmenu=Role::getMenu();
        $accessStatus=Role::getAccessStatus();
        $result=Session::all();
        return view('settings.session.index',['dmenu'=>$dmenu,'result'=>$result,'accessStatus'=>$accessStatus]);
    }
    public function create(){
        $accessStatus=Role::getAccessStatus();
        if($accessStatus[2]==1){
          $dmenu=Role::getMenu();
            return view('settings.session.create',['dmenu'=>$dmenu]);
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
       $dmenu=Role::getMenu();
       $aBean=Session::findOrfail($id);
       return view('settings.session.edit',['dmenu'=>$dmenu,'bean'=>$aBean]);
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
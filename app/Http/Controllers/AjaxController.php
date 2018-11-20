<?php

namespace App\Http\Controllers;
use App\Role;
use Illuminate\Http\Request;
use App\settings\Program;
class AjaxController extends Controller
{
  
 public function getPrograms(Request $request){
    $id = $request->id;
    $query="SELECT * FROM  programs where groupid=?";
    $result=\DB::select($query,[$id]);
    $prglvlList = "";
    foreach ($result as $key => $value) {
     $prglvlList .=  "<option value=\"".$value->id."\">".$value->name."</option>";
   }
   echo "<option value=\"\">Select</option>" . $prglvlList;
  }
  public function getGroupByLevel(Request $request){
    $id = $request->id;
    $query="SELECT * FROM  groups where programlevelid=?";
    $result=\DB::select($query,[$id]);
    $prglvlList = "";
    foreach ($result as $key => $value) {
     $prglvlList .=  "<option value=\"".$value->id."\">".$value->name."</option>";
   }
   echo "<option value=\"\">Select</option>" . $prglvlList;
  }
  public function getCourse(Request $request){
     $id = $request->id;
     $query="SELECT * FROM  subjectcodes where id=?";
     $result=\DB::select($query,[$id]);
     foreach($result as $key => $value){
      echo $value->name;
     }
  }
  public function getDistbydivision(Request $request){
     $id = $request->id;
    $query="SELECT * FROM  districts where divisionid=?";
    $result=\DB::select($query,[$id]);
    $prglvlList = "";
    foreach ($result as $key => $value) {
     $prglvlList .=  "<option value=\"".$value->id."\">".$value->name."</option>";
   }
   echo "<option value=\"\">Select</option>" . $prglvlList;
  }
  public function getThanabydistrict(Request $request){
     $id = $request->id;
    $query="SELECT * FROM  thanas where districtid=?";
    $result=\DB::select($query,[$id]);
    $prglvlList = "";
    foreach ($result as $key => $value) {
     $prglvlList .=  "<option value=\"".$value->id."\">".$value->name."</option>";
   }
   echo "<option value=\"\">Select</option>" . $prglvlList;
  }
    public function getPostOfficebyThana(Request $request){
     $id = $request->id;
    $query="SELECT * FROM  postoffices where thanaid=?";
    $result=\DB::select($query,[$id]);
    $prglvlList = "";
    foreach ($result as $key => $value) {
     $prglvlList .=  "<option value=\"".$value->id."\">".$value->name."</option>";
   }
   echo "<option value=\"\">Select</option>" . $prglvlList;
  }
   public function getUnionbyThana(Request $request){
     $id = $request->id;
    $query="SELECT * FROM  localgovs where thanaid=?";
    $result=\DB::select($query,[$id]);
    $prglvlList = "";
    foreach ($result as $key => $value) {
     $prglvlList .=  "<option value=\"".$value->id."\">".$value->name."</option>";
   }
   echo "<option value=\"\">Select</option>" . $prglvlList;
  }
  public function index1(Request $request){
    $id = $request->id;
    dd($id);
}
public function rolePower(Request $request){
                  $option=array();
                  $option[1]="Read";
                  $option[2]="create";
                  $option[4]="Up";
                  $option[8]="del";
                  $option[16]="Print";
                  $option[32]="Down";
                  $id=$request->id;
                  $rolecreatorid=$request->rolecreatorid;
                  $rolepower=$this->getRolePower($rolecreatorid);
                  $aBean=Role::findOrfail($id);
                  $accesspowers=$aBean->accesspower;
                  $access=$this->getBinaryPositionValue($accesspowers);
                  $value=array();
                  foreach($rolepower['accessPower'] as $val) {
                    $value[$val]=(isset($access[$val])? $access[$val]:0);
                  }
                  // dd($rolepower['accessPower']);
    $result=\DB::select("select parentrolemenu.menu_id, IFNULL(childrolemenu.menu_id,0) AS id, parentrolemenu.menuName, parentrolemenu.url, parentrolemenu.parentid, parentrolemenu.menuorder FROM(SELECT roles.id as parentroleid,roles.name AS roleName,roles.rolecreatorid,roles.instituteid,roles.accesspower,menus.id AS menu_id,menus.name AS menuName,menus.url,menus.parentid,menus.menuorder from roles INNER JOIN role_menu on roles.id=role_menu.role_id INNER JOIN menus ON role_menu.menu_id=menus.id WHERE roles.id=?) AS parentrolemenu left JOIN (SELECT roles.id as childroleid,roles.name AS roleName,roles.rolecreatorid,roles.instituteid,roles.accesspower,menus.id AS menu_id,menus.name AS menuName from roles INNER JOIN role_menu on roles.id=role_menu.role_id INNER JOIN menus ON role_menu.menu_id=menus.id WHERE roles.id=?) AS childrolemenu ON parentrolemenu.menu_id=childrolemenu.menu_id",[$rolecreatorid,$id]);
    $output="<div class='form-group col-sm-12'>"."<label>Access power  :</label><br/>";
    foreach ($rolepower['accessPower'] as $val) {
      if($value[$val]==$val){
       $output.="<input type='checkbox' checked  name='accesspower[]' value='".$val."'> ".$option[$val]."&nbsp;&nbsp";
      }else{
         $output.="<input type='checkbox'  name='accesspower[]' value='".$val."'> ".$option[$val]."&nbsp;&nbsp";
      }
    }
    $output.="</div>";
    foreach ($result as $aObj){
    $output.="<div class='form-group col-sm-3'><div class='checkbox'>";
    if($aObj->id==0){
      $output.="<label><input type='checkbox'  name='menu_id[]' value='".$aObj->menu_id."'>".$aObj->menuName."</label>";
    }else{
      $output.="<label><input type='checkbox' checked  name='menu_id[]' value='".$aObj->menu_id."'>".$aObj->menuName."</label>";
    }
    $output.="</div></div>";
    }
   echo  $output;
   }
    private function getRolePower($roleid){
    $rolepower=array();
    $accessPower=\DB::select("SELECT roles.id,roles.name AS roleName,roles.accesspower
FROM roles
WHERE roles.id=?",[$roleid])[0]->accesspower;
    $menusAccess=\DB::select("SELECT roles.id,roles.name AS roleName,roles.accesspower,
IFNULL(vmenus.menu_id,0) as menu_id,
IFNULL(vmenus.menuName,'No Selected') as menuName
FROM roles
left JOIN (SELECT role_menu.role_id,role_menu.menu_id,menus.name AS menuName from role_menu
INNER JOIN menus ON role_menu.menu_id=menus.id) as vmenus on vmenus.role_id=roles.id
WHERE roles.id=?",[$roleid]);
    $accessPower=$this->getBinaryPositionValue($accessPower);
    $rolepower['accessPower']=$accessPower;
    $rolepower['menusAccess']=$menusAccess;
    return $rolepower;
  }
  private function getBinaryPositionValue($accesspowers){
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
      return $access;
  }
}

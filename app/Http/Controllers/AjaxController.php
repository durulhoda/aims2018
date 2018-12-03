<?php

namespace App\Http\Controllers;
use App\Role;
use App\role\RoleHelper;
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
public function getOwnRole(Request $request){
  $id = $request->id;
  dd($id);
  $output="<div>Hello</div>";
  echo  $output;
}
public function createRolePower(Request $request){
 $rolecreatorid=$request->rolecreatorid;
 $rh=new RoleHelper();
 $menuListByRoleId=$rh->getFilterMenuListByRole($rolecreatorid);
 $permissionNameList=$rh->getPermissionNamebyLevel();
 // dd($menuListByRoleId);
 $output="<div class='col-md-12'>";
  $output.="<ul class='role_menu'>";
  foreach($menuListByRoleId as $x){
     if($x['item']->parentid==0){
        $output.="<li>";
          $xid=$x['item']->id;
          $xname=$x['item']->menuName;
          $output.="<label><input type='checkbox' name='menuid[]' value='$xid'>$xname</label>";
        $output.="<ul>";
        foreach($menuListByRoleId as $y){
          if($x['item']->id==$y['item']->parentid){
          $yid=$y['item']->id;
          $yname=$y['item']->menuName;
          $output.="<li>";
          $output.="<div class='menu'>";
          $output.="<label><input type='checkbox' name='menuid[]' value='$yid'>$yname</label>";
          $output.="</div>";
          $output.="<div class='permission'>";
             foreach($y['binaryPositionValue'] as $bpv){
               $permissionvalue="permissionvalue_".$y['item']->id."[]";
               $output.="<label><input type='checkbox'  name='$permissionvalue' value='$bpv'>$permissionNameList[$bpv] &nbsp;&nbsp;</label>";
             }
          $output.="</div>";
          $output.=" <div style='clear: both;''></div>";
          $output.="</li>";
        }
        }
        $output.="</ul>";
        $output.="</li>";
     }
  }
  $output.="</ul>";
  $output.="</div>"; 
  echo  $output;
}
public function editRolePower(Request $request){
  $id=$request->id;
  $parentid=$request->rolecreatorid;
  $rh=new RoleHelper();
  $menuListByRoleId=$rh->getRoleEditMenuList($parentid,$id);
  $permissionNameList=$rh->getPermissionNamebyLevel();
  $output="<div class='col-md-12'>";
  $output.="<ul class='role_menu'>";
  foreach($menuListByRoleId as $x){
     if($x['item']->parentid==0){
        $output.="<li>";
          $xid=$x['item']->id;
          $xname=$x['item']->menuName;
        if($x['item']->cmenuid!=0){
           $output.="<label><input type='checkbox' checked name='menuid[]' value='$xid'>$xname</label>";
        }else{
          $output.="<label><input type='checkbox' name='menuid[]' value='$xid'>$xname</label>";
        }
        $output.="<ul>";
        foreach($menuListByRoleId as $y){
          if($x['item']->id==$y['item']->parentid){
          $yid=$y['item']->id;
          $yname=$y['item']->menuName;
          $output.="<li>";
           $output.="<div class='menu'>";
           if($y['item']->cmenuid!=0){
              $output.="<label><input type='checkbox' checked name='menuid[]' value='$yid'>$yname</label>";
           }else{
              $output.="<label><input type='checkbox' name='menuid[]' value='$yid'>$yname</label>";
           }
          $output.="</div>";
          $output.="<div class='permission'>";
             foreach($y['parentPositionValue'] as $bpv){
               $permissionvalue="permissionvalue_".$y['item']->id."[]";
               if($y['meargeResult'][$bpv]!=0){
                  $output.="<label><input type='checkbox' checked name='$permissionvalue' value='$bpv'>$permissionNameList[$bpv] &nbsp;&nbsp;</label>";
               }else{
                  $output.="<label><input type='checkbox' name='$permissionvalue' value='$bpv'>$permissionNameList[$bpv] &nbsp;&nbsp;</label>";
               }
             }
          $output.="</div>";
          $output.=" <div style='clear: both;''></div>";
          $output.="</li>";
        }
        }
        $output.="</ul>";
        $output.="</li>";
     }
  }
  $output.="</ul>";
  $output.="</div>"; 
  echo  $output;
 }
}

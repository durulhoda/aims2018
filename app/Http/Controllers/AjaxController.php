<?php

namespace App\Http\Controllers;

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
}

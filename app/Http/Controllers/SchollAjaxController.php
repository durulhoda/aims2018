<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SchollAjaxController extends Controller
{
   // By Only Id
	public function getValue(Request $request)
	{
		$option=$request->option;
		$idvalue=$request->idvalue;
		$methodid=$request->methodid;
		if($option=="divisionToDistrict"){
			if($methodid==1){
				$this->getDistrict($idvalue);
			}elseif($methodid==2){
				$this->getThana($idvalue);
			}elseif($methodid==3){
				$this->getPostOffice($idvalue);
			}elseif($methodid==4){
				$this->getlocalgov($idvalue);
			}
		}elseif($option=="districtToThana"){
			if($methodid==1){
				$this->getThana($idvalue);
			}elseif ($methodid==2) {
				$this->getPostOffice($idvalue);
			}elseif ($methodid==3) {
				$this->getlocalgov($idvalue);
			}	
		}elseif($option=="thanaToPostoffice"){
			if($methodid==1){
				$this->getPostOffice($idvalue);
			}elseif ($methodid==2) {
				$this->getlocalgov($idvalue);
			}	
		}elseif($option=="divisionToDistrict2"){
			if($methodid==1){
				$this->getDistrict($idvalue);
			}elseif($methodid==2){
				$this->getThana($idvalue);
			}elseif($methodid==3){
				$this->getPostOffice($idvalue);
			}elseif($methodid==4){
				$this->getlocalgov($idvalue);
			}
		}elseif($option=="districtToThana2"){
			if($methodid==1){
				$this->getThana($idvalue);
			}elseif ($methodid==2) {
				$this->getPostOffice($idvalue);
			}elseif ($methodid==3) {
				$this->getlocalgov($idvalue);
			}	
		}elseif($option=="thanaToPostoffice2"){
			if($methodid==1){
				$this->getPostOffice($idvalue);
			}elseif ($methodid==2) {
				$this->getlocalgov($idvalue);
			}	
		}
	}
	private function getDistrict($divisionid){
		$sql="SELECT * FROM `districts` WHERE `divisionid`=?";
		$result=\DB::select($sql,[$divisionid]);
		$output="<option value=''>SELECT</option>";
		foreach($result as $x){
			$output.="<option value='$x->id'>$x->name</option>";
		}
		echo  $output;
	}
	private function getThana($districtid){
		$sql="SELECT * FROM `thanas` WHERE `districtid`=?";
		$result=\DB::select($sql,[$districtid]);
		$output="<option value=''>SELECT</option>";
		foreach($result as $x){
			$output.="<option value='$x->id'>$x->name</option>";
		}
		echo  $output;
	}
	private function getPostOffice($thanaid){
		$sql="SELECT * FROM `postoffices` WHERE `thanaid`=?";
		$result=\DB::select($sql,[$thanaid]);
		$output="<option value=''>SELECT</option>";
		foreach($result as $x){
			$output.="<option value='$x->id'>$x->name</option>";
		}
		echo  $output;
	}
	private function getlocalgov($thanaid){
		$sql="SELECT * FROM `localgovs` WHERE `thanaid`=?";
		$result=\DB::select($sql,[$thanaid]);
		$output="<option value=''>SELECT</option>";
		foreach($result as $x){
			$output.="<option value='$x->id'>$x->name</option>";
		}
		echo  $output;
	}
	// ===================By Institute Id=============
	public function getValueWithIstitute(Request $request){
		$option=$request->option;
		$instituteid=$request->instituteid;
		$idvalue=$request->idvalue;
		$methodid=$request->methodid;
		if($option=="admissionsessiontoall"){
			if($methodid==1){
				$this->getProgramOnSession($instituteid,$idvalue);
			}elseif($methodid==2){
				$this->getGroupOnProgram($instituteid,0,$idvalue);
			}elseif($methodid==3){
				$this->getMediumOnSession($instituteid,$idvalue);
			}elseif($methodid==4){
				$this->getProgramOnSession($instituteid,$idvalue);
			}
		}
	}
	// For Admission Form View 
  private function getProgramOnSession($instituteid,$sessionid){
    $sql="SELECT programs.* FROM(SELECT * FROM `programoffer`
WHERE instituteid =? AND sessionid=? GROUP BY programid) AS t1
INNER JOIN programs ON t1.programid=programs.id";
    $result=\DB::select($sql,[$instituteid,$sessionid]);
     $output="<option value=''>SELECT</option>";
      foreach($result as $x){
        $output.="<option value='$x->id'>$x->name</option>";
      }
      echo  $output;
  }
  private function getGroupOnProgram($instituteid,$sessionid,$programid){
      $sql="SELECT groups.* FROM(SELECT * FROM `programoffer`
WHERE instituteid =? AND sessionid=? AND programid=? GROUP BY groupid) AS t1
INNER JOIN groups ON t1.groupid=groups.id";
      $result=\DB::select($sql,[$instituteid,$sessionid,$programid]);
     $output="<option value=''>SELECT</option>";
      foreach($result as $x){
        $output.="<option value='$x->id'>$x->name</option>";
      }
      echo  $output;
  }
  private function getMediumOnSession($instituteid,$sessionid){
    $sql="SELECT mediums.* FROM(SELECT * FROM `programoffer`
WHERE instituteid =? AND sessionid=? GROUP BY mediumid) AS t1
INNER JOIN mediums ON t1.mediumid=mediums.id";
    $result=\DB::select($sql,[$instituteid,$sessionid]);
     $output="<option value=''>SELECT</option>";
      foreach($result as $x){
        $output.="<option value='$x->id'>$x->name</option>";
      }
      echo  $output;
  }
  private function getShiftOnSession($instituteid,$sessionid){
    $sql="SELECT shifts.* FROM(SELECT * FROM `programoffer`
WHERE instituteid =? AND sessionid=? GROUP BY shiftid) AS t1
INNER JOIN shifts ON t1.shiftid=shifts.id";
    $result=\DB::select($sql,[$instituteid,$sessionid]);
     $output="<option value=''>SELECT</option>";
      foreach($result as $x){
        $output.="<option value='$x->id'>$x->name</option>";
      }
      echo  $output;
  }
	// ===================By Institute Id And Session Id============= 
	public function getValueWithSession(Request $request){
		$option=$request->option;
		$instituteid=$request->instituteid;
		$sessionid=$request->sessionid;
		$idvalue=$request->idvalue;
		$methodid=$request->methodid;
		if($option=="programofferviewtogroup"){
			$this->getGroupOnProgram($instituteid,$sessionid,$idvalue);
		}
	}
}

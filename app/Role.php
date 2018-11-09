<?php

namespace App;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table='roles';
   	protected $fillable = ['name','accesspower','status'];

   	public static function getAccessStatus(){
   		$userid = Auth::user()->id;
   		$result=\DB::select('SELECT user_role.user_id,user_role.role_id,roles.name AS roleName,roles.accesspower FROM `user_role` 
INNER JOIN `roles` on user_role.role_id=roles.id
WHERE user_role.user_id=?',[$userid])[0];
   		$bina=base_convert($result->accesspower,10,2);
        $i=0;
        $access=array();
        while($bina>0) {
           $mr=$bina%10;
           $bina=$bina-$mr;
           $dr=$mr;
             $access[$i]=$dr;
           $bina=$bina/10;
           $i++;
        }
        $data[1]=(isset($access[0])? $access[0]:0);
        $data[2]=(isset($access[1])? $access[1]:0);
        $data[4]=(isset($access[2])? $access[2]:0);
        $data[8]=(isset($access[3])? $access[3]:0);
        $data[16]=(isset($access[4])? $access[4]:0);
        $data[32]=(isset($access[5])? $access[5]:0);
   		return $data;
   	}
}


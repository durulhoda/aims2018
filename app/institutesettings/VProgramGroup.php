<?php

namespace App\institutesettings;

use Illuminate\Database\Eloquent\Model;

class VProgramGroup extends Model
{
    protected $table="vprogram_group";
	protected $fillable = ['instituteid','sessionid','programid','groupid','status'];
}

<?php

namespace App\institutesettings;

use Illuminate\Database\Eloquent\Model;

class VProgramGroup extends Model
{
    protected $table="vprogramgroup";
	protected $fillable = ['programid','groupid','status'];
}

<?php

namespace App\institutesettings;

use Illuminate\Database\Eloquent\Model;

class AdmissionProgram extends Model
{
    protected $table="admissionprogram";
	protected $fillable = ['instituteid','sessionid','programid','groupid','mediumid','shiftid','status'];
}

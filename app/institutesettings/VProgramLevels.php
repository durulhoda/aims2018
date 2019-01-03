<?php

namespace App\institutesettings;

use Illuminate\Database\Eloquent\Model;

class VProgramLevels extends Model
{
    protected $table="vprogramlevels";
    protected $fillable = ['instituteid','sessionid','programid','programlevelid','status'];
}
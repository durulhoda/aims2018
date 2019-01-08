<?php

namespace App\institutesettings;

use Illuminate\Database\Eloquent\Model;

class VProgramLevel extends Model
{
	protected $table="vprogramlevels";
	protected $fillable = ['programlevelid','programid','status'];
}
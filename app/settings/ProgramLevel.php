<?php

namespace App\settings;

use Illuminate\Database\Eloquent\Model;

class ProgramLevel extends Model
{
	protected $table="programlevels";
    protected $fillable = ['instituteid','name','status'];
}

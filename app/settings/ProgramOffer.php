<?php

namespace App\settings;

use Illuminate\Database\Eloquent\Model;

class ProgramOffer extends Model
{
	protected $table='programoffer';
    protected $fillable = ['instituteid','sessionid','programid','groupid','mediumid','shiftid','status'];
}

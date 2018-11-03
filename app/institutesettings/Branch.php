<?php

namespace App\institutesettings;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
   	protected $table='branches';
   	protected $fillable = ['name','code','instituteid','status'];
}

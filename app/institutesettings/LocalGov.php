<?php

namespace App\institutesettings;

use Illuminate\Database\Eloquent\Model;

class LocalGov extends Model
{
    protected $table='localgovs';
   	protected $fillable = ['name','thanaid','status'];
}

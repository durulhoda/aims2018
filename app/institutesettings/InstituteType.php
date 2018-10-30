<?php

namespace App\institutesettings;

use Illuminate\Database\Eloquent\Model;

class InstituteType extends Model
{
    protected $table='institutetype';
   	protected $fillable = ['name','status'];
}

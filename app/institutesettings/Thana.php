<?php

namespace App\institutesettings;

use Illuminate\Database\Eloquent\Model;

class Thana extends Model
{
    protected $table='thanas';
   	protected $fillable = ['name','districtid','status'];
}

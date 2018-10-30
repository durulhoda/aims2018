<?php

namespace App\institutesettings;

use Illuminate\Database\Eloquent\Model;

class PostOffice extends Model
{
    protected $table='postoffices';
   	protected $fillable = ['name','thanaid','status'];
}

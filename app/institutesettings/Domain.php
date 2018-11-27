<?php

namespace App\institutesettings;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    protected $table='domains';
   	protected $fillable = ['name','instituteid','status'];
}

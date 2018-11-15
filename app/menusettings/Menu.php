<?php

namespace App\menusettings;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table='menus';
   	protected $fillable = ['name','url','parentid','menuorder','status'];
}

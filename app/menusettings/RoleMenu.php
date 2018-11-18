<?php

namespace App\menusettings;

use Illuminate\Database\Eloquent\Model;

class RoleMenu extends Model
{
    protected $table='role_menu';
    public $timestamps = false;
   	protected $fillable = ['role_id','menu_id'];
}

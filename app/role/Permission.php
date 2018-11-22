<?php

namespace App\role;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table='permissions';
    protected $fillable = ['name','level','status'];
}

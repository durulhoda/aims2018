<?php

namespace App\settings;

use Illuminate\Database\Eloquent\Model;

class Quota extends Model
{
    protected $table="quotas";
    protected $fillable = ['name','status'];
}

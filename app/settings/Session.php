<?php

namespace App\settings;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
     protected $fillable = ['name','instituteid','status'];
}

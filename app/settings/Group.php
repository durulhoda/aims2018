<?php

namespace App\settings;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
	protected $table="groups";
    protected $fillable = ['instituteid','name','status'];
}

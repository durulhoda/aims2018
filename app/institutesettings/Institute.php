<?php

namespace App\institutesettings;

use Illuminate\Database\Eloquent\Model;

class Institute extends Model
{
     protected $table='institute';
     protected $fillable = ['name','institutetypeid','institutecategoryid','institutesubcategoryid','divisionid','districtid','thanaid','postofficeid','localgovid','wordno','cluster','ein','institutecode','status'];
}

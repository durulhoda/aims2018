<?php

namespace App\school;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table='addresses';
    protected $fillable = ['instituteid','personid''addressgroupid','divisionid','districtid','thanaid','postofficeid','postcode','area','status'];
}

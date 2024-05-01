<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleAttr extends Model
{
    use HasFactory;

    protected $table = "vehicle_attributes";

    protected $guarded = [];

    public $timestamps = false;

    public function attribute()
    {
        return $this->hasOne(VehicleAttribute::class, 'id','attribute_id');
    }
}

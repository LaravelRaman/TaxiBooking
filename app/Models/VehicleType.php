<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vehicle;
use App\Models\VehiclePrice;

class VehicleType extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'vehicle_type_id','id');
    }
    public function price()
    {
        return $this->hasOne(VehiclePrice::class, 'vehicle_type_id','id');
    }
}

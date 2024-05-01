<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\VehicleType;
use App\Models\VehicleImage;

class Vehicle extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function VehicleTypes()
    {
        return $this->belongsTo(VehicleType::class,'vehicle_type_id');
    }
    public function VehicleImages()
    {
        return $this->hasMany(VehicleImage::class,'vehicle_id');
    }
    public function attrs()
    {
        return $this->hasMany(VehicleAttr::class, 'vehicle_id','id');
    }
}

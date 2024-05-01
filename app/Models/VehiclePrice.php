<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vehicle;

class VehiclePrice extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'vehicle_price';
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_manufacturer_id',
        'code',
        'name'
    ];

    public function manufacturer(){
        return $this->belongsTo(VehicleManufacturers::class, 'vehicle_manufacturer_id');
    }
}

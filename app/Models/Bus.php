<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Bus extends Model
{
    use HasApiTokens, HasFactory, SoftDeletes;

    protected $fillable = [
        'color',
        'manufacturer_id',
        'model_id',
        'plate_number',
        'vin_number',
        'chasis_number',
        'is_verified',
        'status',
        'loginid',
        'password'
    ];

    public function manufacturer(){
        return $this->belongsTo(VehicleManufacturers::class, 'manufacturer_id');
    }

    public function model(){
        return $this->belongsTo(VehicleModel::class, 'model_id');
    }

    public function trip(){
        return $this->hasMany(Trip::class, 'bus_id');
    }

    public function user(){
        return $this->hasMany(UserBus::class, 'bus_id');
    }

    public function destination(){
        return $this->hasMany(BusDestination::class, 'bus_id');
    }

    public function bus_load(){
        return $this->hasMany(BusLoad::class, 'bus_id');
    }

}

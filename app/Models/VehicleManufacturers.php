<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleManufacturers extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'image'
    ];

    public function models(){
        return $this->hasMany(VehicleModel::class, 'manufacturer_id');
    }
}

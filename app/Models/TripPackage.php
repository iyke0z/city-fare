<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TripPackage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'price',
        'count',
        'interval'
    ];

    public function users(){
        return $this->hasMany(TripPackageLog::class, 'package_id');
    }

    public function codes(){
        return $this->hasMany(PackageCodes::class, 'package_id');
    }
}

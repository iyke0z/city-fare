<?php

namespace App\Models;

use Facade\Ignition\Support\Packagist\Package;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageCodes extends Model
{
    use HasFactory;
    protected $fillable = [
        'package_id',
        'code',
        'is_used'
    ];

    public function package(){
        return $this->belongsTo(TripPackage::class, 'package_id');
    }


}

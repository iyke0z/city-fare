<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bonus extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "percentage",
        "expiry",
        "description"
    ];

    public function users(){
        return $this->hasMany(UserBonus::class, 'bonus_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserBonus extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'bonus_id',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bonus(){
        return $this->belongsTo(Bonus::class, 'bonus_id');
    }
}

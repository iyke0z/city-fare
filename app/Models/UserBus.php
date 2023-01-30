<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserBus extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'bus_id'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bus(){
        return $this->belongsTo(Bus::class, 'bus_id');
    }
}

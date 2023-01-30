<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserTrip extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_id',
        'trip_no',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}

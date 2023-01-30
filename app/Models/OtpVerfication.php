<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OtpVerfication extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'phone',
        'otp',
        'request_type',
        'is_verified',
        'is_registered',
        'expiry'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}

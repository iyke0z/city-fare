<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DriverDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'lisence_no',
        'issue_date',
        'expiry_date',
        'is_verified',
        'years_of_experience'
    ];

    public function driver(){
        return $this->belongsTo(User::class);
    }
}

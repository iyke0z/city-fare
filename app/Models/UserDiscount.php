<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserDiscount extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'discount_id'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function discount(){
        return $this->belongsTo(Discount::class, 'discount_id');
    }
}

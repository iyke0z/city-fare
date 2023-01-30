<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PayAsYouGoCodes extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['code', 'count', 'institution'];

    public function trips(){
        return $this->hasMany(Trip::class, 'payg_id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function institution(){
        return $this->belongsTo(User::class, 'institution');
    }

}

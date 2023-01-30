<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trip extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'payg_id',
        'bus_id',
        'trip_number',
        'start_longitude',
        'start_latitude',
        'finish_longitude',
        'finish_latitude',
        'units'
    ];

    public function passenger(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bus(){
        return $this->belongsTo(Bus::class, 'bus_id');
    }

    public function payg(){
        return $this->belongsTo(PayAsYouGoCodes::class, 'payg_id');
    }
}

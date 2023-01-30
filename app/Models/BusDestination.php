<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusDestination extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'bus_id',
        'bus_stop'
    ];

    public function bus(){
        return $this->belongsTo(Bus::class, 'bus_id');
    }

    public function busStop(){
        return $this->belongsTo(BusStop::class, 'bus_stop');
    }

}

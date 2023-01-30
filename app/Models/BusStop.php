<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusStop extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['state_id','longitude','latitude','common_name'];

    public function state(){
        return $this->belongsTo(State::class, 'state_id');
    }

    public function bus_destination(){
        return $this->hasMany(BusDestination::class, 'bus_stop');
    }
}

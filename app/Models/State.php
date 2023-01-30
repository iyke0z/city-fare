<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    public function bus_stop(){
        return $this->hasMany(BusStop::class, 'state_id');
    }
}

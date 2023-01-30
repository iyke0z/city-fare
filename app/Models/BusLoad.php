<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusLoad extends Model
{
    use HasFactory;
    protected $fillable = [
        'bus_id',
        'is_full'
    ];

    public function bus(){
        return $this->belongsTo(Bus::class, 'bus_id');
    }
}

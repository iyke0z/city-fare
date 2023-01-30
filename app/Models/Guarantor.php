<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guarantor extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'fullname',
        'nin',
        'email_address',
        'phone',
        'address'
    ];

    protected $hidden = ['nin'];

    public function user(){
        return $this->hasMany(UserGuarantor::class, 'guarantor_id');
    }
}

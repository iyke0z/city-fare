<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankDetails extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'account_number',
        'bank_id',
        'account',
        'user_id'
    ];

    public function bank(){
        return $this->belongsTo(Bank::class, 'bank_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}

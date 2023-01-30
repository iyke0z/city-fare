<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Log extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'user_id',
        'action',
        'acted_by'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function actionby(){
        return $this->belongsTo(User::class, 'acted_by');
    }
}

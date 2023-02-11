<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'phone',
        'email',
        'password',
        'account_type',
        'trip_count',
        'wallet_balance',
        'identity',
        'dob',
        'nin',
        'is_banned',
        'ban_start_date',
        'ban_end_date',
        'institution_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'nin'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function trip(){
        return $this->hasMany(Trip::class, 'user_id');
    }
    public function bank_details(){
        return $this->hasOne(BankDetails::class, 'user_id');
    }
    public function bonus(){
        return $this->hasMany(UserBonus::class, 'user_id');
    }
    public function discount(){
        return $this->hasMany(UserDiscount::class, 'user_id');
    }
    public function guarantor(){
        return $this->hasMany(UserGuarantor::class, 'user_id');
    }
    public function bus(){
        return $this->hasMany(UserBus::class, 'user_id');
    }
    public function otp(){
        // return $this->hasMany(OtpVerfication::class, 'user_id');
    }
    public function contact(){
        return $this->hasMany(ContactDetail::class, 'user_id');
    }
    public function transaction(){
        return $this->hasMany(Transaction::class, 'user_id');
    }
    public function logs(){
        return $this->hasMany(Log::class, 'user_id');
    }
    public function log_action(){
        return $this->hasMany(Log::class, 'acted_by');
    }
    public function driver_datail(){
        return $this->hasOne(DriverDetail::class, 'user_id');
    }
    public function package(){
        return $this->hasMany(TripPackageLog::class, 'user_id');
    }
    public function trip_units(){
        return $this->hasMany(UserTrip::class, 'user_id');
    }
    public function cards(){
        return $this->hasMany(PayAsYouGoCodes::class, 'user_id');
    }
    public function institution(){
        return $this->belongsTo(User::class, 'institution_id');
    }

}

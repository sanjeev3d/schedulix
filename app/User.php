<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\UserBusiness;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','role_id','image','password','status','email_verified_at','remember_token','unique_id','verify_email','verify_mobile',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function mybusiness()
    {
        return $this->hasOne('App\UserBusiness');
    }

    public function businessOtherDetail()
    {
        return $this->hasOne('App\BusinessOtherDetails');
    }

    public function businessId()
    {
        return $this->hasOne('App\UserBusiness','user_id','id');

    }
}

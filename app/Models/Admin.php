<?php

namespace App\Models;

use App\Http\Middleware\Authenticate;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;


class Admin extends Authenticatable implements MustVerifyEmailContract,JWTSubject
{
    use HasFactory, Notifiable,SoftDeletes;

    protected $table='admin';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    protected $fillable = [
        'username',
        'phone',
        'email',
        'password',
        'avatar',
        'open_id_wechat',
        'unionid_wechat',
        'open_id_mini',
        'token',
        'is_phone',
        'user_num',
        'pid',
        'is_info',
        'is_wx_up',
        'wechat',
        'email',
        'qq',
        'walk_num',
        'today_walk_num',
        'today_time',
        'lng',
        'lat',
        'login_time',
        'geographic',
        'invitation_code',
        'app_walk_num',
        'app_today_walk_num',
        'app_today_time'
    ];


    public function getJWTIdentifier()
    {
        // TODO: Implement getJWTIdentifier() method.
        return $this->getKey();
    }


    public function getJWTCustomClaims()
    {
        // TODO: Implement getJWTCustomClaims() method.
        return [];
    }
}

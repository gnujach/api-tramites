<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{

    use HasApiTokens, Notifiable, HasRoles;
    // use HasApiTokens, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
    public function images()
    {
        return $this->hasMany(UserImage::class);
        // return $this->hasMany('App\UserImage');
    }

    /**
     * Description, en esta relación observar que es otra relación con el 
     * modelo UserImage, solo que esta relación es uno a uno
     * y tomamos la última imagen que sea de tipo cover en el campo location
     */
    public function coverImage()
    {
        // return $this->hasOne(UserImage::class)
        return $this->hasOne('App\UserImage')
            ->orderByDesc('id')
            ->where('location', 'cover');
    }
    public function profileImage()
    {
        // return $this->hasOne(UserImage::class)
        return $this->hasOne('App\UserImage')
            ->orderByDesc('id')
            ->where('location', 'profile')
            ->withDefault(function ($userImage) {
                $userImage->path = 'storage/user-images/user_default.png';
            });
    }
}

<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Lumen\Auth\Authorizable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable, HasFactory, MustVerifyEmail,Notifiable;

    protected $guarded = [];

    const TYPE_ADMIN = 'admin';
    const TYPE_SUPER = 'super';
    const TYPE_USER = 'user';
    const TYPES = [self::TYPE_ADMIN,self::TYPE_SUPER,self::TYPE_USER];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];


    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function isNormal()
    {
        return $this->type == self::TYPE_USER;
    }

    public function isAdmin()
    {
        return $this->type == self::TYPE_ADMIN;
    }

    public function isSuper()
    {
        return $this->type == self::TYPE_SUPER;
    }
}

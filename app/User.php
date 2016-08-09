<?php

namespace App;

use App\Member;
use App\AppRole;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the members a user has
     */
    public function members()
    {
        return $this->hasMany(Member::class);
    }

    /**
     * Get the roles a user has
     */
    public function roles()
    {
        return $this->belongsToMany(AppRole::class, 'users_approles');
    }

}

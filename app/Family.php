<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Get all of the family's roles.
     */
    public function roles()
    {
        return $this->morphMany('App\Role', 'group');
    }

}

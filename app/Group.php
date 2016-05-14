<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    // protected $table = 'fellowship';

     /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

     /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['type'];

    // public $types;

    public function roles()
    {
        return $this->hasMany('App\Role');
    }

    public function members()
    {
        return $this->hasMany('App\Member');
    }

}

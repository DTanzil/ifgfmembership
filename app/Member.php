<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    
   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    public $table = "members";

    public function roles()
    {
        return $this->hasMany('App\Role');
    }

    public function groups()
    {
        return $this->hasMany('App\Group');
    }
}

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

     /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'birthdate'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'description' => 'array',
    ];


    public $table = "members";

    public function roles()
    {
        return $this->morphMany('App\Group', 'group');
        // return $this->morphToMany('App\MemberRole', 'group');
    }

    // public function groups()
    // {
    //     return $this->hasMany('App\Group');
    // }
}

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
    protected $fillable = ['name', 'description', 'email', 'status', 'gender', 'birthdate', 'image'];

     /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['birthdate'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'description' => 'array',
    ];

    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    // protected $dateFormat = 'U';

    public function roles()
    {
        return $this->morphMany('App\Group', 'group');
        // return $this->morphToMany('App\MemberRole', 'group');
    }
}

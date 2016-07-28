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
    protected $fillable = ['name', 'description'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'description' => 'array',
    ];
    
    /**
     * Get all of the family members.
     */
    public function members()
    {
        return $this->morphToMany('App\Member', 'group')->withPivot('title');
    }

}

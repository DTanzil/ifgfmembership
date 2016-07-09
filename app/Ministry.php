<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ministry extends Model
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
     * Get all of the icare roles.
     */
    public function roles()
    {
        return $this->morphToMany('App\Member', 'group')->withPivot('title');
    }
}

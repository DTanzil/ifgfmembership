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
    protected $fillable = ['name', 'detail', 'level', 'parent_ministry_id'];

    /*
     * Set timestamp to false
     */
    public $timestamps = false;

     /**
     * Get all of the ministry members.
     */
    public function members()
    {
        return $this->morphToMany('App\Member', 'group')->withPivot('title');
    }
}

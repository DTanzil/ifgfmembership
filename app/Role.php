<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['description', 'title', 'member_id'];


    /**
     * Get all of the owning group models.
     */
    public function group()
    {
        return $this->morphTo();
    }
}

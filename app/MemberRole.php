<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberRole extends Model
{

	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'members_roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'type', 'priority', 'maxlimit'];
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get all of the owning group models
     */
    public function families()
    {
        return $this->morphedByMany('App\Family', 'group');
    }

}

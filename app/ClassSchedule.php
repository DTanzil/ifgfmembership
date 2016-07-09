<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassSchedule extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = ['description', 'title', 'member_id', 'group_type', 'group_id'];


    /**
     * Get all of the owning imageable models.
     */
    public function lesson()
    {
        return $this->morphTo();
    }

    

}

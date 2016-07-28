<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['member_id'];
    
    /*
     * Set timestamp to false
     */
    public $timestamps = false;

    /**
     * Get the post that owns the comment.
     */
    public function classes()
    {
        return $this->belongsTo('App\ClassSchedules');
    }

}

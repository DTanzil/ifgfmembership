<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassSchedules extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['class_date', 'name'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['class_date'];

    /**
     * Get all of the owning imageable models.
     */
    public function lesson()
    {
        return $this->morphTo();
    }

    /**
     * Get the attendance for the class schedule.
     */
    public function attendance()
    {
        return $this->hasMany('App\Attendance');
    }

    /**
     * Get all of the corresponding teachers.
     */
    public function teachers()
    {
        return $this->morphToMany('App\Member', 'group');
    }


    

}

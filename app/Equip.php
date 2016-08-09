<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equip extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'equip';

     /**
     * Get all of the engage students.
     */
    public function students()
    {
        return $this->morphToMany('App\Member', 'group')->withPivot('description', 'title');
    }

    /**
     * Get all of the classes.
     */
    public function classes()
    {
        return $this->morphMany('App\ClassSchedules', 'lesson');
    }

    /**
     * Get all of the attendances for the class.
     */
    public function attendances()
    {
        return $this->hasManyThrough('App\Attendance', 'App\ClassSchedules', 'lesson_id', 'class_schedules_id');
    }

}

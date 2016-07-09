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
     * Get all of the icares that are assigned to this member
     */
    public function icare()
    {
        return $this->morphedByMany('App\Icare', 'group')->withPivot('title');
    }

    /**
     * Get all of the families that are assigned to this member
     */
    public function family()
    {
        return $this->morphedByMany('App\Family', 'group')->withPivot('title');
    }

    /**
     * Get all of the ministries that are assigned to this member
     */
    public function ministry()
    {
        return $this->morphedByMany('App\Ministry', 'group')->withPivot('title');
    }

    /**
     * Get all of engage classes assigned to this member
     */
    public function engage()
    {
        return $this->morphedByMany('App\Engage', 'discipleship')->withPivot('status');
    }

    // /**
    //  * Get all of engage classes assigned to this member
    //  */
    // public function classes()
    // {
    //     // return $this->morphedByMany('App\Engage', 'lesson', 'lessons', 'teacher_id', 'teacher_id');

    //     return $this->morphedByMany('App\Engage', 'lesson');

    //     // return $this->morphedByMany('App\Engage', 'lesson', 'lessons', 'lesson_id', 'teacher_id');
    // }




}

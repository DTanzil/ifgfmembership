<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Engage extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'engage';


	// *
	//  * The attributes that are mass assignable.
	//  *
	//  * @var array
	 
 //    protected $fillable = ['name', 'description'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'description' => 'array',
    // ];

     /**
     * Get all of the engage students.
     */
    public function students()
    {
        return $this->morphToMany('App\Member', 'discipleship')->withPivot('status');
    }


    /**
     * Get all of the staff member's photos.
     */
    public function classes()
    {
        return $this->morphMany('App\ClassSchedule', 'lesson');
    }

    // /**
    //  * Get all of the icare roles.
    //  */
    // public function lessons()
    // {
    //     return $this->morphToMany('App\Member', 'lesson');

    //     // return $this->morphToMany('App\Member', 'lesson', 'lessons', 'teacher_id');

    //     // return $this->morphToMany('App\Member', 'lesson', 'lessons', 'lesson_id', 'teacher_id'); // this work for getting teachers
    // }

    


}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Config;

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
        return $this->morphedByMany('App\Engage', 'group')->withPivot('description');

    }

    /**
     * Get all of engage classes taught by this member
     */
    public function teachings()
    {
        return $this->morphedByMany('App\ClassSchedules', 'group');
    }

    /**
     * Mark student as graduated if student has completed the bible study class
     * @param $classes number of classes attended
     */
    public function determineStudentStatus($classes = 0) 
    {
        $status = ($classes >= Config::get('constants.FINISH_ENGAGE')) ? "Graduated" : "Attending";
        return $status;
    }

    /**
     * Check whether member is verified as a member or still as visitor
     */
    public function isMember() 
    {
        if($this->approve_member === 1) return true;

        return $this->is_member;
    }

    /**
     * Check this member's bible study or discipleship involvement
     */
    public function checkStudentStatus()
    {
        $biblestudy = $this->engage;
        foreach ($biblestudy as $key => $class) {
            if($class->pivot->description == 'Graduated') return true;
        }
        return false;
    } 

    /**
     * Check this member's icare involvement
     */
    public function checkiCareStatus()
    {
        $icare = count($this->icare);
        return $icare >= 1;
    } 

    /**
     * Mark student as a member or a visitor (if false)
     * @param $membership membership status
     */
    public function approveMember($membership = false)
    {
        $this->is_member = $membership;
        $this->save();
    }
}

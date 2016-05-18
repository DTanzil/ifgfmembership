<?php

namespace App;

use App\Task;
use App\Member;
use App\AppRole;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get all of the tasks for the user.
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function members()
    {
        return $this->hasMany(Member::class);
    }






/**
 * Get the roles a user has
 */
public function roles()
{
    return $this->belongsToMany(AppRole::class, 'users_approles');
}

/**
 * Find out if User is an employee, based on if has any roles
 *
 * @return boolean
 */
public function isEmployee()
{
    $roles = $this->roles->toArray();
    return !empty($roles);
}

/**
 * Find out if user has a specific role
 *
 * $return boolean
 */
public function hasRole($check)
{
    return in_array($check, array_pluck($this->roles->toArray(), 'name'));
}

/**
 * Get key in array with corresponding value
 *
 * @return int
 */
private function getIdInArray($array, $term)
{
    foreach ($array as $key => $value) {
        if ($value == $term) {
            return $key;
        }
    }
    // return 'lalala';
    abort(403, 'WRONG! Unauthorized action.');
    return null;
    throw new UnexpectedValueException;
}

/**
 * Add roles to user to make them a concierge
 */
public function makeEmployee($title)
{
    $assigned_roles = array();

    // $array = array_pluck($array, 'developer.name');
    $roles = array_pluck(AppRole::all()->toArray(), 'name', 'id');
    // var_dump($roles);
    switch ($title) {
        case 'super_admin':
            // $assigned_roles[] = $this->getIdInArray($roles, 'edit_customer');
            // $assigned_roles[] = $this->getIdInArray($roles, 'delete_customer');
            $assigned_roles[] = $this->getIdInArray($roles, 'add_family');
        case 'admin':
            $assigned_roles[] = $this->getIdInArray($roles, 'edit_family');
        case 'concierge':
            $assigned_roles[] = $this->getIdInArray($roles, 'delete_family');
            break;
        default:
            // return 0;
            throw new \Exception("The employee status entered does not exist");
    }
    // var_dump($assigned_roles); die();
    $this->roles()->attach($assigned_roles);
}
















}

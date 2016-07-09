<?php

namespace App\Policies;

use App\User;
use App\Icare;
use Illuminate\Auth\Access\HandlesAuthorization;

class IcarePolicy
{
    use HandlesAuthorization;

    // *
    //  * Create a new policy instance.
    //  *
    //  * @return void
     
    // public function __construct()
    // {
    //     //
    // }

    /**
     * Determine if the given user can delete the given task.
     *
     * @param  User  $user
     * @param  Task  $task
     * @return bool
     */
    public function destroy(User $user, Family $family)
    {
        if($user->hasRole('edit_family')) {
            var_dump("YESS");
        }


        return $user->hasRole('edit_family');

    }

}

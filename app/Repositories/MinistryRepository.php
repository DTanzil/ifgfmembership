<?php

namespace App\Repositories;

use App\Repositories\MyRepository;

// class MemberRepository implements BaseRepositoryInterface
class MinistryRepository extends MyRepository
{

    // /**
    //  * Get all of the tasks for a given user.
    //  *
    //  * @param  User  $user
    //  * @return Collection
    //  */
    // public function forUser(User $user)
    // {
    //     // return Member::all();
    //     return Member::where('id', $user->id)
    //                 ->orderBy('created_at', 'asc')
    //                 ->get();
    // }

    // public function all()
    // {
    //     return Member::all();
    // }

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'App\Ministry';
    }

    function key()
    {
        return 'App%Ministry';
    }

    
    // function getMembers($famid)
    // {
        
    // }

}

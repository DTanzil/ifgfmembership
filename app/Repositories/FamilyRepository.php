<?php

namespace App\Repositories;

use App\User;
// use App\Member;
// use App\Group;
use App\Repositories\MyRepository;

// class MemberRepository implements BaseRepositoryInterface
class FamilyRepository extends MyRepository
{

    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        // return Member::all();
        return Member::where('id', $user->id)
                    ->orderBy('created_at', 'asc')
                    ->get();
    }

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
        return 'App\Family';
    }

    function key()
    {
        return 'App%Family';
    }

    
    // function getMembers($famid)
    // {
        
    // }

}

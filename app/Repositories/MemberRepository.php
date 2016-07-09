<?php

namespace App\Repositories;

use App\User;
use App\Member;
use App\Group;
use App\Family;
use App\Icare;
use App\Ministry;
use App\Repositories\MyRepository;

// class MemberRepository implements BaseRepositoryInterface
class MemberRepository extends MyRepository
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
        return 'App\Member';
    }

    function key()
    {
        return 'App%Member';
    }
    // function getAllGroups($id) {
        
    //     $groups = Group::where('member_id', $id)
    //                 ->orderBy('created_at', 'asc')
    //                 ->get();
    //     $activities = array('family' => array(), 'ministry' => array(), 'icare' => array());
    //     $family = Family::class;
    //     $icare = Icare::class;
    //     $ministry = Ministry::class;
     
    //     foreach ($groups as $key => $value) {
    //         $group = $value->group;
    //         $info = array('name' => $group->name, 'title' => $value->title, 'description' => $group->description);
    //         if($group instanceof $family) {
    //             $activities['family'][] = $info;
    //         } else if($group instanceof $icare) {
    //             $activities['icare'][] = $info;
    //         } else if($group instanceof $ministry) {
    //             $activities['ministry'][] = $info;
    //         } 
    //     }
    //     return $activities;
    // }
}

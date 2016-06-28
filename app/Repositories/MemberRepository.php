<?php

namespace App\Repositories;

use App\User;
use App\Member;
use App\Group;
use App\Family;
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

    function getAllGroups($id) {
        
        $groups = Group::where('member_id', $id)
                    ->orderBy('created_at', 'asc')
                    ->get();

        $activities = array();
        foreach ($groups as $key => $value) {
            $group = $value->group;
            // var_dump($group);
            // die();
            // var_dump(Family::class);
            // var_dump(is_a(Family::class, Family::class));
            $family = Family::class;
            $user = User::class;
            // var_dump($value->title);
            if($group instanceof $family) {
                $info = array('name' => $group->name, 'title' => $value->title, 'description' => $group->description);
                $activities['family'][] = $info;
            } else {
                // $info = array('name' => $group->name, 'title' => $value->title, 'description' => $group->name);
                // $activities['other'][] = $info;
            }
        }

        return $activities;

        return 'DANIA';
    }
}

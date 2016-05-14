<?php

namespace App\Repositories;

use App\User;
use App\Task;

class TaskRepository implements BaseRepositoryInterface
{
    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return Task::where('user_id', $user->id)
                    ->orderBy('created_at', 'asc')
                    ->get();
    }

    public function all()
    {

    }
}
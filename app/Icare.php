<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Icare extends Model
{
     /**
     * Get all of the icare roles.
     */
    public function roles()
    {
        return $this->morphMany('App\Role', 'group');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppRole extends Model
{
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'approles';

     /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    
    /**
     * Get users with a certain role
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'users_approles');
    }

}

<?php

namespace App\Repositories;

use App\Repositories\MyRepository;

class EngageRepository extends MyRepository
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'App\Engage';
    }

}

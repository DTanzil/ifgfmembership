<?php

namespace App\Repositories;

use App\Repositories\MyRepository;

class EstablishRepository extends MyRepository
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'App\Establish';
    }

    /**
     * Mark student as graduated if student has completed the requirement to pass
     * @param $classes number of classes attended
     */
    public function determineStudentStatus($classes = 0, $rule) 
    {
        $status = (count($classes) >= $rule['minimum']) ? "Graduated" : "Not Graduated"; 
        return $status;
    }
}

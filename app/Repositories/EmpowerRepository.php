<?php

namespace App\Repositories;

use App\Repositories\MyRepository;

class EmpowerRepository extends MyRepository
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'App\Empower';
    }

    /**
     * Mark student as graduated if student has completed the requirement to pass
     * @param $classes number of classes attended
     */
    public function determineStudentStatus($classes = 0, $rule) 
    {
    	$status = "Not Graduated";
    	$pass = !array_diff($rule['classes'], $classes);

    	// must attend the required sessions
    	if($pass) 
	        $status = (count($classes) >= $rule['minimum']) ? "Graduated" : "Not Graduated"; 
        return $status;
    }

}

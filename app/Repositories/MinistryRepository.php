<?php

namespace App\Repositories;

use App\Repositories\MyRepository;

class MinistryRepository extends MyRepository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'App\Ministry';
    }

    /**
     * Delete Ministry and all of its associated ministry
     */
    function deleteMyMinistry($base_id)
    {
    	$ministry_ids = \App\Ministry::where('parent_ministry_id', $base_id)->get();
	    foreach ($ministry_ids as $key => $value) {
	    	$id = $value->id;
		    $this->deleteMyMinistry($id);
		    $this->deleteMinistry($id);
	    }
	    $this->deleteMinistry($base_id);
    }

    /**
     * Delete a Ministry
     */
    function deleteMinistry($id)
    {
    	$item = \App\Ministry::find($id);

    	if($item) {
    		$item->members()->detach();
    		$item->delete();
    	}
    }

}

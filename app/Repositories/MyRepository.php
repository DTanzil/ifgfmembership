<?php 

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as App;

use App\Member;
use App\MemberRole;

// use App\Group;
// use App\Family;
// use App\Icare;
// use App\Ministry;

// use DB;

/**
 * Class Repository
 */
abstract class MyRepository implements BaseRepositoryInterface {

    /**
     * @var App
     */
    private $app;
 
    /**
     * @var
     */
    protected $model;
 
    /**
     * Model Table name
     */
    protected $model_table;

    /**
     * Model type
     */
    protected $model_type;

    /**
     * @param App $app
     */
    public function __construct(App $app) {
        $this->app = $app;
        $this->makeModel();
    }
 
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    abstract function model();
    
    /**
     * Get all members in the fellowship (Family,iCare, Ministry)
     *
     * @return mixed
     */
    public function getMyMembers(Model $mdl, $validRoles) {
        $members = array();
        foreach ($validRoles as $role => $limit) {
            $members[$role] = $mdl->members()->getQuery()->get()->filter(function ($mdl) use ($role) {
                return $mdl->title == $role;
            });
        }

        return $members;
    }

    /**
     * Get all valid roles in the fellowship (Family,iCare, Ministry)
     *
     * @return mixed
     */
    public function getValidRoles() {
        return MemberRole::where('type', $this->model())->orderBy('priority', 'asc')->lists('maxlimit', 'title'); 
    }

    /**
     * Get all registered members
     *
     * @return mixed
     */
    public function getAllMembers() {
        return Member::all();
    }



//     // get members and their ministry to display on a table
//     function dandan($fellowship_id) {
//         // $group = $this->model->find($fellowship_id);

//         $results = array();
        
//         $groups = Group::where('group_id', $fellowship_id)
//                     ->where('group_type', 'LIKE', $this->model_type)
//                     ->orderBy('created_at', 'asc')
//                     ->lists('title', 'member_id')->toArray();
//         // var_dump($groups); 
//         // die();
        
//         if(empty($groups)) return $results;

//         // find all roles of each member that belongs to one Icare/Family/Ministry
//         $ministries = DB::table('groups')
//                 ->select('groups.title', 'groups.member_id', 'ministries.name')
//                 ->join('ministries', function ($join) use ($groups) {
//                     $join->on("groups.group_id", '=', 'ministries.id')
//                          ->where('groups.group_type', 'LIKE', 'App%Ministry' )
//                           ->whereIn('groups.member_id', array_keys($groups));
//                 })
//                 ->groupBy('groups.member_id')
//                 ->orderBy('groups.member_id', 'asc')
//                 ->get();
        
// //         var_dump($ministries);
// // die();
//         foreach ($ministries as $key => $item) {
//             $member = Member::find($item->member_id);
//             // $member->groupid = $item->id;
//             $member->age = $member->birthdate->age;
//             $member->ministry = $item->name;
//             $member->title = $groups[$item->member_id];

//             if(array_key_exists($groups[$item->member_id], $results)) {
//                 //include in results
//                 array_push($results[$groups[$item->member_id]], $member);
//             } else {
//                 //create new key
//                 $results[$groups[$item->member_id]] = array($member);                
//             }
//             // array_push($results[$groups[$item->member_id]], $member);
//         }



//         // die();
//         // foreach ($groups as $item) {
//         //     // var_dump($roles);
//         //     // var_dump($roles->id);
//         //     $member = Member::find($item->member_id);
//         //     $member->groupid = $item->id;
//         //     $member->age = $member->birthdate->age;
            
//         //     if(array_key_exists($item->title, $results)) {
//         //         //include in results
//         //         array_push($results[$item->title], $member);
//         //     } else {
//         //         //create new key
//         //         $results[$item->title] = array($member);                
//         //     }
//         // }

//         // var_dump($group->roles);
//         // var_dump($results);
//         // die();

//         return $results;

//     }

    // get members and their ministry to display on a table
    // function getMembersData($groups = array('icare', 'family', 'ministry')) {
        
    //     $results = $this->model->orderBy('id', 'asc')->get(array('*'));

    //     // if(empty($groups)) return $results;

    //     foreach ($results as $member) {
            
    //         foreach ($member->icares as $icare) {                
    //             if(isset($member->icare)) {
    //                 $data = $member->icare;
    //                 $data .= ", ".$icare->name;
    //             } else {
    //                 $data = $icare->name;
    //             }
    //             $member->icare = $data;
    //         }

    //         // foreach ($member->ministry as $icare) {                
    //         //     if(isset($member->icare)) {
    //         //         $data = $member->icare;
    //         //         $data .= ", ".$icare->name;
    //         //     } else {
    //         //         $data = $icare->name;
    //         //     }
    //         //     $member->icare = $data;
    //         // }


    //         // foreach ($member->families as $fam) {                
    //         //     if(isset($member->family)) {
    //         //         $data = $member->family;
    //         //         array_push($data, $fam->name);
    //         //     } else {
    //         //         $data = array($fam->name);
    //         //     }
    //         //     $member->family = $data;
    //         // }            
    //     }
    //     return $results;
    // }

    // // get members and their ministry to display on a table
    // function getAMemberData($id, $groups = array('icare', 'family', 'ministry')) {
        
    //     $member = $this->model->where('id', $id)->orderBy('id', 'asc')->first();

    //     // if(empty($groups)) return $results;

    //     // foreach ($results as $member) {
            
    //         foreach ($member->icares as $icare) {                
    //             if(isset($member->icare)) {
    //                 $data = $member->icare;
    //                 $data .= ", ".$icare->name;
    //             } else {
    //                 $data = $icare->name;
    //             }
    //             $member->icare = $data;
    //         }

    //         // foreach ($member->ministry as $icare) {                
    //         //     if(isset($member->icare)) {
    //         //         $data = $member->icare;
    //         //         $data .= ", ".$icare->name;
    //         //     } else {
    //         //         $data = $icare->name;
    //         //     }
    //         //     $member->icare = $data;
    //         // }


    //         // foreach ($member->families as $fam) {                
    //         //     if(isset($member->family)) {
    //         //         $data = $member->family;
    //         //         array_push($data, $fam->name);
    //         //     } else {
    //         //         $data = array($fam->name);
    //         //     }
    //         //     $member->family = $data;
    //         // }            
    //     // }
    //     // var_dump($member->icare);
    //     return $member;
    // }




    // function getAllGroups($member_id) {
        
    //     $groups = Group::where('member_id', $member_id)
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

    // public function getMember($id, $role) {
    //     $group = $this->model->find($id);
    //     foreach ($group->roles as $roles) {
    //         if($roles->group_id == $id && $roles->title === $role && $roles->group_type == $this->model()) {
    //             $member = Member::find($roles->member_id);
    //             return $member;
    //         }
    //     }
    //     return null;
    // }




    /**
     * @param array $columns
     * @return mixed
     */
    public function all($columns = array('*')) {
        return $this->model->get($columns);
    }
 
    /**
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate($perPage = 15, $columns = array('*')) {
        return $this->model->paginate($perPage, $columns);
    }
 
    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data) {
        // return $this->model->insert($data);
        return $this->model->insertGetId($data);
    }
 
    /**
     * @param array $data
     * @param $id
     * @param string $attribute
     * @return mixed
     */
    public function update(array $data, $value, $attribute="id") {
        return $this->model->where($attribute, '=', $value)->update($data);
    }
 
    /**
     * @param $id
     * @return mixed
     */
    public function delete($id) {
        return $this->model->delete($id);
    }
 
    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = array('*')) {
        return $this->model->find($id, $columns);
    }
 
    /**
     * @param $attribute
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findBy($attribute, $value, $columns = array('*')) {
        return $this->model->where($attribute, '=', $value)->first($columns);
    }

    // /**
    //  * @param $attribute
    //  * @param $value
    //  * @return mixed
    //  */
    // public function findOrFail($id) {
    //     return $this->model->findOrFail($id);
    // }

     /**
     * @param $attribute
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findWhere($attribute, $value, $columns = array('*')) {
        return $this->model->where($attribute, $value)->get($columns);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     * @throws RepositoryException
     */
    public function makeModel() {
        $model = $this->app->make($this->model());
 
        if (!$model instanceof Model)
            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");

        $this->model_table = $model->getTable();
        $this->model_type = $this->key();

        return $this->model = $model->newQuery();
    }

     /**
     * @param $request
     * @param array $fields
     * @return $results
     * json_encode address, phone, meta data and store it in 'description' field   
     */
    public function castDescriptionField($request, $fields = array('phone', 'city', 'address', 'zipcode')) {

        // place other fields information into one array
        $results = array();
        foreach ($fields as $key => $value) {
            $results[$value] = $request->$value;
        }
        return json_encode($results);
    }

    /**
     * @param $values
     * @return $results
     * create associative array with the same value for its key and values    
     */
    public function castRoleField($validRoles) {

        if(empty($validRoles)) return array();

        $result = array_combine($validRoles->keys()->toArray(), $validRoles->keys()->toArray());
        return $result;
    }

}

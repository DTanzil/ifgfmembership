<?php 

namespace App\Repositories;

// use Bosnadev\Repositories\Contracts\RepositoryInterface;
// use Bosnadev\Repositories\Exceptions\RepositoryException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as App;
use App\Member;
use DB;
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
     * Get all members in the group (family,icare,bible study)
     *
     * @return mixed
     */
    public function getAllMembers($id) {
        $group = $this->model->find($id);

        $results = array();
        foreach ($group->roles as $roles) {
            // var_dump($roles);
            // var_dump($roles->id);
            $member = Member::find($roles->member_id);
            $member->groupid = $roles->id;
            $member->age = $member->birthdate->age;
            
            if(array_key_exists($roles->title, $results)) {
                //include in results
                array_push($results[$roles->title], $member);
            } else {
                //create new key
                $results[$roles->title] = array($member);                
            }
        }
        // var_dump($group->roles);
        // var_dump($results);
        // die();

        return $results;

    }

    public function getMember($id, $role) {
        $group = $this->model->find($id);
        foreach ($group->roles as $roles) {
            if($roles->group_id == $id && $roles->title === $role && $roles->group_type == $this->model()) {
                $member = Member::find($roles->member_id);
                return $member;
            }
        }
        return null;
    }




    /**
     * @param array $columns
     * @return mixed
     */
    public function all($columns = array('*'), $countMembers = false) {
        
        if($countMembers) {

            $model = $this->app->make($this->model());
            $model_table = $model->getTable();
            $model_key = $this->key();
            // get member
            $results = DB::table($model_table)
                ->select(DB::raw("$model_table.id, $model_table.name, groups.group_id, COUNT(groups.id) as member_count"))
                ->leftJoin('groups', function ($join) use ($model_table, $model_key) {
                    $join->on("$model_table.id", '=', 'groups.group_id')
                         ->where('groups.group_type', 'LIKE', $model_key );
                })
                ->groupBy("$model_table.id")
                ->get();
                
            return $results;
        } else {
            return $this->model->get($columns);
        }


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
    
    /**
     * @param $attribute
     * @param $value
     * @return mixed
     */
    public function findIfExist($attribute, $value) {
        //findOrFail(1)
        return $this->model->where($attribute, '=', $value)->exists();
    }


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

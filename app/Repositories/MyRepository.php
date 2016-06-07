<?php 

namespace App\Repositories;

// use Bosnadev\Repositories\Contracts\RepositoryInterface;
// use Bosnadev\Repositories\Exceptions\RepositoryException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as App;
use App\Member;

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
    public function all($columns = array('*')) {
         // $columns = array('name', 'gender');
        // $model = $this->model;
        // return $model::all();
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
     * @param array $columns
     * @return $familyinfo
     * json_encode address, phone, meta data and store it in 'description' field   
     */
    public function castDescriptionField($request, $columns = array('phone', 'city', 'address', 'zipcode')) {

        // place other fields information into one array
                    // $fields = ;
        $familyinfo = array();
        foreach ($columns as $key => $value) {
            $familyinfo[$value] = $request->$value;
        }

        return json_encode($familyinfo);
        // return $this->model->where($attribute, $value)->get($columns);
    }


}

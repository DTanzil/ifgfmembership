<?php 

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as App;
use App\Member;
use App\MemberRole;

/**
 * Class MyRepository
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
     * @return mixed
     */
    public function insert(array $data) {
        return $this->model->insert($data);
        // return $this->model->insertGetId($data);
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

    /**
     * @param $mdl
     * Get all members in the fellowship (Family, iCare, Ministry)
     * @return mixed
     */
    public function getMyMembers(Model $mdl) {
        $members = $mdl->members->groupBy(function($item){
            return $item->pivot->title;
        });
        return $members;
    }

     /**
     * @param $member_ids
     * Evaluate member's membership status
     * @return mixed
     */
    public function evaluateMembership($member_ids = array())
    {
        foreach ($member_ids as $key => $id) {
            $mbr = \App\Member::find($id);
            if($mbr->checkiCareStatus() && $mbr->checkStudentStatus()) 
            {
                $mbr->approveMember(true);
            } else {
                $mbr->approveMember(false);                
            }
        }
    }
    
    /**
     * Get all valid roles in the fellowship (Family,iCare, Ministry, Engage, etc)
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

    /**
     * Configure sync information for sync()
     *
     * @return mixed
     */
    public function configureSync($member_ids, $data) {
        $newids = array();
        foreach ($member_ids as $key => $id) {
            $newids[$id] = $data;
        }
        return $newids;
    }

    /**
     * Get Discipleship class attendance (Engage, Establish, Equip, Empower)
     *
     * @return mixed
     */
    function getClassAttendance($classes, $tableCols = array('name' => 'Name'))
    {
        $results = $class_attendance = array();
        foreach ($classes as $key => $class) {
            $attn = $class->attendance->lists('member_id', 'member_id')->toArray();
            $tableCols[$class->name] = $class->class_date->format('d M Y');
            foreach ($attn as $key => $value) {
                $class_attendance[$key][] = $class->name;                
            }
        }
        $tableCols['status'] = 'Status';
        $results['attendance'] = $class_attendance;
        $results['table'] = $tableCols;
        return $results;
    }

    /**
     * change easy to read date format to Y-m-d for database
     *
     * @return mixed
     */
    public function sanitizeDate($date) 
    {
        if(empty($date)) {
            return null;
        } else {
            $formattedDate = \Carbon\Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
            return $formattedDate;
        }
    }

}

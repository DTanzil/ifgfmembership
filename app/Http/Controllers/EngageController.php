<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Config;
use App\Repositories\EngageRepository as Engage;

class EngageController extends Controller
{

    /**
     * The model repository instance.
     *
     * @var EngageRepository
     */
    protected $baseModel;

    /**
     * The valid Icare roles instance.
     */
    protected $validRoles;
    
    /**
     * The default Icare role.
     */
    protected $defaultRole;
    
    /*
     * General title page
     */
    protected $title;

    /*
     * Classes name
     */
    protected $classes;

    /*
     * Model parameters from Route URL
     */
    protected $paramid;

    /*
     * Parameters for the URL
     */
    protected $paramrole;

    /*
     * Hidden input id name for the form
     */
    protected $hdninput;

    /*
     * Hidden input class id for the form
     */
    protected $hdncls;

    /*
     * Hidden input class name for the form
     */
    protected $hdncnm;


    /**
     * Create a new controller instance.
     *
     * @param  EngageRepository  $engage
     * @return void
     */
    public function __construct(Engage $engage)
    {
        $this->middleware('auth');
        $this->baseModel = $engage;
        $this->defaultRole = 'student';
        $this->paramid = 'eng';
        $this->paramrole = 'engrole';
        $this->paramclass = 'eclass';
        $this->hdninput = '_engid';
        $this->hdncls = '_cls';
        $this->hdncnm = '_cnm';
        $this->classes = Config::get('constants.ENGAGE_CLASSES');
        $this->title = array('header' => 'Engage', 'singular' => 'Engage');
        $this->validRoles = $this->baseModel->getValidRoles(); //get valid roles
    }

    /**
     * Show a list of all available items.
     *
     */
    public function index(Request $request)
    {   
        // assign start and end dates of instruction
        $results = $this->baseModel->all();
        foreach ($results as $key => $item) {
            $class_dates = $item->classes()->getQuery()->orderBy('class_date', 'asc')->get();
            if(count($class_dates) > 0) {
                $item->class_start = $class_dates[0]->class_date->format('d M Y');
                $item->class_end = $class_dates[count($class_dates) - 1]->class_date->format('d M Y');        
            }
        }

        $tableCols = array('name' => 'Name', 'student_count' => 'Number of Engage Students', 'class_start' => 'Start Date', 'class_end' => 'End Date');
        $urls = array(
            'add' => route('addengage'), 
            'delete' => route('deleteengage'), 
            'edit' => route('editengage'), 
            'view' => route('viewengage')
        );

        return view('members.index', 
            ['title' => $this->title, 'urls' => $urls, 'tableCols' => $tableCols, 'results' => $results, 'dlt_field' => $this->hdninput, 'dlt_act' => 'deleteEngage']
        );
    }

    /*
     * Add a new item
     */
    public function add(Request $request)
    {   
        return view('discipleship.add', 
            ['title' => $this->title, 'classes' => $this->classes, 'urls' => array('save' => route('saveengage'), 'cancel' => route('allengage')), 'dlt_act' => 'addEngage' ]
        );   
    }

    /*
     * Edit general information
     */
    public function edit(Request $request)
    {   
        $fellowship = $request->{$this->paramid};
        $fellowship_id = $fellowship->id;
        $tableCols = array('name' => 'Name');
       
        // get class attendance
        $results = $this->baseModel->getClassAttendance($fellowship->classes, $tableCols);
        $class_attendance = $results['attendance'];
        $tableCols = $results['table'];
        
        $urls = array(
            'add' => route('addengage'),
            'delete' => route('deleteicare'), 
            'view' => route('viewengage', ["$this->paramid" => $fellowship_id]),  
            'save' => route('saveengage'), 
            'cancel' => route('allengage'),
            'assign' => route('assignengrole', ["$this->paramid" => $fellowship_id]),
            'assignteacher' => route('assignengteacher', ["$this->paramid" => $fellowship_id]),
            'attend' => route('attendengage', ["$this->paramid" => $fellowship_id]),
            'update' => route('saveengage')
        );
        return view('discipleship.edit', 
            ['title' => $this->title, 'urls' => $urls, 'tableCols' => $tableCols, 'fellowship' => $fellowship,'role' => $this->defaultRole, 'class_attendance' => $class_attendance, 'order' => $this->validRoles, 'dlt_field' => $this->hdninput, 'dlt_act' => 'editEngage']
        );
    }


    /*
     * View detail
     * TODO: Print PDF option
     */
    public function view(Request $request)
    {
        $fellowship = $request->{$this->paramid};
        $fellowship_id = $fellowship->id;
        $tableCols = array('name' => 'Name');
        
        // get class attendance
        $results = $this->baseModel->getClassAttendance($fellowship->classes, $tableCols);
        $class_attendance = $results['attendance'];
        $tableCols = $results['table'];

        $validRoles = $this->baseModel->castRoleField($this->validRoles);
        $urls = array(
            'cancel' => route('editengage', ["$this->paramid" => $fellowship_id]), 
        );

        return view('discipleship.view', 
            ['title' => $this->title, 'tableCols' => $tableCols, 'urls' => $urls, 'fellowship' => $fellowship, 'class_attendance' => $class_attendance, 'order' => $validRoles]
        );
    }



    /*
     * Edit/Assign members to a role 
     */
    public function assign(Request $request)
    {
        // check if requested role is valid
        $fellowship_role = empty($request->{$this->paramrole}) ? $this->defaultRole : $request->{$this->paramrole};
        if(!array_key_exists($fellowship_role, $this->validRoles->toArray())) {
            return redirect()->route('allengage');    
        }

        $fellowship = $request->{$this->paramid};
        $fellowship_id = $fellowship->id;
        $results = $this->baseModel->getAllMembers();
        $tableCols = array('name' => 'Name', 'icare' => 'iCare', 'age' => 'Age', 'gender' => 'Gender');
        // get current members
        $current_members = $fellowship->students()->getQuery()->where('title', $fellowship_role)->get()->lists('member_id')->toArray(); 
        $urls = array(
            'save' => route('saveengage'), 
            'edit' => route('assignengrole', ["$this->paramid" => $fellowship_id]),
            'cancel' => route('editengage', ["$this->paramid" => $fellowship_id])
        );

        return view('discipleship.assign', 
            ['title' => $this->title, 'urls' => $urls, 'tableCols' => $tableCols, 'results' => $results, 'fellowship' => $fellowship, 'defaultrole' => $fellowship_role, 'current_members' => $current_members,'dlt_field' => $this->hdninput ]
        ); 
    }

    /*
     * Edit/Assign members as a teacher 
     */
    public function assignteacher(Request $request)
    {
        $fellowship_role = 'teacher';
        $class_name = $request->eclass;
        $fellowship = $request->{$this->paramid};
        $fellowship_id = $fellowship->id;
        $classes = $fellowship->classes->lists('id', 'name')->toArray();
        // check if requested class name is valid
        if(!array_key_exists($class_name, $classes)) {
            return redirect()->route('allengage');    
        }    

        $class_id = $classes[$class_name];
        $results = $this->baseModel->getAllMembers();
        $tableCols = array('name' => 'Name', 'icare' => 'iCare', 'age' => 'Age', 'gender' => 'Gender');
        // get current members
        $class = $fellowship->classes()->getQuery()->where('id', $class_id)->first();
        $current_members = $class->teachers->lists('id')->toArray();
     
        // get class schedule
        $dates = $fellowship->classes()->getQuery()->get()->each(function($item) {
            $item->date = $item->class_date->format('d M Y') . " (" . $item->name . ")";
        })->lists('date', 'name')->toArray();

        $urls = array(
            'save' => route('saveengage'), 
            'edit' => route('assignengteacher', ["$this->paramid" => $fellowship_id]),
            'cancel' => route('editengage', ["$this->paramid" => $fellowship_id])
        );
        return view('discipleship.assignteacher', 
            ['title' => $this->title, 'urls' => $urls, 'tableCols' => $tableCols, 'results' => $results, 'fellowship' => $fellowship,'current_members' => $current_members, 'class_id' => $class_id, 'dates' => $dates, 'defaultclass' => $class_name, 'defaultrole' => $fellowship_role, 'dlt_field' => $this->hdninput]
        ); 
    }


    /*
     * Mark member's attendance
     */
    public function attend(Request $request)
    {
        // check if requested role is valid
        $fellowship_role = 'student';
        $class_name = $request->eclass;
        $fellowship = $request->{$this->paramid};
        $fellowship_id = $fellowship->id;
        $classes = $fellowship->classes->lists('id', 'name')->toArray();

        if(!array_key_exists($class_name, $classes)) {
            return redirect()->route('allengage');    
        }    

        $class_id = $classes[$class_name];
        $results = $fellowship->students;
        $tableCols = array('name' => 'Name', 'icare' => 'iCare', 'age' => 'Age', 'gender' => 'Gender');
        // get class schedule
        $dates = $fellowship->classes()->getQuery()->get()->each(function($item) {
            $item->date = $item->class_date->format('d M Y') . " (" . $item->name . ")";
        })->lists('date', 'name')->toArray();
        // get current members
        $current_members = $fellowship->classes->find($class_id)->attendance()->lists('member_id')->toArray();
        $urls = array(
            'save' => route('saveengage'), 
            'edit' => route('attendengage', ["$this->paramid" => $fellowship_id]),
            'cancel' => route('editengage', ["$this->paramid" => $fellowship_id]), 
        );

        return view('discipleship.attend', 
            ['title' => $this->title, 'urls' => $urls, 'tableCols' => $tableCols, 'results' => $results, 'fellowship' => $fellowship, 'current_members' => $current_members,'class_id' => $class_id, 'dates' => $dates, 'defaultclass' => $class_name, 'defaultrole' => $this->defaultRole, 'dlt_field' => $this->hdninput]
        ); 
    }


    /*
     * Delete an item 
     * TODO: authorize which users can destroy [$this->authorize('destroy', $item)];
     */
    public function destroy(Request $request)
    {
        // form validation
        $this->validate($request, [
            '_formaction' => 'bail|required|in:,deleteEngage',
        ]);
        
        $fellowship = $request->{$this->paramid};
        $fellowship_id = $fellowship->id;
        $action = $request->_formaction;

        switch ($action) {
            case 'deleteEngage':
                $member_ids = $fellowship->students->lists('id')->toArray();
                $fellowship->students()->detach();
                $fellowship->attendances()->delete();
                $fellowship->delete();
                $this->baseModel->evaluateMembership($member_ids); //evaluate member status
                $request->session()->flash('message', sprintf("One %s has been successfully deleted.", $this->title['singular']));
                return redirect()->route('allengage');
            break;
        }
    }


    /*
     * Function to handle all save process like add, edit and updates
     * TODO: AUTHORIZE SAVE
     */
    public function save(Request $request)
    {
        // form action validation
        $this->validate($request, [
            '_formaction' => 'bail|required|in:addEngage,editEngage,editRole,markAttendance,editTeacher',
        ]);

        $action = $request->_formaction;
        
        switch ($action) {

            case 'addEngage':
                $classes_rule = array();
                foreach (array_keys($this->classes) as $key) {
                    $field = 'session_'.$key;
                    $classes_rule[$field] = 'required|date_format:d/m/Y';
                }

                // form validation
                $validationrules = $classes_rule;
                $validationrules['name'] = 'bail|required|unique:engage|max:255';
                $this->validate($request, $validationrules);

                $fellowship_id = $this->baseModel->create(['name' => $request->name]);
                $fellowship = $this->baseModel->find($fellowship_id);
                foreach ($this->classes as $key => $value) {
                    $field = 'session_'.$key;
                    $date = $this->baseModel->sanitizeDate($request->$field);
                    $fellowship->classes()->create(['class_date' => $date, 'name' => $value]);                       
                }
                $request->session()->flash('message', sprintf("You have successfully created a new %s!", $this->title['singular']));
            break;

            case 'editEngage':
                $classes_rule = array();
                foreach (array_keys($this->classes) as $key) {
                    $field = 'session_'.$key;
                    $classes_rule[$field] = 'required|date_format:d/m/Y';
                }
                
                // form validation
                $validationrules = $classes_rule;
                $fellowship_id = $request->{$this->hdninput};
                $validationrules['name'] = 'bail|required|unique:engage,name,'.$fellowship_id.'|max:255';
                $this->validate($request, $validationrules);
                
                $this->baseModel->update(['name' => $request->name], $fellowship_id, 'id');
                $fellowship = $this->baseModel->find($fellowship_id);
                foreach ($fellowship->classes as $key => $item) {
                    $field = 'session_'.$key;
                    $date = $this->baseModel->sanitizeDate($request->$field);
                    $item->update(['class_date' => $date]);                       
                }
                $request->session()->flash('message', 'Update successful!'); 
            break;

            case 'editRole':                
                // form validation
                $this->validate($request, [
                    "$this->hdninput" => 'bail|required|integer|exists:engage,id', 
                    '_mbrids' => 'bail|required|json',
                ]);

                // check quantity limit for this role
                $member_role = 'student';
                $role_limit = $this->validRoles->get($member_role);
                $fellowship_id = $request->{$this->hdninput};
                $member_ids = json_decode($request->_mbrids);

                // check if number of selected members exceed max
                if($role_limit > 0 && count($member_ids) > $role_limit ) {
                    // error, cannot add this role anymore
                    $name = $this->title['singular'];
                    $request->session()->flash('message', "Invalid request. There can be no more than $role_limit $member_role for this $name");
                    $request->session()->flash('alert-class', 'alert-danger');
                    return redirect()->route('assignengrole', ["$this->paramid" => $fellowship_id, "$this->paramrole" => $member_role]);
                }
                
                // get previous selected ids from database then insert new ids 
                $fellowship = $this->baseModel->find($fellowship_id);                  
                $previous_ids = $fellowship->students()->getQuery()->where('title', $member_role)->get()->lists('member_id')->toArray();
                $newids = $this->baseModel->configureSync($member_ids, ['title' => $member_role, 'description' => 'Attending']);
                $fellowship->students()->sync($newids);

                // remove deleted member's attendance list
                $deleted = array_diff($previous_ids, $member_ids);
                $fellowship->classes->each(function($c) use($deleted) {
                    foreach ($deleted as $key => $id) {
                        $c->attendance()->where('member_id', $id)->delete();                    
                    }
                });

                $request->session()->flash('message', 'Update successful!');                            
            break;

            case 'editTeacher':
                // form validation
                $class_id = isset($request->{$this->hdncls}) ? $request->{$this->hdncls} : '';
                $classRule = "required_with:{$this->hdncls}|exists:class_schedules,name,id,{$class_id}";

                
                $this->validate($request, [
                    "$this->hdninput" => 'bail|required|integer|exists:engage,id', 
                    '_mbrids' => 'bail|required|json',
                    "$this->hdncls" => 'required|integer|exists:class_schedules,id',
                    "$this->hdncnm" => $classRule,
                ]);

                // check quantity limit for this role
                $member_role = 'teacher';                
                $role_limit = Config::get('constants.TEACHERS_MAX_NUM');
                $fellowship_id = $request->{$this->hdninput};
                $member_ids = json_decode($request->_mbrids);

                // check if number of selected members exceed max
                if($role_limit > 0 && count($member_ids) > $role_limit ) {
                    // error, cannot add this role anymore
                    $name = $this->title['singular'];
                    $request->session()->flash('message', "Invalid request. There can be no more than $role_limit $member_role for this $name");
                    $request->session()->flash('alert-class', 'alert-danger');
                    return redirect()->route('assignengteacher', ["$this->paramid" => $fellowship_id, "$this->paramclass" => $request->{$this->hdncnm}]);
                }
                
                // sync/insert new ids  
                $fellowship = $this->baseModel->find($fellowship_id); 
                $item = $fellowship->classes()->where('id', $class_id)->first();              
                // $previous_ids = $fellowship->classes()->getQuery()->where('id', $class_id)->get()->lists('member_id')->toArray();
                $newids = $this->baseModel->configureSync($member_ids, ['title' => $member_role]);
                $item->teachers()->sync($newids);

                $request->session()->flash('message', 'Update successful!');                            
            break;

            case 'markAttendance':

                $class_id = isset($request->{$this->hdncls}) ? $request->{$this->hdncls} : '';
                $classRule = "required_with:{$this->hdncls}|exists:class_schedules,name,id,{$class_id}";

                // form validation
                $this->validate($request, [
                    "$this->hdninput" => 'bail|required|integer|exists:engage,id', 
                    '_mbrids' => 'bail|required|json',
                    "$this->hdncls" => 'required|integer|exists:class_schedules,id',
                    "$this->hdncnm" => $classRule,
                ]);

                $fellowship_id = $request->{$this->hdninput};
                $member_ids = json_decode($request->_mbrids);
                $fellowship = $this->baseModel->find($fellowship_id);
                $class = $fellowship->classes->find($class_id);                

                // get previous selected ids from databse
                $previous_ids = $class->attendance()->lists('member_id')->toArray();
                // delete previous selected ids
                if(!empty($previous_ids)) $class->attendance()->delete();
                // insert new ids
                foreach ($member_ids as $id) {  
                    $class->attendance()->create(['member_id' => $id]);                     
                }

                // evaluate student status
                $results = $this->baseModel->getClassAttendance($fellowship->classes);
                $class_attendance = $results['attendance'];
                foreach ($class_attendance as $id => $value) {
                    $checked = count($value);
                    $mbr = $fellowship->students()->find($id);
                    $status = $mbr->determineStudentStatus($checked);
                    $fellowship->students()->sync([$id => ['description' => $status]], false);
                    // evaluate member status 
                    $allids =  array_merge($previous_ids, $member_ids);
                    $this->baseModel->evaluateMembership($allids);                   
                }
                $request->session()->flash('message', 'Update successful!');                            
            break;

            default:
                return redirect()->route('allengage');    
            break;
        }
        return redirect()->route('editengage', [$fellowship_id]);
        
    }

}
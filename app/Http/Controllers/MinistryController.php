<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Config;
use App\Repositories\MinistryRepository as Ministry;

class MinistryController extends Controller
{

    /**
     * The model repository instance.
     *
     * @var MinistryRepository
     */
    protected $baseModel;

    /**
     * The valid roles instance.
     */
    protected $validRoles;
    
    /**
     * The default role.
     */
    protected $defaultRole;
    
    /*
     * General title page
     */
    protected $title;

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

    /**
     * Create a new controller instance.
     *
     * @param  MinistryRepository  $ministry
     * @return void
     */
    public function __construct(Ministry $ministry)
    {
        $this->middleware('auth');
        $this->baseModel = $ministry;
        $this->defaultRole = 'member';
        $this->paramid = 'mstry';
        $this->paramrole = 'mstrole';
        $this->hdninput = '_mstid';
        $this->title = array('header' => 'Ministry', 'singular' => 'Ministry');
        $this->validRoles = $this->baseModel->getValidRoles(); //get valid roles
    }

    /**
     * Show a list of all available items.
     *
     */
    public function index(Request $request)
    {   
        $results = $this->baseModel->all();

        $tableCols = array('name' => 'Name', 'member_count' => sprintf("Number of %s Members", $this->title['singular']));

        $urls = array(
            'add' => route('addministry'), 
            'delete' => route('deleteministry'), 
            'edit' => route('editministry'), 
            'view' => route('viewministry')
        );
        return view('members.index', 
            ['title' => $this->title, 'results' => $results, 'tableCols' => $tableCols, 'urls' => $urls, 'dlt_field' => $this->hdninput, 'dlt_act' => 'deleteMinistry']
        );
    }

    /*
     * Add a new item
     */
    public function add(Request $request)
    {        
        // $results = $this->baseModel->all()->sortBy('level');
        
        $list = $this->baseModel->all()->sortBy('name')->lists('name', 'name');
       

        return view('ministry.add', 
            ['title' => $this->title, 'ministry_list' => $list, 'urls' => array('save' => route('saveministry'), 'cancel' => route('allministry'))]
        );   
    }

    /*
     * Edit general information
     */
    public function edit(Request $request)
    {   
        $fellowship = $request->{$this->paramid};
        $fellowship_id = $fellowship->id;
        $members = $this->baseModel->getMyMembers($fellowship); //get all members associated with this fellowship
        $tableCols = array('name' => 'Name', 'role' => sprintf("Role in %s", $this->title['singular']), 'email' => 'Email', 'age' => 'Age', 'gender' => 'Gender', 'is_member' => 'Church Member');
        $validRoles = $this->baseModel->castRoleField($this->validRoles);
        $list = $this->baseModel->all()->sortBy('name')->lists('name', 'name');
        $parent_ministry = $this->baseModel->find($fellowship->parent_ministry_id); //other info
        $parent_name = $parent_ministry->name;

        $urls = array(
            'add' => route('addministry'),
            'delete' => route('deleteministry'), 
            'view' => route('viewministry', ["$this->paramid" => $fellowship_id]),   
            'viewmember' => route('viewmember'),
            'save' => route('saveministry'), 
            'cancel' => route('allministry'),
            'assign' => route('assignmstrole', ["$this->paramid" => $fellowship_id])
        );
        return view('ministry.edit', 
            ['title' => $this->title, 'ministry_list' => $list, 'tableCols' => $tableCols, 'urls' => $urls, 'members' => $members, 'fellowship' => $fellowship, 'parent_name' => $parent_name, 'validRoles' => $this->validRoles, 'order' => $validRoles, 'default_role' => $this->defaultRole, 'dlt_field' => $this->hdninput]
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
            return redirect()->route('allministry');    
        }

        $fellowship = $request->{$this->paramid};
        $fellowship_id = $fellowship->id;
        $results = $this->baseModel->getAllMembers();
        $tableCols = array('name' => 'Name', 'ministry' => 'Ministry', 'age' => 'Age', 'gender' => 'Gender');

        // get current members
        $current_members = $fellowship->members()->getQuery()->where('title', $fellowship_role)->get()->lists('member_id')->toArray(); 
        $validRoles = $this->baseModel->castRoleField($this->validRoles);

        $urls = array(
            'save' => route('saveministry'), 
            'edit' => route('assignmstrole', ["$this->paramid" => $fellowship_id]),
            'cancel' => route('editministry', ["$this->paramid" => $fellowship_id]), 
        );
        return view('icares.assign', 
            ['title' => $this->title, 'results' => $results, 'tableCols' => $tableCols, 'urls' => $urls, 'fellowship' => $fellowship, 'validRoles' => $validRoles, 'defaultrole' => $fellowship_role, 'dlt_field' => $this->hdninput, 'current_members' => $current_members]
        ); 
    }

    /*
     * View item detail
     * TODO: Print PDF option
     */
    public function view(Request $request)
    {
        $fellowship = $request->{$this->paramid};
        $fellowship_id = $fellowship->id;
        $members = $this->baseModel->getMyMembers($fellowship);
       
        $info = $fellowship->description;
        $tableCols = array('name' => 'Name', 'role' => sprintf("Role in %s", $this->title['singular']), 'email' => 'Email', 'age' => 'Age', 'gender' => 'Gender', 'is_member' => 'Church Member');
        $validRoles = $this->baseModel->castRoleField($this->validRoles);
        $urls = array(
            'cancel' => route('editministry', ["$this->paramid" => $fellowship_id]), 
        );

        return view('ministry.view', 
            ['title' => $this->title, 'tableCols' => $tableCols, 'urls' => $urls, 'fellowship' => $fellowship, 'info' => $info, 'members' => $members, 'order' => $validRoles]
        );
    }

    /*
     * Delete one ministry or delete a member of the ministry
     * TODO: authorize which users can destroy [$this->authorize('destroy', $item)];
     */
    public function destroy(Request $request)
    {
        // form validation
        $this->validate($request, [
            '_formaction' => 'bail|required|in:,deleteMinistry,deleteMember',
            '_mbrid' => "required_if:_formaction,deleteMember|exists:ministries,id",
        ]);
        
        $fellowship = $request->{$this->paramid};
        $fellowship_id = $fellowship->id;
        $action = $request->_formaction;

        switch ($action) {
            case 'deleteMinistry':
                $this->baseModel->deleteMyMinistry($fellowship_id);
                $request->session()->flash('message', sprintf("The selected %s and all other %s under it has been successfully deleted.", $this->title['singular'], $this->title['singular']));
                return redirect()->route('allministry');
            break;

            case 'deleteMember':
                $memberid = $request->_mbrid;
                $fellowship->members()->detach($memberid);                
                $request->session()->flash('message', sprintf("One member has been successfully dismissed from this %s.", $this->title['singular']));
                return redirect()->route('editministry', [$fellowship_id]);
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
            '_formaction' => 'bail|required|in:addMinistry,editMinistry,editRole',
        ]);
        $action = $request->_formaction;
        
        switch ($action) {

            case 'addMinistry':
                // form validation
                $this->validate($request, [
                    'name' => 'bail|required|unique:ministries|max:255',
                    'description' => 'max:255',
                    'mtrname' => 'required|exists:ministries,name',
                ]);

                $parent_ministry = $this->baseModel->findBy('name', $request->mtrname);
                $parent_id = $parent_ministry->id;
                $level = $parent_ministry->level + 1;
                $fellowship_id = $this->baseModel->create(['name' => $request->name, 'description' => $request->description, 'level' => $level, 'parent_ministry_id' => $parent_id]);
                $request->session()->flash('message', sprintf("You have successfully created a new %s!", $this->title['singular']));                
            break;

            case 'editMinistry':
                         
                $fellowship_id = $request->{$this->hdninput};
                
                // form validation
                $this->validate($request, [
                    'name' => 'bail|required|unique:ministries,name,'.$fellowship_id.'|max:255',
                    'description' => 'max:255',
                    'mtrname' => 'required|exists:ministries,name',
                    "$this->hdninput" => 'bail|required|integer|exists:ministries,id' 
                ]);

                // configure ministry level                
                $fellowship = \App\Ministry::where('name', $request->mtrname)->first();  
                $parent = $fellowship->id;
                $level = intval($fellowship->level) + 1;   

                $this->baseModel->update(['name' => $request->name, 'description' => $request->description, 'level' => $level, 'parent_ministry_id' => $parent], $fellowship_id, 'id');
                $request->session()->flash('message', 'Update successful!');                    

            break;

            case 'editRole':
                $rule = $this->validRoles->keys()->implode(",");
                $roleRule = "required|in:{$rule}";
                // form validation
                $this->validate($request, [
                    "$this->hdninput" => 'bail|required|integer|exists:ministries,id', 
                    '_mbrids' => 'bail|required|json',
                    '_mbrole' => $roleRule
                ]);

                // check quantity limit for this role
                $member_role = $request->_mbrole;
                $role_limit = $this->validRoles->get($member_role);
                $fellowship_id = $request->{$this->hdninput};
                $member_ids = json_decode($request->_mbrids);
                // check if number of selected members exceed max
                if($role_limit > 0 && count($member_ids) > $role_limit ) {
                    // error, cannot add this role anymore
                    $name = $this->title['singular'];
                    $request->session()->flash('message', "Invalid request. There can be no more than $role_limit $member_role for this $name");
                    $request->session()->flash('alert-class', 'alert-danger');
                    return redirect()->route('assignmstrole', ["$this->paramid" => $fellowship_id, "$this->paramrole" => $member_role]);
                }

                $fellowship = $this->baseModel->find($fellowship_id);   
                // get previous selected ids from databse
                $previous_ids = $fellowship->members()->getQuery()->where('title', $member_role)->get()->lists('member_id')->toArray();
                // delete previous selected ids
                if(!empty($previous_ids)) $fellowship->members()->detach($previous_ids);
                // insert new ids
                foreach ($member_ids as $id) {                       
                    $fellowship->members()->attach($id, ['title' => $member_role]);
                }

                $request->session()->flash('message', 'Update successful!');                            
            break;

            default:
                return redirect()->route('allministry');    
            break;
        }
        return redirect()->route('editministry', [$fellowship_id]);
        
    }

}
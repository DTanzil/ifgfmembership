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
     * @var IcareRepository
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
     * @param  IcareRepository  $icare
     * @return void
     */
    public function __construct(Engage $icare)
    {
        $this->middleware('auth');
        $this->baseModel = $icare;
        $this->defaultRole = 'member';
        $this->paramid = 'icare';
        $this->paramrole = 'icarerole';
        $this->hdninput = '_icrid';
        $this->title = array('header' => 'iCares', 'singular' => 'iCare');
        $this->validRoles = $this->baseModel->getValidRoles(); //get valid roles
    }

    /**
     * Show a list of all available icares.
     *
     */
    public function index(Request $request)
    {   
        $results = $this->baseModel->all();
        $tableCols = array('name' => 'Name', 'member_count' => 'Number of iCare Members', 'day' => 'Meetup Day', 'leader' => 'CG Leader');

        $urls = array(
            'add' => route('addicare'), 
            'delete' => route('deleteicare'), 
            'edit' => route('editicare'), 
            'view' => route('viewicare')
        );
        return view('members.index', 
            ['title' => $this->title, 'results' => $results, 'tableCols' => $tableCols, 'urls' => $urls, 'dlt_field' => $this->hdninput, 'dlt_act' => 'deleteIcare']
        );
    }

    /*
     * Add a new icare
     */
    public function add(Request $request)
    {        
        return view('icares.add', 
            ['title' => $this->title, 'urls' => array('save' => route('saveicare'), 'cancel' => route('allicare'))]
        );   
    }

    /*
     * Edit icare general information
     */
    public function edit(Request $request)
    {   
        $fellowship = $request->{$this->paramid};
        $fellowship_id = $fellowship->id;
        $members = $this->baseModel->getMyMembers($fellowship, $this->validRoles); //get all members associated with this fellowship
        $info = $fellowship->description; //other info

        $urls = array(
            'add' => route('addicare'),
            'delete' => route('deleteicare'), 
            'view' => route('viewmember'),  
            'save' => route('saveicare'), 
            'assign' => route('assignicarerole', ["$this->paramid" => $fellowship_id])
        );
        return view('icares.edit', 
            ['title' => $this->title, 'urls' => $urls, 'members' => $members, 'fellowship' => $fellowship, 'info' => $info, 'order' => $this->validRoles, 'default_role' => $this->defaultRole, 'dlt_field' => $this->hdninput]
        );
    }

    /*
     * Edit/Assign members to a role in an icare
     */
    public function assign(Request $request)
    {
        // check if requested role is valid
        $fellowship_role = empty($request->{$this->paramrole}) ? $this->defaultRole : $request->{$this->paramrole};
        if(!array_key_exists($fellowship_role, $this->validRoles->toArray())) {
            return redirect()->route('allicare');    
        }

        $fellowship = $request->{$this->paramid};
        $fellowship_id = $fellowship->id;
        $results = $this->baseModel->getAllMembers();
        $tableCols = array('name' => 'Name', 'ministries' => 'Ministry', 'age' => 'Age', 'gender' => 'Gender');

        // get current members
        $current_members = $fellowship->members()->getQuery()->where('title', $fellowship_role)->get()->lists('member_id')->toArray(); 
        $validRoles = $this->baseModel->castRoleField($this->validRoles);

        $urls = array(
            'save' => route('saveicare'), 
            'edit' => route('assignicarerole', ["$this->paramid" => $fellowship_id]),
            'cancel' => route('editicare', ["$this->paramid" => $fellowship_id]), 
        );
        return view('icares.assign', 
            ['title' => $this->title, 'results' => $results, 'tableCols' => $tableCols, 'urls' => $urls, 'fellowship' => $fellowship, 'validRoles' => $validRoles, 'defaultrole' => $fellowship_role, 'dlt_field' => $this->hdninput, 'current_members' => $current_members]
        ); 
    }

    /*
     * View Icare detail
     * TODO: Print PDF option
     */
    public function view(Request $request)
    {
        $fellowship = $request->{$this->paramid};
        $fellowship_id = $fellowship->id;
        $members = $this->baseModel->getMyMembers($fellowship, $this->validRoles);
        $info = $fellowship->description;
        $tableCols = array('name' => 'Name', 'role' => 'Role in iCare', 'email' => 'Email', 'age' => 'Age', 'gender' => 'Gender', 'ministries' => 'Ministry', 'is_member' => 'Church Member');
        $validRoles = $this->baseModel->castRoleField($this->validRoles);
        $urls = array(
            'cancel' => route('editicare', ["$this->paramid" => $fellowship_id]), 
        );

        return view('icares.view', 
            ['title' => $this->title, 'tableCols' => $tableCols, 'urls' => $urls, 'fellowship' => $fellowship, 'info' => $info, 'members' => $members, 'order' => $validRoles]
        );
    }

    /*
     * Delete one icare or delete a member of the icare
     * TODO: authorize which users can destroy [$this->authorize('destroy', $icare)];
     */
    public function destroy(Request $request)
    {
        // form validation
        $this->validate($request, [
            '_formaction' => 'bail|required|in:,deleteIcare,deleteMember',
            '_mbrid' => "required_if:_formaction,deleteMember|exists:members,id",
        ]);
        
        $fellowship = $request->{$this->paramid};
        $fellowship_id = $fellowship->id;
        $action = $request->_formaction;

        switch ($action) {
            case 'deleteIcare':
                $fellowship->members()->detach();
                $fellowship->delete();
                $request->session()->flash('message', 'One iCare has been successfully deleted.');
                return redirect()->route('allicare');
            break;

            case 'deleteMember':
                $memberid = $request->_mbrid;
                $fellowship->members()->detach($memberid);
                $request->session()->flash('message', 'One member has been successfully deleted.');
                return redirect()->route('editicare', [$fellowship_id]);
            break;
        }
    }


    /*
     * Function to handle all save process like add, edit and updates in icare
     * TODO: AUTHORIZE SAVE
     */
    public function save(Request $request)
    {
        // form action validation
        $this->validate($request, [
            '_formaction' => 'bail|required|in:addIcare,editIcare,editRole',
        ]);
        $days_rule = implode(array_keys(Config::get('constants.DAYS')), ",");
        $action = $request->_formaction;
        
        switch ($action) {

            case 'addIcare':
                // form validation
                $this->validate($request, [
                    'name' => 'bail|required|unique:icares|max:255',
                    'phone' => 'alpha_dash',
                    'email' => 'required|email|unique:icares',
                    'city' => 'required|max:255',
                    'address' => 'required|max:255',
                    'zipcode' => 'required|digits_between:0,8',
                    'day' => "required|in:$days_rule",
                    'time' => 'required|digits_between:1,4'
                ]);

                $info = $this->baseModel->castDescriptionField($request);
                $fellowship_id = $this->baseModel->create(['name' => $request->name, 'time' => $request->time, 'day' => $request->day, 'email' => $request->email, 'description' => $info]);
                $request->session()->flash('message', 'You have successfully created a new icare!');
            break;

            case 'editIcare':
                         
                $fellowship_id = $request->{$this->hdninput};
               
                // form validation
                $this->validate($request, [
                    'name' => 'bail|required|unique:icares,name,'.$fellowship_id.'|max:255',
                    'phone' => 'alpha_dash',
                    'email' => 'required|email|unique:icares,email,'.$fellowship_id,
                    'city' => 'required|max:255',
                    'address' => 'required|max:255',
                    'zipcode' => 'required|digits_between:0,8',
                    'day' => "required|in:$days_rule",
                    'time' => 'required|digits_between:1,4',
                    "$this->hdninput" => 'bail|required|integer|exists:icares,id' 
                ]);

                $info = $this->baseModel->castDescriptionField($request);
                $this->baseModel->update(['name' => $request->name, 'time' => $request->time, 'day' => $request->day, 'email' => $request->email, 'description' => $info], $fellowship_id, 'id');
                $request->session()->flash('message', 'Update successful!');                    

            break;

            case 'editRole':
                $rule = $this->validRoles->keys()->implode(",");
                $roleRule = "required|in:{$rule}";
                // form validation
                $this->validate($request, [
                    "$this->hdninput" => 'bail|required|integer|exists:icares,id', 
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
                    return redirect()->route('assignicarerole', ["$this->paramid" => $fellowship_id, "$this->paramrole" => $member_role]);
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
                return redirect()->route('allicare');    
            break;
        }
        return redirect()->route('editicare', [$fellowship_id]);
        
    }

}
<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Requests;

use App\Group;
use App\Member;
use App\MemberRole;

use Config;

use App\Http\Controllers\Controller;
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
     * The valid model roles instance.
     */
    protected $validRoles;
    
    /**
     * The default icare role.
     */
    protected $defaultRole;
    
    /*
     * General title page
     */
    protected $title;

    /*
     * General title page
     */
    protected $parameters;

    /**
     * Create a new controller instance.
     *
     * @param  IcareRepository  $icare
     * @return void
     */
    public function __construct(Ministry $ministry)
    {
        $this->middleware('auth');

        $this->baseModel = $ministry;

        // get all valid roles
        $this->validRoles =  MemberRole::where('type', $this->baseModel->model())
                     ->orderBy('priority', 'asc')
                     ->lists('maxlimit', 'title');

        $this->title = array('header' => 'iCares', 'singular' => 'iCare');

        $this->defaultRole = 'member';

    }

    /**
     * Show a list of all available icares.
     *
     */
    public function index(Request $request)
    {   
        $results = $this->baseModel->all(array('*'), true);
        $tableCols = array('name' => 'Name', 'member_count' => 'Number of iCare Members', 'leader' => 'CG Leader');
        $urls = array(
            'add' => route('addicare'), 
            'delete' => route('deleteicare'), 
            'edit' => route('editicare'), 
            'view' => route('allicare')
        );
        return view('members.index', ['title' => $this->title, 'results' => $results, 'tableCols' => $tableCols, 'urls' => $urls, 'dlt_field' => '_icrid']);
    }

    /*
     * Add a new icare
     */
    public function add(Request $request)
    {        
        return view('icares.add', ['title' => $this->title, 'urls' => array('save' => route('saveicare'))]);   
    }

    /*
     * Edit icare general information
     */
    public function edit(Request $request)
    {   
     
        $fellowship_id = $request->mstid;
        
        // check if icare, member id is valid
        if ($this->baseModel->findIfExist('id', $fellowship_id) ) {  
            $fellowship = $this->baseModel->find($fellowship_id);
            $members = $this->baseModel->getAllMembers($fellowship_id);
            $info = $fellowship->description; //other info
            $urls = array(
                'add' => route('addicare'), 
                'delete' => route('deletearole'), 
                'edit' => route('editicare', ['icareid' => $fellowship_id]), 
                'addrole' => 'icare/add/', 
                'view' => 'icare/view/', 
                'save' => route('saveicare'), 
                'editmultiple' => route('editicaremultiple', ['icareid' => $fellowship_id]) 
            );
            return view('icares.edit', ['title' => $this->title, 'urls' => $urls, 'fellowship' => $fellowship, 'info' => $info, 'members' => $members, 'order' => $this->validRoles->keys(), 'the_roles' => $this->validRoles->keys()->implode(","), 'default_role' => $this->defaultRole ]);

        } else {
            return redirect()->route('allicare');            
        }
        
    }

    /*
     * Edit/assign a member to an existing role in a icare
     */
    public function editRole(Request $request)
    {
        $icare_id = $request->icareid;
        $icare_role = $request->icarerole;
        
        // check if icare, member id is valid
        if($this->baseModel->findIfExist('id', $icare_id)) {
            $icare = $this->baseModel->find($icare_id);
            $results = Member::all();
            $member = $this->baseModel->getMember($icare_id, $icare_role);
            $tableCols = array('name' => 'Name', 'age' => 'Age', 'gender' => 'Gender', 'icare' => 'iCare');
            $urls = array(
                'save' => route('saveicare'), 
                'cancel' => route('editicare', ['icareid' => $icare_id])
            );

            return view('families.editrole', ['title' => $this->title, 'results' => $results, 'tableCols' => $tableCols, 'urls' => $urls, 'item' => $icare, 'member' => $member, 'role' => $icare_role, 'dlt_field' => '_icrid']);

        } else {
            return redirect()->route('allicare');     
        }
    }

    /*
     * Edit/assign a member to an existing role in a icare
     */
    public function editRoleMultiple(Request $request)
    {
        $item_role = $this->defaultRole; //set default role to member
        $item_id = $request->icareid;

        if($this->baseModel->findIfExist('id', $item_id)) {
            
            $results = Member::all();
            $item = $this->baseModel->find($item_id);
            $tableCols = array('name' => 'Name', 'icare' => 'iCare', 'age' => 'Age', 'gender' => 'Gender');
            $urls = array(
                'save' => route('saveicare'), 
                'edit' => route('editicarerole', ['icareid' => $item_id])
            );


            $validRoles = $this->baseModel->castRoleField($this->validRoles);

            // get current members
            $current_members = Group::where(['title' => $this->defaultRole, 'group_id' => $item_id, 'group_type' => $this->icare->model()])->lists('member_id')->toArray(); 

            // $groups = Group::where(['title' => $this->defaultRole, 'group_id' => $item_id, 'group_type' => $this->baseModel->model()])->get(); 
            // $current_members = array();
            // foreach ($groups as $group) {
            //     array_push($current_members, $group->member_id);
            // }

            return view('icares.editmultiple', ['title' => $this->title, 'results' => $results, 'tableCols' => $tableCols, 'urls' => $urls, 'validRoles' => $validRoles, 'item' => $item, 'defaultrole' => $item_role, 'dlt_field' => '_icrid', 'current_members' => $current_members]); 

        } else {
            return redirect()->route('allicare');  
        }   
    }

    /*
     * Assign a member to new role in an icare
     */
    public function addRole(Request $request)
    {
        $icare_role = $request->icarerole;
        $icare_id = $request->icareid;

        if($this->baseModel->findIfExist('id', $icare_id)) {
            if(empty($icare_role)) $icare_role = $this->defaultRole; //set default role to children

            $results = Member::all();
            $icare = $this->baseModel->find($icare_id);
            $tableCols = array('name' => 'Name', 'icare' => 'iCare', 'age' => 'Age', 'gender' => 'Gender');
            $urls = array(
                'save' => route('saveicare'), 
                'edit' => route('editicarerole', ['icareid' => $icare_id])
            );

            foreach ($this->validRoles->keys() as $key => $value) {
                $validRoles[$value] = $value;
            }

            return view('families.addrole', ['title' => $this->title, 'results' => $results, 'tableCols' => $tableCols, 'urls' => $urls, 'validRoles' => $validRoles, 'item' => $icare, 'defaultrole' => $icare_role, 'dlt_field' => '_icrid']); 

        } else {
            return redirect()->route('allicare');  
        }   
    }

     /*
     * Delete a icare
     */
    public function destroy(Request $request)
    {
        $icare_id = $request->_icrid;

        // form validation
        $this->validate($request, [
            '_icrid' => 'bail|required|integer|exists:icares,id' 
        ]);

        $this->authorize('destroy', $this->baseModel->find($icare_id));
        $this->baseModel->delete($icare_id);
        $request->session()->flash('message', 'One icare has been successfully deleted.');
        
        return redirect()->route('allicare');
    }


    /*
     * Function to handle all save process like add, edit and updates in icare
     */
    public function save(Request $request)
    {
        
        if ($request->isMethod('post')) {

            // form action validation
            $this->validate($request, [
                '_formaction' => 'bail|required|in:addIcare,editIcare,editRole,editRoleMultiple',
            ]);

            $action = $request->_formaction;

            switch ($action) {

                case 'addIcare':
                    // form validation
                    $this->validate($request, [
                        'name' => 'bail|required|unique:families|max:255',
                        'phone' => 'alpha_dash',
                        'email' => 'required|email|unique:icares',
                        'city' => 'required|max:255',
                        'address' => 'required|max:255',
                        'zipcode' => 'required|digits_between:0,8',
                        'day' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
                        'time' => 'required|digits_between:1,4'
                    ]);

                    $icareinfo = $this->baseModel->castDescriptionField($request);
                    $icare_id = $this->baseModel->create(['name' => $request->name, 'time' => $request->time, 'day' => $request->day, 'email' => $request->email, 'description' => $icareinfo]);
                    $request->session()->flash('message', 'You have successfully created a new icare!');
                break;

                case 'editIcare':
                             
                    $icare_id = $request->_icrid;           
                    // form validation
                    $this->validate($request, [
                        'name' => 'bail|required|unique:icares,name,'.$icare_id.'|max:255',
                        'phone' => 'alpha_dash',
                        'email' => 'required|email|unique:icares,email,'.$icare_id,
                        'city' => 'required|max:255',
                        'address' => 'required|max:255',
                        'zipcode' => 'required|digits_between:0,8',
                        'day' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
                        'time' => 'required|digits_between:1,4',
                        '_icrid' => 'bail|required|integer|exists:icares,id' 
                    ]);

                    $icareinfo = $this->baseModel->castDescriptionField($request);
                    $this->baseModel->update(['name' => $request->name, 'time' => $request->time, 'day' => $request->day, 'email' => $request->email, 'description' => $icareinfo], $icare_id, 'id');
                    $request->session()->flash('message', 'Update successful!');                    

                break;

                case 'editRole':
                    // form validation
                    $rule = $this->validRoles->keys()->implode(",");
                    $roleRule = "required|in:{$rule}";
                    $this->validate($request, [
                        '_icrid' => 'bail|required|integer|exists:icares,id', 
                        '_mbrid' => 'bail|required|integer|exists:members,id',
                        '_fmaction' => 'required|in:replace,add',
                        '_mbrole' => $roleRule
                    ]);

                    $icare_id = $request->_icrid;
                    $member_id = $request->_mbrid;
                    $member_role = $request->_mbrole;
                    $icare_action = $request->_fmaction;
                    
                    // find if role already exists, whether replacing or creating it
                    if($icare_action == 'replace') {
                        $role = Group::firstOrNew(['title' => $member_role, 'group_id' => $icare_id, 'group_type' => $this->baseModel->model()]);
                    } else {
                        // check if it's possible to add this role
                        $num_current = Group::where(['title' => $member_role, 'group_id' => $icare_id, 'group_type' => $this->baseModel->model()])->count();
                        $num_max = $this->validRoles[$member_role];
                        if($num_max > 0 && $num_current == $num_max) {
                            // error, cannot add this role anymore
                            $request->session()->flash('message', "Invalid request. There cannot be more than $num_max $member_role for this iCare");
                            $request->session()->flash('alert-class', 'alert-danger'); 
                            return redirect()->route('addicarerole', ['icareid' => $icare_id, 'icarerole' => $member_role]);
                        }
                    
                        // add new role
                        $role = Group::firstOrNew(['title' => $member_role, 'group_id' => $icare_id, 'group_type' => $this->baseModel->model(), 'member_id' => $member_id]);
                    }
                        
                    $role->member_id = $member_id;
                    $icare = $this->baseModel->find($icare_id);
                    $icare->roles()->save($role); 
                    $request->session()->flash('message', 'Update successful!');                            

                break;

                case 'editRoleMultiple':
                    // form validation
                    $this->validate($request, [
                        '_icrid' => 'bail|required|integer|exists:icares,id', 
                        '_mbrids' => 'bail|required|json'
                    ]);

                    $icare_id = $request->_icrid;
                    $member_ids = json_decode($request->_mbrids);
                    $icare = $this->baseModel->find($icare_id);                    
                    $groups = Group::where(['title' => $this->defaultRole, 'group_id' => $icare_id, 'group_type' => $this->baseModel->model()])->get();
                    
                    // if selected members are less than previous members, delete all entries first
                    if($groups->count() > 0 && count($member_ids) < $groups->count()) {
                        Group::where(['title' => $this->defaultRole, 'group_id' => $icare_id, 'group_type' => $this->baseModel->model()])->delete();
                    } else { 
                        // selected members > previous members, replace the id first 
                        foreach ($groups as $group) {
                            $group->member_id = array_pop($member_ids);
                            $icare->roles()->save($group);     
                        }
                    }

                    //create new member if there's still any ids
                    if(!empty($member_ids)){
                        foreach ($member_ids as $id) {
                            $newgroup = Group::create(['member_id' => $id, 'title' => $this->defaultRole, 'group_id' => $icare_id, 'group_type' => $this->baseModel->model()]);
                            $icare->roles()->save($newgroup);                     
                        }
                    }

                    $request->session()->flash('message', 'Update successful!');                            

                break;

                
                default:
                    return redirect()->route('allicare');    
                break;
            }
            return redirect()->route('editicare', [$icare_id]);
        }
        return redirect()->route('allicare');
    }

}
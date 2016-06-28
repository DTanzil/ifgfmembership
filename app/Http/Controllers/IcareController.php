<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Requests;

use App\Group;
use App\Member;
use App\MemberRole;

use Config;

use App\Http\Controllers\Controller;
use App\Repositories\IcareRepository as Icare;

// use App\CustomStuff\CustomDirectory\QRcode as QRcode;

use App\functions\QRcode as QRcode;
// use App\functions\QRcode as QRcode;

class IcareController extends Controller
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
     * Parameters for the URL
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
    public function __construct(Icare $icare)
    {
        $this->middleware('auth');
        $this->baseModel = $icare;
        $this->defaultRole = 'member';
        $this->paramid = 'icareid';
        $this->paramrole = 'icarerole';
        $this->hdninput = '_icrid';
        $this->title = array('header' => 'iCares', 'singular' => 'iCare');
        //get valid roles
        $this->validRoles =  MemberRole::where('type', $this->baseModel->model())->orderBy('priority', 'asc')->lists('maxlimit', 'title'); 
        

        // tihs works with putting namespace on phpqrcode
        // include(app_path() . '\CustomStuff\CustomDirectory\phpqrcode.php');
        
        // $aa = new \App\CustomStuff\CustomDirectory\QRcode();
        // // $aa::png('PHP QR Code :)');
        // $aa::png('aiefjiofae',false, QR_ECLEVEL_L, 14, 10); 
        

        // // $tempDir = "33";      
        // // $codeContents = '123456DEMO'; 
         
        // // generating 
        // // $aa::png($codeContents, $tempDir.'007_1.png', QR_ECLEVEL_L, 1); 
        // // $aa::png($codeContents, $tempDir.'007_2.png', QR_ECLEVEL_L, 2); 
        // // $aa::png($codeContents, $tempDir.'007_3.png', QR_ECLEVEL_L, 3); 
             
        // // displaying 
        // // echo '<img src="'.EXAMPLE_TMP_URLRELPATH.'007_1.png" />'; 
        // // echo '<img src="'.EXAMPLE_TMP_URLRELPATH.'007_2.png" />'; 
        // // echo '<img src="'.EXAMPLE_TMP_URLRELPATH.'007_3.png" />'; 
        // // echo '<img src="'.EXAMPLE_TMP_URLRELPATH.'007_4.png" />'; 
           
           // $aa = new DD();
           // var_dump($aa);

           QRcode::png('aiefjiofae',false, QR_ECLEVEL_L, 14, 10); 
        
      
        die();
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
            'view' => route('viewicare')
        );

        return view('members.index', ['title' => $this->title, 'results' => $results, 'tableCols' => $tableCols, 'urls' => $urls, 'dlt_field' => $this->hdninput]);
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
     
        $fellowship_id = $request->{$this->paramid};

        // check if icare, member id is valid
        if ($this->baseModel->findIfExist('id', $fellowship_id) ) {  
            $fellowship = $this->baseModel->find($fellowship_id);
            $members = $this->baseModel->getAllMembers($fellowship_id);
            $info = $fellowship->description; //other info
            $urls = array(
                'add' => route('addicare'),
                'delete' => route('deletearole'), 
                'view' => route('viewmember'),  
                'save' => route('saveicare'), 
                'assign' => route('assignicarerole', ["$this->paramid" => $fellowship_id]) 
            );

            return view('icares.edit', ['title' => $this->title, 'urls' => $urls, 'fellowship' => $fellowship, 'info' => $info, 'members' => $members, 'order' => $this->validRoles->keys(), 'the_roles' => $this->validRoles->keys()->implode(","), 'default_role' => $this->defaultRole ]);

        } else {
            return redirect()->route('allicare');            
        }
        
    }

    /*
     * Edit/Assign members to a role in an icare
     */
    public function assign(Request $request)
    {
        $fellowship_id = $request->{$this->paramid};
        $fellowship_role = empty($request->{$this->paramrole}) ? $this->defaultRole : $request->{$this->paramrole};

        // check if requested role is valid
        if(!array_key_exists($fellowship_role, $this->validRoles->toArray())) {
            return redirect()->route('allicare');    
        }

        if($this->baseModel->findIfExist('id', $fellowship_id)) {
            $results = Member::all();
            $fellowship = $this->baseModel->find($fellowship_id);
            $tableCols = array('name' => 'Name', 'icare' => 'iCare', 'age' => 'Age', 'gender' => 'Gender');
            $urls = array(
                'save' => route('saveicare'), 
                'edit' => route('assignicarerole', ["$this->paramid" => $fellowship_id])
            );

            // get current members
            $current_members = Group::where(['title' => $fellowship_role, 'group_id' => $fellowship_id, 'group_type' => $this->baseModel->model()])->lists('member_id')->toArray(); 
            $validRoles = $this->baseModel->castRoleField($this->validRoles);

            return view('icares.editmultiple', ['title' => $this->title, 'results' => $results, 'tableCols' => $tableCols, 'urls' => $urls, 'item' => $fellowship, 'validRoles' => $validRoles, 'defaultrole' => $fellowship_role, 'dlt_field' => $this->hdninput, 'current_members' => $current_members]); 

        } else {
            return redirect()->route('allicare');  
        }   
    }

     /*
     * Delete a icare
     */
    public function destroy(Request $request)
    {
        $icare_id = $request->{$this->hdninput};

        // form validation
        $this->validate($request, [
            "$this->hdninput" => 'bail|required|integer|exists:icares,id' 
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
                '_formaction' => 'bail|required|in:addIcare,editIcare,editRole',
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
                        'day' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
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
                        return redirect()->route('editicaremultiple', ["$this->paramid" => $fellowship_id, "$this->paramrole" => $member_role]);
                    }

                    $icare = $this->baseModel->find($fellowship_id);                    
                    $groups = Group::where(['title' => $member_role, 'group_id' => $fellowship_id, 'group_type' => $this->baseModel->model()])->get();
        
                    // if selected members are less than previous members, delete all entries first
                    if($groups->count() > 0 && count($member_ids) < $groups->count()) {
                        Group::where(['title' => $member_role, 'group_id' => $fellowship_id, 'group_type' => $this->baseModel->model()])->delete();
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
                            $newgroup = Group::create(['member_id' => $id, 'title' => $member_role, 'group_id' => $fellowship_id, 'group_type' => $this->baseModel->model()]);
                            $icare->roles()->save($newgroup);                     
                        }
                    }
                    $request->session()->flash('message', 'Update successful!');                            
                break;

                default:
                    return redirect()->route('allicare');    
                break;
            }
            return redirect()->route('editicare', [$fellowship_id]);
        }
        return redirect()->route('allicare');
    }

}
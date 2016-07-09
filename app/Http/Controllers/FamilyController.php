<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Requests;

use App\Group;
use App\Member;
use App\MemberRole;

use App\Http\Controllers\Controller;
use App\Repositories\FamilyRepository as Family;


use View;
use PDF;
use Barryvdh\Snappy;

class FamilyController extends Controller
{

    /**
     * The family repository instance.
     *
     * @var FamilyRepository
     */
    protected $family;

    /**
     * The valid family roles instance.
     *
     * @var Roles
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

    /**
     * Create a new controller instance.
     *
     * @param  FamilyRepository  $family
     * @return void
     */
    public function __construct(Family $family)
    {
        $this->middleware('auth');

        $this->family = $family;

        // get all valid roles
        $this->validRoles =  MemberRole::where('type', $this->family->model())
                     ->orderBy('priority', 'asc')
                     ->lists('maxlimit', 'title');

        //TODO: organize valid roles
        // $this->validRoles = array('father','mother','children');

        $this->title = array('header' => 'Families', 'singular' => 'Family');

        $this->defaultRole = 'children';
    }

    /**
     * Show a list of all available families.
     *
     */
    public function index(Request $request)
    {   
        // working pdf sample code
        // $data = array('father','mother','children');
        // $pdf = PDF::loadView('pdf.invoice', $data);
        // return $pdf->download('invoice.pdf');

        $results = $this->family->all(array('*'), true);
        $tableCols = array('name' => 'Name', 'member_count' => 'Number of Family Members');
        $urls = array('add' => route('addfamily'), 'delete' => route('deletefamily'), 'edit' => route('editfamily'), 'view' => route('viewfamily'));
        return view('members.index', ['title' => $this->title, 'results' => $results, 'tableCols' => $tableCols, 'urls' => $urls, 'dlt_field' => '_fmid']);
    }

    /*
     * Add a new family
     */
    public function add(Request $request)
    {        
        return view('families.add', ['title' => $this->title, 'urls' => array('save' => route('savefamily'))]);   
    }

    /*
     * View family detail
     * TODO: Print PDF option
     */
    public function view(Request $request)
    {
        // $fam_id = $request->famid;
        $fellowship_id = $request->famid;

        if ($this->family->findIfExist('id', $fellowship_id) ) { 
            
            $fellowship = $this->family->find($fellowship_id);
            $members = $this->family->getAllMembers($fellowship_id);

            $allmembers = $this->family->dandan($fellowship_id);
// var_dump($members); die();
            $results = $this->family->all();
            // $order = array('father', 'mother', 'children');
            $info = $fellowship->description;
            $tableCols = array('pic' => 'Pic', 'name' => 'Name', 'role' => 'Role in iCare', 'email' => 'Email', 'age' => 'Age', 'gender' => 'Gender', 'ministry' => 'Ministry', 'is_member' => 'Church Member');

            $validRoles = $this->family->castRoleField($this->validRoles);

            $urls = array(
                'add' => route('editfamilyrole', ['famid' => $fellowship_id, 'famrole' =>'father']), 
                'delete' => route('deletearole'), 
                'edit' => route('editfamilyrole', ['famid' => $fellowship_id]), 
                'addrole' => route('addfamilyrole', ['famid' => $fellowship_id, 'famrole' => 'children'] ), 
                'view' => 'family/view/', 
                'save' => route('savefamily')
            );
            return view('families.view', ['title' => $this->title, 'tableCols' => $tableCols, 'urls' => $urls, 'fellowship' => $fellowship, 'info' => $info, 'members' => $members, 'allmembers' => $allmembers, 'order' => $validRoles]);
        } else {
            return redirect()->route('allfamily');  
        }
    }

    public function viewpdf(Request $request)
    {
        $fam_id = $request->famid;

        if ($this->family->findIfExist('id', $fam_id) ) { 
            // working pdf sample code


            $family = $this->family->find($fam_id);
            $members = $this->family->getAllMembers($fam_id);
            $results = $this->family->all();
            $order = array('father', 'mother', 'children');
            $info = $family->description;
            $tableCols = array('name' => 'Name', 'icare' => 'iCare', 'age' => 'Age');
            $urls = array('add' => route('editfamilyrole', ['famid' => $fam_id, 'famrole' =>'father']), 'delete' => route('deletearole'), 'edit' => route('editfamilyrole', ['famid' => $fam_id]), 'addrole' => route('addfamilyrole', ['famid' => $fam_id, 'famrole' => 'children'] ), 'view' => 'family/view/', 'save' => route('savefamily'));
            // // return view('families.view', ['title' => $this->title, 'results' => $results, 'tableCols' => $tableCols, 'urls' => $urls, 'family' => $family, 'info' => $info, 'members' => $members, 'order' => $order]);


           

            // $view = View::make('families.view', ['title' => $this->title, 'results' => $results, 'tableCols' => $tableCols, 'urls' => $urls, 'family' => $family, 'info' => $info, 'members' => $members, 'order' => $order]);

            $view = View::make('pdf.dania', ['name' => 'Rishabh']);

            // $sections = $view->renderSections(); // returns an associative array of 'content', 'head' and 'footer'

            // var_dump($sections['content']); // this will only return whats in the content section
            // die();
            // $contents = (string) $view;
            // or
            $data = $view->render();
// var_dump($data); 
// die();
            // $data = array('father','mother','children');
            // // $data = ['title' => $this->title, 'results' => $results, 'tableCols' => $tableCols, 'urls' => $urls, 'family' => $family, 'info' => $info, 'members' => $members, 'order' => $order];
            // $data = ['title' => 'MY TITLE'];

        
            // $pdf = PDF::loadView('pdf.family', $data);
            
            $pdf = PDF::loadHTML($data);
            // $family = $this->family->find($fam_id);
            // $members = $this->family->getAllMembers($fam_id);
            // $results = $this->family->all();
            // $order = array('father', 'mother', 'children');
            // $info = $family->description;
            // $tableCols = array('name' => 'Name', 'icare' => 'iCare', 'age' => 'Age');
            // $urls = array('add' => route('editfamilyrole', ['famid' => $fam_id, 'famrole' =>'father']), 'delete' => route('deletearole'), 'edit' => route('editfamilyrole', ['famid' => $fam_id]), 'addrole' => route('addfamilyrole', ['famid' => $fam_id, 'famrole' => 'children'] ), 'view' => 'family/view/', 'save' => route('savefamily'));
            
            // // $data = array('father','mother','children');


            // $pdf = PDF::loadView('pdf.family', ['title' => $this->title, 'results' => $results, 'tableCols' => $tableCols, 'urls' => $urls, 'family' => $family, 'info' => $info, 'members' => $members, 'order' => $order]);

            // $pdf = App::make('snappy.pdf.wrapper');
// $pdf->loadHTML('<h1>Test</h1>');
            return $pdf->inline();
            return $pdf->inline('invoice.pdf');

            // return view('families.view', );
        } else {
            return redirect()->route('allfamily');  
        }

        
    }

    /*
     * Edit family general information
     */
    public function editFamily(Request $request)
    {   
     
        $fam_id = $request->famid;
        
        // check if family, member id is valid
        if ($this->family->findIfExist('id', $fam_id) ) {  
            $family = $this->family->find($fam_id);
            $members = $this->family->getAllMembers($fam_id);
            $info = $family->description; //other info
            $urls = array('add' => route('editfamilyrole', ['famid' => $fam_id, 'famrole' =>'father']), 'delete' => route('deletearole'), 'edit' => route('editfamilyrole', ['famid' => $fam_id]), 'addrole' => route('addfamilyrole', ['famid' => $fam_id, 'famrole' => 'children'] ), 'view' => 'family/view/', 'save' => route('savefamily'), 'editmultiple' => route('editfammultiple', ['famid' => $fam_id]));

            return view('families.edit', ['title' => $this->title, 'urls' => $urls, 'fellowship' => $family, 'info' => $info, 'members' => $members, 'order' => $this->validRoles->keys(), 'the_roles' => $this->validRoles->keys()->implode(","), 'default_role' => $this->defaultRole ]);

        } else {
            return redirect()->route('allfamily');            
        }
        
    }

    /*
     * Edit/assign a member to an existing role in a family
     */
    public function editRole(Request $request)
    {
        $fam_id = $request->famid;
        $fam_role = $request->famrole;
        
        // check if family, member id is valid
        if($this->family->findIfExist('id', $fam_id)) {
            $family = $this->family->find($fam_id);
            $results = Member::all();
            $member = $this->family->getMember($fam_id, $fam_role);
            $tableCols = array('name' => 'Name', 'age' => 'Age', 'gender' => 'Gender', 'icare' => 'iCare');
            $urls = array('save' => route('savefamily'), 'cancel' => route('editfamily', ['famid' => $fam_id]));
            return view('families.editrole', ['title' => $this->title, 'results' => $results, 'tableCols' => $tableCols, 'urls' => $urls, 'item' => $family, 'member' => $member, 'role' => $fam_role, 'dlt_field' => '_fmid']);

        } else {
            return redirect()->route('allfamily');     
        }
    }

    /*
     * Assign a member to new role in a family
     */
    public function addRole(Request $request)
    {
        $fam_role = $request->famrole;
        $fam_id = $request->famid;

        if($this->family->findIfExist('id', $fam_id)) {
            if(empty($fam_role)) $fam_role = 'children'; //set default role to children

            $results = Member::all();
            $family = $this->family->find($fam_id);
            $title = array('header' => 'Families', 'singular' => 'Keluarga');
            $tableCols = array('name' => 'Name', 'icare' => 'iCare', 'age' => 'Age', 'gender' => 'Gender');
            $urls = array('save' => route('savefamily'), 'edit' => route('editfamilyrole', ['famid' => $fam_id]));

            $validRoles = $this->family->castRoleField($this->validRoles);

            return view('families.addrole', ['title' => $this->title, 'results' => $results, 'tableCols' => $tableCols, 'urls' => $urls, 'validRoles' => $validRoles, 'item' => $family, 'defaultrole' => $fam_role, 'dlt_field' => '_fmid']); 

        } else {
            return redirect()->route('allfamily');  
        }   
    }

    /*
     * Edit/assign a member to an existing role in a icare
     */
    public function editRoleMultiple(Request $request)
    {
        $item_role = $this->defaultRole; //set default role to member
        $item_id = $request->famid;

        if($this->family->findIfExist('id', $item_id)) {
            
            $results = Member::all();
            $item = $this->family->find($item_id);
            $tableCols = array('name' => 'Name', 'icare' => 'iCare', 'age' => 'Age', 'gender' => 'Gender');
            $urls = array('save' => route('saveicare'), 'edit' => route('editicarerole', ['icareid' => $item_id]));

            foreach ($this->validRoles->keys() as $key => $value) {
                $validRoles[$value] = $value;
            }

            // get current members
            $groups = Group::where(['title' => $this->defaultRole, 'group_id' => $item_id, 'group_type' => $this->family->model()])->get(); 
            $current_members = array();
            foreach ($groups as $group) {
                array_push($current_members, $group->member_id);
            }

            return view('icares.editmultiple', ['title' => $this->title, 'results' => $results, 'tableCols' => $tableCols, 'urls' => $urls, 'validRoles' => $validRoles, 'item' => $item, 'defaultrole' => $item_role, 'dlt_field' => '_icrid', 'current_members' => $current_members]); 

        } else {
            return redirect()->route('allicare');  
        }   
    }


     /*
     * Delete a family
     */
    public function destroy(Request $request)
    {
        $fam_id = $request->_fmid;

        // form validation
        $this->validate($request, [
            '_fmid' => 'bail|required|integer|exists:families,id' 
        ]);

        $this->authorize('destroy', $this->family->find($fam_id));
        $this->family->delete($fam_id);
        $request->session()->flash('message', 'One family has been successfully deleted.');
        
        return redirect()->route('allfamily');

    }


    /*
     * Function to handle all save process like add, edit and updates in family
     */
    public function save(Request $request)
    {
        
        if ($request->isMethod('post')) {

            // form action validation
            $this->validate($request, [
                '_formaction' => 'bail|required|in:addFamily,editRole,editFamily',
            ]);

            $action = $request->_formaction;

            switch ($action) {

                case 'addFamily':
                    // form validation
                    $this->validate($request, [
                        'name' => 'bail|required|unique:families|max:255',
                        'phone' => 'alpha_dash',
                        'city' => 'max:255',
                        'address' => 'max:255',
                        'zipcode' => 'digits_between:0,8' 
                    ]);

                    // place other fields information into one array
                    $familyinfo = $this->family->castDescriptionField($request);
                    $fam_id = $this->family->create(['name' => $request->name, 'description' => $familyinfo]);
                    $request->session()->flash('message', 'You have successfully created a new family!');
                break;

                case 'editFamily':
                             
                    $fam_id = $request->_fmid;           
                    // form validation
                    $this->validate($request, [
                        'name' => 'bail|required|unique:families,name,'.$fam_id.'|max:255',
                        'phone' => 'alpha_dash',
                        'city' => 'max:255',
                        'address' => 'max:255',
                        'zipcode' => 'digits_between:0,8', 
                        '_fmid' => 'bail|required|integer|exists:families,id' 
                    ]);

                    // place other fields information into one array
                    $familyinfo = $this->family->castDescriptionField($request);
                    $this->family->update(['name' => $request->name, 'description' => $familyinfo], $fam_id, 'id');
                    $request->session()->flash('message', 'Update successful!');                    

                break;

                case 'editRole':
                    // form validation
                    $rule = $this->validRoles->keys()->implode(",");
                    $roleRule = "required|in:{$rule}";
                    $this->validate($request, [
                        '_fmid' => 'bail|required|integer|exists:families,id', 
                        '_mbrid' => 'bail|required|integer|exists:members,id',
                        '_fmaction' => 'required|in:replace,add',
                        '_mbrole' => $roleRule
                    ]);

                    $fam_id = $request->_fmid;
                    $member_id = $request->_mbrid;
                    $member_role = $request->_mbrole;
                    $fam_action = $request->_fmaction;
                    
                    // find if role already exists, whether replacing or creating it
                    if($fam_action == 'replace') {
                        $role = Group::firstOrNew(['title' => $member_role, 'group_id' => $fam_id, 'group_type' => $this->family->model()]);
                    } else {
                        // check if it's possible to add this role
                        $num_current = Group::where(['title' => $member_role, 'group_id' => $fam_id, 'group_type' => $this->family->model()])->count();
                        $num_max = $this->validRoles[$member_role];
                        if($num_max > 0 && $num_current == $num_max) {
                            // error, cannot add this role anymore
                            $request->session()->flash('message', "Invalid request. There cannot be more than $num_max $member_role for this family.");
                            $request->session()->flash('alert-class', 'alert-danger'); 
                            return redirect()->route('addfamilyrole', ['famid' => $fam_id, 'famrole' => $member_role]);
                        }

                        // add new role
                        $role = Group::firstOrNew(['title' => $member_role, 'group_id' => $fam_id, 'group_type' => $this->family->model(), 'member_id' => $member_id]);
                    }
                        
                    $role->member_id = $member_id;
                    $fam = $this->family->find($fam_id);
                    $fam->roles()->save($role); 
                    $request->session()->flash('message', 'Update successful!');                            

                break;
                
                default:
                    return redirect()->route('allfamily');    
                break;
            }
            return redirect()->route('editfamily', [$fam_id]);
        }
        return redirect()->route('allfamily');
    }

    // public function doajax(Request $request)
    // {
    //     if($request->ajax()){
    //         return "AJAX";
    //     }
    //     return "HTTP";
    // }
}
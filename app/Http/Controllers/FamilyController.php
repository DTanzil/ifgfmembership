<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Requests;

use App\Group;
use App\Member;
use App\MemberRole;

use App\Http\Controllers\Controller;
use App\Repositories\FamilyRepository as Family;

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
                     ->get();

        //TODO: organize valid roles
        $this->validRoles = array('father','mother','children');

        $this->title = array('header' => 'Families', 'singular' => 'Family');
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

        $results = $this->family->all();
        $tableCols = array('name' => 'Name', 'people' => '# of Members');
        $urls = array('add' => route('addfamily'), 'delete' => route('deletefamily'), 'edit' => route('editfamily'), 'view' => route('viewfamily'));
        return view('members.index', ['title' => $this->title, 'results' => $results, 'tableCols' => $tableCols, 'urls' => $urls]);
    }

    /*
     * Add a new family
     */
    public function add(Request $request)
    {        
        return view('families.add', ['title' => $this->title, 'urls' => array('save' => route('savefamily'))]);   
    }

    //TODO: NOT FINISHED
    public function view(Request $request)
    {
        $fam_id = 6;
        $family = $this->family->find($fam_id);

            $members = $this->family->getAllMembers($fam_id);
            
            foreach ($members as $key => $member) {
                # code...
            }
                   
            $results = $this->family->all();
            $order = array('father', 'mother', 'children');
            $info = $family->description;
            // $title = array('header' => 'Families', 'singular' => 'Keluarga');
            // $results = $this->->all();
            $tableCols = array('name' => 'Name', 'icare' => 'iCare', 'age' => 'Age');
            $urls = array('add' => route('editfamilyrole', ['famid' => $fam_id, 'famrole' =>'father']), 'delete' => route('deletearole'), 'edit' => route('editfamilyrole', ['famid' => $fam_id]), 'addrole' => route('addfamilyrole', ['famid' => $fam_id, 'famrole' => 'children'] ), 'view' => 'family/view/', 'save' => route('savefamily'));
            return view('families.view', ['title' => $this->title, 'results' => $results, 'tableCols' => $tableCols, 'urls' => $urls, 'family' => $family, 'info' => $info, 'members' => $members, 'order' => $order]);
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
            $order = array('father', 'mother', 'children');
            $info = $family->description; //other info
            $urls = array('add' => route('editfamilyrole', ['famid' => $fam_id, 'famrole' =>'father']), 'delete' => route('deletearole'), 'edit' => route('editfamilyrole', ['famid' => $fam_id]), 'addrole' => route('addfamilyrole', ['famid' => $fam_id, 'famrole' => 'children'] ), 'view' => 'family/view/', 'save' => route('savefamily'));

            return view('families.edit', ['title' => $this->title, 'urls' => $urls, 'family' => $family, 'info' => $info, 'members' => $members, 'order' => $order]);

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
            $tableCols = array('name' => 'Name', 'icare' => 'iCare', 'age' => 'Age');
            $urls = array('save' => route('savefamily'), 'cancel' => route('editfamily', ['famid' => $fam_id]));

            return view('families.editrole', ['title' => $this->title, 'results' => $results, 'tableCols' => $tableCols, 'urls' => $urls, 'family' => $family, 'member' => $member, 'role' => $fam_role]);

        } else {
            return redirect()->route('allfamily');     
        }
    }

    /*
     * Assign a member to new role in a family
     */
    public function addFamMemberRole(Request $request)
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

            foreach ($this->validRoles as $key => $value) {
                $validRoles[$value] = $value;
            }
            return view('families.addrole', ['title' => $this->title, 'results' => $results, 'tableCols' => $tableCols, 'urls' => $urls, 'validRoles' => $validRoles, 'family' => $family, 'defaultrole' => $fam_role]); 

        } else {
            return redirect()->route('allfamily');  
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
            '_fmid' => 'bail|required|integer',
        ]);

        if ($this->family->findIfExist('id', $fam_id) ) { 
            $this->authorize('destroy', $this->family->find($fam_id));
            $this->family->delete($fam_id);
            $request->session()->flash('message', 'One family has been successfully deleted.');
        } else {
            $request->session()->flash('message', 'Invalid family ID.');
            $request->session()->flash('alert-class', 'alert-danger'); 
        }
        
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
            $name = $request->old('name');

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
                    $fields = array('phone', 'city', 'address', 'zipcode');
                    $familyinfo = array();
                    foreach ($fields as $key => $value) {
                        $familyinfo[$value] = $request->$value;
                    }

                    $fam_id = $this->family->create(['name' => $request->name, 'description' => json_encode($familyinfo)]);
                    $request->session()->flash('message', 'You have successfully created a new family!');
                    // return redirect()->route('editviewfamily', [$fam]);
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
                    $fields = array('phone', 'city', 'address', 'zipcode');
                    $familyinfo = array();
                    foreach ($fields as $key => $value) {
                        $familyinfo[$value] = $request->$value;
                    }

                    $this->family->update(['name' => $request->name, 'description' => json_encode($familyinfo)], $fam_id, 'id');
                    $request->session()->flash('message', 'Update successful!');                    
                    // Session::flash('alert-class', 'alert-danger'); 


                break;

                case 'editRole':
                    // form validation
                    $rule = implode(",", $this->validRoles);
                    $roleRule = "required|in:{$rule}";
                    $this->validate($request, [
                        '_fmid' => 'bail|required|integer|exists:families,id' 
                        '_mbrid' => 'bail|required|integer|exists:members,id'
                        '_fmaction' => 'required|in:replace,add',
                        '_mbrole' => $roleRule
                    ]);

                    $fam_id = $request->_fmid;
                    $member_id = $request->_mbrid;
                    $member_role = $request->_mbrole;
                    $fam_action = $request->_fmaction;
                    
                    // check if role is included in family, if family & member id is valid
                    if ($this->family->findIfExist('id', $fam_id) ) {    

                        // find if role already exists, whether replacing or creating it
                        if($fam_action == 'replace') {
                            $role = Group::firstOrNew(['title' => $member_role, 'group_id' => $fam_id, 'group_type' => $this->family->model()]);
                        } else {
                            // add new role
                            $role = Group::firstOrNew(['title' => $member_role, 'group_id' => $fam_id, 'group_type' => $this->family->model(), 'member_id' => $member_id]);
                        }
                            
                        $role->member_id = $member_id;
                        $fam = $this->family->find($fam_id);
                        $fam->roles()->save($role); 
                        $request->session()->flash('message', 'Update successful!');                            

                    } else {
                        // family does not exist
                        // $request->session()->flash('message', 'Invalid request.');
                        // $request->session()->flash('alert-class', 'alert-danger'); 
                        return redirect()->route('allfamily');  
                    }
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
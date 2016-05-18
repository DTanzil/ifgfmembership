<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Requests;

use App\Role;
use App\Member;

use App\AppRole;
use App\User;

use App\Http\Controllers\Controller;
use App\Repositories\FamilyRepository as Family;

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
     * Create a new controller instance.
     *
     * @param  FamilyRepository  $family
     * @return void
     */
    public function __construct(Family $family)
    {
        $this->middleware('auth');

        // get all valid roles
        $this->validRoles = 'father,mother,children';
        $this->family = $family;
    }

    /**
     * Show a list of all available families.
     *
     */
    public function index(Request $request)
    {


        // $user = User::create(
        //     array(
        //          'name' => 'Alex',
        //          'password' => 'Cincinnati',
        //          'email' => 'alexsears@gmail.com',
        //          'city' => 'Cincinnati',
        //          'state' => 'OH'
        //     ));

        // $user = User::find(1);
        // $user->makeEmployee('admin');


        $results = $this->family->all();
        $title = array('header' => 'Families', 'singular' => 'Family');
        $tableCols = array('name' => 'Name', 'description' => 'Description');
        $urls = array('add' => route('addfamily'), 'delete' => route('deletefamily'), 'edit' => 'family/edit/', 'view' => route('viewfamily') );
        return view('members.index', ['title' => $title, 'results' => $results, 'tableCols' => $tableCols, 'urls' => $urls]);
    }

    // public function view($num)
    // {
    //     $results = $this->family->find($num);


    //     $title = array('header' => 'Families', 'singular' => 'Family');
    //     $tableCols = array('name' => 'Name', 'description' => 'Description');
    //     $urls = array('add' => 'family/add', 'delete' => 'family/delete/', 'edit' => 'family/edit/', 'view' => 'family/view/');
    //     return view('families.add', ['title' => $title, 'results' => $results, 'tableCols' => $tableCols, 'urls' => $urls]);   
    // }
 
    public function add(Request $request)
    {
        
        if ($request->isMethod('post')) {
            $name = $request->old('name');
            // form validation
            $this->validate($request, [
                'name' => 'bail|required|unique:families|max:255'
            ]);

            $fam = $this->family->create(['name' => $request->name]);
            
            $request->session()->flash('message', 'You have successfully created a new family!');
            // Session::flash('alert-class', 'alert-danger'); 

            return redirect()->route('viewfamily', [$fam]);
        }

        $urls = array('add' => route('addfamily'));
        $title = array('header' => 'Families', 'singular' => 'Family');
        return view('families.add', ['title' => $title, 'urls' => $urls]);   
        
    }

    public function save(Request $request)
    {
        if ($request->isMethod('post')) {

            // form validation
            $roleRule = "required|in:{$this->validRoles}";
            $this->validate($request, [
                '_fmid' => 'bail|required|integer',
                '_mbrid' => 'required|integer',
                '_mbrole' => $roleRule
            ]);

            $fam_id = $request->_fmid;
            $member_id = $request->_mbrid;
            $member_role = $request->_mbrole;

            // check if role is included in family, if family & member id is valid
            if ($this->family->findIfExist('id', $fam_id) ) {    
                // find if role already exists, just update not new role
                $role = Role::firstOrNew(['title' => $member_role, 'group_id' => $fam_id, 'group_type' => $this->family->model()]);
                if($member_role == 'children') {
                    // $role = Role::create(['name' => 'Flight 10'])
                }
                $role->member_id = $member_id;
                $fam = $this->family->find($fam_id);
                $fam->roles()->save($role); 

            } else {
                // family does not exist
                var_dump('eaffeafea'); die();
            }

            return redirect()->route('viewfamily', [$fam_id]);
        }
        
    }

    public function view(Request $request)
    {   
        
        $fam_id = $request->famid;
        

        //TODO: check if role is included in family, if family & member id is valid
        if ($this->family->findIfExist('id', $fam_id) ) {  
            $family = $this->family->find($fam_id);

            $members = $this->family->getAllMembers($fam_id);
            
            foreach ($members as $key => $value) {
                # code...
                // var_dump($value->title); 
            }
            
            $results = $this->family->all();
            $order = array('father', 'mother', 'children');

            $title = array('header' => 'Families', 'singular' => 'Keluarga');
            // $results = $this->->all();
            $tableCols = array('name' => 'Name', 'icare' => 'iCare', 'age' => 'Age');
            $urls = array('add' => route('editfamily', ['famid' => $fam_id, 'famrole' =>'father']), 'delete' => 'family/delete/', 'edit' => route('editfamily', ['famid' => $fam_id]), 'view' => 'family/view/');
            return view('families.view', ['title' => $title, 'results' => $results, 'tableCols' => $tableCols, 'urls' => $urls, 'family' => $family, 'members' => $members, 'order' => $order]);

        }
        
        $request->session()->flash('message', 'Invalid family ID.');
        $request->session()->flash('alert-class', 'alert-danger'); 
        return redirect()->route('allfamily');


       
    }

    public function edit(Request $request)
    {

        $fam_id = $request->famid;
        $fam_role = $request->famrole;

        $family = $this->family->find($fam_id);

        $results = Member::all();

        $title = array('header' => 'Families', 'singular' => 'Keluarga');
        // $results = $this->->all();

        $member = $this->family->getMember($fam_id, $fam_role);

        // if(!empty($member)) $member['title'] = $fam_role;
            // if(count($member[$fam_role]) > 1 ) {

            // }
            // $member = $member[$fam_role];
        // }
        // var_dump($member); die();

        $tableCols = array('name' => 'Name', 'icare' => 'iCare', 'age' => 'Age');
        $urls = array('add' => route('boboho'), 'save' => route('savefamily'), 'edit' => 'family/edit/', 'view' => 'family/view/');
        return view('families.edit', ['title' => $title, 'results' => $results, 'tableCols' => $tableCols, 'urls' => $urls, 'family' => $family, 'member' => $member, 'role' => $fam_role]);
    }

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
            // return redirect()->route('allfamily');
        } else {
            $request->session()->flash('message', 'Invalid family ID.');
            $request->session()->flash('alert-class', 'alert-danger'); 
        }
        
        return redirect()->route('allfamily');

    }

    public function doajax(Request $request)
    {
        if($request->ajax()){
            return "AJAX";
        }
        return "HTTP";
    }
}
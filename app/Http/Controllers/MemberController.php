<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Family;
// use App\MemberRole;
// use App\Member;

use App\Http\Controllers\Controller;
use App\Repositories\MemberRepository as Member;

use Image;

class MemberController extends Controller
{


    /**
     * The member repository instance.
     *
     * @var MemberRepository
     */
    protected $members;


     /**
     * Create a new controller instance.
     *
     * @param  MemberRepository  $members
     * @return void
     */
    public function __construct(Member $members)
    {
        $this->middleware('auth');

        $this->members = $members;
    }



    /**
     * Show a list of all members.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $title = array('header' => 'Members', 'singular' => 'Member');
        $results = $this->members->all();
        $tableCols = array('name' => 'Name', 'age' => 'Age', 'gender' => 'Gender', 'phone' => 'Phone', 'engage' => 'Member', 'icare' => 'iCare');
        $urls = array('add' => route('addmember'), 'delete' => '/member/delete/', 'edit' => '/member/edit/', 'view' => 'member/view/');
        return view('members.index', ['title' => $title, 'results' => $results, 'tableCols' => $tableCols, 'urls' => $urls]);
    }


    /**
     * Create a new member.
     *
     * @param  Request  $request
     * @return Response
     */
    public function add(Request $request)
    {
        $username = $request->old('name');

        // var_dump($request); die();
        
        // $this->validate($request, [
        //     'name' => 'required|max:3',
        //     'gender' => 'required|in:male,female'

        // ]);

        // $request->user()->members()->create([
        //     'name' => $request->name,
        // ]);


        $urls = array('add' => route('addmember'), 'delete' => '/member/delete/', 'save' => route('savemember'), 'view' => 'member/view/');
        
        $members = $this->members->all();
        return view('members.add', ['tasks' => $this->members, 'urls' => $urls]);

        // return redirect('/members');
    }

    public function display(Request $request)
    {
        $members = $this->members->all();
        return view('members.add', ['tasks' => $this->members]);
    }

    /*
     * Delete member photo
     */
    public function deletePhoto(Request $request)
    {
        $mbr_id = $request->_mbrid;
        $this->validate($request, [
            '_formaction' => 'bail|required|in:deleteMemberPhoto',
            '_mbrid' => 'bail|required|integer|exists:members,id' 
        ]);

        //TODO: delete existing member picture first
        //TODO: separate form and layout for profile picture
        $this->members->update(['image' => ''], $mbr_id, 'id');
    }

    /*
     * Function to handle all save process like add, edit and updates in family
     */
    public function save(Request $request)
    {
        
        if ($request->isMethod('post')) {

            // form action validation
            $this->validate($request, [
                '_formaction' => 'bail|required|in:addMember,editRole,editMember',
            ]);

            $action = $request->_formaction;
            $name = $request->old('name');

            switch ($action) {

                case 'addMember':
                    // var_dump($request);
                    // die();
                    // form validation
                    $this->validate($request, [
                        'name' => 'bail|required|unique:members|max:255',
                        'phone' => 'alpha_dash',
                        'city' => 'max:255',
                        'address' => 'max:255',
                        'zipcode' => 'digits_between:0,8',
                        'email' => 'required|email|unique:members',
                        'status' => 'required|in:single,married',
                        'gender' => 'required|in:male,female',
                        // 'image' => ''
                    ]);

                    // place other fields information into one array
                    $fields = array('phone', 'city', 'address', 'zipcode');
                    $memberinfo = array();
                    foreach ($fields as $key => $value) {
                        $memberinfo[$value] = $request->$value;
                    }

                    $mbr_id = $this->members->create(['name' => $request->name, 'email' => 'aaa@gmail.com', 'status' => 'single', 'gender' => 'female', 'description' => json_encode($memberinfo)]);
                    $request->session()->flash('message', 'You have successfully created a new member!');
                    // return redirect()->route('editviewfamily', [$fam]);
                break;

                case 'editMember':
                             
                    $mbr_id = $request->_mbrid;           
                    $data = array();

                    // form validation
                    $this->validate($request, [
                        'name' => 'bail|required|unique:members,name,'.$mbr_id.'|max:255',
                        'phone' => 'alpha_dash',
                        'city' => 'max:255',
                        'address' => 'max:255',
                        'zipcode' => 'digits_between:0,8',
                        'email' => 'required|email|unique:members,email,'.$mbr_id,
                        'status' => 'required|in:single,married',
                        'gender' => 'required|in:male,female',
                        'birthdate' => 'date',
                        'photo' => 'mimes:jpeg,bmp,png',
                        '_mbrid' => 'bail|required|integer|exists:members,id'
                    ]);                    

                    // place other fields information into one array
                    $fields = array('phone', 'city', 'address', 'zipcode');
                    $memberinfo = array();
                    foreach ($fields as $key => $value) {
                        $memberinfo[$value] = $request->$value;
                    }

                    $data = ['name' => $request->name, 'email' => $request->email, 'birthdate' => $request->birthdate, 'gender' => $request->gender, 'status' => $request->status, 'description' => json_encode($memberinfo)];

                    // check photo upload
                    $file = $request->file('photo');
                    if ($request->hasFile('photo')) {
                        // user upload a profile picture                        
                        if(!$request->file('photo')->isValid()) {
                            // redirect to photo error
                            $request->session()->flash('message', 'Error uploading photo, please try again.');                  
                            $request->session()->flash('alert-class', 'alert-danger');
                            return redirect()->route('editmember', [$mbr_id]); 
                        }
                       
                        $filename = "bar2." . $file->getClientOriginalExtension(); //TODO: randomize or systemize the naming
                        $path = public_path('img/members/' . $filename);
                        Image::make($file->getRealPath())->resize('200','200')->save($path);
                        $photourl = 'img/members/' . $filename;
                        $data['image'] = $photourl; 
                    } 

                    $this->members->update($data, $mbr_id, 'id');
                    $request->session()->flash('message', 'Update successful!');                    

                break;

                case 'editRole':
                    // form validation
                    $rule = implode(",", $this->validRoles);
                    $roleRule = "required|in:{$rule}";
                    $this->validate($request, [
                        '_fmid' => 'bail|required|integer',
                        '_mbrid' => 'required|integer',
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
            return redirect()->route('editmember', [$mbr_id]);
        }
        return redirect()->route('allfamily');
    }


    /*
     * Edit family general information
     */
    public function editMember(Request $request)
    {   
     
        $mbr_id = $request->mbrid;
        
        // check if family, member id is valid
        if ($this->members->findIfExist('id', $mbr_id) ) {  
            $member = $this->members->find(2);
            
            // $this->members->get
            // var_dump($member->roles); 
            // $fam = Family::find(2);
            // foreach ($fam->roles as $role) {
            //     var_dump($role);
            // }

            // die();
            $groups = $this->members->getAllGroups(2);
            
            // $info = $this->members->castDescriptionField($request);

            $info = $member->description;
            // var_dump($groups); 

            // die();
            // $members = $this->members->getAllMembers(2);
            // $order = array('father', 'mother', 'children');
            // $info = $family->description; //other info
            $urls = array('deletephoto' => route('deletephoto'), 'delete' => route('deletearole'), 'edit' => route('editfamilyrole', ['famid' => $mbr_id]), 'add' => route('addfamilyrole', ['famid' => $mbr_id, 'famrole' => 'children'] ), 'view' => 'family/view/', 'save' => route('savemember'));

            return view('members.editgeneral', ['title' => 'aijiea', 'info' => $info, 'urls' => $urls, 'member' => $member, 'groups' => $groups]);

        } else {
            return redirect()->route('allfamily');            
        }
        
    }

}
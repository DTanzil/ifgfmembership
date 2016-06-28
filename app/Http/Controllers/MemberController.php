<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Family;
// use App\MemberRole;
// use App\Member;
use Storage;
use Image;

use App\Http\Controllers\Controller;
use App\Repositories\MemberRepository as Member;


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
        $tableCols = array('name' => 'Name', 'age' => 'Age', 'gender' => 'Gender', 'is_member' => 'Member Status', 'icare' => 'iCare');
        $urls = array('add' => route('addmember'), 'delete' => '/member/delete/', 'edit' => route('editmember'), 'view' => 'member/view/');
        return view('members.index', ['title' => $title, 'results' => $results, 'tableCols' => $tableCols, 'urls' => $urls, 'dlt_field' => '_mbrid']);
    }


    /**
     * Create a new member.
     *
     * @param  Request  $request
     * @return Response
     */
    public function add(Request $request)
    {
        $urls = array('add' => route('addmember'), 'delete' => '/member/delete/', 'save' => route('savemember'), 'view' => 'member/view/');
        return view('members.add', ['urls' => $urls]);
    }

    // public function display(Request $request)
    // {
    //     $members = $this->members->all();
    //     return view('members.add', ['tasks' => $this->members]);
    // }

    /*
     * Delete member photo
     */
    public function deletePhoto(Request $request)
    {
        $mbr_id = $request->_mbrid;
        $this->validate($request, [
            '_formaction' => 'bail|required|in:deleteMemberPhoto,updateMemberPhoto',
            '_mbrid' => 'bail|required|integer|exists:members,id'
        ]);

        $member = $this->members->find($mbr_id, array('image'));
        $oldphoto = $member->image;

        switch ($request->_formaction) {
            case 'deleteMemberPhoto':
                // delete old picture file
                if(!empty($oldphoto) && Storage::disk('members')->has($oldphoto)) 
                    Storage::disk('members')->delete($oldphoto);
                
                $this->members->update(['image' => ''], $mbr_id, 'id');  
            break;
        
            case 'updateMemberPhoto':
                //replace or upload picture
                $this->validate($request, [
                    'photo' => 'bail|required|mimes:jpeg,bmp,png'
                ]);
                // delete old picture file
                if(!empty($oldphoto) && Storage::disk('members')->has($oldphoto)) 
                    Storage::disk('members')->delete($oldphoto);
                // user upload a profile picture
                if ($request->hasFile('photo'))
                    $photourl = $this->sanitizeFile($request);
                $this->members->update(['image' => $photourl], $mbr_id, 'id');

            break;

            default:
                return redirect()->route('allmember');
                break;
        }

        $request->session()->flash('message', 'Update successful!');  
        return redirect()->route('editmember', [$mbr_id]);
    }

    /*
     * Function to handle all save process like add, edit and updates in members
     */
    public function save(Request $request)
    {
        
        if ($request->isMethod('post')) {

            // form action validation
            $this->validate($request, [
                '_formaction' => 'bail|required|in:addMember,editRole,editMember',
            ]);

            switch ($request->_formaction) {

                case 'addMember':

                    // form validation
                    $this->validate($request, [
                        'name' => 'bail|required|unique:members|max:255',
                        'phone' => 'alpha_dash',
                        'city' => 'max:255',
                        'address' => 'max:255',
                        'zipcode' => 'digits_between:0,8',
                        'birthdate' => 'date_format:d/m/Y',
                        'email' => 'required|email|unique:members',
                        'status' => 'required|in:single,married',
                        'gender' => 'required|in:male,female',
                        'photo' => 'mimes:jpeg,bmp,png',
                        // 'mbrstatus' => 'required|in:member,visitor'
                    ]);
                    
                    // place other fields information into one array
                    $description = $this->sanitizeDescription($request);
                    //sanitize birthdate field
                    $birth_date = $this->sanitizeDate($request->birthdate);
                    $mbrstatus = $request->mbrstatus == 'member' ? true : false;

                    $data = ['name' => $request->name, 'email' => $request->email, 'birthdate' => $birth_date, 'gender' => $request->gender, 'status' => $request->status, 'description' => $description, 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now(), 'is_member' => $mbrstatus];

                     // check photo upload
                    if ($request->hasFile('photo')) {
                        $photourl = $this->sanitizeFile($request);
                        $data['image'] = $photourl; 
                    } 

                    $mbr_id = $this->members->create($data);
                    $request->session()->flash('message', 'You have successfully created a new member!');
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
                        'birthdate' => 'date_format:d/m/Y',
                        '_mbrid' => 'bail|required|integer|exists:members,id'
                    ]);                    

                    // place other fields information into one array
                    $description = $this->sanitizeDescription($request);

                    //sanitize birthdate field
                    $birth_date = $this->sanitizeDate($request->birthdate);
                    
                    $data = ['name' => $request->name, 'email' => $request->email, 'birthdate' => $birth_date, 'gender' => $request->gender, 'status' => $request->status, 'description' => $description];

                    $this->members->update($data, $mbr_id, 'id');
                    $request->session()->flash('message', 'Update successful!');                    

                break;

                case 'editRole':
                    // form validation
                    // $rule = implode(",", $this->validRoles);
                    // $roleRule = "required|in:{$rule}";
                    // $this->validate($request, [
                    //     '_fmid' => 'bail|required|integer',
                    //     '_mbrid' => 'required|integer',
                    //     '_fmaction' => 'required|in:replace,add',
                    //     '_mbrole' => $roleRule
                    // ]);

                    // $fam_id = $request->_fmid;
                    // $member_id = $request->_mbrid;
                    // $member_role = $request->_mbrole;
                    // $fam_action = $request->_fmaction;
                    
                    // // check if role is included in family, if family & member id is valid
                    // if ($this->family->findIfExist('id', $fam_id) ) {    

                    //     // find if role already exists, whether replacing or creating it
                    //     if($fam_action == 'replace') {
                    //         $role = Group::firstOrNew(['title' => $member_role, 'group_id' => $fam_id, 'group_type' => $this->family->model()]);
                    //     } else {
                    //         // add new role
                    //         $role = Group::firstOrNew(['title' => $member_role, 'group_id' => $fam_id, 'group_type' => $this->family->model(), 'member_id' => $member_id]);
                    //     }
                            
                    //     $role->member_id = $member_id;
                    //     $fam = $this->family->find($fam_id);
                    //     $fam->roles()->save($role); 
                    //     $request->session()->flash('message', 'Update successful!');                            

                    // } else {
                    //     // family does not exist
                    //     // $request->session()->flash('message', 'Invalid request.');
                    //     // $request->session()->flash('alert-class', 'alert-danger'); 
                    //     return redirect()->route('allfamily');  
                    // }
                break;
                
                default:
                    return redirect()->route('allmember');    
                break;
            }
            return redirect()->route('editmember', [$mbr_id]);
        }
        return redirect()->route('allmember');
    }


    /*
     * Edit family general information
     */
    public function editMember(Request $request)
    {   
     
        $mbr_id = $request->mbrid;
        
        // check if family, member id is valid
        if ($this->members->findIfExist('id', $mbr_id) ) {  
            $member = $this->members->find($mbr_id);
            $groups = $this->members->getAllGroups($mbr_id);
            $info = $member->description;
            $urls = array('deletephoto' => route('deletephoto'), 'updatephoto' => route('updatephoto'), 'delete' => route('deletearole'), 'edit' => route('editfamilyrole', ['famid' => $mbr_id]), 'add' => route('addfamilyrole', ['famid' => $mbr_id, 'famrole' => 'children'] ), 'view' => 'family/view/', 'save' => route('savemember'));

            return view('members.editgeneral', ['title' => 'aijiea', 'info' => $info, 'urls' => $urls, 'member' => $member, 'groups' => $groups]);

        } else {
            return redirect()->route('allfamily');            
        }
        
    }

    // check uploaded file and return its name
    private function sanitizeFile(Request $request)
    {
        $file = $request->file('photo');
        // user upload a profile picture                        
        if(!$request->file('photo')->isValid()) {
            // redirect to photo error
            $request->session()->flash('message', 'Error uploading photo, please try again.');                  
            $request->session()->flash('alert-class', 'alert-danger');
            return redirect()->route('editmember', [$request->_mbrid]); 
        }
        
        $filename =  str_random(30) . "." .$file->getClientOriginalExtension(); 
        $path = public_path('img/members/' . $filename);
        Image::make($file->getRealPath())->resize('200','200')->save($path);
        $photourl = 'img/members/' . $filename;
 
        return $photourl;

    }

    // change easy to read date format to Y-m-d for database
    private function sanitizeDate($date) 
    {
        if(empty($date)) {
            return null;
        } else {
            $formattedDate = \Carbon\Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
            return $formattedDate;
        }
    }

    // change multiple fields into json format 
    private function sanitizeDescription(Request $request) 
    {
        $fields = array('phone', 'city', 'address', 'zipcode');
        $memberinfo = array();
        foreach ($fields as $key => $value) {
            $memberinfo[$value] = $request->$value;
        }

        return json_encode($memberinfo);
    }

}
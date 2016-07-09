<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Family;
// use App\MemberRole;
// use App\Member;
use Storage;
use Image;

use Config;

use App\Icare;

use App\Engage;

use App\Http\Controllers\Controller;
use App\Repositories\MemberRepository as Member;


use App\functions\QRcode as QRcode;

class MemberController extends Controller
{


    /**
     * The model repository instance.
     *
     * @var MemberRepository
     */
    protected $baseModel;
    
    /**
     * The default Member role.
     */
    // protected $defaultRole;
    
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
    // protected $paramrole;

    /*
     * Hidden input id name for the form
     */
    protected $hdninput;



     /**
     * Create a new controller instance.
     *
     * @param  MemberRepository  $members
     * @return void
     */
    public function __construct(Member $members)
    {
        $this->middleware('auth');

        $this->baseModel = $members;
        $this->paramid = 'mbr';
        // $this->paramrole = 'icarerole';
        $this->hdninput = '_mbrid';
        $this->title = array('header' => 'Members', 'singular' => 'Member');

        
        // $member = $members->find(5);
        // $aa = Engage::find(1);
        
        // $cl = $member->engage;
        // foreach ($cl as $key => $value) {
        //     var_dump($value->name);
        // }

        // $ll = $aa->students;
        // foreach ($ll as $key => $value) {
        //     var_dump($value->name);
        //     var_dump($value->id);
        // }

        // $pp = $aa->classes;
        // foreach ($pp as $key => $value) {
        //     var_dump($value->name);
        // }

        
        
        // // var_dump($member->engage);
        // die();
            
        // tihs works with putting namespace on phpqrcode
        // include(app_path() . '\CustomStuff\CustomDirectory\phpqrcode.php');
        
        // $aa = new \App\CustomStuff\CustomDirectory\QRcode();
        // $aa::png('PHP QR Code :)');
        // $aa::png('aiefjiofae',false, QR_ECLEVEL_L, 14, 10); 
        

        // // $tempDir = "33";      
        // // $codeContents = '123456DEMO'; 
         
        // // generating 
        // $aa::png($codeContents, $tempDir.'007_1.png', QR_ECLEVEL_L, 1); 
        // // $aa::png($codeContents, $tempDir.'007_2.png', QR_ECLEVEL_L, 2); 
        // // $aa::png($codeContents, $tempDir.'007_3.png', QR_ECLEVEL_L, 3); 
             
        // // displaying 
        // // echo '<img src="'.EXAMPLE_TMP_URLRELPATH.'007_1.png" />'; 
        // // echo '<img src="'.EXAMPLE_TMP_URLRELPATH.'007_2.png" />'; 
        // // echo '<img src="'.EXAMPLE_TMP_URLRELPATH.'007_3.png" />'; 
        // // echo '<img src="'.EXAMPLE_TMP_URLRELPATH.'007_4.png" />'; 
        
        
    }



    /**
     * Show a list of all members.
     */
    public function index(Request $request)
    {
        $results = $this->baseModel->all();

        $tableCols = array('name' => 'Name', 'age' => 'Age', 'gender' => 'Gender', 'is_member' => 'Member Status', 'icare' => 'Icare');
        $urls = array(
            'add' => route('addmember'), 
            'delete' => '/member/delete/', 
            'edit' => route('editmember'), 
            'view' => route('viewmember')
        );
        return view('members.index', ['title' => $this->title, 'results' => $results, 'tableCols' => $tableCols, 'urls' => $urls, 'dlt_field' => "$this->hdninput", 'dlt_act' => 'deleteMember']);
    }


    /**
     * Create a new member.
     *
     * @param  Request  $request
     * @return Response
     */
    public function add(Request $request)
    {
        $urls = array(
            'add' => route('addmember'), 
            'delete' => '/member/delete/', 
            'save' => route('savemember'), 
            'view' => route('viewmember')
        );
        return view('members.add', ['urls' => $urls]);
    }

    /*
     * Edit family general information
     */
    public function edit(Request $request)
    {   
        $member = $request->{$this->paramid};
        $mbr_id = $member->id;
        $info = $member->description;

        $groups = array_keys(Config::get('constants.GROUPS'));

        // $groups = array('families', 'icares');

        $urls = array(
            'deletephoto' => route('deletephoto'), 
            'updatephoto' => route('updatephoto'), 
            'delete' => route('deleteicare'), 
            'edit' => route('editfamilyrole', ['famid' => $mbr_id]), 
            'add' => route('addfamilyrole', ['famid' => $mbr_id, 'famrole' => 'children'] ), 
            'view' => 'family/view/', 
            'save' => route('savemember')
        );
        return view('members.editgeneral', ['title' => $this->title, 'info' => $info, 'groups' => $groups, 'urls' => $urls, 'member' => $member]);
    }


    /*
     * Delete member photo
     */
    public function deletePhoto(Request $request)
    {
        $this->validate($request, [
            '_formaction' => 'bail|required|in:deleteMemberPhoto,updateMemberPhoto',
            "$this->hdninput" => 'bail|required|integer|exists:members,id'
        ]);

        $mbr_id = $request->{$this->hdninput};
        $member = $this->baseModel->find($mbr_id);
        $oldphoto = $member->image;
        $photourl = "";

        switch ($request->_formaction) {
            case 'deleteMemberPhoto':
                $photourl = "";
            break;
        
            case 'updateMemberPhoto':
                $photo_rule = Config::get('constants.VALID_IMAGE_TYPES');
                // form validation
                $this->validate($request, [
                    'photo' => "bail|required|mimes:$photo_rule"
                ]);
                // user upload a profile picture
                if($request->hasFile('photo')) $photourl = $this->sanitizePhotoUpload($request);
            break;

            default:
                return redirect()->route('allmember');
            break;
        }
       
        // delete old picture file
        if(!empty($oldphoto) && Storage::disk('img')->has($oldphoto)) {
            Storage::disk('img')->delete($oldphoto);  
        } 
        // update profile pic information
        $this->baseModel->update(['image' => $photourl], $mbr_id, 'id');
        $request->session()->flash('message', 'Update successful!');  
        return redirect()->route('editmember', [$mbr_id]);
    }

    /*
     * Function to handle all save process like add, edit and updates in members
     */
    public function save(Request $request)
    {
        
        if ($request->isMethod('post')) {

            $gender_rule = implode(array_keys(Config::get('constants.GENDER')), ",");
            $kids_rule = implode(array_keys(Config::get('constants.KIDS_CLASSES')), ",");
            $marital_rule = implode(array_keys(Config::get('constants.MARITAL_STATUS')), ",");
            $ibadah_rule = implode(array_keys(Config::get('constants.IBADAH')), ",");
            
            // form action validation
            $this->validate($request, [
                '_formaction' => 'bail|required|in:addMember,editRole,editMember',
            ]);

            switch ($request->_formaction) {

                case 'addMember':

                    // form validation
                    $this->validate($request, [
                        'name' => 'bail|required|max:255',
                        'phone' => 'alpha_dash',
                        'city' => 'max:255',
                        'address' => 'max:255',
                        'zipcode' => 'digits_between:0,8',
                        'birthdate' => 'date_format:d/m/Y',
                        'email' => 'required|email|unique:members,email',
                        'status' => "required|in:$marital_rule",
                        'gender' => "required|in:$gender_rule",
                        'photo' => 'mimes:jpeg,bmp,png',
                        'date_joined' => 'required|digits_between:4,4',
                        'service' => "required|in:$ibadah_rule",
                        'kids_class' => "required_if:service,kids|in:$kids_rule"
                    ]);
                    

                    // create member_id
                    $member_code = $this->createQRCode($request->gender);
                    // set kids_class empty if member is not in sunday school
                    if($request->service != 'kids') $request->kids_class = '';                    
                    // place other fields information into one array
                    $description = $this->baseModel->castDescriptionField($request, array('phone', 'city', 'address', 'zipcode', 'kids_class'));
                    //sanitize birthdate field
                    $birth_date = $this->sanitizeDate($request->birthdate);
                    //TODO: determine membership status

                    $data = ['name' => $request->name, 'member_id' => $member_code['mbr_id'], 'qr_image' => $member_code['qrimg'], 'email' => $request->email, 'birthdate' => $birth_date, 'service' => $request->service, 'gender' => $request->gender, 'status' => $request->status, 'date_joined' => $request->date_joined, 'description' => $description, 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()];

                     // check photo upload
                    if ($request->hasFile('photo')) {
                        $photourl = $this->sanitizePhotoUpload($request);
                        $data['image'] = $photourl; 
                    } 

                    $mbr_id = $this->baseModel->create($data);
                    $request->session()->flash('message', 'You have successfully created a new member!');
                break;

                case 'editMember':
                             
                    $mbr_id = $request->{$this->hdninput};           
                    $data = array();

                    // form validation
                    $this->validate($request, [
                        'name' => 'bail|required|max:255',
                        'phone' => 'alpha_dash',
                        'city' => 'max:255',
                        'address' => 'max:255',
                        'zipcode' => 'digits_between:0,8',
                        'birthdate' => 'date_format:d/m/Y',
                        'email' => 'required|email|unique:members,email,'.$mbr_id,
                        'status' => "required|in:$marital_rule",                        
                        'date_joined' => 'required|digits_between:4,4',
                        'service' => "required|in:$ibadah_rule",
                        "$this->hdninput" => 'bail|required|integer|exists:members,id',
                        'kids_class' => "required_if:service,kids|in:$kids_rule"
                    ]);                    

                    // set kids_class empty if member is not in sunday school
                    if($request->service != 'kids') $request->kids_class = '';    
                    // place other fields information into one array
                    $description = $this->baseModel->castDescriptionField($request, array('phone', 'city', 'address', 'zipcode', 'kids_class'));
                    //sanitize birthdate field
                    $birth_date = $this->sanitizeDate($request->birthdate);

                    $data = ['name' => $request->name, 'email' => $request->email, 'birthdate' => $birth_date, 'service' => $request->service, 'status' => $request->status, 'date_joined' => $request->date_joined, 'description' => $description];

                    $this->baseModel->update($data, $mbr_id, 'id');
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



    // check uploaded file and return its name
    private function sanitizePhotoUpload(Request $request)
    {
        $file = $request->file('photo');
        // user upload a profile picture                        
        if(!$request->file('photo')->isValid()) {
            // redirect to photo error
            $request->session()->flash('message', 'Error uploading photo, please try again.');                  
            $request->session()->flash('alert-class', 'alert-danger');
            return redirect()->route('editmember', [$request->{$this->hdninput}]); 
        }
        
        $filename =  str_random(10) . "." .$file->getClientOriginalExtension(); 
        $path = public_path('img/members/' . $filename);
        Image::make($file->getRealPath())->resize('200','200')->save($path);
        $photourl = 'img/members/'.  $filename;        
 
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

    private function createQRCode($gender)
    {
        // generate random member id
        $idtf = $gender == 'male' ? 'L' : 'P';
        $rand = strtoupper(substr(md5(microtime()),rand(0,26),6));
        $mbr_id = $idtf.$rand;

        $codeContents = 'http://google.com/382020/';   
        $filename = strtoupper(substr(md5(microtime()),rand(0,26),7));
        $path = public_path('img/members/') . $filename . '.png';
        $aa = QRcode::png($codeContents, $path, QR_ECLEVEL_L, 6, 8); 
        $url = 'img/members/'. $filename . '.png';
        
        // Storage::disk('members')->put('325252325.jpg', $aa);
        // Storage::put('file.jpg', $contents);
        // die();
        return array('mbr_id' => $mbr_id, 'qrimg' => $url);

    }

}
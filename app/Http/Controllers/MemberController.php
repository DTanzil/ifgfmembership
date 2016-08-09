<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Storage;
use Image;
use Config;
use App\Http\Controllers\Controller;
use App\Repositories\MemberRepository as Member;

class MemberController extends Controller
{


    /**
     * The model repository instance.
     *
     * @var MemberRepository
     */
    protected $baseModel;
        
    /*
     * General title page
     */
    protected $title;

    /*
     * Parameters for the URL
     */
    protected $paramid;

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
        $this->hdninput = '_mbrid';
        $this->title = array('header' => 'Members', 'singular' => 'Member');

        // $filename = 'img/members/DF97F93.png';
        // $aa = Image::make(storage_path() . '/' . $filename)->response();

        // $aa = Image::make(storage_path() . '/' . 'img/members/DF97F93.png')->response();
        
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
            'delete' => route('deletemember'), 
            'edit' => route('editmember'), 
            'view' => route('viewmember')
        );

        return view('members.index', ['title' => $this->title, 'results' => $results, 'tableCols' => $tableCols, 'urls' => $urls, 'dlt_field' => "$this->hdninput", 'dlt_act' => 'deleteMember']);
    }

    /**
     * Show the homepage.
     */
    public function home(Request $request)
    {
        $groups = Config::get('constants.GROUPS');
        return view('members.home', ['title' => $this->title, 'groups' => $groups]);
    }


    /**
     * Create a new member.
     *
     * @param  Request  $request
     * @return Response
     */
    public function add(Request $request)
    {
        return view('members.add', 
            ['title' => $this->title, 'urls' => array('save' => route('savemember'), 'cancel' => route('allmember'))]
        ); 
    }

    /*
     * Edit member general information
     */
    public function edit(Request $request)
    {   
        $member = $request->{$this->paramid};
        $mbr_id = $member->id;
        $info = $member->description;
        $groups = array_keys(Config::get('constants.GROUPS'));

        $urls = array(
            'deletephoto' => route('deletephoto'), 
            'updatephoto' => route('updatephoto'), 
            'delete' => array(
                'member' => route('deletemember'), 
                'family' => route('deletefamily'),
                'ministry' => route('deleteministry'),
                'icare' => route('deleteicare'),
                'engage' => route('deleteengage'),
                'establish' => route('deleteestablish'),
                'equip' => route('deleteequip'),
                'empower' => route('deleteempower')
            ),
            'viewgroup' => array(
                'member' => route('viewmember'), 
                'family' => route('viewfamily'),
                'ministry' => route('viewministry'),
                'icare' => route('viewicare'),
                'engage' => route('viewengage'),
                'establish' => route('viewestablish'),
                'equip' => route('viewequip'),
                'empower' => route('viewempower')
            ),
            'allgroup' => array(
                'member' => route('allmember'), 
                'family' => route('allfamily'),
                'ministry' => route('allministry'),
                'icare' => route('allicare'),
                'engage' => route('allengage'),
                'establish' => route('allestablish'),
                'equip' => route('allequip'),
                'empower' => route('allempower')
            ),
            'view' => route('viewmember', ['mbr' => $mbr_id] ),  
            'save' => route('savemember'),
            'cancel' => route('allmember')
        );
        return view('members.editgeneral', ['title' => $this->title, 'info' => $info, 'groups' => $groups, 'urls' => $urls, 'member' => $member, 'dlt_field' => $this->hdninput]);
    }

    /*
     * View member information
     */
    public function view(Request $request)
    {   
        $member = $request->{$this->paramid};
        $mbr_id = $member->id;
        $info = $member->description;
        $groups = array_keys(Config::get('constants.GROUPS'));
        $families = $member->family;
        $validRoles = \App\MemberRole::where('type', 'App\Family')->orderBy('priority', 'asc')->lists('maxlimit', 'title'); 
        $urls = array(
            'viewmember' => route('savemember'),
            'cancel' => route('editmember', ["$this->paramid" => $mbr_id]), 
            'assign' => route('savemember'),  
        );
       
        return view('members.view', ['title' => $this->title, 'validRoles' => $validRoles, 'info' => $info, 'groups' => $groups, 'urls' => $urls, 'member' => $member]);
    }


    /**
     * Show a list of all members and option to edit membership status.
     *
     */
    public function mymembers(Request $request)
    {   
        $results = $this->baseModel->all();
        $title = array('header' => 'Override Membership Status', 'singular' => 'Member');
        $tableCols = array('name' => 'Name', 'age' => 'Age', 'gender' => 'Gender', 'is_member' => 'Member Status', 'icare' => 'Icare');
        $urls = array(
            'add' => route('addmember'), 
            'delete' => route('deletefamily'), 
            'edit' => route('editmymember'), 
            'view' => route('viewmember')
        );
        return view('members.index', 
            ['title' => $title, 'results' => $results, 'tableCols' => $tableCols, 'urls' => $urls, 'dlt_field' => $this->hdninput, 'dlt_act' => 'deleteFamily', 'editbutton' => 'Edit Membership']
        );
    }

    /*
     * Edit membership status
     */
    public function editmembership(Request $request)
    {   
        $fellowship = $request->{$this->paramid};
        $fellowship_id = $fellowship->id;
        $info = $fellowship->description; //other info
        $tableCols = array('name' => 'Name', 'role' => sprintf("Role in %s", $this->title['singular']), 'email' => 'Email', 'age' => 'Age', 'gender' => 'Gender', 'is_member' => 'Church Member');

        $urls = array(
            'save' => route('savemember'), 
            'cancel' => route('mymember'),
        );
        $title = array('header' => 'Override Membership Status', 'singular' => 'Membership Status');
        return view('membership.edit', 
            ['title' => $title, 'tableCols' => $tableCols, 'urls' => $urls, 'member' => $fellowship, 'info' => $info, 'dlt_field' => $this->hdninput]
        );
    }

    /*
     * Show all kids
     */
    public function kids(Request $request)
    {
        $now = \Carbon\Carbon::now();
        $agelimit = Config::get('constants.KIDS_AGE'); 
        $base_date = $now->subYears($agelimit)->format('Y-m-d');
        $title = array('header' => 'Kids', 'singular' => 'Kids');

        $results = \App\Member::where('birthdate', '>', $base_date)->orWhere('service', '=', 'kids')->get()->each(function($item){
            $data = $item->description;
            $class = '-';
            if(!empty($data) && isset($data['kids_class']))
                $class = $data['kids_class'];
            $item->kids_class = $class;
        });

        $tableCols = array('name' => 'Name', 'age' => 'Age', 'gender' => 'Gender', 'service' => 'Ibadah', 'kids_class' => 'Kids Class');
        $urls = array(
            'add' => route('addmember'), 
            'delete' => route('deletemember'), 
            'edit' => route('editmember'), 
            'view' => route('viewmember')
        );

        return view('members.index', ['title' => $title, 'results' => $results, 'tableCols' => $tableCols, 'urls' => $urls, 'dlt_field' => "$this->hdninput", 'dlt_act' => 'deleteMember']);
    }



    /*
     * Delete one member
     * TODO: authorize which users can destroy [$this->authorize('destroy', $item)];
     */
    public function destroy(Request $request)
    {
        // form validation
        $this->validate($request, [
            '_formaction' => 'bail|required|in:deleteMember',
        ]);
        
        $member = $request->{$this->paramid};
        $member_id = $member->id;
        $action = $request->_formaction;

        switch ($action) {
            case 'deleteMember':
                $member->family()->detach();
                $member->icare()->detach();
                $member->ministry()->detach();
                $member->engage()->detach();
                $member->establish()->detach();
                $member->equip()->detach();
                $member->empower()->detach();

                //delete image & qr code
                $oldphoto = $member->image;
                if(!empty($oldphoto) && Storage::disk('img')->has($oldphoto)) {
                    Storage::disk('img')->delete($oldphoto);  
                }
                $qrcode = $member->qr_image;
                if(Storage::disk('img')->has($qrcode)) {
                    Storage::disk('img')->delete($qrcode);  
                }

                $member->delete();
                $request->session()->flash('message', sprintf("One %s has been successfully deleted.", $this->title['singular']));             
                 return redirect()->back();
            break;
        }
    }

    /*
     * Delete member photo
     */
    public function deletePhoto(Request $request)
    {
        $this->validate($request, [
            '_formaction1' => 'bail|required|in:deleteMemberPhoto',
            "$this->hdninput" => 'bail|required|integer|exists:members,id'
        ]);

        $mbr_id = $request->{$this->hdninput};
        $member = $this->baseModel->find($mbr_id);
        $oldphoto = $member->image;
        $photourl = "";
       
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
     * Delete member photo
     */
    public function updatePhoto(Request $request)
    {
        $photo_rule = Config::get('constants.VALID_IMAGE_TYPES');
        $this->validate($request, [
            '_formaction2' => 'bail|required|in:updateMemberPhoto',
            "$this->hdninput" => 'bail|required|integer|exists:members,id',
            'photo' => "bail|required|max:3500|mimes:$photo_rule"
        ]);

        $mbr_id = $request->{$this->hdninput};
        $member = $this->baseModel->find($mbr_id);
        $oldphoto = $member->image;
        $photourl = "";

        // user upload a profile picture
        if($request->hasFile('photo')) $photourl = $this->sanitizePhotoUpload($request);

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
        $gender_rule = implode(array_keys(Config::get('constants.GENDER')), ",");
        $kids_rule = implode(array_keys(Config::get('constants.KIDS_CLASSES')), ",");
        $marital_rule = implode(array_keys(Config::get('constants.MARITAL_STATUS')), ",");
        $ibadah_rule = implode(array_keys(Config::get('constants.IBADAH')), ",");
        
        // form action validation
        $this->validate($request, [
            '_formaction' => 'bail|required|in:addMember,editMember,memberStatus',
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

                // set kids_class empty if member is not in sunday school
                if($request->service != 'kids') $request->kids_class = '';                    
                // place other fields information into one array
                $description = $this->baseModel->castDescriptionField($request, array('phone', 'city', 'address', 'zipcode', 'kids_class'));
                //sanitize birthdate field
                $birth_date = $this->sanitizeDate($request->birthdate);
                $data = ['name' => $request->name, 'email' => $request->email, 'birthdate' => $birth_date, 'service' => $request->service, 'gender' => $request->gender, 'status' => $request->status, 'date_joined' => $request->date_joined, 'description' => $description, 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()];

                 // check photo upload
                if ($request->hasFile('photo')) {
                    $photourl = $this->sanitizePhotoUpload($request);
                    $data['image'] = $photourl; 
                } 

                $mbr_id = $this->baseModel->create($data);               
                // create member_id and update member
                $member_code = $this->baseModel->createQRCode($request->gender,$mbr_id);
                $data = ['member_id' => $member_code['mbr_id'], 'qr_image' => $member_code['qrimg']];
                $this->baseModel->update($data, $mbr_id, 'id');
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

            case 'memberStatus':                
                // form validation
                $this->validate($request, [
                    'membershipform' => "required|in:yesiagree",
                    "$this->hdninput" => 'bail|required|integer|exists:members,id',
                ]);                    

                $mbr_id = $request->{$this->hdninput};           
                $data = ['approve_member' => true];
                $this->baseModel->update($data, $mbr_id, 'id');
                $request->session()->flash('message', 'You have successfully updated the membership status!');     

            break;

            default:
                return redirect()->route('allmember');    
            break;
        }
        return redirect()->route('editmember', [$mbr_id]);
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
        $path = storage_path('img/members/' . $filename);
        Image::make($file->getRealPath())->resize('200','200')->save($path);
        $photourl = $filename;         
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


}
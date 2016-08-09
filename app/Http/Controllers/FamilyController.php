<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Config;
use App\Repositories\FamilyRepository as Family;

class FamilyController extends Controller
{

    /**
     * The model repository instance.
     *
     * @var FamilyRepository
     */
    protected $baseModel;

    /**
     * The valid roles instance.
     */
    protected $validRoles;
    
    /**
     * The default role.
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
     * @param  FamilyRepository  $family
     * @return void
     */
    public function __construct(Family $family)
    {
        $this->middleware('auth');
        $this->baseModel = $family;
        $this->defaultRole = 'children';
        $this->paramid = 'fam';
        $this->paramrole = 'famrole';
        $this->hdninput = '_fmid';
        $this->title = array('header' => 'Families', 'singular' => 'Family');
        $this->validRoles = $this->baseModel->getValidRoles(); //get valid roles
    }

    /**
     * Show a list of all available items.
     *
     */
    public function index(Request $request)
    {   
        $results = $this->baseModel->all();

        $tableCols = array('name' => 'Name', 'member_count' => sprintf("Number of %s Members", $this->title['singular']));

        $urls = array(
            'add' => route('addfamily'), 
            'delete' => route('deletefamily'), 
            'edit' => route('editfamily'), 
            'view' => route('viewfamily')
        );
        return view('members.index', 
            ['title' => $this->title, 'results' => $results, 'tableCols' => $tableCols, 'urls' => $urls, 'dlt_field' => $this->hdninput, 'dlt_act' => 'deleteFamily']
        );
    }

    /*
     * Add a new item
     */
    public function add(Request $request)
    {        
        return view('families.add', 
            ['title' => $this->title, 'urls' => array('save' => route('savefamily'), 'cancel' => route('allfamily'))]
        );   
    }

    /*
     * Edit general information
     */
    public function edit(Request $request)
    {   
        $fellowship = $request->{$this->paramid};
        $fellowship_id = $fellowship->id;
        $members = $this->baseModel->getMyMembers($fellowship); //get all members associated with this fellowship
        $info = $fellowship->description; //other info
        $tableCols = array('name' => 'Name', 'role' => sprintf("Role in %s", $this->title['singular']), 'email' => 'Email', 'age' => 'Age', 'gender' => 'Gender', 'is_member' => 'Church Member');
        $validRoles = $this->baseModel->castRoleField($this->validRoles);

        $urls = array(
            'add' => route('addfamily'),
            'delete' => route('deletefamily'), 
            'view' => route('viewfamily', ["$this->paramid" => $fellowship_id]),   
            'viewmember' => route('viewmember'),
            'save' => route('savefamily'), 
            'cancel' => route('allfamily'),
            'assign' => route('assignfamrole', ["$this->paramid" => $fellowship_id])
        );
        return view('families.edit', 
            ['title' => $this->title, 'tableCols' => $tableCols, 'urls' => $urls, 'members' => $members, 'fellowship' => $fellowship, 'info' => $info, 'validRoles' => $this->validRoles, 'order' => $validRoles, 'default_role' => $this->defaultRole, 'dlt_field' => $this->hdninput]
        );
    }

    /*
     * Edit/Assign members to a role
     */
    public function assign(Request $request)
    {
        // check if requested role is valid
        $fellowship_role = empty($request->{$this->paramrole}) ? $this->defaultRole : $request->{$this->paramrole};
        if(!array_key_exists($fellowship_role, $this->validRoles->toArray())) {
            return redirect()->route('allfamily');    
        }

        $fellowship = $request->{$this->paramid};
        $fellowship_id = $fellowship->id;
        $results = $this->baseModel->getAllMembers();
        $tableCols = array('name' => 'Name', 'ministry' => 'Ministry', 'age' => 'Age', 'gender' => 'Gender');

        // get current members
        $current_members = $fellowship->members()->getQuery()->where('title', $fellowship_role)->get()->lists('member_id')->toArray(); 
        $validRoles = $this->baseModel->castRoleField($this->validRoles);

        $urls = array(
            'save' => route('savefamily'), 
            'edit' => route('assignfamrole', ["$this->paramid" => $fellowship_id]),
            'cancel' => route('editfamily', ["$this->paramid" => $fellowship_id]), 
        );
        return view('icares.assign', 
            ['title' => $this->title, 'results' => $results, 'tableCols' => $tableCols, 'urls' => $urls, 'fellowship' => $fellowship, 'validRoles' => $validRoles, 'defaultrole' => $fellowship_role, 'dlt_field' => $this->hdninput, 'current_members' => $current_members]
        ); 
    }

    /*
     * View item detail
     */
    public function view(Request $request)
    {
        $fellowship = $request->{$this->paramid};
        $fellowship_id = $fellowship->id;
        $members = $this->baseModel->getMyMembers($fellowship);
       
        $info = $fellowship->description;
        $tableCols = array('name' => 'Name', 'role' => sprintf("Role in %s", $this->title['singular']), 'email' => 'Email', 'age' => 'Age', 'gender' => 'Gender', 'is_member' => 'Church Member');
        $validRoles = $this->baseModel->castRoleField($this->validRoles);
        $urls = array(
            'cancel' => route('editfamily', ["$this->paramid" => $fellowship_id]), 
        );

        return view('families.view', 
            ['title' => $this->title, 'tableCols' => $tableCols, 'urls' => $urls, 'fellowship' => $fellowship, 'info' => $info, 'members' => $members, 'order' => $validRoles]
        );
    }


    /*
     * TODO: View/Print PDF option
     */
    public function viewpdf(Request $request)
    {
        $view = \View::make('pdf.test', ['name' => 'Rishabh']);
        $data = $view->render();
        $pdf = \PDF::loadHTML($data);
        // return $pdf->inline();
        return $pdf->inline('invoice.pdf');
    }


    /*
     * Delete one icare or delete a member of the icare
     * TODO: authorize which users can destroy [$this->authorize('destroy', $item)];
     */
    public function destroy(Request $request)
    {
        // form validation
        $this->validate($request, [
            '_formaction' => 'bail|required|in:deleteFamily,deleteMember',
            '_mbrid' => "required_if:_formaction,deleteMember|exists:members,id",
        ]);
        
        $fellowship = $request->{$this->paramid};
        $fellowship_id = $fellowship->id;
        $action = $request->_formaction;

        switch ($action) {
            case 'deleteFamily':
                $fellowship->members()->detach();
                $fellowship->delete();
                $request->session()->flash('message', sprintf("One %s has been successfully deleted.", $this->title['singular']));
                return redirect()->route('allfamily');
            break;

            case 'deleteMember':
                $memberid = $request->_mbrid;
                $fellowship->members()->detach($memberid);                
                $request->session()->flash('message', sprintf("One member has been successfully dismissed from %s %s.", $fellowship->name, $this->title['singular']));
                return redirect()->back();
            break;
        }
    }


    /*
     * Function to handle all save process like add, edit and updates 
     * TODO: AUTHORIZE SAVE
     */
    public function save(Request $request)
    {
        // form action validation
        $this->validate($request, [
            '_formaction' => 'bail|required|in:addFamily,editFamily,editRole',
        ]);
        $action = $request->_formaction;
        
        switch ($action) {

            case 'addFamily':
                // form validation
                $this->validate($request, [
                    'name' => 'bail|required|unique:families|max:255',
                    'phone' => 'alpha_dash',
                    'city' => 'required|max:255',
                    'address' => 'required|max:255',
                    'zipcode' => 'required|digits_between:0,8',
                ]);

                $info = $this->baseModel->castDescriptionField($request);
                $fellowship_id = $this->baseModel->create(['name' => $request->name, 'description' => $info]);
                $request->session()->flash('message', sprintf("You have successfully created a new %s!", $this->title['singular']));                
            break;

            case 'editFamily':
                         
                $fellowship_id = $request->{$this->hdninput};
               
                // form validation
                $this->validate($request, [
                    'name' => 'bail|required|unique:families,name,'.$fellowship_id.'|max:255',
                    'phone' => 'alpha_dash',
                    'city' => 'required|max:255',
                    'address' => 'required|max:255',
                    'zipcode' => 'required|digits_between:0,8',
                    "$this->hdninput" => 'bail|required|integer|exists:families,id' 
                ]);

                $info = $this->baseModel->castDescriptionField($request);
                $this->baseModel->update(['name' => $request->name, 'description' => $info], $fellowship_id, 'id');
                $request->session()->flash('message', 'Update successful!');                    

            break;

            case 'editRole':
                $rule = $this->validRoles->keys()->implode(",");
                $roleRule = "required|in:{$rule}";
                // form validation
                $this->validate($request, [
                    "$this->hdninput" => 'bail|required|integer|exists:families,id', 
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
                    return redirect()->route('assignfamrole', ["$this->paramid" => $fellowship_id, "$this->paramrole" => $member_role]);
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
                return redirect()->route('allfamily');    
            break;
        }
        return redirect()->route('editfamily', [$fellowship_id]);
        
    }

}
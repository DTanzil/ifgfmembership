<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\MemberRole;
use Config;

class MemberRoleController extends Controller
{
    /**
     * The MemberRole instance.
     *
     * @var MemberRole
     */
    protected $role;

    /*
     * General title page
     */
    protected $title;

    /*
     * Hidden input id name for the form
     */
    protected $hdninput;

    /**
     * Create a new controller instance.
     *
     * @param  MemberRole  $role
     * @return void
     */
    public function __construct(MemberRole $role)
    {
        $this->middleware('auth');
        $this->hdninput = '_mbroleid';
        $this->title = array('header' => 'Member Roles', 'singular' => 'Role');
        $this->role = $role;
        $this->paramid = 'mbrrole';
    }

    /**
     * Display a list of all of the member's available roles.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {

        $tableCols = array('title' => 'Role Name', 'type' => 'Group', 'priority' => 'Rank', 'maxlimit' => 'Limit');
        $results = $this->role->all();
        $urls = array(
            'add' => route('addicare'), 
            // 'delete' => route('deletememberrole'), 
            'edit' => route('editicare'), 
            'view' => route('viewicare')
        );
        
        return view('member_roles.index', [
            'title' => $this->title, 'results' => $results, 'tableCols' => $tableCols, 'urls' => $urls, 'dlt_field' => $this->hdninput
        ]);
    }


    /**
     * Add new member role
     *
     * @param  Request  $request
     * @return Response
     */
    public function add(Request $request)
    {        
        $urls = array('save' => route('savememberroles'));   
        return view('member_roles.add', [
            'title' => $this->title, 'urls' => $urls
        ]);
    }

    /*
     * Function to handle all save process
     */
    public function save(Request $request)
    {
        $groups_rule = implode(array_keys(Config::get('constants.GROUPS')), ",");
        // form action validation
        $this->validate($request, [
            '_formaction' => 'bail|required|in:addMbrRole,editMbrRole',
            'name' => 'bail|required|max:20',
            'group' => "required|in:$groups_rule",
            'limit' => 'required|integer|digits_between:1,1',
            'rank' => 'required|integer|digits_between:1,1',
            "$this->hdninput" => "required_if:_formaction,editMbrRole|exists:members_roles,id",
        ]);
        
        $action = $request->_formaction;
        $models = Config::get('constants.GROUPS_MODELS');
        $group = $models[$request->group];            
        $name = trim($request->name);
        $title = strtolower(str_replace(" ","-", $name));

        switch ($action) {
            case 'addMbrRole':
                MemberRole::create(['title' => $title, 'name' => $request->name, 'type' => $group, 'maxlimit' => $request->limit, 'priority' => $request->rank]);
                $request->session()->flash('message', 'You have successfully created a new role!');    
                break;
            case 'editMbrRole':
                $id = $request->{$this->hdninput};
                $role = MemberRole::find($id);

                MemberRole::where('id', $id)
                          ->update(['title' => $title, 'name' => $request->name, 'type' => $group, 'maxlimit' => $request->limit, 'priority' => $request->rank]);
                $request->session()->flash('message', 'You have successfully updated a role!');  
                break;
        }
        return redirect()->route('allmemberroles');
    }

    /**
     * Destroy the given role.
     *
     * @param  Request  $request
     * @param  MemberRole  $mbrrole
     * @return Response
     */
    public function destroy(Request $request, MemberRole $mbrrole)
    {
        // $this->authorize('destroy', $task);
        $mbrrole->delete();
        $request->session()->flash('message', 'You have successfully deleted a role!');   
        return redirect()->route('allmemberroles');
    }


}

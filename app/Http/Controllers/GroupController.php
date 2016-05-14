<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Storage;

use App\Role;
use App\Family;

use App\Http\Controllers\Controller;
use App\Repositories\GroupRepository as Group;

class GroupController extends Controller
{


    /**
     * The member repository instance.
     *
     * @var MemberRepository
     */
    protected $groups;

    private $validTypes;


     /**
     * Create a new controller instance.
     *
     * @param  GroupRepository  $groups
     * @return void
     */
    public function __construct(Group $groups)
    {
        $this->middleware('auth');

        // $contents = Storage::get('groups.txt');
        // var_dump($contents);die();

        $this->validTypes = array('family','icare','ministry');
        $this->groups = $groups;
    }



    /**
     * Show a list of all groups.
     *
     * @return Response
     */
    public function index(Request $request)
    {

        // $validGroups = array('family','icare','ministry');
        $type = $request->type;

        // $results = $this->groups->all();
        // $results = $this->groups->all(array('type'));


        if(in_array($type, $this->validTypes)) {
            
            $results = $this->groups->findWhere('type',$type);
            $urls = array('delete' => '/member/delete/', 'edit' => '/member/edit/', 'view' => 'member/view/');

            switch ($type) {
                case 'family':
                    $title = array('header' => 'Families', 'singular' => 'Family');
                    $tableCols = array('name' => 'Name', 'description' => 'Description', 'date_start' => 'Start Date', 'type' => 'Type');
                break;
            
                case 'icare':
                    $title = array('header' => 'iCares', 'singular' => 'iCare');
                    $tableCols = array('name' => 'Name', 'description' => 'Description', 'date_start' => 'Start Date', 'type' => 'Type');
                break;
                
                default:
                    $title = array('header' => 'Ministries', 'singular' => 'Ministry');
                    $tableCols = array('name' => 'Name', 'description' => 'Description', 'date_start' => 'Start Date', 'type' => 'Type');
                break;
            }

            return view('members.index', ['title' => $title, 'results' => $results, 'tableCols' => $tableCols, 'urls' => $urls]);
        }

        //TODO: error 404

    }

    /**
     * Create a new member.
     *
     * @param  Request  $request
     * @return Response
     */
    public function add(Request $request)
    {
        // $username = $request->old('name');

        // // var_dump($request); die();
        
        // $this->validate($request, [
        //     'name' => 'required|max:3',
        //     'gender' => 'required|in:male,female'

        // ]);

        // $request->user()->members()->create([
        //     'name' => $request->name,
        // ]);

        $role = new Role(['title' => 'Father', 'description' => 'A father figure', 'member_id' => 22]);

        $family = Family::find(1);

        $family->roles()->save($role);

        return redirect('/members');
    }

    public function display(Request $request)
    {
        $members = $this->groups->all();
        return view('members.add', ['tasks' => $this->members]);
    }

}
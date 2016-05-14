<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

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
        $tableCols = array('name' => 'Name', 'age' => 'Age', 'gender' => 'Gender', 'phone' => 'Phone', 'classes' => 'Classes', 'engage' => 'Member');
        $urls = array('add' => 'family/add', 'delete' => '/member/delete/', 'edit' => '/member/edit/', 'view' => 'member/view/');
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
        
        $this->validate($request, [
            'name' => 'required|max:3',
            'gender' => 'required|in:male,female'

        ]);

        $request->user()->members()->create([
            'name' => $request->name,
        ]);

        return redirect('/members');
    }

    public function display(Request $request)
    {
        $members = $this->members->all();
        return view('members.add', ['tasks' => $this->members]);
    }

}
<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Requests;

use App\Family;
use App\Member;
use App\Http\Controllers\Controller;

class FamilyController extends Controller
{
    /**
     * Show a list of all available families.
     *
     */
    public function index(Request $request)
    {
        // var_dump($request->profileee); die();
        $results = Family::all();


        $title = array('header' => 'Families', 'singular' => 'Family');
        // $results = $this->->all();
        $tableCols = array('name' => 'Name', 'description' => 'Description');
        $urls = array('add' => 'family/add', 'delete' => 'family/delete/', 'edit' => 'family/edit/', 'view' => 'family/view/');
        return view('members.index', ['title' => $title, 'results' => $results, 'tableCols' => $tableCols, 'urls' => $urls]);


        // return view('members.index', ['members' => $families]);
    }

    public function view($num)
    {
        

        $results = Family::all();


        $title = array('header' => 'Families', 'singular' => 'Family');
        // $results = $this->->all();
        $tableCols = array('name' => 'Name', 'description' => 'Description');
        $urls = array('add' => 'family/add', 'delete' => 'family/delete/', 'edit' => 'family/edit/', 'view' => 'family/view/');
        return view('families.add', ['title' => $title, 'results' => $results, 'tableCols' => $tableCols, 'urls' => $urls]);   
    }

    public function add(Request $request)
    {

       if ($request->isMethod('post')) {

            $this->validate($request, [
                'name' => 'bail|required|max:255'
            ]);

            $fam = new Family(['name' => $request->name]);
            $fam->save();

            // $famid = 3;
            // return redirect()->action('FamilyController@addSuccess', ['familyid' => $famid]);

            // return redirect('/family/add/success', $fam);

            return redirect()->route('famsuccess', [$fam]);
        }

        $results = Family::all();
        $title = array('header' => 'Families', 'singular' => 'Family');
        // $results = $this->->all();
        $tableCols = array('name' => 'Name', 'icare' => 'iCare', 'age' => 'Age');
        $urls = array('add' => 'family/add', 'delete' => 'family/delete/', 'edit' => 'family/edit/', 'view' => 'family/view/');
        return view('families.add', ['title' => $title, 'results' => $results, 'tableCols' => $tableCols, 'urls' => $urls]);   
        
    }

    public function addSuccess(Request $request)
    {   
        
        $fam_id = $request->famid;
        $family = Family::find($fam_id);

        $results = Family::all();

        $title = array('header' => 'Families', 'singular' => 'Keluarga');
        // $results = $this->->all();
        $tableCols = array('name' => 'Name', 'icare' => 'iCare', 'age' => 'Age');
        $urls = array('add' => route('editfamily', $fam_id, 'father'), 'delete' => 'family/delete/', 'edit' => route('editfamily', $fam_id, 'father'), 'view' => 'family/view/');
        return view('families.view', ['title' => $title, 'results' => $results, 'tableCols' => $tableCols, 'urls' => $urls, 'family' => $family]);
    }

    public function edit(Request $request)
    {

        $fam_id = $request->famid;
        $fam_role = $request->famrole;

        $family = Family::find($fam_id);

        $results = Member::all();

        $title = array('header' => 'Families', 'singular' => 'Keluarga');
        // $results = $this->->all();


        $tableCols = array('name' => 'Name', 'icare' => 'iCare', 'age' => 'Age');
        $urls = array('add' => route('boboho'), 'delete' => 'family/delete/', 'edit' => 'family/edit/', 'view' => 'family/view/');
        return view('families.edit', ['title' => $title, 'results' => $results, 'tableCols' => $tableCols, 'urls' => $urls, 'family' => $family]);
    }



    public function doajax(Request $request)
    {
        if($request->ajax()){
            return "AJAX";
        }
        return "HTTP";
    }
}
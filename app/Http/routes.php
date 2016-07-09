<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () {
        return view('welcome');
    })->middleware('guest');

    Route::get('/tasks', 'TaskController@index');
    Route::post('/task', 'TaskController@store');
    Route::delete('/task/{task}', 'TaskController@destroy');


    // MEMBERS ROUTES
    Route::model('mbr', 'App\Member');
    Route::get('/members', ['as' => 'allmember', 'uses' => 'MemberController@index']);
    Route::get('/members/add', ['as' => 'addmember', 'uses' => 'MemberController@add']);

    Route::get('/members/view/{mbr?}', ['as' => 'viewmember', 'uses' => 'MemberController@view']); // not yet

    Route::post('/members/save', ['as' => 'savemember', 'uses' => 'MemberController@save']);
    Route::get('/members/edit/{mbr?}', ['as' => 'editmember', 'uses' => 'MemberController@edit']);

    
    // Route::post('/member/add', ['as' => 'addmember', 'uses' => 'MemberController@add']);
    Route::delete('/members/photo/delete', ['as' => 'deletephoto', 'uses' => 'MemberController@deletePhoto']);
    Route::post('/members/photo/update', ['as' => 'updatephoto', 'uses' => 'MemberController@deletePhoto']);


    // FAMILY ROUTES 
    Route::get('/family', ['as' => 'allfamily', 'uses' => 'FamilyController@index']);
    Route::get('/family/add', ['as' => 'addfamily', 'uses' => 'FamilyController@add']);
    Route::get('/family/edit/{famid?}', ['as' => 'editfamily', 'uses' => 'FamilyController@editFamily']);
    Route::get('/family/edit/{famid}/{famrole?}', ['as' => 'editfamilyrole', 'uses' => 'FamilyController@editRole']);
    Route::get('/family/new/{famid}/{famrole?}', ['as' => 'addfamilyrole', 'uses' => 'FamilyController@addRole']);
    Route::get('/family/view/{famid?}', ['as' => 'viewfamily', 'uses' => 'FamilyController@view']);
    Route::get('/family/viewpdf/{famid?}', ['as' => 'viewpdffamily', 'uses' => 'FamilyController@viewpdf']);
    Route::get('/family/editmultiple/{famid}', ['as' => 'editfammultiple', 'uses' => 'FamilyController@editRoleMultiple']);

    // Route::post('/family/add', ['as' => 'addfamily', 'uses' => 'FamilyController@add']);           
    Route::post('/family/save', ['as' => 'savefamily', 'uses' => 'FamilyController@save']);
    Route::delete('/family/delete', ['as' => 'deletefamily', 'uses' => 'FamilyController@destroy']);


    // ICARE ROUTES
    Route::model('icare', 'App\Icare');
    Route::get('/icares', ['as' => 'allicare', 'uses' => 'IcareController@index']);
    Route::get('/icares/add', ['as' => 'addicare', 'uses' => 'IcareController@add']);
    Route::get('/icares/edit/{icare?}', ['as' => 'editicare', 'uses' => 'IcareController@edit']);
    Route::get('/icares/assign/{icare}/{icarerole?}', ['as' => 'assignicarerole', 'uses' => 'IcareController@assign']);
    Route::get('/icares/view/{icare?}', ['as' => 'viewicare', 'uses' => 'IcareController@view']);
    Route::post('/icares/save', ['as' => 'saveicare', 'uses' => 'IcareController@save']);
    Route::delete('/icares/delete/{icare?}', ['as' => 'deleteicare', 'uses' => 'IcareController@destroy']);
    
    // MINISTRY ROUTES
    Route::get('/ministry', ['as' => 'allministry', 'uses' => 'MinistryController@index']);
    Route::get('/ministry/edit/{minid?}', ['as' => 'editministry', 'uses' => 'MinistryController@edit']);
    

    // MEMBER ROLES ROUTE
    Route::get('/mbrroles', ['as' => 'allmemberroles', 'uses' => 'MemberRoleController@index']);
    Route::get('/mbrroles/add', ['as' => 'addmemberroles', 'uses' => 'MemberRoleController@add']);
    Route::post('/mbrroles/save', ['as' => 'savememberroles', 'uses' => 'MemberRoleController@save']);
    // Route::get('/mbrroles/edit/{mbrrole?}', ['as' => 'editmemberroles', 'uses' => 'MemberRoleController@edit']);
    // Route::delete('/mbrroles/delete/{mbrrole?}', ['as' => 'deletememberrole', 'uses' => 'MemberRoleController@destroy']);
    


    // Route::delete('/group/deletearole', ['as' => 'deletearole', 'uses' => 'GroupController@destroy']);

    // BLA BLA 
    Route::get('/family/user/profile/add', ['as' => 'boboho', 'uses' => 'FamilyController@index']);
    Route::post('/family/user/profile/add', ['as' => 'profileee', 'uses' => 'FamilyController@doajax']);

    
    // Route::get('/groups', 'GroupController@index');
    Route::get('/groups/{type}', 'GroupController@index');
    Route::get('groups/family/add', 'GroupController@add');
    

    Route::auth();

});

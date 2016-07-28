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


    // KIDS ROUTES
    Route::get('/kids', ['as' => 'allkids', 'uses' => 'MemberController@kids']);


    // MEMBERS ROUTES
    Route::model('mbr', 'App\Member');
    Route::get('/members', ['as' => 'allmember', 'uses' => 'MemberController@index']);

    
    Route::get('/members/add', ['as' => 'addmember', 'uses' => 'MemberController@add']);

    Route::get('/members/view/{mbr?}', ['as' => 'viewmember', 'uses' => 'MemberController@view']); 

    Route::post('/members/save', ['as' => 'savemember', 'uses' => 'MemberController@save']);
    Route::get('/members/edit/{mbr?}', ['as' => 'editmember', 'uses' => 'MemberController@edit']);

    
    // Route::post('/member/add', ['as' => 'addmember', 'uses' => 'MemberController@add']);
    Route::delete('/members/photo/delete', ['as' => 'deletephoto', 'uses' => 'MemberController@deletePhoto']);
    Route::post('/members/photo/update', ['as' => 'updatephoto', 'uses' => 'MemberController@updatePhoto']);



    // ICARE ROUTES
    Route::model('icare', 'App\Icare');
    Route::get('/icares', ['as' => 'allicare', 'uses' => 'IcareController@index']);
    Route::get('/icares/add', ['as' => 'addicare', 'uses' => 'IcareController@add']);
    Route::get('/icares/edit/{icare?}', ['as' => 'editicare', 'uses' => 'IcareController@edit']);
    Route::get('/icares/assign/{icare}/{icarerole?}', ['as' => 'assignicarerole', 'uses' => 'IcareController@assign']);
    Route::get('/icares/view/{icare?}', ['as' => 'viewicare', 'uses' => 'IcareController@view']);
    Route::post('/icares/save', ['as' => 'saveicare', 'uses' => 'IcareController@save']);
    Route::delete('/icares/delete/{icare?}', ['as' => 'deleteicare', 'uses' => 'IcareController@destroy']);
    
    // FAMILY ROUTES 
    Route::model('fam', 'App\Family');
    Route::get('/family', ['as' => 'allfamily', 'uses' => 'FamilyController@index']);
    Route::get('/family/add', ['as' => 'addfamily', 'uses' => 'FamilyController@add']);
    Route::get('/family/edit/{fam?}', ['as' => 'editfamily', 'uses' => 'FamilyController@edit']);
    Route::get('/family/assign/{fam}/{famrole?}', ['as' => 'assignfamrole', 'uses' => 'FamilyController@assign']);
    Route::get('/family/view/{fam?}', ['as' => 'viewfamily', 'uses' => 'FamilyController@view']);
    Route::post('/family/save', ['as' => 'savefamily', 'uses' => 'FamilyController@save']);
    Route::delete('/family/delete/{fam?}', ['as' => 'deletefamily', 'uses' => 'FamilyController@destroy']);

    // MINISTRY ROUTES
    Route::model('mstry', 'App\Ministry');
    Route::get('/ministry', ['as' => 'allministry', 'uses' => 'MinistryController@index']);
    Route::get('/ministry/add', ['as' => 'addministry', 'uses' => 'MinistryController@add']);
    Route::get('/ministry/edit/{mstry?}', ['as' => 'editministry', 'uses' => 'MinistryController@edit']);
    Route::get('/ministry/assign/{mstry}/{mstrole?}', ['as' => 'assignmstrole', 'uses' => 'MinistryController@assign']);
    Route::get('/ministry/view/{mstry?}', ['as' => 'viewministry', 'uses' => 'MinistryController@view']);
    Route::post('/ministry/save', ['as' => 'saveministry', 'uses' => 'MinistryController@save']);
    Route::delete('/ministry/delete/{mstry?}', ['as' => 'deleteministry', 'uses' => 'MinistryController@destroy']);

    // Route::get('/family/edit/{famid}/{famrole?}', ['as' => 'editfamilyrole', 'uses' => 'FamilyController@editRole']);
    // Route::get('/family/new/{famid}/{famrole?}', ['as' => 'addfamilyrole', 'uses' => 'FamilyController@addRole']);
    // Route::get('/family/viewpdf/{famid?}', ['as' => 'viewpdffamily', 'uses' => 'FamilyController@viewpdf']);
    // Route::get('/family/editmultiple/{famid}', ['as' => 'editfammultiple', 'uses' => 'FamilyController@editRoleMultiple']);






    // APPROVE MEMBERS ROUTES
    Route::model('mbr', 'App\Member');
    Route::get('/mymembers', ['as' => 'mymember', 'uses' => 'ApproveMemberController@index']);
    Route::get('/mymembers/edit/{mbr?}', ['as' => 'editmymember', 'uses' => 'ApproveMemberController@edit']);
    // Route::get('/members/add', ['as' => 'addmember', 'uses' => 'MemberController@add']);












    

    // MEMBER ROLES ROUTE
    Route::get('/mbrroles', ['as' => 'allmemberroles', 'uses' => 'MemberRoleController@index']);
    Route::get('/mbrroles/add', ['as' => 'addmemberroles', 'uses' => 'MemberRoleController@add']);
    Route::post('/mbrroles/save', ['as' => 'savememberroles', 'uses' => 'MemberRoleController@save']);

    // Route::get('/mbrroles/edit/{mbrrole?}', ['as' => 'editmemberroles', 'uses' => 'MemberRoleController@edit']);
    // Route::delete('/mbrroles/delete/{mbrrole?}', ['as' => 'deletememberrole', 'uses' => 'MemberRoleController@destroy']);
    
    // ENGAGE ROUTE
    Route::model('eng', 'App\Engage');
    Route::get('/engage', ['as' => 'allengage', 'uses' => 'EngageController@index']);
    Route::get('/engage/add', ['as' => 'addengage', 'uses' => 'EngageController@add']);
    Route::post('/engage/save', ['as' => 'saveengage', 'uses' => 'EngageController@save']);
    Route::get('/engage/edit/{eng?}', ['as' => 'editengage', 'uses' => 'EngageController@edit']);
    Route::get('/engage/view/{eng?}', ['as' => 'viewengage', 'uses' => 'EngageController@view']);
    Route::get('/engage/assign/{eng}/{engrole?}', ['as' => 'assignengrole', 'uses' => 'EngageController@assign']);
    Route::get('/engage/assign/{eng}/teacher/{eclass?}', ['as' => 'assignengteacher', 'uses' => 'EngageController@assignteacher']);
    Route::get('/engage/attend/{eng}/{eclass?}', ['as' => 'attendengage', 'uses' => 'EngageController@attend']);
    Route::delete('/engage/delete/{eng?}', ['as' => 'deleteengage', 'uses' => 'EngageController@destroy']);
    
    // Route::delete('/group/deletearole', ['as' => 'deletearole', 'uses' => 'GroupController@destroy']);

    // BLA BLA 
    Route::get('/family/user/profile/add', ['as' => 'boboho', 'uses' => 'FamilyController@index']);
    Route::post('/family/user/profile/add', ['as' => 'profileee', 'uses' => 'FamilyController@doajax']);

    
    // Route::get('/groups', 'GroupController@index');
    Route::get('/groups/{type}', 'GroupController@index');
    Route::get('groups/family/add', 'GroupController@add');
    

    Route::auth();

});

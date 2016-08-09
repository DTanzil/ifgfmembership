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

    // Route::post('login', 'Auth\AuthController@login');
    // Route::get('login',  'Auth\AuthController@showLoginForm');
    // Route::get('logout', 'Auth\AuthController@logout');

    // MEMBER IMAGES
    Route::get('ifgf-photos/{image}', function($image){
        if(!File::exists( $image=storage_path("img/members/{$image}") )) abort(404);
        return Image::make($image)->response(); 
    });


    // HOMEPAGE
    Route::get('/home', ['as' => 'homepage', 'uses' => 'MemberController@home']);

    // MEMBERS ROUTES
    Route::model('mbr', 'App\Member');
    Route::get('/members', ['as' => 'allmember', 'uses' => 'MemberController@index']);
    Route::get('/members/add', ['as' => 'addmember', 'uses' => 'MemberController@add']);
    Route::get('/members/view/{mbr?}', ['as' => 'viewmember', 'uses' => 'MemberController@view']); 
    Route::get('/members/edit/{mbr?}', ['as' => 'editmember', 'uses' => 'MemberController@edit']); 
    Route::get('/mymembers', ['as' => 'mymember', 'uses' => 'MemberController@mymembers']);
    Route::get('/mymembers/edit/{mbr?}', ['as' => 'editmymember', 'uses' => 'MemberController@editmembership']);
    Route::post('/members/save', ['as' => 'savemember', 'uses' => 'MemberController@save']);
    Route::post('/members/photo/update', ['as' => 'updatephoto', 'uses' => 'MemberController@updatePhoto']);
    Route::delete('/members/delete/{mbr?}', ['as' => 'deletemember', 'uses' => 'MemberController@destroy']);
    Route::delete('/members/photo/delete', ['as' => 'deletephoto', 'uses' => 'MemberController@deletePhoto']);

    // KIDS ROUTES
    Route::get('/kids', ['as' => 'allkids', 'uses' => 'MemberController@kids']);

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
    Route::get('/family/viewpdf/{fam}', ['as' => 'viewpdffamily', 'uses' => 'FamilyController@viewpdf']);


    // MINISTRY ROUTES
    Route::model('mstry', 'App\Ministry');
    Route::get('/ministry', ['as' => 'allministry', 'uses' => 'MinistryController@index']);
    Route::get('/ministry/add', ['as' => 'addministry', 'uses' => 'MinistryController@add']);
    Route::get('/ministry/edit/{mstry?}', ['as' => 'editministry', 'uses' => 'MinistryController@edit']);
    Route::get('/ministry/assign/{mstry}/{mstrole?}', ['as' => 'assignmstrole', 'uses' => 'MinistryController@assign']);
    Route::get('/ministry/view/{mstry?}', ['as' => 'viewministry', 'uses' => 'MinistryController@view']);
    Route::post('/ministry/save', ['as' => 'saveministry', 'uses' => 'MinistryController@save']);
    Route::delete('/ministry/delete/{mstry?}', ['as' => 'deleteministry', 'uses' => 'MinistryController@destroy']);

    // ENGAGE ROUTE
    Route::model('eng', 'App\Engage');
    Route::get('/engage', ['as' => 'allengage', 'uses' => 'EngageController@index']);
    Route::get('/engage/add', ['as' => 'addengage', 'uses' => 'EngageController@add']);
    Route::get('/engage/edit/{eng?}', ['as' => 'editengage', 'uses' => 'EngageController@edit']);
    Route::get('/engage/assign/{eng}/{engrole?}', ['as' => 'assignengrole', 'uses' => 'EngageController@assign']);
    Route::get('/engage/assign/{eng}/teacher/{eclass?}', ['as' => 'assignengteacher', 'uses' => 'EngageController@assignteacher']);
    Route::get('/engage/attend/{eng}/{eclass?}', ['as' => 'attendengage', 'uses' => 'EngageController@attend']);
    Route::get('/engage/view/{eng?}', ['as' => 'viewengage', 'uses' => 'EngageController@view']);
    Route::post('/engage/save', ['as' => 'saveengage', 'uses' => 'EngageController@save']);
    Route::delete('/engage/delete/{eng?}', ['as' => 'deleteengage', 'uses' => 'EngageController@destroy']);

    // ESTABLISH ROUTE
    Route::model('est', 'App\Establish');
    Route::get('/establish', ['as' => 'allestablish', 'uses' => 'EstablishController@index']);
    Route::get('/establish/add', ['as' => 'addestablish', 'uses' => 'EstablishController@add']);
    Route::get('/establish/edit/{est?}', ['as' => 'editestablish', 'uses' => 'EstablishController@edit']);
    Route::get('/establish/assign/{est}/{estrole?}', ['as' => 'assignestrole', 'uses' => 'EstablishController@assign']);
    Route::get('/establish/assign/{est}/teacher/{eclass?}', ['as' => 'assignestteacher', 'uses' => 'EstablishController@assignteacher']);
    Route::get('/establish/attend/{est}/{eclass?}', ['as' => 'attendestablish', 'uses' => 'EstablishController@attend']);
    Route::get('/establish/view/{est?}', ['as' => 'viewestablish', 'uses' => 'EstablishController@view']);
    Route::post('/establish/save', ['as' => 'saveestablish', 'uses' => 'EstablishController@save']);
    Route::delete('/establish/delete/{est?}', ['as' => 'deleteestablish', 'uses' => 'EstablishController@destroy']);

    // EQUIP ROUTE
    Route::model('equ', 'App\Equip');
    Route::get('/equip', ['as' => 'allequip', 'uses' => 'EquipController@index']);
    Route::get('/equip/add', ['as' => 'addequip', 'uses' => 'EquipController@add']);
    Route::get('/equip/edit/{equ?}', ['as' => 'editequip', 'uses' => 'EquipController@edit']);
    Route::get('/equip/assign/{equ}/{equrole?}', ['as' => 'assignequrole', 'uses' => 'EquipController@assign']);
    Route::get('/equip/assign/{equ}/teacher/{eclass?}', ['as' => 'assignequteacher', 'uses' => 'EquipController@assignteacher']);
    Route::get('/equip/attend/{equ}/{eclass?}', ['as' => 'attendequip', 'uses' => 'EquipController@attend']);
    Route::get('/equip/view/{equ?}', ['as' => 'viewequip', 'uses' => 'EquipController@view']);
    Route::post('/equip/save', ['as' => 'saveequip', 'uses' => 'EquipController@save']);
    Route::delete('/equip/delete/{equ?}', ['as' => 'deleteequip', 'uses' => 'EquipController@destroy']);

    // EMPOWER ROUTE
    Route::model('emp', 'App\Empower');
    Route::get('/empower', ['as' => 'allempower', 'uses' => 'EmpowerController@index']);
    Route::get('/empower/add', ['as' => 'addempower', 'uses' => 'EmpowerController@add']);
    Route::get('/empower/edit/{emp?}', ['as' => 'editempower', 'uses' => 'EmpowerController@edit']);
    Route::get('/empower/assign/{emp}/{emprole?}', ['as' => 'assignemprole', 'uses' => 'EmpowerController@assign']);
    Route::get('/empower/assign/{emp}/teacher/{eclass?}', ['as' => 'assignempteacher', 'uses' => 'EmpowerController@assignteacher']);
    Route::get('/empower/attend/{emp}/{eclass?}', ['as' => 'attendempower', 'uses' => 'EmpowerController@attend']);
    Route::get('/empower/view/{emp?}', ['as' => 'viewempower', 'uses' => 'EmpowerController@view']);
    Route::post('/empower/save', ['as' => 'saveempower', 'uses' => 'EmpowerController@save']);
    Route::delete('/empower/delete/{emp?}', ['as' => 'deleteempower', 'uses' => 'EmpowerController@destroy']);

    // MEMBER ROLES ROUTE
    Route::get('/mbrroles', ['as' => 'allmemberroles', 'uses' => 'MemberRoleController@index']);
    Route::get('/mbrroles/add', ['as' => 'addmemberroles', 'uses' => 'MemberRoleController@add']);
    Route::post('/mbrroles/save', ['as' => 'savememberroles', 'uses' => 'MemberRoleController@save']);

   

    Route::auth();

});

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

    Route::get('/members', 'MemberController@index');
    Route::get('/member/add', 'MemberController@display');
    Route::post('/member/add', 'MemberController@add');

    Route::get('/family', 'FamilyController@index');
    
    Route::get('/family/add', 'FamilyController@add');
    Route::post('/family/add', 'FamilyController@add');
    // Route::get('/family/add/success/{id}', 'FamilyController@addSuccess');
    
    Route::get('/family/add/success/{famid}', [
        'as' => 'famsuccess', 'uses' => 'FamilyController@addSuccess'
    ]);

    Route::get('/family/edit/{famid}/{famrole}', [ 'as' => 'editfamily', 'uses' => 'FamilyController@edit' ]);


    Route::get('/family/view/{num}', [ 'as' => 'viewfamily', 'uses' => 'FamilyController@view' ]);


    // Route::get('user/{id}', function ($id) {
    //     return 'User '.$id;
    // });

    Route::get('/family/user/profile/add', [ 'as' => 'boboho', 'uses' => 'FamilyController@index' ]);

    Route::post('/family/user/profile/add', [ 'as' => 'profileee', 'uses' => 'FamilyController@doajax' ]);

    
    // Route::get('/groups', 'GroupController@index');
    Route::get('/groups/{type}', 'GroupController@index');
    Route::get('groups/family/add', 'GroupController@add');
    

    Route::auth();

});

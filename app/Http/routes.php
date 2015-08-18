<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('oauth/access_token', function() {
	return Response::json(Authorizer::issueAccessToken());
});

Route::group(['middleware' => 'oauth'], function () {

    Route::resource('client', 'ClientController', ['except' => ['create', 'edit']]);

    //Route::group(['middleware' => 'check-project-owner'], function () {
        Route::resource('project', 'ProjectController', ['except' => ['create', 'edit']]);
    //});

    Route::group(['prefix' => 'project'], function () {

        Route::get('{projectId}/note', 'ProjectNoteController@index');
        Route::post('{projectId}/note', 'ProjectNoteController@store');
        Route::get('{projectId}/note/{id}', 'ProjectNoteController@show');
        Route::delete('{projectId}/note/{id}', 'ProjectNoteController@destroy');
        Route::put('{projectId}/note/{id}', 'ProjectNoteController@update');

        Route::get('{projectId}/task', 'ProjectTaskController@index');
        Route::post('{projectId}/task', 'ProjectTaskController@store');
        Route::get('{projectId}/task/{id}', 'ProjectTaskController@show');
        Route::delete('{projectId}/task/{id}', 'ProjectTaskController@destroy');
        Route::put('{projectId}/task/{id}', 'ProjectTaskController@update');

        Route::get('{id}/members', 'ProjectController@members');
        Route::post('{id}/member', 'ProjectController@addMember');
        Route::delete('{id}/member/{userId}', 'ProjectController@removeMember');
        Route::get('{id}/member/{userId}', 'ProjectController@isMember');

    });

});
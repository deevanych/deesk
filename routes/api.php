<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => '/v1', 'namespace' => 'Api\v1', 'as' => 'api.', 'middleware' => 'auth:api'], function () {
//    Auth::loginUsingId(1);
    Route::post('login', 'AuthController@login')->name('login');
    Route::get('logout', 'AuthController@logout')->name('logout');
    Route::resource('users', 'UserController', ['except' => ['create', 'edit']]);
    Route::resource('organizations', 'OrganizationController', ['except' => ['create', 'edit']]);
    Route::resource('issues/types', 'IssueTypeController', ['except' => ['create', 'edit']]);
    Route::resource('issues/priorities', 'IssuePriorityController', ['except' => ['create', 'edit']]);
    Route::resource('issues/favorite', 'FavoriteIssueController', ['except' => ['create', 'edit']]);
    Route::resource('issues/statuses/colors', 'IssueStatusColorController', ['except' => ['create', 'edit']]);
    Route::resource('issues/statuses/icons', 'IssueStatusIconController', ['except' => ['create', 'edit']]);
    Route::resource('issues/statuses/types', 'IssueStatusTypeController', ['except' => ['create', 'edit'], 'as' => 'statusTypes']);
    Route::resource('issues/statuses', 'IssueStatusController', ['except' => ['create', 'edit']]);
    Route::resource('issues/{id}/comments', 'IssueCommentController', ['except' => ['create', 'edit']]);
    Route::resource('issues', 'IssueController', ['except' => ['create', 'edit']]);
});


<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([ 'prefix' => 'v1'], function () {

    Route::post('login', 'API\AuthController@login');

    Route::get('user_details/{id}', 'API\AuthController@user_details');

    Route::post('signup', 'API\AuthController@signup');

    Route::post('signupCompany', 'API\AuthController@signupCompany');

    Route::get('jobs', 'API\AuthController@jobs');

    Route::get('attributes', 'API\AuthController@getAttributes');

    Route::post('searchJobs', 'API\AuthController@searchJobs');

    Route::post('reset', 'API\AuthController@reset');

    Route::post('resetPassword', 'API\AuthController@resetPassword');


    Route::group(['middleware' => 'auth:api'], function() {

        Route::get('logout', 'API\AuthController@logout');

        Route::get('user', 'API\AuthController@user');

        Route::post('updateProfile', 'API\AuthController@updateProfile');

        Route::get('job/{id}', 'API\AuthController@job');

        Route::post('applyJob', 'API\AuthController@applyJob');

        Route::get('myApplications', 'API\AuthController@myApplications');


    });
});

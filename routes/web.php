<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::post('/adminLogin', 'Auth\LoginController@adminLogin')->name('adminLogin');


Route::get('/', 'HomeController@index');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::get('/profile', 'HomeController@profile')->name('profile');

Route::get('/profiles/{id?}', 'HomeController@profiles')->name('profiles');

Route::get('/empty', 'HomeController@companies')->name('empty');

Route::get('/applicants', 'HomeController@applicants')->name('applicants');

Route::get('/subcribers', 'HomeController@companies')->name('companies');

Route::get('/jobs', 'HomeController@jobs')->name('jobs');

Route::get('/jobsC', 'HomeController@jobsC')->name('jobsC');

Route::post('/jobs', 'HomeController@addJob')->name('addJob');

Route::get('/jobs/{id}/{status}', 'HomeController@job_status')->name('job_status');

Route::get('/jobProfile/{id}/{company}', 'HomeController@job_profile')->name('job_profile');

Route::get('/application/{id}', 'HomeController@application')->name('application');

Route::get('/applications', 'HomeController@applications')->name('applications');

Route::get('/admins', 'HomeController@admins')->name('admins');

Route::post('/admins', 'HomeController@addAdmin')->name('addAdmin');

Route::get('getApplications', 'HomeController@applications')->name('getApplications');

Route::get('getOneapplication/{job_id}', 'HomeController@getOneapplication')->name('getOneapplication');

Route::get('/applicant_status/{id}/{status}', 'HomeController@applicant_status')->name('applicant_status');

Route::get('/admin_status/{id}/{status}', 'HomeController@admin_status')->name('admin_status');

Route::get('/request_status/{id}', 'HomeController@request_status')->name('request_status');

Route::get('/reset', 'PagesController@reset')->name('reset');

Route::post('/reset', 'PagesController@reset_post')->name('reset_post');

Route::get('/reset_get', 'PagesController@reset_get')->name('reset_get');

Route::post('/reset_get', 'PagesController@resetPassword')->name('update_password');

Route::post('/edit_prodile', 'HomeController@editprodile')->name('editProfile');

Route::get('/feedback', 'HomeController@feedback')->name('feedback');

Route::get('/transactions', 'HomeController@transactions')->name('transactions');

Route::get('/subscriptions', 'HomeController@subscriptions')->name('subscriptions');



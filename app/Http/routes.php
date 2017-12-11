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

Route::auth();
// Default routes
Route::get('/', 'HomeController@index');

// Labour routes
Route::get('/labour', ['as' => 'labour.dashboard', 'uses' => 'LabourController@index']);
Route::post('/labour/add', ['uses' => 'LabourController@add']);
Route::post('/labour/allocate', ['uses' => 'LabourController@allocateUser']);
Route::get('/labour/allocations', ['as' => 'labour.allocations', 'uses' => 'LabourController@allocations']);
Route::get('/labour/allocation/{id}', ['as' => 'labour.allocation', 'uses' => 'LabourController@timesheetView']);
Route::post('/labour/timesheet/new', ['as' => 'labour.timesheet.new', 'uses' => 'LabourController@timesheetNew']);

// Builder auth routes
Route::get('/builder', ['as' => 'admin.dashboard', 'uses' => 'AdminController@index']);
Route::get('/builder/login', ['as' => 'admin.login', 'uses' => 'Auth\AdminLoginController@loginForm']);
Route::post('/builder/login/submit', ['as' => 'admin.login.submit', 'uses' => 'Auth\AdminLoginController@login']);
Route::get('/builder/register', ['as' => 'admin.register', 'uses' => 'Auth\AdminLoginController@registerForm']);
Route::post('/builder/register/submit', ['as' => 'admin.register.submit', 'uses' => 'Auth\AdminLoginController@register']);

// Builder
Route::get('/builder/all', ['as' => 'admin.all', 'uses' => 'AdminController@all']);
Route::get('/builder/update', 'AdminController@updateUser');
Route::get('/builder/allocations', ['as' => 'admin.allocations', 'uses' => 'AdminController@allocationsView']);
Route::get('/builder/jobs', ['as' => 'admin.jobs', 'uses' => 'AdminController@jobsView']);
// Jobs
Route::get('/jobs', 'JobsController@index');
Route::get('/jobs/add', 'JobsController@add');
Route::post('/jobs/addjob', ['uses' => 'JobsController@addjob']);
Route::get('/job/{id}', ['uses' => 'JobsController@jobDel']);
// Route::get('/jobs/{id}', ['uses' => 'JobsController@allocJobView']);

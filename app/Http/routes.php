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

Route::get('/', 'Dashboard@index');


// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
// Route::get('auth/register', 'Auth\AuthController@getRegister');
// Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('staff/create', 'StaffController@create');
Route::post('staff/store', 'StaffController@store');
Route::get('staff/show/{id}', 'StaffController@show');

Route::get('dashboard', 'Dashboard@index');
Route::get('home', 'Dashboard@index');

// routes for branches
Route::get('branch', 'BranchController@index');
Route::get('branch/create', 'BranchController@create');
Route::post('branch/store', 'BranchController@store');
Route::delete('branch/destroy', 'BranchController@destroy');
Route::get('branch/edit/{id}', 'BranchController@edit');
Route::post('branch/update', 'BranchController@update');

// rotes for supplier
Route::get('supplier', 'SupplierController@index');
Route::get('supplier/create', 'SupplierController@create');
Route::post('supplier/store', 'SupplierController@store');
Route::get('supplier/edit/{id}', 'SupplierController@edit');
Route::post('supplier/update/', 'SupplierController@update');
Route::delete('supplier/destroy', 'SupplierController@destroy');
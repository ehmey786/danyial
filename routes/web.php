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


Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware' => ['AdminLogin']], function () {
    Route::get('/groups','GroupController@index')->name('groups');
    Route::get('/','GroupController@index');
});






Route::post('/save_group','GroupController@save_group');
Route::get('/group/delete/{id}','GroupController@delete_group');
Route::get('/group/companies/{id}','GroupController@group_companies');
Route::get('/company/files/{id}','GroupController@all_files');
Route::get('/company/employees/{id}','GroupController@all_employees');

Route::post('/save_employee','GroupController@save_employee');
Route::get('/employee/delete/{id}','GroupController@delete_employee');



Route::get('/company/delete/{id}','GroupController@delete_company');
Route::get('/file/delete/{id}','GroupController@delete_file');
Route::post('save_company','GroupController@save_company');

Route::post('save_file','GroupController@save_file');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

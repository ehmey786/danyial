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


//Route::get('/', function () {
//    return view('welcome');
//});


Route::get('/emails', 'EmailController@sendExpiryEmail');
Route::group(['middleware' => ['AdminLogin']], function () {


    Route::get('/users', 'GroupController@users')->name('users');
    Route::post('/save_user', 'GroupController@saveUser');
    Route::get('/user/{id}/tasks', 'GroupController@tasks')->name('user.tasks');
    Route::get('user/{id}/delete', 'GroupController@deleteUser');
    Route::post('/status_change_company', 'GroupController@statusChangeCompany');
    Route::post('/status_change_share', 'GroupController@statusChangeShare');

    Route::post('/save_group', 'GroupController@save_group');
    Route::get('/group/delete/{id}', 'GroupController@delete_group');
    Route::get('/companies', 'GroupController@group_companies');
    //Route::get('/group/companies/{id}','GroupController@group_companies');


    Route::post('/edit_employee/{id}', 'GroupController@editEmployee');

    Route::post('/edit_dependent/{id}', 'GroupController@editDependent');


    Route::post('/edit_task/{id}', 'GroupController@editTask');
    Route::get('/task_delete/{id}', 'GroupController@taskDelete');
    Route::post('/status_change', 'GroupController@statusChange');



    Route::get('/task_detail/{taskId}', 'GroupController@taskDetails')->name('user.task_details');
    Route::post('/save_comment/{taskId}', 'GroupController@saveComment')->name('save_comment');

    Route::post('/save_task', 'GroupController@saveTask');
    Route::post('/search_company', 'GroupController@searchCompany');
    Route::get('/search_notification', 'GroupController@notificationsAll');

    Route::get('/company/files/{id}', 'GroupController@all_files');
    Route::get('/company/employees/{id}', 'GroupController@all_employees');

    Route::post('/save_employee', 'GroupController@save_employee');
    Route::get('/employee/delete/{id}', 'GroupController@delete_employee');


    Route::get('/company/delete/{id}', 'GroupController@delete_company');
    Route::get('/file/delete/{id}', 'GroupController@delete_file');
    Route::post('save_company', 'GroupController@save_company');

    Route::get('company-profile/{id}', 'GroupController@companyProfile');
    Route::post('save_sahre_holder', 'GroupController@saveShareHolders');

    Route::get('delete/share-holder/{id}', 'GroupController@deleteShareHolder');

    Route::get('employee/dependents/{id}', 'GroupController@dependents');
    Route::post('save_dependent', 'GroupController@saveDependent');
    Route::post('save_file', 'GroupController@save_file');


    Route::get('/dependent/delete/{id}', 'GroupController@deleteDependent');

    Route::get('/groups', 'GroupController@groups')->name('groups');

    Route::get('/notifications', 'GroupController@notificationsAll')->name('groups');

    Route::post('/update_document/{id}', 'GroupController@update_document');
    Route::get('/', 'GroupController@index');
    Route::get('/tasks', 'GroupController@tasks');

    Route::post('/edit_company/{id}', 'GroupController@edit_company');

});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

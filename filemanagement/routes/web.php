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


Route::get('/admin', 'AdminController@loginAdmin');

Route::post('/admin', 'AdminController@postloginAdmin');

Route::get('/logout', [
    'as' => 'admin.logout',
    'uses' => 'AdminController@logout'
]);


Route::prefix('admin')->group(function () {


    Route::get('/home', function () {
        return view('home');
    });

    //filemanager
    Route::prefix('filemanager')->group(function () {

        Route::get('/', [
            'as' => 'filemanager.index',
            'uses' => 'FileManagerController@index',
            'middleware' => 'can:list_files'
        ]);


        Route::get('/createfolder/{id}', [
            'as' => 'folder.createfolder',
            'uses' => 'FileManagerController@createFolder',
            'middleware' => 'can:add_folder_files'
        ]);


        Route::get('/selected/{id}', [
            'as' => 'folder.selected',
            'uses' => 'FileManagerController@selectedFolder'
        ]);

        Route::get('/file_edit/{id}', [
            'as' => 'folder.file_edit',
            'uses' => 'FileManagerController@editFileOrFolder',
            'middleware' => 'can:edit_files'
        ]);

        Route::post('/update_file/{id}', [
            'as' => 'folder.update_file',
            'uses' => 'FileManagerController@updateFile'
        ]);

        Route::get('/download/{id}', [
            'as' => 'folder.download',
            'uses' => 'FileManagerController@downLoadFile',
            'middleware' => 'can:download_files'
        ]);

        Route::get('/multi_edit_download', [
            'as' => 'folder.multi_edit_download',
            'uses' => 'FileManagerController@editDownLoadMultiFile',
            'middleware' => 'can:download_files'
        ]);

        Route::get('/delete/{id}', [
            'as' => 'folder.delete',
            'uses' => 'FileManagerController@deleteFile',
            'middleware' => 'can:delete_files'
        ]);
        Route::get('/multi_delete', [
            'as' => 'folder.multi_delete',
            'uses' => 'FileManagerController@deleteMultiFile',
            'middleware' => 'can:delete_files'
        ]);
    });

    //Files
    Route::prefix('fileupload')->group(function () {
        Route::get('/', [
            'as' => 'file.index',
            'uses' => 'FileController@createFile',
            'middleware' => 'can:upload_file_upload'
        ]);

        Route::get('/selected/{id}', [
            'as' => 'file.selected',
            'uses' => 'FileController@selectedFile',
            'middleware' => 'can:upload_file_upload'
        ]);
        Route::post('/upload/{id}', [
            'as' => 'file.upload',
            'uses' => 'FileController@uploadFile'
        ]);
    });

    //Dashboard
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [
            'as' => 'dashboard.index',
            'uses' => 'DashboardController@index',
            'middleware' => 'can:list_dashboard'
        ]);

        Route::get('/selected/{id}', [
            'as' => 'dashboard.selected',
            'uses' => 'DashboardController@selectedCategory'
        ]);

        Route::get('/download/{id}', [
            'as' => 'dashboard.download',
            'uses' => 'DashboardController@download',
            'middleware' => 'can:download_dashboard'
        ]);

        Route::get('/delete/{id}', [
            'as' => 'dashboard.delete',
            'uses' => 'DashboardController@delete',
            'middleware' => 'can:delete_dashboard'
        ]);

        Route::get('/multi_download', [
            'as' => 'dashboard.multi_download',
            'uses' => 'DashboardController@downLoadMultiFile',
            'middleware' => 'can:download_dashboard'
        ]);

        Route::get('/multi_delete', [
            'as' => 'dashboard.multi_delete',
            'uses' => 'DashboardController@deleteMultiFile',
            'middleware' => 'can:delete_dashboard'
        ]);

    });

    //Users
    Route::prefix('user')->group(function () {
        Route::get('/', [
            'as' => 'user.index',
            'uses' => 'UserController@index',
            'middleware' => 'can:list_user'
        ]);

        Route::get('/create', [
            'as' => 'user.create',
            'uses' => 'UserController@create',
            'middleware' => 'can:add_user'
        ]);

        Route::post('/store', [
            'as' => 'user.store',
            'uses' => 'UserController@store'
        ]);

        Route::get('/edit/{id}', [
            'as' => 'user.edit',
            'uses' => 'UserController@edit',
            'middleware' => 'can:edit_user'
        ]);

        Route::post('/update/{id}', [
            'as' => 'user.update',
            'uses' => 'UserController@update'
        ]);

        Route::get('/delete/{id}', [
            'as' => 'user.delete',
            'uses' => 'UserController@delete',
            'middleware' => 'can:delete_user'
        ]);

    });

    //Roles
    Route::prefix('role')->group(function () {
        Route::get('/', [
            'as' => 'role.index',
            'uses' => 'RoleController@index',
            'middleware' => 'can:list_role'
        ]);

        Route::get('/create', [
            'as' => 'role.create',
            'uses' => 'RoleController@create',
            'middleware' => 'can:add_role'
        ]);

        Route::post('/store', [
            'as' => 'role.store',
            'uses' => 'RoleController@store'
        ]);

        Route::get('/edit/{id}', [
            'as' => 'role.edit',
            'uses' => 'RoleController@edit',
            'middleware' => 'can:edit_role'
        ]);

        Route::post('/update/{id}', [
            'as' => 'role.update',
            'uses' => 'RoleController@update'
        ]);

        Route::get('/delete/{id}', [
            'as' => 'role.delete',
            'uses' => 'RoleController@delete',
            'middleware' => 'can:delete_role'
        ]);

    });

});

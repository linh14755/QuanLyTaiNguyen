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
            'uses' => 'FileManagerController@index'
        ]);


        Route::get('/createfolder/{id}', [
            'as' => 'folder.createfolder',
            'uses' => 'FileManagerController@createFolder'
        ]);


        Route::get('/selected/{id}', [
            'as' => 'folder.selected',
            'uses' => 'FileManagerController@selectedFolder'
        ]);

        Route::get('/file_edit/{id}', [
            'as' => 'folder.file_edit',
            'uses' => 'FileManagerController@editFileOrFolder'
        ]);

        Route::post('/update_file/{id}', [
            'as' => 'folder.update_file',
            'uses' => 'FileManagerController@updateFile'
        ]);

        Route::get('/download/{id}', [
            'as' => 'folder.download',
            'uses' => 'FileManagerController@downLoadFile'
        ]);

        Route::get('/delete/{id}', [
            'as' => 'folder.delete',
            'uses' => 'FileManagerController@deleteFile'
        ]);
    });

    //Files
    Route::prefix('fileupload')->group(function () {
        Route::get('/', [
            'as' => 'file.index',
            'uses' => 'FileController@createFile'
        ]);

        Route::get('/selected/{id}', [
            'as' => 'file.selected',
            'uses' => 'FileController@selectedFile'
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
            'uses' => 'DashboardController@index'
        ]);
    });

});

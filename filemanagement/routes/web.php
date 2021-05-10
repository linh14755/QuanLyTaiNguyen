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


Route::get('/home', function () {
    return view('home');
});

Route::prefix('admin')->group(function () {

    Route::get('/', [
        'as' => 'admin.logout',
        'uses' => 'AdminController@logout'
    ]);

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

});

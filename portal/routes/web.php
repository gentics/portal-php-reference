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

// custom preview for multichanneling
Route::any("api/preview/{folderPath?}", 'CmsController@index')->where(['folderPath' => '.*']);

Route::any("/{pathPrefix}/{path}", 'ContentController@index')->where('path' , '.*');

Route::any("/{path}", 'ContentController@index')->where('path', '.*');

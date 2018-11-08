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

//Auth::routes();

Route::prefix('/echofa')->group(function(){
    Route::get('/login', 'EchofaAuthController@loginForm')->name('login');
    Route::post('/login', 'EchofaAuthController@login');

    Route::post('/logout', 'EchofaAuthController@logout')->name('logout');
    Route::middleware(['auth:echofa'])->group(function(){
        Route::get('/index', 'EchofaIndexController@index')->name('index');
        Route::get('/project_process_chart' , 'ProjectProcessController@getGanttChart')->name('showProjectProcessChart');
        Route::get('/userinfo', 'EchofaUserController@showUserInfoTable')->name('showUserInfoTable');
        Route::get('/project_cost/{hid?}', 'ProjectCostController@getProjectCostTable')->name('showProjectCostTable');
    });
});
Route::get('/home', 'HomeController@index')->name('home');

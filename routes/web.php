<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::redirect('/', '/home');

Auth::routes([
    'register' => false
]);

Route::group(['middleware' => 'auth'], function() {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/projects/{id}', 'ProjectController@show');
    Route::post('/projects/add', 'ProjectController@add');
    Route::post('/projects/update', 'ProjectController@update');
    Route::post('/projects/delete', 'ProjectController@delete');

    Route::post('/entries/start', 'EntryController@start');
    Route::post('/entries/stop', 'EntryController@stop');
    Route::post('/entries/delete', 'EntryController@delete');

});

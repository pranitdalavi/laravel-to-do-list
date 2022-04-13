<?php

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

Route::get('login', 'App\Http\Controllers\Auth\AuthController@index')->name('login');
Route::post('post-login', 'App\Http\Controllers\Auth\AuthController@postLogin')->name('login.post');
Route::get('registration', 'App\Http\Controllers\Auth\AuthController@registration')->name('registration');
Route::post('post-registration', 'App\Http\Controllers\Auth\AuthController@postRegistration')->name('register.post');
Route::get('logout', 'App\Http\Controllers\Auth\AuthController@logout')->name('logout');


Route::get('/to-do-list', 'App\Http\Controllers\TaskController@listTasks');

Route::post('/store-task', 'App\Http\Controllers\TaskController@storeTask')->name('store-task');

Route::get('/delete/{id}', 'App\Http\Controllers\TaskController@destroy');

Route::get('/edit/task/{id}', 'App\Http\Controllers\TaskController@editTask');
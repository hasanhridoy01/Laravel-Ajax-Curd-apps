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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('student', 'App\Http\Controllers\StudentController');
Route::post('student-add', 'App\Http\Controllers\StudentController@store') -> name('studnet.add');
Route::get('student-edit/{id}', 'App\Http\Controllers\StudentController@edit') -> name('studnet.edit');
Route::post('student-update', 'App\Http\Controllers\StudentController@update') -> name('studnet.update');
Route::get('student-show/{id}', 'App\Http\Controllers\StudentController@show');

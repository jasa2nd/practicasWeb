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
Route::get('/', 'App\Http\Controllers\TestController@show');
Route::get('/welcome/{id}', 'App\Http\Controllers\HelloController@welcome');

Route::get('/professors', 'App\Http\Controllers\ProfessorController@getProfessors');
Route::get('/professoradd', 'App\Http\Controllers\ProfessorController@showProfessorAdd');
Route::get('/professoraddangular', 'App\Http\Controllers\ProfessorController@showProfessorAddAngular');
Route::post('/professors', 'App\Http\Controllers\ProfessorController@postProfessor');
Route::get('/professors/{id}', 'App\Http\Controllers\ProfessorController@getProfessor');
Route::put('/professors', 'App\Http\Controllers\ProfessorController@putProfessor');

Route::get('/ajaxprofessors', 'App\Http\Controllers\ProfessorAjaxController@getProfessors');
Route::post('/ajaxprofessors', 'App\Http\Controllers\ProfessorAjaxController@postProfessor');
Route::put('/ajaxprofessors', 'App\Http\Controllers\ProfessorAjaxController@putProfessor');
Route::delete('/ajaxprofessors/{id}', 'App\Http\Controllers\ProfessorAjaxController@deleteProfessor');


Route::get('/', function () {
    return view('welcome');
});

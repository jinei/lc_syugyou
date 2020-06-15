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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('timeline/{checkyear}/{checkmonth}/{checkuserid}','timelineController@index');
Route::post('timeline/{checkyear}/{checkmonth}/{checkuserid}','timelineController@database');
Route::get('login','LoginController@index');
Route::post('login','AuthController@login');
Route::post('logout','AuthController@logout');

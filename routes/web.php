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

Route::get('timeline/{checkyear}/{checkmonth}/{checkuserid}','timelineController@index');
Route::post('timeline/{checkyear}/{checkmonth}/{checkuserid}','timelineController@database');

Route::get('login','LoginController@index');
Route::post('login','AuthController@login');
Route::post('create','AuthController@create');
Route::post('delete','AuthController@delete');
Route::post('logout','AuthController@logout');
Route::get('account','AccountController@index');

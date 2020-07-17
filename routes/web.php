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

/*
|--------------------------------------------------------------------------
| 認証必須画面
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'auth'], function () {
    Route::get('timeline/{checkyear}/{checkmonth}/{checkuserid}','timelineController@index'); //勤務表 初期表示
    Route::post('timeline/{checkyear}/{checkmonth}/{checkuserid}','timelineController@database'); //勤務表 db操作
    Route::get('account','AccountController@index'); //アカウント作成画面 初期表示
    Route::post('create','AuthController@create'); //アカウント作成画面 作成機能
    Route::post('delete','AuthController@delete'); //アカウント作成画面 削除機能
    Route::post('logout','AuthController@logout'); //ログアウト機能
});


/*
|--------------------------------------------------------------------------
| 認証不要画面
|--------------------------------------------------------------------------
*/
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

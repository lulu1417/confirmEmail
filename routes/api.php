<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Mail\MyTestMail as MyTestMail;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register','UserController@register');
Route::get('forget/{user}','UserController@forget');
Route::post('update/password','UserController@updatePassword');
Route::get('confirm/{user}','UserController@confirm');
Route::get('reset/{user}','UserController@resetPassword');

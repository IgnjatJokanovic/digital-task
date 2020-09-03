<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', "UserController@login");
Route::post('/register', "UserController@register");
Route::get('/', 'ArticleController@index');
Route::post('/article/delete/{id}', 'ArticleController@destroy');
Route::post('/article/create', 'ArticleController@create');
Route::get('/article/edit/{id}', 'ArticleController@edit');
Route::post('/article/update/{id}', 'ArticleController@update');

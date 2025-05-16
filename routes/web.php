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

Route::get('/', 'showDiariesController@show');

Route::get('/create', 'DiaryController@create');

Route::post('/add', 'DiaryController@add');

Route::delete('/{id}', 'showDiariesController@destroy');

Route::get('/{id}/edit', 'showDiariesController@edit');

Route::post('/{id}', 'showDiariesController@update');

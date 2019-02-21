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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', 'DashboardController@index');
Route::get('/topics/list', 'TopicsController@listAction');
Route::get('/topics/add', 'TopicsController@addAction');
Route::get('/topics/edit', 'TopicsController@editAction');
Route::get('/topics/delete', 'TopicsController@deleteAction');

// app api
Route::get('/api/all_topics', 'AppApiController@getAllTopics');
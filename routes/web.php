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

Route::get('/', 'DashboardController@index');
Route::get('/dashboard', 'DashboardController@index');

Route::get('/topics/list', 'TopicsController@listAction');
Route::any('/topics/add', 'TopicsController@addAction');
Route::any('/topics/edit', 'TopicsController@editAction');
Route::any('/topics/delete', 'TopicsController@deleteAction');

Route::get('/tests/list', 'TestsController@listAction');
Route::any('/tests/add', 'TestsController@addAction');
Route::any('/tests/edit', 'TestsController@editAction');
Route::any('/tests/delete', 'TestsController@deleteAction');

// app api
Route::get('/api/all_topics', 'AppApiController@getAllTopics');
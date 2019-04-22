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
Route::any('/tests/photograph', 'TestsController@testPhotographAction');
Route::any('/tests/get-question', 'TestsController@getQuestionById');

Route::get('/questions/list', 'QuestionsController@listAction');
Route::any('/questions/add', 'QuestionsController@addAction');
Route::any('/questions/edit', 'QuestionsController@editAction');
Route::any('/questions/delete', 'QuestionsController@deleteAction');

Route::get('/conversations/list', 'ConversationController@listConversations');
Route::any('/conversations/edit', 'ConversationController@edit');

//app
Route::any('/user/register', 'WebView\UserController@register');
Route::any('/user/info', 'WebView\UserController@info');
Route::any('/user/contact', 'WebView\ConversationController@contact');
Route::any('/user/start-conversation', 'WebView\ConversationController@start');
Route::any('/user/list-topics', 'WebView\TopicsController@listTopics');
Route::any('/user/list-tests', 'WebView\TestsController@listTests');
Route::any('/user/test', 'WebView\TestsController@test');

// app api
Route::get('/api/all_topics', 'AppApiController@getAllTopics');

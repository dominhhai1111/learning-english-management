<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/user/login', 'AppApiController@login');
Route::post('/user/auto-login', 'AppApiController@autoLogin');
Route::post('/user/update-member-result', 'AppApiController@updateMemberResult');
Route::post('/user/update-conversation', 'AppApiController@updateConversation');
Route::post('/user/send-conversation', 'AppApiController@sendConversation');

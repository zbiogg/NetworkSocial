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


Route::apiResource('posts','Api\postcontroller')->middleware('jwtAuth');

Route::post('posts','Api\postcontroller@addPost')->middleware('jwtAuth');

Route::post('deletePost','Api\postcontroller@deletePost')->middleware('jwtAuth');

Route::apiResource('users','Api\usercontroller')->middleware('jwtAuth');

Route::apiResource('likes','Api\likecontroller')->middleware('jwtAuth');

Route::apiResource('comments','Api\commentcontroller')->middleware('jwtAuth');

Route::apiResource('notifications','Api\notificationcontroller')->middleware('jwtAuth');

Route::apiResource('relationship','Api\relationshipcontroller')->middleware('jwtAuth');

Route::apiResource('replycomments','Api\replycommentcontroller')->middleware('jwtAuth');

Route::get('postcmts','Api\commentcontroller@postcmts')->middleware('jwtAuth');

Route::post('login','Api\AuthController@login');

Route::get('checklogin','Api\AuthController@checklogin')->middleware('jwtAuth');

Route::post('register','Api\AuthController@register');

Route::get('logout','Api\AuthController@logout');

Route::get('myposts','Api\postcontroller@myPosts')->middleware('jwtAuth');

Route::get('userprofile/{id}','Api\postcontroller@userPosts')->middleware('jwtAuth');

Route::post('comments','Api\commentcontroller@addCmt')->middleware('jwtAuth');

Route::post('repcmt','Api\commentcontroller@addRepCmt')->middleware('jwtAuth');

Route::get('replycomments','Api\commentcontroller@replycomments')->middleware('jwtAuth');

Route::get('requestFriends','Api\friendcontroller@requestFriends')->middleware('jwtAuth');

Route::get('suggestFriends','Api\friendcontroller@suggestFriends')->middleware('jwtAuth');

Route::post('addFriend','Api\friendcontroller@addFriend')->middleware('jwtAuth');

Route::post('acceptFriend','Api\friendcontroller@acceptFriend')->middleware('jwtAuth');

Route::post('cancelAddFriend','Api\friendcontroller@cancelAddFriend')->middleware('jwtAuth');

Route::post('deleteRequest','Api\friendcontroller@deleteRequest')->middleware('jwtAuth');

Route::get('search','Api\searchcontroller@search')->middleware('jwtAuth');

Route::post('sendMessage','Api\chatcontroller@sendMessage');

Route::get('notification','Api\notificationcontroller@getNotification')->middleware('jwtAuth');


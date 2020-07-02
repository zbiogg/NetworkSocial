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

Route::post('register','Api\registercontroller@register');

Route::apiResource('posts','Api\postcontroller')->middleware('jwtAuth');

Route::post('posts','Api\postcontroller@addPost')->middleware('jwtAuth');

Route::apiResource('users','Api\usercontroller');

Route::apiResource('likes','Api\likecontroller')->middleware('jwtAuth');

Route::apiResource('comments','Api\commentcontroller');

Route::apiResource('notifications','Api\notificationcontroller');

Route::apiResource('relationship','Api\relationshipcontroller');

Route::apiResource('replycomments','Api\replycommentcontroller');

Route::get('postcmts','Api\commentcontroller@postcmts');

Route::post('login','Api\AuthController@login');

Route::get('checklogin','Api\AuthController@checklogin')->middleware('jwtAuth');

Route::post('signup','Api\AuthController@register');

Route::get('logout','Api\AuthController@logout');

Route::get('myposts','Api\postcontroller@myPosts')->middleware('jwtAuth');

Route::get('userprofile/{id}','Api\postcontroller@userPosts')->middleware('jwtAuth');

Route::post('comments','Api\commentcontroller@addCmt')->middleware('jwtAuth');

Route::get('requestFriends','Api\friendcontroller@requestFriends')->middleware('jwtAuth');

Route::post('addFriend','Api\friendcontroller@addFriend')->middleware('jwtAuth');

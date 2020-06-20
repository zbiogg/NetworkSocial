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

/*Route::get('/', function () {
    return view('home');
});*/


Route::get('/', function(){
    return view('home');
})->middleware('auth');

Route::get('/login', 'logincontroller@GetLogin')->name('login');

Route::post('/login','logincontroller@PostLogin');

Route::get('/logout', 'logincontroller@Logout');

Route::get('/signup', 'registercontroller@GetSignup');

Route::post('/signup', 'registercontroller@PostSignup');

/*Route::get('/','homecontroller@LoadPosts');*/
Route::group(['prefix'=>'/friends','middleware' => 'auth'],function(){

    Route::get('requests',function(){

        return view('friends.pagerequests');
        
    });

    Route::post('/addFriend','friendcontroller@addFriend');

    Route::post('/acceptFriend','friendcontroller@acceptFriend');
    
    Route::post('/deleteRequest','friendcontroller@deleteRequest');
});

Route::post('/addPost','postcontroller@CreatePost')->middleware('auth');




Route::get('/loginfb','facebookcontroller@loginfb');

Route::get('/callback/facebook','facebookcontroller@callback');

Route::group(['prefix'=>'/posts', 'middleware' => 'auth'],function(){

    Route::get('comments/{postid}',function($postid){
        return view('posts.comments',['postID'=>$postid]);
    });

    Route::get('replycomments/{cmtid}',function($cmtid){
        return view('posts.replycomments',['cmtid'=>$cmtid]);
    });

    Route::view('newfeedposts','posts.newfeedposts');

    Route::view('friendposts','posts.friendposts');

    Route::view('trend-day','posts.trendposts');

    Route::view('trend-7day','posts.trendposts7day');

    Route::view('trend-month','posts.trendpostsmonth');

    Route::view('trend-year','posts.trendpostsyear');

    Route::view('newreplycomment','posts.newreplycomment');

    Route::view('newcomment','posts.newcomment');
    //sửa bài viết
    Route::post('/editPost','postcontroller@editPost');
    //xóa bài viết
    Route::post('/deletePost','postcontroller@deletePost');

    Route::get('{postID}','postcontroller@showpost');

    Route::post('/addCmt','commentcontroller@addCmt');

    Route::post('addrepCmt','commentcontroller@addrepCmt');

    Route::post('likePost','likecontroller@likePost');

 

});

Route::view('loadnoti','header.noti');

Route::view('listonline','header.listonline');

Route::view('qtynoti','header.qtynoti');

Route::view('qtyrequest','header.qtyrequest');

Route::group(['prefix'=>'/profile','middleware' => 'auth'],function(){

    Route::get('/friends','profilecontroller@getFriends');

    Route::get('/photos','profilecontroller@getPhotos');

    Route::get('/', 'profilecontroller@GetProfile');

    Route::post('/editAvt','profilecontroller@editAvt');

    Route::post('/editCover','profilecontroller@editCover');

    Route::post('/editInfo', 'profilecontroller@editInfo');

    Route::get('/profileposts/{id}',function($id){
        return view('posts.profileposts',['id'=>$id]);
    });
});


Route::get('/login-admin',function(){
    return view('admin.login');
});

Route::post('/login-admin','admincontroller@postLogin');

Route::group(['prefix'=>'/admin', 'middleware' => 'adminLogin'], function(){

    Route::get('/',function(){
        return view('admin.index');
    });

   

    Route::view('/users','admin.users');

    Route::view('/posts','admin.posts');

    Route::post('/blockUser','admincontroller@blockUser');

    Route::post('/deleteUser','admincontroller@deleteUser');

    Route::post('/blockPost','admincontroller@blockPost');

    Route::post('/deletePost','admincontroller@deletePost');
});

Route::view('notifications','notifications');

Route::post('readNoti','profilecontroller@readNoti');

Route::get('/search','searchcontroller@viewsearch');

Route::get('/trend',function(){
    return view('trend');
});

Route::post('checknewNoti','noticontroller@checknewNoti');

Route::get('test',function(){
    return 1;
});





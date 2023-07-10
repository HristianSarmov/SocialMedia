<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\postcontroller;
use App\Http\Controllers\searchcontroller;
use App\Http\Controllers\leftpanecontroller;
use App\Http\Controllers\profilecontroller;
use App\Http\Controllers\registercontroller;
use App\Http\Controllers\logincontroller;
use App\Http\Controllers\likescontroller;
use App\Http\Controllers\commentscontroller;
use App\Http\Controllers\likecontroller;
use App\Http\Controllers\commentcontroller;
use App\Http\Controllers\notificationscontroller;
use App\Http\Controllers\addfriendcontroller;
use App\Http\Controllers\cancelrequestcontroller;
use App\Http\Controllers\unfriendcontroller;
use App\Http\Controllers\rejectrequestcontroller;
use App\Http\Controllers\acceptrequestcontroller;
use App\Http\Controllers\notificationpostcontroller;
use App\Http\Controllers\profilefriendslistcontroller;
use App\Http\Controllers\profilefriendrequestslistcontroller;
use App\Http\Controllers\deletecommentcontroller;
use App\Http\Controllers\deletePictureFromPostcontroller;
use App\Http\Controllers\addimagestopostcontroller;
use App\Http\Controllers\addnewpostcontroller;
use App\Http\Controllers\deletepostcontroller;
use App\Http\Controllers\updatecaptioncontroller;
use App\Http\Controllers\changeprofilepiccontroller;
use App\Http\Controllers\changecoverpiccontroller;
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
Route::get('/register', [registercontroller::class, 'loadreg']);
Route::post('/register', [registercontroller::class, 'loadreg']);
Route::get('/login', [logincontroller::class, 'login']);
Route::post('/login', [logincontroller::class, 'login']);

Route::group(['middleware' => ['protectedPages']], function() {
	Route::get('/', [postcontroller::class, 'showposts']);
	Route::get('/post', [postcontroller::class, 'showposts']);
	Route::post('/search', [searchcontroller::class, 'showsearch']);
	Route::get('/profile/{username}', [profilecontroller::class, 'showuserprofile']);
	Route::post('/profile/{username}', [profilecontroller::class, 'showupdateduserprofile']);
	Route::get('/likes/{postid}', [likescontroller::class, 'getPostLikes']);
	Route::get('/comments/{postid}', [commentscontroller::class, 'getPostComments']);
	Route::get('/like/{postid}', [likecontroller::class, 'likeAPost']);
	Route::get('/comment/{postid}/{comment}', [commentcontroller::class, 'commentOnAPost']);
	Route::get('/notifications', [notificationscontroller::class, 'loadNotifications']);
	Route::get('/addfriend/{PersonID}', [addfriendcontroller::class, 'addFriend']);
	Route::get('/cancelrequest/{PersonID}', [cancelrequestcontroller::class, 'cancelRequest']);
	Route::get('/unfriend/{PersonID}', [unfriendcontroller::class, 'unfriend']);
	Route::get('/rejectrequest/{PersonID}', [rejectrequestcontroller::class, 'rejectRequest']);
	Route::get('/acceptrequest/{PersonID}', [acceptrequestcontroller::class, 'acceptRequest']);
	Route::get('/notificationpost/{PostID}/{LikesOrComments}', [notificationpostcontroller::class, 'getPost']);
	Route::get('/profilefriendslist/{PersonID}', [profileFriendsListcontroller::class, 'getFriends']);
	Route::get('/profilefriendrequestslist/{PersonID}', [profileFriendRequestsListcontroller::class, 'getFriendRequests']);
	Route::get('/deletecomment/{CommentID}', [deletecommentcontroller::class, 'deleteComment']);
	Route::get('/deletepicturefrompost/{ImageID}', [deletePictureFromPostcontroller::class, 'deletePictureFromPost']);
	Route::post('/addimagestopost/{PostID}', [addimagestopostcontroller::class, 'addImagesToPost']);
	Route::post('/addnewpost/{PersonID}', [addnewpostcontroller::class, 'addNewPost']);
	Route::get('/deletepost/{PostID}', [deletepostcontroller::class, 'deletePost']);
	Route::get('/updatecaption/{PostID}/{newcaption}', [updatecaptioncontroller::class, 'updateCaption']);
	Route::post('/changeprofilepic', [changeprofilepiccontroller::class, 'chooseNewProfilePic']);
	Route::post('/changecoverpic', [changecoverpiccontroller::class, 'chooseNewCoverPic']);
});

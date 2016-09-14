<?php

use App\User;
use App\Role;
use App\Post;
use App\Category;
use App\Photo;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();
Route::get('/home', 'HomeController@index');
Route::get('/post/{id}', ['as'=>'home.post', 'uses'=>'AdminPostsController@post']);


Route::group(['middleware' => 'admin'], function() {
	// Route to the admin section
		Route::get('/admin', function() {
	  		return view('admin.index');
		});

	// Admin CRUD Operations with Users
    	Route::resource('admin/users', 'AdminUsersController');

    // Posts CRUD
    	Route::resource('admin/posts', 'AdminPostsController');

    // Categories CRUD
    	Route::resource('admin/categories', 'AdminCategoriesController');

    // Media CRUD
        Route::resource('admin/media', 'AdminMediaController');
        
    // Comments CRUD
        Route::resource('admin/comments', 'PostCommentController');
        Route::resource('admin/comments/replies', 'CommentRepliesController');

});


Route::group(['middleware' => 'auth'], function() {
    Route::post('/comment/reply', 'CommentRepliesController@createReply');
});



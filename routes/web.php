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
Auth::routes();
Route::get('/','PostController@index');

//Auth::routes();
// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
Route::get('/logout', 'Auth\LoginController@logout');
//$this->post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
$this->post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset');

//Route::get('/home', 'HomeController@index')->name('home');
// check for logged in user
Route::get('/home',['as' => 'home', 'uses' => 'PostController@index']);
//authentication
/*Route::controllers([
 'auth' => 'Auth\AuthController',
 'password' => 'Auth\PasswordController',
]);*/
//Route::group(['middleware' => ['auth']], function()
//{
 // show new post form
 Route::get('new-post','PostController@create');
 // save new post
 Route::post('new-post','PostController@store');
 // edit post form
 Route::get('edit/{slug}','PostController@edit');
 // update post
 Route::post('update','PostController@update');
 // delete post
 Route::get('delete/{id}','PostController@destroy');
 // display user's all posts
 Route::get('my-all-posts','UserController@user_posts_all');
 // display user's drafts
 Route::get('my-drafts','UserController@user_posts_draft');
 // add comment
 Route::post('comment/add','CommentController@store');
 // delete comment
 Route::post('comment/delete/{id}','CommentController@distroy');
//});
//users profile
Route::get('user/{id}','UserController@profile')->where('id', '[0-9]+');
// display list of posts
Route::get('user/{id}/posts','UserController@user_posts')->where('id', '[0-9]+');
// display single post
Route::get('/{slug}',['as' => 'post', 'uses' => 'PostController@show'])->where('slug', '[A-Za-z0-9-_]+');


//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

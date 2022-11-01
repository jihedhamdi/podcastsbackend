<?php

//dd(bcrypt("jihed12345"));
if(version_compare(PHP_VERSION, '7.3.31', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}
// User Routes
// Route::group(['namespace' => 'User'],function(){
	// Route::get('/','HomeController@index');
	// Route::get('post/{post}','PostController@post')->name('post');

	// Route::get('post/tag/{tag}','HomeController@tag')->name('tag');
	// Route::get('post/category/{category}','HomeController@category')->name('category');

	//vue routes
	// Route::post('getPosts','PostController@getAllPosts');
	// Route::post('saveLike','PostController@saveLike');
// });

//Admin Routes
Route::group(['namespace' => 'Admin'],function(){
	Route::get('/','HomeController@index')->name('admin.home');
	//Route::get('admin/home','HomeController@index')->name('admin.home');
	// Users Routes
	Route::resource('admin/user','UserController');
	Route::get('admin/user_Status', 'UserController@changeStatus');
	// Roles Routes
	Route::resource('admin/role','RoleController');
	// Permission Routes
	Route::resource('admin/permission','PermissionController');
	// Post Routes
	Route::resource('admin/post','PostController');
	Route::get('admin/post_Status', 'PostController@changeStatus');
	Route::post('admin/post_Slug', 'PostController@generate_slug');
	// Tag Routes
	Route::resource('admin/tag','TagController');
	// Category Routes
	Route::resource('admin/category','CategoryController');
	// Author Routes
	Route::resource('admin/authors','AuthorController');
	// Page Informative ordering
	Route::post('admin/gestion-page-informative/update-order', 'PageInformativeController@updateOrder')->name('gestion-page-informative.updateOrder');
	//	Gestion Page Informative Routes
	Route::resource('admin/gestion-page-informative','PageInformativeController');

	// Gestion des commentaire admin
	Route::resource('admin/comments','CommentController');
    Route::get('admin/approuvecomment', 'CommentController@approuve');

	// Gestion utilisateur Routes
	Route::resource('admin/gestion-users','UsersController');
	// Admin Auth Routes
	Route::get('admin-login', 'Auth\LoginController@showLoginForm')->name('admin.login');
	Route::post('admin-login', 'Auth\LoginController@login');
	
	Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth:admin']], function () {
		\UniSharp\LaravelFilemanager\Lfm::routes();
	});
	
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

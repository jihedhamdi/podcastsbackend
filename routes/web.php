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
	Route::get('admin/home','HomeController@index')->name('admin.home');
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

	Route::resource('admin/authors','AuthorController');

	// Gestion utilisateur Routes
	Route::resource('admin/gestion-users','UsersController');
	// Admin Auth Routes
	Route::get('admin-login', 'Auth\LoginController@showLoginForm')->name('admin.login');
	Route::post('admin-login', 'Auth\LoginController@login');

	
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

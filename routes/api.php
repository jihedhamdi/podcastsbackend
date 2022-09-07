<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

 //ALL routes/ Api
Route::group(['middleware'=>'cors','namespace'=>'Api'], function(){
   //     return podcasts
   //index
   Route:: get('posts', 'PostsController@index');
   // show
   Route:: get('posts/{slug}', 'PostsController@show');
   // animation 
   Route:: get('animation', 'PostsController@animationPodcast');
   // search
   Route:: get('posts/search/{keywords}', 'PostsController@search');

   //testpagination
   Route:: get('postspaginate', 'PostsController@testpaginate');

   // return categories
   Route:: get('categories', 'CategoriesController@index');
   // show
   Route:: get('categories/{slug}', 'CategoriesController@show');

   // return tags
   Route:: get('tags', 'TagsController@index');
    // show
    Route:: get('tags/{slug}', 'TagsController@show');

   // return authors
   Route:: get('authors', 'AuthorsController@index');
   // show
   Route:: get('authors/{slug}', 'AuthorsController@show');

   // Authentification
   Route::post('register', 'RegisterController@create');
   Route::get('test', 'RegisterController@test');
  

});

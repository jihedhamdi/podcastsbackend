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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

 //ALL routes/ Api
Route::group(['middleware'=>'api','namespace'=>'Api'], function(){
   Route:: get('categories', 'CategoriesController@index');
   Route:: get('tags', 'TagsController@index');
   Route:: get('posts', 'PostsController@index');

});

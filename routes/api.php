<?php

if(version_compare(PHP_VERSION, '7.3.31', '>=')) {
   error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use tizis\laraComments\Http\Controllers\CommentsController;
use tizis\laraComments\Http\Controllers\VoteController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

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
Route::group(['middleware' => 'cors', 'namespace' => 'Api'], function () {
   //     return podcasts
   //index
   Route::get('posts', 'PostsController@index');
   // show
   Route::get('posts/{slug}', 'PostsController@show');
   // animation 
   Route::get('animation', 'PostsController@animationPodcast');
   // search
   Route::get('posts/search/{keywords}', 'PostsController@search');

   //testpagination
   Route::get('postspaginate', 'PostsController@testpaginate');

   // return categories
   Route::get('categories', 'CategoriesController@index');
   // show
   Route::get('categories/{slug}', 'CategoriesController@show');

   // return tags
   Route::get('tags', 'TagsController@index');
   // show
   Route::get('tags/{slug}', 'TagsController@show');

   // show multi tags
   Route::post('multitags', 'PostsController@multishow');

   // return authors
   Route::get('authors', 'AuthorsController@index');
   // show
   Route::get('authors/{slug}', 'AuthorsController@show');

    // return informative
    Route::get('informative', 'InformativeController@index');
    // show
    Route::get('informative/{slug}', 'InformativeController@show');

    // nous contacter
    Route::post('contact', 'ContactController@ContactForm');


   // Authentification
   Route::post('login', 'Auth\PassportController@login');
   Route::post('register', 'Auth\PassportController@register');
   Route::post('forgetpassword', 'Auth\ForgotPasswordController');
   Route::post('resetpassword', 'Auth\ResetPasswordController@resetPassword');
   Route::post('resend', 'Auth\PassportController@resend');
   Route::post('verify/{token}', 'Auth\PassportController@verifyEmail');
   //Route::post('password/forgot-password', 'Auth\ForgotPasswordController@sendResetLinkResponse'); 
   //Route::post('password/reset','Auth\ResetPasswordController@sendResetResponse'); 

   Route::group(['middleware' => 'auth:api'], function () {
      Route::post('getdetails', 'Auth\PassportController@getDetails');
      Route::post('updateuser', 'Auth\PassportController@updateuser');
      Route::post('changepassword', 'Auth\PassportController@changePassword');
      Route::get('logout', 'Auth\PassportController@logout');


      //save Like
      Route::post('saveLike', 'PostsController@saveLike');
      //save Bookmarks
      Route::post('saveBookmark', 'PostsController@saveBookmark');
      //show Bookmarks
      Route::get('showBookmarks', 'PostsController@showbookmark');

      if (config('comments.route.root') !== null) {
         Route::group(['prefix' => config('comments.route.root')], static function () {
            Route::group(['prefix' => config('comments.route.group'), 'as' => 'comments.',], static function () {
               Route::get('/', [CommentsController::class, 'get'])->name('get');
               Route::post('/', [CommentsController::class, 'store'])->name('store');
               Route::delete('/{comment}', [CommentsController::class, 'destroy'])->name('delete');
               Route::put('/{comment}', [CommentsController::class, 'update'])->name('update');
               Route::get('/{comment}', [CommentsController::class, 'show']);
               Route::post('/{comment}', [CommentsController::class, 'reply'])->name('reply');
               Route::post('/{comment}/vote', [VoteController::class, 'vote'])->name('vote');
            });
         });
      }

      

   });
   Route::get('auth/callback', function () {
      
      $user = Socialite::driver('google')->user();
     
            // OAuth 2.0 providers...
      $token = $user->token;
      $refreshToken = $user->refreshToken;
      $expiresIn = $user->expiresIn;
   
      return response()->json(['success'=>'connected','token'=>$token,'refreshToken'=>$refreshToken,'expiresIn'=>$expiresIn], 200);
  });
   //Route::post('register', 'RegisterController@create');
   //Route::get('test', 'RegisterController@test');


});

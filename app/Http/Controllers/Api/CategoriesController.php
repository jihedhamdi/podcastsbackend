<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\user\category;
use App\Http\Resources\Api\CategoriesResource;
use App\Http\Resources\Api\CategoriesshowResource;

class CategoriesController extends Controller
{
    public function index(){
        CategoriesResource::withoutWrapping();
        $categories=category::withcount('posts_category')->get();
        return new CategoriesResource($categories);
    }

    public function show($slug){
        CategoriesshowResource::withoutWrapping();
        $categories=category::with('posts_category')->where('slug',$slug)->first();
        return new CategoriesshowResource($categories);
    }
}

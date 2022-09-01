<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\user\authors;
use App\Http\Resources\Api\AuthorsResource;
use App\Http\Resources\Api\authorsshowResource;

class AuthorsController extends Controller
{
    public function index(){
        AuthorsResource::withoutWrapping();
        $authors=authors::withcount('posts_author')->get();
        return new AuthorsResource($authors);
    }

    public function show($slug)
    {
        authorsshowResource::withoutWrapping();
        $authors = authors::with('posts_author')->where('slug',$slug)->first();
        return new authorsshowResource($authors);
    }
}

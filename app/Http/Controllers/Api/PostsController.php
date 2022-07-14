<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\user\post;

class PostsController extends Controller
{
    public function index(){
        $posts=post::get();
        return response()->json($posts);
    }
}

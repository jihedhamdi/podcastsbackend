<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\user\tag;
use App\Http\Resources\Api\TagsResource;
use App\Http\Resources\Api\tagsshowResource;

class TagsController extends Controller
{
    public function index(){
        TagsResource::withoutWrapping();
        $tags=tag::withcount('tags_posts')->get();
        return new TagsResource($tags);
    }

    public function show($slug){
        tagsshowResource::withoutWrapping();
        $tag=tag::with('tags_posts')->where('slug',$slug)->first();
        return new tagsshowResource($tag);
    }
}

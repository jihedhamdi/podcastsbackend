<?php

namespace App\Http\Controllers\Api;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\PostsResource;
use App\Http\Resources\Api\PostslistResource;
use App\Model\user\post;
use App\Model\user\like;
use App\Model\user\bookmark;
use App\Model\user\authors;


class PostsController extends Controller
{
    
    public function index(){
        PostslistResource::withoutWrapping();
        //$posts=post::with('tags','categories','authors','likes','bookmark')->where("status","1")->paginate(5);
        $posts=post::with('tags','categories','authors','likes','bookmark')->where([["status", '=',"1"],["visible", '=',"0"],])->orderByDesc("posts.updated_at")->get();
        return new PostslistResource($posts);
    }

    public function testpaginate(){
        PostslistResource::withoutWrapping();
        $posts=post::with('tags','categories','authors','likes','bookmark')->where("status","1")->paginate(5);
       // $posts=post::with('tags','categories','authors','likes','bookmark')->where([["status", '=',"1"],["visible", '=',"0"],])->orderByDesc("posts.updated_at")->get();
        return new PostslistResource($posts);
    }

    public function animationPodcast(){
        PostslistResource::withoutWrapping();
        $posts=post::with('tags','categories','authors','likes','bookmark')->where([["status", '=',"1"],["animation", '=',"1"],["visible", '=',"0"],])->orderByDesc("posts.updated_at")->limit(1)->get();
        return new PostslistResource($posts);
    }

  

    public function search(Request $request,$keywords){

        //dd($request);
         $request->merge(['keywords' => $request->route('keywords')]);
     
            $validator = Validator::make($request->all(), [
                'keywords'=>'required',
            ]);
            if ($validator->fails()) {
                return ["Error" => "Check input"];
            }    
       // $keywords = $request->keywords;
        PostslistResource::withoutWrapping();
        //$posts=post::with('tags','categories','authors','likes','bookmark')->where("status","1")->paginate(5);
        $posts=post::with('tags','categories','authors','likes','bookmark')->where(function($query) use ($keywords) {
            $query->where([['posts.title', 'LIKE', "%{$keywords}%"],])
                  ->orWhere([["posts.subtitle", 'LIKE',"%{$keywords}%"],])
                  ->orWhere([["posts.slug", 'LIKE',"%{$keywords}%"],])
                  ->orWhere([["posts.body", 'LIKE',"%{$keywords}%"],])
                  ->orWhere([["posts.updated_at", 'LIKE',"%{$keywords}%"],]);
                })
       ->where([["posts.status", '=',"1"],["posts.visible", '=',"0"],])->orderByDesc("posts.updated_at")->get();
        return new PostslistResource($posts);
    }
         /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        PostsResource::withoutWrapping();
        $post = post::with('tags','categories','authors','likes','bookmark')->where('slug',$slug)->first();
       // $authorscount = authors::withCount('posts_author')->where('slug',$slug)->first();
       // $post->count_authors =  $authorscount->posts_author_count;
        return new PostsResource($post);
    }

    public function saveLike(request $request)
    {
    	$likecheck = like::where(['user_id'=>Auth::id(),'post_id'=>$request->id])->first();
    	if ($likecheck) {
    		like::where(['user_id'=>Auth::id(),'post_id'=>$request->id])->delete();
    		return response()->json(['success'=>"like deleted"], 200);
    	}else{
	    	$like = new like;
	    	$like->user_id = Auth::id();
	    	$like->post_id = $request->id;
	    	$like->save();

            return response()->json(['success'=>"like saved"], 200);
    	}
    }

    public function saveBookmark(request $request)
    {
    	$likecheck = bookmark::where(['user_id'=>Auth::id(),'post_id'=>$request->id])->first();
    	if ($likecheck) {
    		bookmark::where(['user_id'=>Auth::id(),'post_id'=>$request->id])->delete();
    		return response()->json(['success'=>"Bookmark deleted"], 200);
    	}else{
	    	$like = new bookmark;
	    	$like->user_id = Auth::id();
	    	$like->post_id = $request->id;
	    	$like->save();

            return response()->json(['success'=>"Bookmark saved"], 200);
    	}
    }

    
}

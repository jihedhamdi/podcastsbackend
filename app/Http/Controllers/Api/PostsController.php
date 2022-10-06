<?php

namespace App\Http\Controllers\Api;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use tizis\laraComments\UseCases\CommentService;
use tizis\laraComments\Http\Resources\CommentResource;
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

    public function multishow(Request $request){
        $validator = Validator::make($request->all(), [
            'multitags' => 'required|array|min:1',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $tags_array = $request->multitags;
        PostslistResource::withoutWrapping();
        $posts=post::with('tags','categories','authors','likes','bookmark')->where("status","1",["visible", '=',"0"])->whereHas('tags', function($query) use ($tags_array)
        {
            $query->whereIn('tags.id',$tags_array);
        
        })->orderByDesc("posts.updated_at")->paginate(5);
    
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
        PostslistResource::withoutWrapping();
        $posts=post::with('tags','categories','authors','likes','bookmark')->where(function($query) use ($keywords) {
            $query->where([['posts.title', 'LIKE', "%{$keywords}%"],])
                  ->orWhere([["posts.subtitle", 'LIKE',"%{$keywords}%"],])
                  ->orWhere([["posts.slug", 'LIKE',"%{$keywords}%"],])
                  ->orWhere([["posts.body", 'LIKE',"%{$keywords}%"],])
                  ->orWhere([["posts.updated_at", 'LIKE',"%{$keywords}%"],]);
                })
       ->where([["posts.status", '=',"1"],["posts.visible", '=',"0"],])->orderByDesc("posts.updated_at")->paginate(5);
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

        $commentable_encrypted_key = $post->getEncryptedKey();
       
        $decryptedModelData = decrypt($commentable_encrypted_key);

        $modelId = $decryptedModelData['id'];
        $modelPath = $decryptedModelData['type'];

        //$orderBy = CommentService::orderByRequestAdapter($request);
        if (!CommentService::modelIsExists($modelPath)) {
            throw new \DomainException('Model don\'t exists');
        }

        if (!CommentService::isCommentable(new $modelPath)) {
            throw new \DomainException('Model is\'t commentable');
        }
        $model = $modelPath::where('id', $modelId)->first();
        
        $post->comments_model = $model;
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

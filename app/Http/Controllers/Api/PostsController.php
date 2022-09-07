<?php

namespace App\Http\Controllers\Api;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\user\post;
use App\Model\user\authors;
use App\Http\Resources\Api\PostsResource;
use App\Http\Resources\Api\PostslistResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

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
        // $authors = authors::withCount('posts')->where('id',$post->authors[0]->id)->get();
        // $authors = post::withCount([
        //     'authors' => function (Builder $query) {
        //         $query->where('authors_id', 2);
        //     },
        // ])->get();
        // $authors = post::withCount(['authors'  => function (Builder $query) {
        //     $query->where('id','like','2');
        //  }])->get();
        //  $authors = post::with(["authors" => function (Builder $query){
            // $query->where('authors_posts.authors_id', '=', 2);
            //$q->where('some other field', $someId);
        // }]);
        $authorscount = DB::table('authors_posts')
        ->select(DB::raw('count(*) as count'))
        ->where('authors_id',$post->authors[0]->id)
        ->count();
        $post->count_authors =  $authorscount;
        return new PostsResource($post);
    }

    
}

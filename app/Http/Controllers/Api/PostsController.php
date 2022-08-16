<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\user\post;
use App\Model\user\authors;
use App\Http\Resources\Api\PostsResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    
    public function index(){
        $posts=post::where("status","1")->get();
        return response()->json($posts);
    }

         /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = post::with('tags','categories','authors','likes','bookmark')->where('id',$id)->first();
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

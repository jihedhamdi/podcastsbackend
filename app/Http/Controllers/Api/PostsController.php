<?php

namespace App\Http\Controllers\Api;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use tizis\laraComments\UseCases\CommentService;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\PostsResource;
use App\Http\Resources\Api\PostslistResource;
use App\Model\user\post;
use App\Model\user\like;
use App\Model\user\bookmark;
use App\Model\user\PostView;
use App\User;

class PostsController extends Controller
{

    public function index(Request $request)
    {
        if ($request->direction == "asc")
            $direction = "ASC";
        else
            $direction = "DESC";
        switch ($request->filter) {
            case "views":
                $orderby = "post_view_count";
                break;
            case "likes":
                $orderby = "likes_count";
                break;
            case "date":
                $orderby = "posts.updated_at";
                break;
            case "comments":
                $orderby = "comments_count";
                break;
            default:
                $orderby = "posts.updated_at";
                break;
        }
        PostslistResource::withoutWrapping();
        // $posts=post::withcount('tags','categories','authors','likes','bookmark','postView')->where([["status", '=',"1"],["visible", '=',"0"],])->whereDate('publish_date','<=',now())->orderByDesc("posts.updated_at")->paginate(6);
        $posts = post::withcount('tags', 'categories', 'authors', 'likes', 'bookmark', 'postView', 'comments')->where([["status", '=', "1"], ["visible", '=', "0"],])->whereDate('publish_date', '<=', now())->orderBy($orderby, $direction)->paginate(6)->appends(request()->query());
        return new PostslistResource($posts);
    }

    public function testpaginate(Request $request)
    {
        if ($request->direction == "asc")
            $direction = "ASC";
        else
            $direction = "DESC";
        switch ($request->filter) {
            case "views":
                $orderby = "post_view_count";
                break;
            case "likes":
                $orderby = "likes_count";
                break;
            case "date":
                $orderby = "posts.updated_at";
                break;
            case "comments":
                $orderby = "comments_count";
                break;
            default:
                $orderby = "posts.updated_at";
                break;
        }
        PostslistResource::withoutWrapping();
        $posts = post::withcount('tags', 'categories', 'authors', 'likes', 'bookmark', 'postView', 'comments')->where([["status", '=', "1"], ["visible", '=', "0"],])->whereDate('publish_date', '<=', now())->orderBy($orderby, $direction)->paginate(6)->appends(request()->query());
        // $posts=post::with('tags','categories','authors','likes','bookmark')->where([["status", '=',"1"],["visible", '=',"0"],])->orderByDesc("posts.updated_at")->get();
        return new PostslistResource($posts);
    }

    public function animationPodcast()
    {
        PostslistResource::withoutWrapping();
        $posts = post::withcount('tags', 'categories', 'authors', 'likes', 'bookmark', 'postView')->where([["status", '=', "1"], ["animation", '=', "1"], ["visible", '=', "0"],])->whereDate('publish_date', '<=', now())->orderByDesc("posts.updated_at")->limit(1)->get();
        return new PostslistResource($posts);
    }

    public function multishow(Request $request)
    {

        if ($request->direction == "asc")
            $direction = "ASC";
        else
            $direction = "DESC";
        switch ($request->filter) {
            case "views":
                $orderby = "post_view_count";
                break;
            case "likes":
                $orderby = "likes_count";
                break;
            case "date":
                $orderby = "posts.updated_at";
                break;
            case "comments":
                $orderby = "comments_count";
                break;
            default:
                $orderby = "posts.updated_at";
                break;
        }
        $validator = Validator::make($request->all(), [
            'multitags' => 'required|array|min:1',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $tags_array = $request->multitags;
        PostslistResource::withoutWrapping();
        $posts = post::withcount('tags', 'categories', 'authors', 'likes', 'bookmark', 'postView', 'comments')->where("status", "1", ["visible", '=', "0"])->whereDate('publish_date', '<=', now())->whereHas('tags', function ($query) use ($tags_array) {
            $query->whereIn('tags.id', $tags_array);
        })->orderBy($orderby, $direction)->paginate(6)->appends(request()->only(['direction', 'filter']));

        return new PostslistResource($posts);
    }



    public function search(Request $request, $keywords)
    {

        if ($request->direction == "asc")
            $direction = "ASC";
        else
            $direction = "DESC";
        switch ($request->filter) {
            case "views":
                $orderby = "post_view_count";
                break;
            case "likes":
                $orderby = "likes_count";
                break;
            case "date":
                $orderby = "posts.updated_at";
                break;
            case "comments":
                $orderby = "comments_count";
                break;
            default:
                $orderby = "posts.updated_at";
                break;
        }

        $request->merge(['keywords' => $request->route('keywords')]);

        $validator = Validator::make($request->all(), [
            'keywords' => 'required',
        ]);
        if ($validator->fails()) {
            return ["Error" => "Check input"];
        }
        PostslistResource::withoutWrapping();
        $posts = post::withcount('tags', 'categories', 'authors', 'likes', 'bookmark', 'postView', 'comments')->where(function ($query) use ($keywords) {
            $query->where([['posts.title', 'LIKE', "%{$keywords}%"],])
                ->orWhere([["posts.subtitle", 'LIKE', "%{$keywords}%"],])
                ->orWhere([["posts.slug", 'LIKE', "%{$keywords}%"],])
                ->orWhere([["posts.body", 'LIKE', "%{$keywords}%"],])
                ->orWhere([["posts.updated_at", 'LIKE', "%{$keywords}%"],]);
        })->where([["posts.status", '=', "1"], ["posts.visible", '=', "0"],])->whereDate('publish_date', '<=', now())->orderBy($orderby, $direction)->paginate(6)->appends(request()->query());
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
        $post = post::withcount('tags', 'categories', 'authors', 'likes', 'bookmark', 'postView')->where([['slug', '=', $slug], ["posts.status", '=', "1"], ["posts.visible", '=', "0"]])->whereDate('publish_date', '<=', now())->first();
        PostView::createViewLog($post);
        return new PostsResource($post);
    }

    public function saveLike(request $request)
    {
        $likecheck = like::where(['user_id' => Auth::id(), 'post_id' => $request->id])->first();
        if ($likecheck) {
            like::where(['user_id' => Auth::id(), 'post_id' => $request->id])->delete();
            return response()->json(['success' => "like deleted"], 200);
        } else {
            $like = new like;
            $like->user_id = Auth::id();
            $like->post_id = $request->id;
            $like->save();

            return response()->json(['success' => "like saved"], 200);
        }
    }

    public function saveBookmark(request $request)
    {
        $likecheck = bookmark::where(['user_id' => Auth::id(), 'post_id' => $request->id])->first();
        if ($likecheck) {
            bookmark::where(['user_id' => Auth::id(), 'post_id' => $request->id])->delete();
            return response()->json(['success' => "Bookmark deleted"], 200);
        } else {
            $like = new bookmark;
            $like->user_id = Auth::id();
            $like->post_id = $request->id;
            $like->save();

            return response()->json(['success' => "Bookmark saved"], 200);
        }
    }

    public function showbookmark()
    {
        //dd("asba el anos");
        $user = Auth::user();
        PostslistResource::withoutWrapping();
        $posts = $user->bookmarks()->paginate(6);

        return new PostslistResource($posts);
    }
}

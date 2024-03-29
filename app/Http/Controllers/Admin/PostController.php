<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\user\authors;
use App\Model\user\category;
use App\Model\user\post;
use App\Model\user\tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use \Cviebrock\EloquentSluggable\Services\SlugService;


class PostController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = post::all();
        return view('admin.post.show',compact('posts'));   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->can('posts.create')) {
            $tags =tag::all();
            $categories =category::all();
            $authors =authors::all();
            return view('admin.post.post',compact('tags','categories','authors'));
        }
        return redirect(route('admin.home'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function generate_slug(Request $request)
    {
        $slug = SlugService::createSlug(post::class, 'slug', $request->title, ['unique' => false,'maxLength' => 150]);
        return ["slug" => $slug];
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'subtitle' => 'required',
            'slug' => 'required|unique:posts,slug|alpha_dash',
            'body' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,bmp,gif,svg',
            'audio_link' => 'required',
            ]);
        if ($request->hasFile('image')) {
            $imageName   = time() .  $request->image->getClientOriginalExtension();
            Storage::disk('public')->put( "posts/".$imageName, File::get($request->image));
            // $imageName = $request->image->store('posts');
            $info = pathinfo($imageName);
            $path = "storage/posts/thumbs/300_".basename($imageName,'.'.$info['extension']).'.webp'; 
            $image_resize = Image::make($request->image->getRealPath());
            $image_resize->encode('webp', 90);                  
            $image_resize->resize(300, 300);
            $image_resize->save($path);
        }
        $post = new post;
        $post->image = $imageName;
        $post->title = $request->title;
        $post->subtitle = $request->subtitle;
        $post->slug = $request->slug;
        $post->body = $request->body;
        $post->status = $request->status? : 0;
        $post->animation = $request->animation? : 0;
        $post->access = $request->access? : 0;
        $post->visible = $request->visible? : 0;
        $post->audio_link = $request->audio_link;
        $post->publish_date = $request->publish_date;
        $post->save();
        $post->tags()->sync($request->tags);
        $post->categories()->sync($request->categories);
        $post->authors()->sync($request->authors);

        return redirect(route('post.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->can('posts.update')) {
            $post = post::with('tags','categories','authors')->where('id',$id)->first();
            $tags =tag::all();
            $categories =category::all();
            $authors =authors::all();
            return view('admin.post.edit',compact('tags','categories','authors','post'));
        }
        return redirect(route('admin.home'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $checkimagereq ="";
        if ($request->hasFile('image')) {
            $checkimagereq ="'image' => 'required|image|mimes:jpeg,png,jpg,bmp,gif,svg'";
            }
        $this->validate($request,[
            'title'=>'required',
            'subtitle' => 'required',
            'slug' => 'required|unique:posts,slug,'.$id.'|alpha_dash',
            'body' => 'required',
             $checkimagereq,
            'audio_link' => 'required'
           
            ]);
        if ($request->hasFile('image')) {
            $imageName   = time() .  $request->image->getClientOriginalExtension();
            Storage::disk('public')->put( "posts/".$imageName, File::get($request->image));
            $info = pathinfo($imageName);
            //$imageName = $request->image->store('posts');
           // $path = asset('storage/posts/thumbs/')."/".$imageName;
           $path = "storage/posts/thumbs/300_".basename($imageName,'.'.$info['extension']).'.webp'; 
           $image_resize = Image::make($request->image->getRealPath());
           $image_resize->encode('webp', 90);                  
           $image_resize->resize(300, 300);
           $image_resize->save($path);
        }

        $post = post::find($id);
        if ($request->hasFile('image')) {
        $post->image = $imageName;
        }
        $post->title = $request->title;
        $post->subtitle = $request->subtitle;
        $post->slug = $request->slug;
        $post->body = $request->body;
        $post->status = $request->status? : 0;
        $post->animation = $request->animation? : 0;
        $post->access = $request->access? : 0;
        $post->visible = $request->visible? : 0;
        $post->audio_link = $request->audio_link;
        $post->publish_date = $request->publish_date;
        $post->tags()->sync($request->tags);
        $post->categories()->sync($request->categories);
        $post->authors()->sync($request->authors);
        $post->save();

        return redirect(route('post.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        post::where('id',$id)->delete();
        return redirect()->back();
    }

    public function changeStatus(Request $request)
    {
        $post = post::find($request->podcast_id);
        $post->status = $request->status;
        $post->save();
  
        return response()->json(['success'=>'Status change successfully.']);
    }
}

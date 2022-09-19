<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\user\authors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\DocBlock\Tags\Author;

class AuthorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('can:posts.category');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = authors::all();
        return view('admin.author.show',compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.author.author');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $this->validate($request,[
            'last_name' => 'required',
            'first_name' => 'required',
            'name' => 'required',
            'email' => 'required',
            'slug' => 'required|unique:authors,slug|alpha_dash',
            'image' => 'required|image|mimes:jpeg,png,jpg,bmp,gif,svg',
            'bgimage' => 'required|image|mimes:jpeg,png,jpg,bmp,gif,svg',
			'link_facebook' => 'url',
			'link_twitter' => 'url',
			'link_youtube' => 'url',
			'link_Instagram' => 'url',
            ]);
            if ($request->hasFile('image')) {
                $imageName   = time() .  $request->image->getClientOriginalName();
                Storage::disk('public')->put( "author/".$imageName, File::get($request->image));
                // $imageName = $request->image->store('posts');
             }
            else{
                 return 'No';
             }

             if ($request->hasFile('bgimage')) {
                $bgimageName   = 'bg_'.time() .  $request->bgimage->getClientOriginalName();
                Storage::disk('public')->put( "author/bg/".$bgimageName, File::get($request->bgimage));
                // $imageName = $request->image->store('posts');
             }
            else{
                 return 'No';
             }

        $author = new authors;
        $author->first_name = $request->first_name;
        $author->last_name = $request->last_name;
        $author->name = $request->name;
        $author->email = $request->email;
        $author->job_name = $request->job_name;
        $author->gender = $request->gender;
        $author->slug = $request->slug;
        $author->description = $request->description;
        $author->color = $request->color;
		$author->link_facebook = $request->link_facebook;
		$author->link_twitter = $request->link_twitter;
		$author->link_youtube = $request->link_youtube;
		$author->link_Instagram = $request->link_Instagram;
        $author->image = $imageName;
        $author->bgimage = $bgimageName;
        $author->save();

        return redirect(route('authors.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $author = authors::where('id',$id)->first();
        return view('admin.author.edit',compact('author'));
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
        if ($request->hasFile('image')) {
            $checkimagereq ="'image' => 'required|image|mimes:jpeg,png,jpg,bmp,gif,svg'";
            }
            if ($request->hasFile('bgimage')) {
                $checkimagebgreq ="'bgimage' => 'required|image|mimes:jpeg,png,jpg,bmp,gif,svg'";
                }

        $this->validate($request,[
            'last_name' => 'required',
            'first_name' => 'required',
            'name' => 'required',
            'email' => 'required',
            'slug' => 'required|unique:authors,slug,'.$id.'|alpha_dash',
            $checkimagereq,
            $checkimagebgreq,
			'link_facebook' => 'url',
			'link_twitter' => 'url',
			'link_youtube' => 'url',
			'link_Instagram' => 'url',
            ]);
            if ($request->hasFile('image')) {
                $imageName   = time() .  $request->image->getClientOriginalName();
                Storage::disk('public')->put( "author/".$imageName, File::get($request->image));
            }

            if ($request->hasFile('bgimage')) {
                $bgimageName   = 'bg_'.time() .  $request->bgimage->getClientOriginalName();
                Storage::disk('public')->put( "author/bg/".$bgimageName, File::get($request->bgimage));

             }
        $author = authors::find($id);
        $author->first_name = $request->first_name;
        $author->last_name = $request->last_name;
        $author->name = $request->name;
        $author->email = $request->email;
        $author->job_name = $request->job_name;
        $author->gender = $request->gender;
        $author->slug = $request->slug;
        $author->description = $request->description;
        $author->color = $request->color;
		$author->link_facebook = $request->link_facebook;
		$author->link_twitter = $request->link_twitter;
		$author->link_youtube = $request->link_youtube;
		$author->link_Instagram = $request->link_Instagram;
        if ($request->hasFile('image')) {
            $author->image = $imageName;
        }
        if ($request->hasFile('bgimage')) {
            $author->bgimage = $bgimageName;
        }
        $author->save();

        return redirect(route('authors.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        authors::where('id',$id)->delete();
        return redirect()->back();
    }
}

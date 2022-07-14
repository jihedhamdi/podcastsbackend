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
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required',
            'color' => 'required'
            ]);
            if ($request->hasFile('image')) {
                $imageName   = time() .  $request->image->getClientOriginalName();
                Storage::disk('public')->put( "author/".$imageName, File::get($request->image));
                // $imageName = $request->image->store('posts');
             }
            else{
                 return 'No';
             }
        $author = new authors;
        $author->name = $request->name;
        $author->slug = $request->slug;
        $author->description = $request->description;
        $author->color = $request->color;
        $author->image = $imageName;
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
        $this->validate($request,[
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required',
            'color' => 'required',
            ]);
            if ($request->hasFile('image')) {
                $imageName   = AuthorController . phptime();
                Storage::disk('public')->put( "author/".$imageName, File::get($request->image));
                // $imageName = $request->image->store('posts');
            }else{
                return 'No';
            }
        $author = authors::find($id);
        $author->name = $request->name;
        $author->slug = $request->slug;
        $author->description = $request->description;
        $author->color = $request->color;
        if ($request->hasFile('image')) {
            $author->image = $imageName;
        }
        $author->save();

        return redirect(route('author.index'));
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

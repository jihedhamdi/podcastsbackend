<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\user\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
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
        $categories = category::all();
        return view('admin.category.show',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.category');
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
                Storage::disk('public')->put( "categories/".$imageName, File::get($request->image));
                // $imageName = $request->image->store('posts');
             }
            else{
                 return 'No';
             }
        $category = new category;
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->description = $request->description;
        $category->color = $request->color;
        $category->image = $imageName;
        $category->save();

        return redirect(route('category.index'));
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
        $category = category::where('id',$id)->first();
        return view('admin.category.edit',compact('category'));
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
                $imageName   = time() .  $request->image->getClientOriginalName();
                Storage::disk('public')->put( "categories/".$imageName, File::get($request->image));
                // $imageName = $request->image->store('posts');
            }else{
                return 'No';
            }
        $category = category::find($id);
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->description = $request->description;
        $category->color = $request->color;
        if ($request->hasFile('image')) {
        $category->image = $imageName;
        }
        $category->save();

        return redirect(route('category.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        category::where('id',$id)->delete();
        return redirect()->back();
    }
}

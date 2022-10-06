<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\admin\PageInformative;


class PageInformativeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $pageinformatives = PageInformative::all();
        return view('admin.informative.show', compact('pageinformatives'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.informative.informative');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'titre' => 'required|max:255',
            'slug' => 'required|max:255',
            'contenu' => 'required',
        ]);
        $pageinformative = new PageInformative;
        $pageinformative->titre = $request->titre;
        $pageinformative->slug = $request->slug;
        $pageinformative->contenu = $request->contenu;
       
        $pageinformative->save();

        return redirect(route('gestion-page-informative.index'));
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
        $pageinformative = PageInformative::where('id',$id)->first();
        return view('admin.informative.edit', compact('pageinformative'));
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
        $this->validate($request, [
            'titre' => 'required|max:255',
            'slug' => 'required|max:255',
            'contenu' => 'required',
        ]);
        
        $pageinformative = PageInformative::find($id);
        $pageinformative->titre = $request->titre;
        $pageinformative->slug = $request->slug;
        $pageinformative->contenu = $request->contenu;

        $pageinformative->save();

        return redirect(route('gestion-page-informative.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PageInformative::where('id',$id)->delete();
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\user\category;

class CategoriesController extends Controller
{
    public function index(){
        $categories=category::select('name as title','slug', 'color as couleur','image')->get();
        return response()->json($categories);
    }
}

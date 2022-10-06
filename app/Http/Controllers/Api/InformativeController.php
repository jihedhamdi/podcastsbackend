<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\user\PageInformative;
use App\Http\Resources\Api\InformativesResource;
use App\Http\Resources\Api\InformativesshowResource;

class InformativeController extends Controller
{
    public function index(){
        InformativesResource::withoutWrapping();
        $PageInformative = PageInformative::get();
        return new InformativesResource($PageInformative);
    }

    public function show($slug)
    {
        InformativesshowResource::withoutWrapping();
        $PageInformative = PageInformative::where('slug',$slug)->first();
        return new InformativesshowResource($PageInformative);
    }
}

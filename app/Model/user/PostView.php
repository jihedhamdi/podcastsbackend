<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Model;

class PostView  extends Model
{

    public function postView()
    {
        return $this->belongsTo('App\Model\user\post','id','post_id');
    }

    public static function createViewLog($post) {
        $postViews= new PostView();
        $postViews->post_id = $post->id;
        $postViews->titleslug = $post->slug;
        $postViews->url = request()->url();
        $postViews->session_id = request()->getSession()->getId();
        $postViews->user_id = (auth('api')->check())?auth('api')->id():null; 
        $postViews->ip = request()->ip();
        $postViews->agent = request()->header('User-Agent');
        $postViews->save();
    }
}

<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Model;

class tag extends Model
{
    public function posts()
    {
    	return $this->belongsToMany('App\Model\user\post','post_tags')->orderBy('created_at','DESC')->paginate(5);
    }

    public function tags_posts()
    {
    	return $this->belongsToMany('App\Model\user\post','post_tags')->where([["posts.status", '=', "1"], ["posts.visible", '=', "0"]])->whereDate('posts.publish_date', '<=', now());
    }
    public function getRouteKeyName()
    {
    	return 'slug';
    }
}

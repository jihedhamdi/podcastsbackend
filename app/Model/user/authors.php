<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Model;

class authors extends Model
{
    public function posts()
    {
    	return $this->belongsToMany('App\Model\user\post','authors_posts')->orderBy('created_at','DESC')->paginate(5);
    }

    public function getRouteKeyName()
    {
    	return 'slug';
    }
}

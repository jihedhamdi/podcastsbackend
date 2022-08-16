<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Model;

class bookmark extends Model
{
    public function post()
    {
    	return $this->belongsTo('App\Model\user\post','bookmark'); 
    }
}

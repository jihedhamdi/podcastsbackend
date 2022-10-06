<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Model;

class PageInformative extends Model
{

    public function getRouteKeyName()
    {
    	return 'slug';
    }
}

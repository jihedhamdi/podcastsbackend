<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class CategorieminilistResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return ['id' => $this->id,
        'name' => $this->name,
        'href' => '/categories/'.$this->slug,
        'thumbnail' => $this->getresizedimage($this->image,"category","48x48_"),
        'count' =>  $this->posts_category_count,
        'color' => $this->color,
        'taxonomy' => "category"                
    ];
    }
    private function getresizedimage($imagename,$directory,$dimension)
    {
        if ($imagename != "")
        {
            $info = pathinfo($imagename);
            $resizedimagename = asset('storage/'.$directory.'/thumbs/'.$dimension.basename($imagename,'.'.$info['extension']).'.webp');
            return $resizedimagename;
        }else{
	    	return "";
    	}

    }
}

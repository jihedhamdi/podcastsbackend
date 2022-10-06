<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class InformativesminilistResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
        'label' => $this->titre,
        'href' => '/informative/'.$this->slug,
    ];
    }
    // public function with($request)
    // {
    //     return [
    //     'label' => "Nous contacter",
    //     'href' => "/contact",
    // ];
    // }
}

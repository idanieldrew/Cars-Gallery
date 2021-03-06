<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
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
            'name' => $this->name,
            'slug' => $this->slug,
            'details' => $this->details,
            'description' => $this->description,
            'images' => new ImageCollection($this->Images),
            'likes' => count(new LikeCollection($this->likes)),
            'comments' => new CommentCollection($this->comments)
        ];
    }
}

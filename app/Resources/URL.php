<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class URL extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'url'  => $this->url,
            'hash' => $this->hash,
            'link' => url($this->hash)
        ];
    }
}

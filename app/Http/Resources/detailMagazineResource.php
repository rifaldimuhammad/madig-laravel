<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class detailMagazineResource extends JsonResource
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
            'id' => $this->id,
            'magazine_id' => $this->magazine_id,
            'img_file' => $this->img_file,
            'page' => $this->page,
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
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
            'jobTitle' => $this->jobTitle,
            'jobContent' => $this->jobContent,
            'jobImage' => $this->jobImage,
            'categoryName' => $this->category->categoryName,
        ];
    }
}

<?php

namespace App\Http\Resources\admin\news;

use Illuminate\Http\Resources\Json\ResourceCollection;

class NewsRecycleBinCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public $collects = NewsRecycleBinResource::class;
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}

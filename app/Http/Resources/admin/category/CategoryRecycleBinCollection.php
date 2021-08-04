<?php

namespace App\Http\Resources\admin\category;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryRecycleBinCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public $collects = CategoryRecycleBinResource::class;
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}

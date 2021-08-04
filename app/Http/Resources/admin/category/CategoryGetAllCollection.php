<?php

namespace App\Http\Resources\admin\category;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryGetAllCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public $collects = CategoryGetAllResource::class;
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}

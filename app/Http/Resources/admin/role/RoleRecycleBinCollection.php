<?php

namespace App\Http\Resources\admin\role;

use Illuminate\Http\Resources\Json\ResourceCollection;

class RoleRecycleBinCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public $collects = RoleRecycleBinResource::class;
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}

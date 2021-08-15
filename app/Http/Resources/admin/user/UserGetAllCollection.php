<?php

namespace App\Http\Resources\admin\user;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserGetAllCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public $collects = UserGetAllResource::class;
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}

<?php

namespace App\Http\Resources\admin\role;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleRecycleBinResource extends JsonResource
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
            'id' => $this->id,
            'role_name' => $this->role_name,
            'status' => $this->disabled,
            'created_at' => $this->created_at->format('d-m-Y H:i:s'),
            'created_by' => $this->created_by,
            'deleted_at' => $this->deleted_at
        ];
    }
}

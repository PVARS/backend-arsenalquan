<?php

namespace App\Http\Resources\admin\news;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsGetAllResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $approve = "Đang chờ";
        if ($this->approve === 1){
            $approve = "Đã duyệt";
        }

        return [
            'id' => $this->id,
            'category' => $this->category_name,
            'title' => $this->title,
            'short_description' => $this->short_description,
            'thumbnail' => $this->thumbnail,
            'content' => $this->content,
            'view' => $this->view,
            'slug' => $this->slug,
            'approve' => $approve,
            'approved_by' => $this->approved_by,
            'created_at' => $this->created_at->format('d-m-Y H:i:s'),
            'created_by' => $this->login_id
        ];
    }
}

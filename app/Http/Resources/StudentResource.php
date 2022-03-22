<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "Identifier" => $this->id,
            "Name" => $this->name,
            "Status" => $this->status,
            "OrderIn" => $this->order,
            "SchoolName" => $this->school->name,
        ];
    }
}

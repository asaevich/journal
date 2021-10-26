<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LecturerResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'last_name' => $this->last_name,
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'username' => $this->username,
            'department' => [
                'id' => $this->department->id,
                'name' => $this->department->name,
                'abbreviation' => $this->department->abbreviation,
            ],
            'faculty' => $this->faculty,
            'position' => $this->position
        ];
    }
}

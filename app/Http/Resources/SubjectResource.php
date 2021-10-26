<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubjectResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'department' => [
                'id' => $this->department->id,
                'name' => $this->department->name,
                'abbreviation' => $this->department->abbreviation,
            ],
            'faculty' => $this->faculty,
        ];
    }
}

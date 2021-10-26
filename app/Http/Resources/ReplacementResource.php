<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReplacementResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'lesson' => $this->lesson,
            'lesson_date' => $this->lesson_date,
            'old_lecturer' => $this->oldLecturer,
            'new_lecturer' => $this->newLecturer,
        ];
    }
}

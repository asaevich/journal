<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class LessonResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'=> $this->id,
            'subject'=> $this->subject,
            'employment_type'=> $this->employmentType,
            'auditorium'=> $this->auditorium,
            'lesson_type'=> $this->lessonType,
            'week_type'=> $this->week_type,
            'number'=> $this->number,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'lecturers' => new LecturerCollection($this->lecturers),
            'groups' => GroupResource::collection($this->groups)
        ];
    }
}

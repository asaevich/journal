<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class LessonCollection extends ResourceCollection
{
    public static $wrap = 'lessons';

    public function toArray($request): array
    {
        return parent::toArray($request);
    }
}

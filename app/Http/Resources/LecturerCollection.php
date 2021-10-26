<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class LecturerCollection extends ResourceCollection
{
    public static $wrap = 'lecturers';

    public function toArray($request): array
    {
        return parent::toArray($request);
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SubjectCollection extends ResourceCollection
{
    public static $wrap = 'subjects';

    public function toArray($request): array
    {
        return parent::toArray($request);
    }
}

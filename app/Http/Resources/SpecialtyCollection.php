<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SpecialtyCollection extends ResourceCollection
{
    public static $wrap = 'specialties';

    public function toArray($request): array
    {
        return parent::toArray($request);
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ReplacementCollection extends ResourceCollection
{
    public static $wrap = 'replacements';

    public function toArray($request): array
    {
        return parent::toArray($request);
    }
}

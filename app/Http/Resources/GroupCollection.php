<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class GroupCollection extends ResourceCollection
{
    public static $wrap = 'groups';

    public function toArray($request): array
    {
        return parent::toArray($request);
    }
}

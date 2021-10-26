<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class DepartmentCollection extends ResourceCollection
{
    public static $wrap = 'departments';

    public function toArray($request): array
    {
        return parent::toArray($request);
    }
}

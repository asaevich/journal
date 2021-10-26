<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TransferCollection extends ResourceCollection
{
    public static $wrap = 'transfers';

    public function toArray($request): array
    {
        return parent::toArray($request);
    }
}

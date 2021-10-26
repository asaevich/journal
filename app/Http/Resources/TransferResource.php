<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransferResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'lesson' => $this->lesson,
            'old_date' => $this->old_date,
            'new_date' => $this->new_date
        ];
    }
}

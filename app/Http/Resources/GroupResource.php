<?php

namespace App\Http\Resources;

use App\Models\Faculty;
use App\Models\Specialty;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupResource extends JsonResource
{
    public function toArray($request): array
    {
        $fullName = $this->specialty->abbreviation . '-' . substr($this->admission_year, 2) . $this->subgroup;
        return [
            'id' => $this->id,
            'full_name' => $fullName,
            'specialty' => [
                'id' => $this->specialty->id,
                'name' => $this->specialty->name,
                'abbreviation' => $this->specialty->abbreviation,
            ],
            'department' => [
                'id' => $this->department->id,
                'name' => $this->department->name,
                'abbreviation' => $this->department->abbreviation,
            ],
            'faculty' => $this->faculty,
            'subgroup' => $this->subgroup,
            'education_type' => $this->educationType,
            'admission_year' => $this->admission_year
        ];
    }
}

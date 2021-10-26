<?php

namespace App\Http\Controllers;

use App\Http\Resources\SpecialtyCollection;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Specialty;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SpecialtyController extends Controller
{
    public function index(Faculty $faculty=null, Department $department=null): SpecialtyCollection
    {
        if (!empty($faculty) && !empty($department)) {
            $departments = Department::select('id')->where('faculty_id', $faculty->id)->get();

            if (!$departments->contains($department)) {
                throw new ModelNotFoundException;
            }

            return new SpecialtyCollection(Specialty::where('department_id', $department->id)->get());
        } else if (!empty($faculty)) {
            $departments = Department::select('id')->where('faculty_id', $faculty->id)->get();
            return new SpecialtyCollection(Specialty::whereIn('department_id', $departments)->get());
        } else {
            return new SpecialtyCollection(Specialty::all());
        }
    }
}

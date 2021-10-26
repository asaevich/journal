<?php

namespace App\Http\Controllers;

use App\Http\Resources\LecturerCollection;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Lecturer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Resources\Json\ResourceCollection;

class LecturerController extends Controller
{
    public function index(Faculty $faculty=null, Department $department=null): LecturerCollection
    {
        if (!empty($faculty) && !empty($department)) {
            $departments = Department::select('id')->where('faculty_id', $faculty->id)->get();

            if (!$departments->contains($department)) {
                throw new ModelNotFoundException;
            }

            return new LecturerCollection(Lecturer::where('department_id', $department->id)->get());
        } else if (!empty($faculty)) {
            $departments = Department::select('id')->where('faculty_id', $faculty->id)->get();
            return new LecturerCollection(Lecturer::whereIn('department_id', $departments)->get());
        } else {
            return new LecturerCollection(Lecturer::all());
        }
    }
}

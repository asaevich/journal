<?php

namespace App\Http\Controllers;

use App\Http\Resources\SubjectCollection;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Subject;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SubjectController extends Controller
{
    public function index(Faculty $faculty=null, Department $department=null): SubjectCollection
    {
        if (!empty($faculty) && !empty($department)) {
            $departments = Department::select('id')->where('faculty_id', $faculty->id)->get();

            if (!$departments->contains($department)) {
                throw new ModelNotFoundException;

            }
            return new SubjectCollection(Subject::where('department_id', $department->id)
                ->with(['department', 'faculty'])->get());
        } else if (!empty($faculty)) {
            $departments = Department::select('id')->where('faculty_id', $faculty->id)->get();
            return new SubjectCollection(Subject::whereIn('department_id', $departments)
                ->with(['department', 'faculty'])->get());
        } else {
            return new SubjectCollection(Subject::with(['department', 'faculty'])->get());
        }
    }
}

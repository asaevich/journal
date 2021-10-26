<?php

namespace App\Http\Controllers;

use App\Http\Resources\GroupCollection;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Group;
use App\Models\Specialty;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Resources\Json\ResourceCollection;

class GroupController extends Controller
{
    public function index(Faculty $faculty=null, Department $department=null): GroupCollection
    {
        if (!empty($faculty) && !empty($department)) {
            $departments = Department::select('id')->where('faculty_id', $faculty->id)->get();

            if (!$departments->contains($department)) {
                throw new ModelNotFoundException;
            }

            $specialties = Specialty::select('id')->where('department_id', $department->id)->get();
            return new GroupCollection(Group::whereIn('specialty_id', $specialties)->get());
        } else if (!empty($faculty)) {
            $departments = Department::select('id')->where('faculty_id', $faculty->id)->get();
            $specialties = Specialty::select('id')->whereIn('department_id', $departments)->get();
            return new GroupCollection(Group::whereIn('specialty_id', $specialties)->get());
        } else {
            return new GroupCollection(Group::all());
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Resources\DepartmentCollection;
use App\Models\Department;
use App\Models\Faculty;

class DepartmentController extends Controller
{
    public function index(Faculty $faculty=null): DepartmentCollection
    {
        if (!empty($faculty)) {
            return new DepartmentCollection(Department::where('faculty_id', $faculty->id)
                ->with('faculty')->get());
        }
        return new DepartmentCollection(Department::with('faculty')->get());
    }
}

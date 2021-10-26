<?php

namespace App\Http\Controllers;

use App\Models\EmploymentType;
use Illuminate\Http\JsonResponse;

class EmploymentTypeController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['employment_types' => EmploymentType::all()]);
    }
}

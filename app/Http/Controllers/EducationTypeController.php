<?php

namespace App\Http\Controllers;

use App\Models\EducationType;
use Illuminate\Http\JsonResponse;

class EducationTypeController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['education_types' => EducationType::all()]);
    }
}

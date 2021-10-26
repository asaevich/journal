<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use Illuminate\Http\JsonResponse;

class FacultyController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['faculties' => Faculty::all()]);
    }
}

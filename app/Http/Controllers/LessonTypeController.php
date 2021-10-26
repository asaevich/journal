<?php

namespace App\Http\Controllers;

use App\Models\LessonType;
use Illuminate\Http\JsonResponse;

class LessonTypeController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['lesson_types' => LessonType::all()]);
    }
}

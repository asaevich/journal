<?php

namespace App\Http\Controllers;

use App\Models\LecturerPosition;
use Illuminate\Http\JsonResponse;

class LecturerPositionController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['lecturer_positions' => LecturerPosition::all()]);
    }
}

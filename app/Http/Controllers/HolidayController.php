<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use Illuminate\Http\JsonResponse;

class HolidayController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['holidays' => Holiday::all()]);
    }
}

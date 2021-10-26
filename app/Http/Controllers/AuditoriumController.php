<?php

namespace App\Http\Controllers;

use App\Models\Auditorium;
use Illuminate\Http\JsonResponse;

class AuditoriumController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['auditoriums' => Auditorium::all()]);
    }
}

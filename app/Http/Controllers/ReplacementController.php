<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReplacementCollection;
use App\Models\Replacement;
use Illuminate\Http\Request;

class ReplacementController extends Controller
{
    public function index(): ReplacementCollection
    {
        return new ReplacementCollection(Replacement::all());
    }

    public function store(Request $request)
    {
        //
    }

    public function update(Request $request, Replacement $replacement)
    {
        //
    }

    public function destroy(Replacement $replacement)
    {
        //
    }
}

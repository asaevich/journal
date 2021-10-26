<?php

namespace App\Http\Controllers;

use App\Http\Resources\TransferCollection;
use App\Models\Lesson;
use App\Models\Transfer;
use DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    public function index(Lesson $lesson): TransferCollection
    {
        return new TransferCollection($lesson->transfers);
    }

    public function store(Request $request): JsonResponse
    {
        $message = $this->lessonCheck($request);
        if (!empty($message)) {
            return response()->json(['error' => $message], 400);
        }

        $transfer = Transfer::create($request->all());
        return response()->json(['lesson' => $transfer], 201);
    }

    public function lessonCheck(Request $request): string
    {
        $message = '';

        if ($request->query('store-type', 'with-check') != 'force') {
            $message = '';
            if ($this->isAuditoriumOccupied($request)) {
                $message .= 'В это время в данной аудитории уже есть пара.';
            }
            if ($this->isAnyGroupBusy($request, $request->groups)) {
                $message .= 'В это время у одной из перечисленных групп уже есть пара.';
            }
            if ($this->isAnyLecturerBusy($request, $request->lecturers)) {
                $message .= 'В это время в у одного из перечисленных преподавателей уже есть пара.';
            }
        }

        return $message;
    }

    private function isAuditoriumOccupied(Request $request)
    {

    }

    private function isAnyGroupBusy(Request $request, mixed $groups)
    {

    }

    private function isAnyLecturerBusy(Request $request, mixed $lecturers)
    {

    }

    public function update(Request $request, Transfer $transfer): JsonResponse
    {
        $message = $this->lessonCheck($request);
        if (!empty($message)) {
            return response()->json(['error' => $message], 400);
        }

        $transfer->update($request->all());
        return response()->json(['lesson' => $transfer]);
    }

    public function destroy(Transfer $transfer): JsonResponse
    {
        $transfer->delete();
        return response()->json(status: 204);
    }
}

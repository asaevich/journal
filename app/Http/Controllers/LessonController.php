<?php

namespace App\Http\Controllers;

use App\Http\Resources\LessonCollection;
use App\Models\Group;
use App\Models\Holiday;
use App\Models\Lecturer;
use App\Models\Lesson;
use DateInterval;
use DatePeriod;
use DateTime;
use DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    public function index(Request $request, Lecturer $lecturer = null): JsonResponse
    {
        if (empty($lecturer)) {
            $lecturer = Auth::user();
        }

        $period = $this->getPeriod($request);
        // Если в нет ни одного периода, значит, нет ни одной пары
        if (empty($period)) {
            return response()->json(status: 204);
        }

        $semesterStartDate = $period[0];
        $semesterEndDate = $period[1];

        $weekDays = array('Mon' => '', 'Tue' => '', 'Wed' => '', 'Thu' => '', 'Fri' => '', 'Sat' => '', 'Sun' => '');
        $timetable = array();
        $rawLessons = $lecturer->lessons
            ->where('start_date', $semesterStartDate)
            ->where('end_date', '<=', $semesterEndDate);

        if ($request->has('week')) {
            // Парсим год и номер недели из формата ISO (2020-W45)
            $splitISODate = explode('-W', $request->week);
            $year = $splitISODate[0];
            $week = $splitISODate[1];

            // Получаем даты начала и конца запрашиваемой недели
            $weekStartDate = new DateTime('midnight');
            $weekStartDate->setISODate($year, $week);
            $weekEndDate = new DateTime('midnight');
            $weekEndDate->setISODate($year, $week)->modify('+7 days');

            // Получаем номера недель начала и конца семестра
            $semesterStartWeek = $semesterStartDate->format('W');
            $semesterEndWeek = $semesterEndDate->format('W');

            if ($weekStartDate->format('W') < $semesterStartWeek || $weekEndDate->format('W') > $semesterEndWeek) {
                return response()->json(['error' => 'Неделя должны быть в пределах учебного семестра'], 400);
            }

            // Формируем период дат по запрашиваемой неделе и сохраняем его в массив, где ключи - дни недели
            $period = new DatePeriod($weekStartDate, new DateInterval('P1D'), $weekEndDate);
            foreach ($period as $day) {
                $weekDays[$day->format('D')] = $day->format('Y-m-d');
            }

            // Удаляем все праздничные дни из промежутка
            $holidays = Holiday::all();
            foreach ($weekDays as $week_day => $date) {
                if ($holidays->where('start_date', '<=', $date)
                        ->where('end_date', '>=', $date)->count() > 0) {
                    unset($weekDays[$week_day]);
                }
            }

            // Определяем тип недели
            $weekType = ($week - $semesterStartWeek) % 2 == 0 ? 'up' : 'down';
            $rawLessons = $rawLessons->whereIn('week_type', [$weekType, 'always'])
                ->where('end_date', '>', $weekStartDate);
        }

        foreach ($weekDays as $weekDay => $_) {
            $lessons = $rawLessons->where('week_day', $weekDay);
            if ($lessons->count() > 0) {
                $timetable[$weekDay] = new LessonCollection($lessons);
            }
        }

        return response()->json(['timetable' => $timetable]);
    }

    private function getPeriod(Request $request): array
    {
        if ($request->has('period')) {
            // Парсим начало и конец периода
            $splitPeriod = explode('-', $request->period);
            $semesterStartDate = DateTime::createFromFormat('!d/m/Y', $splitPeriod[0]);
            $semesterEndDate = DateTime::createFromFormat('!d/m/Y', $splitPeriod[1]);
        } else {
            // Если не передали период, то получаем все периоды и используем самый новый
            $semesterPeriods = Lesson::select(['start_date', 'end_date'])->distinct()
                ->orderBy('start_date', 'desc')
                ->orderBy('end_date', 'desc')->get();

            // Если в нет ни одного периода, значит, нет ни одной пары
            if ($semesterPeriods->count() == 0) {
                return [];
            }

            $semesterStartDate = $semesterPeriods[0]->start_date;
            $semesterEndDate = $semesterPeriods[0]->end_date;

        }
        return [$semesterStartDate, $semesterEndDate];
    }

    public function store(Request $request): JsonResponse
    {
        $message = $this->lessonCheck($request);
        if (!empty($message)) {
            return response()->json(['error' => $message], 400);
        }

        $lesson = Lesson::create($request->all());
        foreach ($request->groups as $groupId) {
            Group::find($groupId)->lessons()->attach($lesson->id);
        }
        foreach ($request->lecturers as $lecturerId) {
            Lecturer::find($lecturerId)->lessons()->attach($lesson->id);
        }

        if (!in_array(Auth::id(), $request->lecturers)) {
            Auth::user()->lessons()->attach($lesson->id);
        }

        return response()->json(['lesson' => $lesson], 201);
    }

    public function lessonCheck(Request $request): string
    {
        $message = '';

        if ($request->get('store-type', 'with-check') != 'force') {
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

    private function isAuditoriumOccupied(Request $request): bool
    {
        $lessons = Lesson::where(
            function ($query) use ($request) {
                $query->where(
                    function ($query) use ($request) {
                        $query->where('start_date', '<=', $request->start_date)
                            ->where('end_date', '>=', $request->start_date);
                    })
                    ->orWhere(
                        function ($query) use ($request) {
                            $query->where('start_date', '>=', $request->start_date)
                                ->where('start_date', '<=', $request->end_date);
                        });
            })
            ->where('week_day', $request->week_day)
            ->where('number', $request->number)
            ->whereIn('week_type', [$request->week_type, 'always'])
            ->where('auditorium_id', $request->auditorium_id)
            ->get();

        return $lessons->count() > 0;
    }

    private function isAnyGroupBusy(Request $request, $groups): bool
    {
        foreach ($groups as $groupId) {
            $lessonsId = DB::table('group_lesson')->select('lesson_id')
                ->where('group_id', $groupId)->get()->pluck('lesson_id')->toArray();

            if ($this->isLessonsAlreadyExists($request, $lessonsId)) {
                return true;
            }
        }

        return false;
    }

    private function isLessonsAlreadyExists(Request $request, $lessonsId): bool
    {
        return Lesson::whereIn('id', $lessonsId)
                ->where(
                    function ($query) use ($request) {
                        $query->where(
                            function ($query) use ($request) {
                                $query->where('start_date', '<=', $request->start_date)
                                    ->where('end_date', '>=', $request->start_date);
                            })
                            ->orWhere(
                                function ($query) use ($request) {
                                    $query->where('start_date', '>=', $request->start_date)
                                        ->where('start_date', '<=', $request->end_date);
                                });
                    })
                ->where('week_day', $request->week_day)
                ->where('number', $request->number)
                ->whereIn('week_type', [$request->week_type, 'always'])
                ->get()
                ->count() > 0;
    }

    private function isAnyLecturerBusy(Request $request, $lecturers): bool
    {
        foreach ($lecturers as $lecturerId) {
            $lessonsId = DB::table('lecturer_lesson')->select('lesson_id')
                ->where('lecturer_id', $lecturerId)->get()->pluck('lesson_id')->toArray();

            if ($this->isLessonsAlreadyExists($request, $lessonsId)) {
                return true;
            }
        }

        return false;
    }

    public function update(Request $request, Lesson $lesson): JsonResponse
    {
        if ($lesson->week_type != $request->week_type) {
            if ($this->isCannotChangeWeekType($request)) {
                return response()->json(['error' => 'Пара по этой недели уже существует. Для начала удалите ее.'], 400);
            }
        }

        $originGroups = $lesson->groups()->get()->pluck('id')->toArray();
        $newGroups = array_diff($request->groups, $originGroups);
        $deletedGroups = array_diff($originGroups, $request->groups);

        $originLecturers = $lesson->lecturers()->get()->pluck('id')->toArray();
        $newLecturers = array_diff($request->lecturers, $originLecturers);
        $deletedLecturers = array_diff($originLecturers, $request->lecturers);

        $message = $this->lessonCheck($request);
        if (!empty($message)) {
            return response()->json(['error' => $message], 400);
        }

        $lesson->update($request->all());

        foreach ($newGroups as $groupId) {
            Group::find($groupId)->lessons()->attach($lesson->id);
        }
        foreach ($newLecturers as $lecturerId) {
            Lecturer::find($lecturerId)->lessons()->attach($lesson->id);
        }

        foreach ($deletedGroups as $groupId) {
            Group::find($groupId)->lessons()->detach($lesson->id);
        }
        foreach ($deletedLecturers as $lecturerId) {
            Lecturer::find($lecturerId)->lessons()->detach($lesson->id);
        }

        if ($lesson->lecturers->count() == 0) {
            $lesson->delete();
            return response()->json(status: 204);
        }

        return response()->json(['lesson' => $lesson]);
    }

    private function isCannotChangeWeekType(Request $request): bool
    {
        return Lesson::where(
                function ($query) use ($request) {
                    $query->where(
                        function ($query) use ($request) {
                            $query->where('start_date', '<=', $request->start_date)
                                ->where('end_date', '>=', $request->start_date);
                        })
                        ->orWhere(
                            function ($query) use ($request) {
                                $query->where('start_date', '>=', $request->start_date)
                                    ->where('start_date', '<=', $request->end_date);
                            });
                })
                ->where('week_day', $request->week_day)
                ->where('number', $request->number)
                ->where('week_type', $request->week_type)
                ->get()
                ->count() > 0;
    }

    public function destroy(Lesson $lesson): JsonResponse
    {
        Auth::user()->lessons()->detach($lesson->id);
        if ($lesson->lecturers->count() == 0) {
            $lesson->delete();
        }
        return response()->json(status: 204);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\EmploymentType;
use App\Models\Lecturer;
use App\Models\Lesson;
use App\Models\Replacement;
use App\Models\Semester;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;

class GeneralJournalController extends Controller
{
    public function journal(Request $request): StreamedResponse|Response|JsonResponse
    {
        if (!$request->has('semester_id')) {
            return response(status: 400);
        }

        $semester = Semester::find($request->semester_id);
        $employmentType = EmploymentType::find($request->employment_type_id);
        $semesterLessons = $this->getSemesterLessons($semester, $employmentType);
        if (count($semesterLessons) == 0) {
            return response(status: 204);
        }

        // Например: '1с. 2020-2021г'
        $periodName = $semester->number . 'с. ' . $semester->start_eucation_year . '-' . ++$semester->start_eucation_year . 'г';

        // Например: 'Филипишин Ставка 1с. 2020-2021г.xlsx'
        $lecturer = Auth::user();
        $journalName = $lecturer->last_name . ' ' . $employmentType->type . ' ' . $periodName . '.xlsx';
        $this->createJournal($semesterLessons, $lecturer, $journalName);

        return Storage::download($journalName);
    }

    private function getSemesterLessons(Semester $semester, EmploymentType $employmentType): array
    {
        $lecturer = Auth::user();
        $timetable = $lecturer->lessons
            ->where('employment_type_id', $employmentType->id)
            ->where('start_date', '>=', $semester->start_date)
            ->where('end_date', '<=', $semester->end_date);
        if ($timetable->count() == 0) {
            return [];
        }

        $semesterLessons = array();
        $semesterDates = $this->getSemesterDates($semester);
        $semesterStartWeek = $this->getSemesterStartWeek($semesterDates);

        // Формируем массив пар на семестр, разделяя их на месяцы, а те в свою очередь разбивая на дни
        foreach ($semesterDates as $monthNum => $month) {
            $monthLessons = array();
            foreach ($month as $weekNum => $week) {
                $weekType = ($weekNum - $semesterStartWeek) % 2 == 0 ? 'up' : 'down';

                foreach ($week as $weekDay => $date) {
                    // Получаем все пары определенного дня недели
                    $dayLessons = $timetable->whereIn('week_type', [$weekType, 'always'])
                        ->where('week_day', $weekDay);

                    if ($dayLessons->count() > 0) {
                        $monthLessons[$date] = $dayLessons->values();
                    }
                }
            }
            $semesterLessons[$monthNum] = $monthLessons;
        }

        $semesterLessons = $this->setTransfers($semesterLessons, $timetable);
        $semesterLessons = $this->setReplacements($semesterLessons, $semester, $lecturer);
        $this->recur_ksort($semesterLessons);
        return $semesterLessons;
    }

    private function getSemesterDates(Semester $semester): array
    {
        // Получаем промежуток, в который входят все месяцы семестра. При это если семестр начинается не с 1 числа
        // в промежуток оно все равно будет включено. Промежуток будет начинаться первым днем первого месяца семестра
        // и заканчиваться последним днем последнего месяца семестра
        $startDate = (new DateTime($semester->start_date))->modify('first day of this month');
        $endDate = (new DateTime($semester->end_date))->modify('first day of next month');
        $monthPeriod = new DatePeriod($startDate, new DateInterval('P1M'), $endDate);

        $semesterDates = array();

        foreach ($monthPeriod as $month) {
            // Получаем промежуток дат определенного месяца
            $monthEndDate = (new DateTime($month->format('Y-m-t')))->modify('+1 day');
            $dateRange = new DatePeriod($month, new DateInterval('P1D'), $monthEndDate);

            $weekNumber = $month->format('W');
            $weeks = array();

            foreach ($dateRange as $date) {
                $weeks[$weekNumber][$date->format('D')] = $date->format('Y-m-d');

                // Если достигли воскресенья, то обновляем номер недели
                if ($date->format('w') == 0) {
                    $weekNumber++;
                }
            }

            $semesterDates[$month->format('m')] = $weeks;
        }

        // Удалить все дни, которые не входят в промежуток семестра
        foreach ($semesterDates as $monthName => $month) {
            foreach ($month as $weekName => $week) {
                foreach ($week as $weekDay => $date) {
                    if ($date < $semester->start_date->format('Y-m-d') ||
                        $date > $semester->end_date->format('Y-m-d')) {
                        unset($semesterDates[$monthName][$weekName][$weekDay]);
                    }
                }
            }
        }

        // Удалить пустые массивы, появившиеся после удаления дней, которые не входят в проммежуток семестра
        foreach ($semesterDates as $monthName => $month) {
            foreach ($month as $weekName => $week) {
                if (empty($week)) {
                    unset($semesterDates[$monthName][$weekName]);
                }
            }
        }
        return $semesterDates;
    }

    private function getSemesterStartWeek(array $semesterDates): int
    {
        $monthKeys = array_keys($semesterDates);
        $weekKeys = array_keys($semesterDates[$monthKeys[0]]);
        return $weekKeys[0];
    }

    private function setTransfers($semesterLessons, Collection $timetable): array
    {
        // Получаем все переносы для каждой пары в расписании
        $transfers = collect([]);
        foreach ($timetable as $lesson) {
            if (!empty($lesson->transfers)) {
                $transfers = $transfers->concat($lesson->transfers);
            }
        }

        foreach ($transfers as $transfer) {
            // Получаем номер месяца из старой даты и находим в этом месяце нужный день, опираясь на дату.
            // Получаем все пары этого дня
            $oldMonthNum = $transfer->old_date->format('m');
            $oldDateLessons = $semesterLessons[$oldMonthNum][$transfer->old_date->format('Y-m-d')];

            // Удаляем пары по старым датам
            foreach ($oldDateLessons as $index => $lesson) {
                if ($lesson->id == $transfer->lesson_id) {
                    unset($oldDateLessons[$index]);
                }
            }

            // Если перенесли все пары дня, то удаляем день из списка
            if (count($oldDateLessons) == 0) {
                unset($semesterLessons[$oldMonthNum][$transfer->old_date->format('Y-m-d')]);
            }

            // Добавляем паре старую дату, чтобы вывести ее в отчете
            $transfer->lesson->old_date = $transfer->old_date;
            // Добавляем пару по новой дате
            $newMonthNum = $transfer->new_date->format('m');
            $semesterLessons[$newMonthNum][$transfer->new_date->format('Y-m-d')][] = $transfer->lesson;
        }

        return $semesterLessons;
    }

    private function setReplacements($semesterLessons, Semester $semester, $lecturer): array
    {
        // Пары, где заменили данного преподавателя
        $meReplaced = Replacement::where('semester_id', $semester->id)
            ->where('old_lecturer_id', $lecturer->id)->get();

        // Пары, где заменял данный преподаватель
        $iReplaced = Replacement::where('semester_id', $semester->id)
            ->where('new_lecturer_id', $lecturer->id)->get();

        foreach ($meReplaced as $replacement) {
            // Получаем номер месяца из даты пары и находим в этом месяце нужный день, опираясь на дату.
            // Получаем все пары этого дня
            $lessonMonth = $replacement->lesson_date->format('m');
            $dateLessons = $semesterLessons[$lessonMonth][$replacement->lesson_date->format('Y-m-d')];

            // Удаляем те пары, где заменили данного преподавателя
            foreach ($dateLessons as $index => $lesson) {
                if ($lesson->id == $replacement->lesson_id) {
                    unset($dateLessons[$index]);
                }
            }

            // Если заменили на всех парах дня, то удаляем день из списка
            if (count($dateLessons) == 0) {
                unset($semesterLessons[$lessonMonth][$replacement->lesson_date->format('Y-m-d')]);
            }
        }

        foreach ($iReplaced as $replacement) {
            // Добавляем паре заменяемого лектора, чтобы вывести его в отчете
            $replacement->lesson->old_lecturer = $replacement->oldLecturer;
            // Добавляем замену по дате
            $lessonMonthNum = $replacement->lesson_date->format('m');
            $semesterLessons[$lessonMonthNum][$replacement->lesson_date->format('Y-m-d')][] = $replacement->lesson;
        }

        return $semesterLessons;
    }

    private function recur_ksort(&$array): void
    {
        foreach ($array as &$value) {
            if (is_array($value))
            {
                $this->recur_ksort($value);
            }
        }
        ksort($array);
    }

    private function createJournal(array $semesterLessons, $lecturer, string $name)
    {
        $spreadsheet = new Spreadsheet();
        $spreadsheet->removeSheetByIndex(0); // Удаляем страницу, созданную по умолчанию

        foreach ($semesterLessons as $monthNum => $monthLessons) {
            // Вставляем на каждую страницу шапку
            $worksheet = $this->getTemplateSheet();
            $spreadsheet->addExternalSheet($worksheet);

            // Записываем название страницы: текущмй месяц
            $monthName = $this->getMonthName($monthNum);
            $worksheet->setTitle($monthName);
            // Записываем ФИО преподавателя
            $lecturerName = implode(' ', [$lecturer->last_name, $lecturer->first_name, $lecturer->middle_name]);
            $worksheet->setCellValue('A1', $lecturerName);
            // Записываем месяц и год
            $year = $this->getYearForMonth($monthLessons);
            $worksheet->setCellValue('A6', $monthName . ' ' . $year . 'г.');

            $dateRowNum = 7;
            $groupRowNum = 7;
            foreach ($monthLessons as $date => $lessons) {
                // Записываем дату занятий
                $d = (new DateTime($date))->format('d.m.y');
                $worksheet->setCellValue('A' . $dateRowNum, $d);

                foreach ($lessons as $lesson) {
                    // Записываем часы по определенному типу занятий
                    $lessonTypeColNum = $this->getLessonTypeColumnNum($lesson->lessonType->type);
                    $worksheet->setCellValueByColumnAndRow($lessonTypeColNum, $groupRowNum, 2);

                    $groupNames = array();
                    foreach ($lesson->groups as $group) {
                        // Формируем массив имен групп: ПИ-19в, ПИ-17а
                        $shortYear = substr($group->admission_year, 2);
                        $groupFullName = $group->specialty->abbreviation . '-' . $shortYear . $group->subgroup;
                        array_push($groupNames, $groupFullName);
                        // Формируем строку из массива
                        $groupsStr = join(",\n", $groupNames);

                        // Записываем группы, присутствующие на занятии
                        $worksheet->setCellValue('B' . $groupRowNum, $groupsStr);
                        $worksheet->getStyle('B' . $groupRowNum)->getAlignment()->setWrapText(true);
                    }

                    $groupRowNum++;
                    $dateRowNum++;
                }
            }

            $worksheet->mergeCells("A$groupRowNum:B$groupRowNum");
            $worksheet->setCellValue("A$groupRowNum", 'Итого за '.mb_strtolower($monthName).':');

            $lastRowNum = $groupRowNum + 1;
            $worksheet->mergeCells("A$lastRowNum:H$lastRowNum");
            $worksheet->mergeCells("I$lastRowNum:U$lastRowNum");

            $lecturerName = $lecturer->last_name.' '
                .substr($lecturer->first_name, 0, 2).'. '
                .substr($lecturer->middle_name, 0, 2).'.';
            $worksheet->setCellValue("A$lastRowNum", "Преподаватель $lecturerName");
            $worksheet->setCellValue("I$lastRowNum", 'Зав. кафедрой ПИ');


            $this->setFormulas($worksheet, $groupRowNum);
            $this->setStyles($worksheet, $groupRowNum);
        }

        $journalPath = storage_path('app') . '/' . $name;
        $writer = new Xlsx($spreadsheet);
        $writer->save($journalPath);
    }

    private function getTemplateSheet(): Worksheet
    {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $templatePath = storage_path('app') . '/template.xlsx';
        $templateSheet = $reader->load($templatePath);
        return $templateSheet->getSheetByName('Template');
    }

    private function getMonthName(int $monthNum): string
    {
        return match ($monthNum) {
            1 => 'Январь',
            2 => 'Февраль',
            3 => 'Март',
            4 => 'Апрель',
            5 => 'Май',
            6 => 'Июнь',
            7 => 'Июль',
            8 => 'Август',
            9 => 'Сентябрь',
            10 => 'Октябрь',
            11 => 'Ноябрь',
            12 => 'Декабрь',
        };
    }

    private function getYearForMonth(array $monthLessons): int
    {
        $key = array_keys($monthLessons)[0];
        return (new DateTime($key))->format('Y');
    }

    private function getLessonTypeColumnNum(string $lessonType): int
    {
        return match ($lessonType) {
            'Лекции' => 3,
            'Практические (семинарские) занятия' => 4,
            'Лабораторные занятия' => 5,
            'НИРС' => 6,
            'Контр. работы студентов-заочников' => 7,
            'Проведение консультаций по курсу' => 8,
            'Проведение экзаменационнных консультаций' => 9,
            'Проверка контрольных аудиторных работ' => 10,
            'Проверка контрольных самостоятельных работ' => 11,
            'Рук-во и приём инд. заданий: рефератов, переводов' => 12,
            'Рук-во и приём инд. заданий: рассчётных, графических, рассч.-граф. работ' => 13,
            'Рук-во и приём инд. заданий: курсовых проектов, работ' => 14,
            'Проведение семестровых экзаменов' => 15,
            'Руководство практикой' => 16,
            'Проведение государственных экзаменов' => 17,
            'Рук-во, рец-е и пров-е защит ВКР' => 18,
            'Рук-во асп., соискателями и стажировкой преп.' => 19,
            'Другие виды учебной нагрузки' => 20,
        };
    }

    private function setFormulas(Worksheet $worksheet, int $rowNum)
    {
        // Задаем суммы по рядам
        for ($i = 7; $i < $rowNum; $i++) {
            $worksheet->setCellValue('U'.$i, "=SUM(C$i:T$i)");
        }

        // Задаем суммы по столбцам
        $lastRowNum = $rowNum - 1;
        for ($i = 3; $i <= 21; $i++) {
            $coords = $worksheet->getCellByColumnAndRow($i, $lastRowNum)->getCoordinate();
            $worksheet->setCellValueByColumnAndRow($i, $rowNum, "=SUM(".$coords[0]."7:$coords)");
        }
    }

    private function setStyles(Worksheet $worksheet, int $rowNum)
    {
        // Выравниваем даты по центру
        $worksheet->getStyle('A7:A' . $rowNum)->getAlignment()
            ->setVertical(Alignment::VERTICAL_CENTER);
        $worksheet->getStyle('A7:A' . $rowNum)->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Добавляем границы ячеек
        $worksheet->getStyle('A7:U' . $rowNum)->getBorders()
            ->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        // Задаем размер и семейство шрифта
        $lastRowNum = $rowNum + 1;
        $worksheet->getStyle('A7:U' . $lastRowNum)->getFont()->setName('Times New Roman');
        $worksheet->getStyle('A7:U' . $lastRowNum)->getFont()->setSize(12);

        // Для строки с итогами устанавливаем жирный шрифт
        $worksheet->getStyle('A' . $rowNum . ':U' . $rowNum)->getFont()->setBold(true);

        // Задаем толстые границы ячеек для нижней строки
        $worksheet->getStyle('A' . $lastRowNum . ':U' . $lastRowNum)->getBorders()->getOutline()
            ->setBorderStyle(Border::BORDER_MEDIUM);
        $worksheet->getStyle('A' . $lastRowNum . ':U' . $lastRowNum)->getBorders()->getInside()
            ->setBorderStyle(Border::BORDER_THIN);

        // Выравниваем по центру для нижней строки
        $worksheet->getStyle('A' . $lastRowNum . ':U' . $lastRowNum)->getAlignment()
            ->setVertical(Alignment::VERTICAL_CENTER);
        $worksheet->getStyle('A' . $lastRowNum . ':U' . $lastRowNum)->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);
    }
}

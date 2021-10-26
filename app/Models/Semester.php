<?php

namespace App\Models;

use DateTime;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Auditorium
 *
 * @property int $id
 * @property int $number
 * @property int $year
 * @property DateTime $start_date
 * @property DateTime $end_date
 * @method static Builder|Auditorium newModelQuery()
 * @method static Builder|Auditorium newQuery()
 * @method static Builder|Auditorium query()
 * @method static Builder|Auditorium whereAuditoriumNumber($value)
 * @method static Builder|Auditorium whereBuildingNumber($value)
 * @method static Builder|Auditorium whereId($value)
 * @mixin Eloquent
 */
class Semester extends Model
{
    use HasFactory;

    protected $table = 'semesters';
    protected $dates = ['start_date', 'end_date'];
}

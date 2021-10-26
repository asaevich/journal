<?php

namespace App\Models;

use Eloquent;
use Encore\Admin\Form\Field\HasMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


/**
 * App\Models\Lesson
 *
 * @property int $id
 * @property int $subject_id
 * @property int $employment_type_id
 * @property int $auditorium_id
 * @property int $lesson_type_id
 * @property string $start_date
 * @property string $end_date
 * @property string $week_day
 * @property string $week_type
 * @property int $number
 * @property-read \App\Models\Auditorium $auditorium
 * @property-read \App\Models\EmploymentType $employmentType
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Group[] $groups
 * @property-read int|null $groups_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Lecturer[] $lecturers
 * @property-read int|null $lecturers_count
 * @property-read \App\Models\LessonType $lessonType
 * @property-read \App\Models\Subject $subject
 * @method static Builder|Lesson newModelQuery()
 * @method static Builder|Lesson newQuery()
 * @method static Builder|Lesson query()
 * @method static Builder|Lesson whereAuditoriumId($value)
 * @method static Builder|Lesson whereEmploymentTypeId($value)
 * @method static Builder|Lesson whereEndDate($value)
 * @method static Builder|Lesson whereId($value)
 * @method static Builder|Lesson whereLessonTypeId($value)
 * @method static Builder|Lesson whereNumber($value)
 * @method static Builder|Lesson whereStartDate($value)
 * @method static Builder|Lesson whereSubjectId($value)
 * @method static Builder|Lesson whereWeekDay($value)
 * @method static Builder|Lesson whereWeekType($value)
 * @mixin Eloquent
 */
class Lesson extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $dates = ['start_date', 'end_date'];
    protected $guarded = ['id'];
    protected $with = ['subject', 'employmentType', 'auditorium', 'lessonType', 'lecturers', 'groups'];

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function employmentType(): BelongsTo
    {
        return $this->belongsTo(EmploymentType::class);
    }

    public function auditorium(): BelongsTo
    {
        return $this->belongsTo(Auditorium::class);
    }

    public function lessonType(): BelongsTo
    {
        return $this->belongsTo(LessonType::class);
    }

    public function lecturers(): BelongsToMany
    {
        return $this->belongsToMany(Lecturer::class);
    }

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class);
    }

    public function transfers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Transfer::class);
    }
}

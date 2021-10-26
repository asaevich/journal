<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Replacement extends Model
{
    use HasFactory;

    protected $dates = ['lesson_date'];
    protected $with = ['lesson', 'semester', 'oldLecturer', 'newLecturer'];

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    public function semester(): BelongsTo
    {
        return $this->belongsTo(Semester::class);
    }

    public function oldLecturer(): BelongsTo
    {
        return $this->belongsTo(Lecturer::class);
    }

    public function newLecturer(): BelongsTo
    {
        return $this->belongsTo(Lecturer::class);
    }
}

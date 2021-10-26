<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\LessonType
 *
 * @property int $id
 * @property string $type
 * @method static Builder|LessonType newModelQuery()
 * @method static Builder|LessonType newQuery()
 * @method static Builder|LessonType query()
 * @method static Builder|LessonType whereId($value)
 * @method static Builder|LessonType wherePeriod($value)
 * @method static Builder|LessonType whereType($value)
 * @mixin Eloquent
 */
class LessonType extends Model
{
    use HasFactory;
}

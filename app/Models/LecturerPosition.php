<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\LecturerPosition
 *
 * @property int $id
 * @property string $position
 * @method static Builder|LecturerPosition newModelQuery()
 * @method static Builder|LecturerPosition newQuery()
 * @method static Builder|LecturerPosition query()
 * @method static Builder|LecturerPosition whereId($value)
 * @method static Builder|LecturerPosition wherePosition($value)
 * @mixin Eloquent
 */
class LecturerPosition extends Model
{
    use HasFactory;
}

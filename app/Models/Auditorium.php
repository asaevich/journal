<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Auditorium
 *
 * @property int $id
 * @property int $building_number
 * @property int $auditorium_number
 * @method static Builder|Auditorium newModelQuery()
 * @method static Builder|Auditorium newQuery()
 * @method static Builder|Auditorium query()
 * @method static Builder|Auditorium whereAuditoriumNumber($value)
 * @method static Builder|Auditorium whereBuildingNumber($value)
 * @method static Builder|Auditorium whereId($value)
 * @mixin Eloquent
 */
class Auditorium extends Model
{
    use HasFactory;

    protected $table = 'auditoriums';
}

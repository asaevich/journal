<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Holiday
 *
 * @property int $id
 * @property string $holiday
 * @property string $start_date
 * @property string $end_date
 * @method static Builder|Holiday newModelQuery()
 * @method static Builder|Holiday newQuery()
 * @method static Builder|Holiday query()
 * @method static Builder|Holiday whereEndDate($value)
 * @method static Builder|Holiday whereHoliday($value)
 * @method static Builder|Holiday whereId($value)
 * @method static Builder|Holiday whereStartDate($value)
 * @mixin Eloquent
 */
class Holiday extends Model
{
    use HasFactory;
}

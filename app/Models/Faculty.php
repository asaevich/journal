<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Faculty
 *
 * @property int $id
 * @property string $name
 * @property string $abbreviation
 * @method static Builder|Faculty newModelQuery()
 * @method static Builder|Faculty newQuery()
 * @method static Builder|Faculty query()
 * @method static Builder|Faculty whereAbbreviation($value)
 * @method static Builder|Faculty whereId($value)
 * @method static Builder|Faculty whereName($value)
 * @mixin Eloquent
 */
class Faculty extends Model
{
    use HasFactory;
}

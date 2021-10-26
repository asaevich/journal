<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\EmploymentType
 *
 * @property int $id
 * @property string $type
 * @method static Builder|EmploymentType newModelQuery()
 * @method static Builder|EmploymentType newQuery()
 * @method static Builder|EmploymentType query()
 * @method static Builder|EmploymentType whereId($value)
 * @method static Builder|EmploymentType whereType($value)
 * @mixin Eloquent
 */
class EmploymentType extends Model
{
    use HasFactory;
}

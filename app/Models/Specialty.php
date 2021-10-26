<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Znck\Eloquent\Traits\BelongsToThrough;


/**
 * App\Models\Specialty
 *
 * @property int $id
 * @property string $name
 * @property string $abbreviation
 * @property int $department_id
 * @property-read \App\Models\Department $department
 * @method static Builder|Specialty newModelQuery()
 * @method static Builder|Specialty newQuery()
 * @method static Builder|Specialty query()
 * @method static Builder|Specialty whereAbbreviation($value)
 * @method static Builder|Specialty whereDepartmentId($value)
 * @method static Builder|Specialty whereId($value)
 * @method static Builder|Specialty whereName($value)
 * @mixin Eloquent
 */
class Specialty extends Model
{
    use HasFactory, BelongsToThrough;

    protected $with = ['department', 'faculty'];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function faculty(): \Znck\Eloquent\Relations\BelongsToThrough
    {
        return $this->belongsToThrough('App\Models\Faculty', 'App\Models\Department');
    }
}

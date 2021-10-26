<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Znck\Eloquent\Traits\BelongsToThrough;

/**
 * App\Models\Subject
 *
 * @property int $id
 * @property string $name
 * @property int $department_id
 * @property-read \App\Models\Department $department
 * @method static Builder|Subject newModelQuery()
 * @method static Builder|Subject newQuery()
 * @method static Builder|Subject query()
 * @method static Builder|Subject whereDepartmentId($value)
 * @method static Builder|Subject whereId($value)
 * @method static Builder|Subject whereName($value)
 * @mixin Eloquent
 */
class Subject extends Model
{
    use HasFactory, BelongsToThrough;

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function faculty(): \Znck\Eloquent\Relations\BelongsToThrough
    {
        return $this->belongsToThrough('App\Models\Faculty', 'App\Models\Department');
    }
}

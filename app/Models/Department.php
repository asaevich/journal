<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Department
 *
 * @property int $id
 * @property string $department
 * @property int $faculty_id
 * @method static Builder|Department newModelQuery()
 * @method static Builder|Department newQuery()
 * @method static Builder|Department query()
 * @method static Builder|Department whereDepartment($value)
 * @method static Builder|Department whereFacultyId($value)
 * @method static Builder|Department whereId($value)
 * @mixin Eloquent
 * @property string $name
 * @property string $abbreviation
 * @property-read \App\Models\Faculty $faculty
 * @method static Builder|Department whereAbbreviation($value)
 * @method static Builder|Department whereName($value)
 */
class Department extends Model
{
    use HasFactory;

    public function faculty(): BelongsTo
    {
        return $this->belongsTo(Faculty::class);
    }
}

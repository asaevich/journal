<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Znck\Eloquent\Traits\BelongsToThrough;


/**
 * App\Models\Group
 *
 * @property int $id
 * @property int $specialty_id
 * @property string|null $subgroup
 * @property int $education_type_id
 * @property int $admission_year
 * @property-read \App\Models\EducationType $educationType
 * @property-read \App\Models\Specialty $specialty
 * @method static Builder|Group newModelQuery()
 * @method static Builder|Group newQuery()
 * @method static Builder|Group query()
 * @method static Builder|Group whereAdmissionYear($value)
 * @method static Builder|Group whereEducationTypeId($value)
 * @method static Builder|Group whereId($value)
 * @method static Builder|Group whereSpecialtyId($value)
 * @method static Builder|Group whereSubgroup($value)
 * @mixin Eloquent
 */
class Group extends Model
{
    use HasFactory, BelongsToThrough;

    protected $with = ['specialty', 'department', 'faculty', 'educationType'];

    public function specialty(): BelongsTo
    {
        return $this->belongsTo(Specialty::class);
    }

    public function department(): \Znck\Eloquent\Relations\BelongsToThrough
    {
        return $this->belongsToThrough('App\Models\Department', 'App\Models\Specialty');
    }

    public function faculty(): \Znck\Eloquent\Relations\BelongsToThrough
    {
        return $this->belongsToThrough('App\Models\Faculty', ['App\Models\Department', 'App\Models\Specialty']);
    }

    public function educationType(): BelongsTo
    {
        return $this->belongsTo(EducationType::class);
    }

    public function lessons(): BelongsToMany
    {
        return $this->belongsToMany(Lesson::class);
    }
}

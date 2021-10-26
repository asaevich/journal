<?php

namespace App\Models;

use App\Http\Resources\LecturerCollection;
use App\Http\Resources\LecturerResource;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Resources\Json\JsonResource;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Znck\Eloquent\Relations\BelongsToThrough;


/**
 * App\Models\Lecturer
 *
 * @property int $id
 * @property string $last_name
 * @property string $first_name
 * @property string|null $middle_name
 * @property int $department_id
 * @property int $position_id
 * @property string $username
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Department $department
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Lesson[] $lessons
 * @property-read int|null $lessons_count
 * @property-read \App\Models\LecturerPosition $position
 * @method static Builder|Lecturer newModelQuery()
 * @method static Builder|Lecturer newQuery()
 * @method static Builder|Lecturer query()
 * @method static Builder|Lecturer whereCreatedAt($value)
 * @method static Builder|Lecturer whereDepartmentId($value)
 * @method static Builder|Lecturer whereFirstName($value)
 * @method static Builder|Lecturer whereId($value)
 * @method static Builder|Lecturer whereLastName($value)
 * @method static Builder|Lecturer whereMiddleName($value)
 * @method static Builder|Lecturer wherePassword($value)
 * @method static Builder|Lecturer wherePositionId($value)
 * @method static Builder|Lecturer whereRememberToken($value)
 * @method static Builder|Lecturer whereUpdatedAt($value)
 * @method static Builder|Lecturer whereUsername($value)
 * @mixin Eloquent
 */
class Lecturer extends Authenticatable implements JWTSubject
{
    use HasFactory, \Znck\Eloquent\Traits\BelongsToThrough;

    protected $hidden = ['password'];
    protected $with = ['department', 'faculty', 'position'];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function faculty(): \Znck\Eloquent\Relations\BelongsToThrough
    {
        return $this->belongsToThrough('App\Models\Faculty', 'App\Models\Department');
    }

    public function position(): BelongsTo
    {
        return $this->belongsTo(LecturerPosition::class);
    }

    public function lessons(): BelongsToMany
    {
        return $this->belongsToMany(Lesson::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [
            'last_name' => $this->last_name,
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'username' => $this->username
        ];
    }
}

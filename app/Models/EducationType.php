<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\EducationType
 *
 * @property int $id
 * @property string $type
 * @method static Builder|EducationType newModelQuery()
 * @method static Builder|EducationType newQuery()
 * @method static Builder|EducationType query()
 * @method static Builder|EducationType whereId($value)
 * @method static Builder|EducationType whereType($value)
 * @mixin Eloquent
 */
class EducationType extends Model
{
    use HasFactory;
}

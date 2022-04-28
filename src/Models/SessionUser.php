<?php

namespace Voxl\Util\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SessionUser
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $property_id
 * @method static \Illuminate\Database\Eloquent\Builder|SessionUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SessionUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SessionUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|SessionUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SessionUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SessionUser wherePropertyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SessionUser whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SessionUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'property_id'
    ];
}

<?php

namespace Voxl\Util\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/*
 * @mixin Builder
 */
/**
 * App\Models\Event
 *
 * @property int $id
 * @property int $user_id
 * @property int $session_id
 * @property string $event_hash
 * @property string $event_name
 * @property string $event_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $property_id
 * @property string|null $registered_at
 * @method static Builder|Event newModelQuery()
 * @method static Builder|Event newQuery()
 * @method static Builder|Event query()
 * @method static Builder|Event whereCreatedAt($value)
 * @method static Builder|Event whereEventHash($value)
 * @method static Builder|Event whereEventName($value)
 * @method static Builder|Event whereEventPath($value)
 * @method static Builder|Event whereId($value)
 * @method static Builder|Event wherePropertyId($value)
 * @method static Builder|Event whereRegisteredAt($value)
 * @method static Builder|Event whereSessionId($value)
 * @method static Builder|Event whereUpdatedAt($value)
 * @method static Builder|Event whereUserId($value)
 * @mixin \Eloquent
 */
class Event extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'source_id',
        'property_id',
        'session_id',
        'event_hash',
        'event_name',
        'event_path',
        'registered_at',
        'parameters',
    ];

    protected $casts = [
        'parameters' => 'array',
    ];

    public function source() {
        return $this->belongsTo(Source::class, "source_id");
    }

}

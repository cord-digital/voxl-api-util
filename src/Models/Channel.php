<?php

namespace Voxl\Util\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;

    protected $casts = [
        'default_groupings' => 'array',
        'properties' => 'array',
    ];

    /**
     * The channels the property has.
     */
    public function properties()
    {
        return $this->belongsToMany(WebProperty::class, "web_property_channels", "channel_id", "property_id")->withPivot(["settings", "channel_groupings", "created_at", "updated_at"]);
    }

}

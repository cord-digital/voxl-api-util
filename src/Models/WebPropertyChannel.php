<?php

namespace Voxl\Util\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebPropertyChannel extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'channel_id',
        'settings',
        'channel_groupings',
        'name_override',
        'icon_override',
        'key_override',
        'order'
    ];

    protected $casts = [
        'channel_groupings' => 'array',
        'settings' => 'array',
    ];

    protected $attributes = [
         'channel_groupings' => "{}",
         'settings' => "{}"
    ];

    /**
     * The channel assigned to the WebPropertyChannel.
     */
    public function channel()
    {
        return $this->belongsTo(Channel::class, "channel_id");
    }

}

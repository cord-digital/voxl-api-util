<?php

namespace Voxl\Util\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlatformAdObject extends Model
{
    use HasFactory;

    protected $fillable = [
        "property_id",
        "ad_account",
        "parent",
        "platform_id",
        'level',
        'name',
        'status',
        'budget',
        'budget_remaining',
        'budget_type',
        'utms'
    ];

    /**
     * The property this belongs to
     */
    public function property()
    {
        return $this->belongsTo(WebProperty::class, "property_id", "id");
    }

    /**
     * The ad_account this belongs to
     */
    public function ad_account()
    {
        return $this->belongsTo(PlatformAdAccount::class, "ad_account", "id");
    }

    /**
     * The parent ad object
     */
    public function parent()
    {
        return $this->belongsTo(PlatformAdObject::class, "parent", "id");
    }

}

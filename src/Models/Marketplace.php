<?php

namespace Voxl\Util\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marketplace extends Model
{
    use HasFactory;

    protected $fillable = [
        "property_id",
        "marketplace",
        "access_token",
        "access_key",
        "api_address",
        "reporting_timezone",
        "settings",
        "enabled",
        "enabled_at",
        "unique_id"
    ];

    protected $casts = [
        "settings" => "array"
    ];

    public function property() {
        return $this->belongsTo(WebProperty::class, "property_id");
    }

}

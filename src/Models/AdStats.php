<?php

namespace Voxl\Util\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Voxl\Util\Models\Ad;

class AdStats extends Model
{
    use HasFactory;

    protected $fillable = [
        "property_id",
        "vxl_campaign",
        "vxl_set",
        "vxl_ad",
        'vxl_channel',
        "ad_id",
        "day",
        "spend",
        "conversions",
        "conversions_value",
        "clicks",
        "impressions",
        "status"

    ];

    public function ad() {
        return $this->belongsTo(Ad::class, "ad_id");
    }

}

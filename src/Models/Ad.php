<?php

namespace Voxl\Util\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    protected $fillable = [
        "property_id",
        "vxl_campaign",
        "vxl_channel",
        "vxl_set",
        "vxl_ad",
        "name",
        "ad_set_name",
        "campaign_name",
        "ad_account",
        "thumbnail"
    ];
}

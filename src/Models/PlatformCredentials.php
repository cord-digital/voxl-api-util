<?php

namespace Voxl\Util\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlatformCredentials extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        "platform",
        "access_id",
        "access_token",
        "access_secret",
        "refresh_token",
        "arguments",
        "name",
        "channel_id",
        'enabled',
    ];

    protected $hidden = [
        "access_token",
        "refresh_token",
        "access_secret"
    ];

    protected $casts = [
      "arguments" => "array"
    ];

    /**
     * The ad accounts this credential has.
     */
    public function ad_accounts()
    {
        return $this->hasMany(PlatformAdAccount::class, "credential_id", "id");
    }

    /**
     * The property this credential is for
     */
    public function property()
    {
        return $this->belongsTo(WebProperty::class, "property_id", "id");
    }

    /**
     * The channel this credential is for
     */
    public function channel()
    {
        return $this->belongsTo(Channel::class, "channel_id", "id");
    }

    /**
     * The enabled ad accounts this credential has.
     */
    public function enabled_ad_accounts()
    {
        return $this->hasMany(PlatformAdAccount::class, "credential_id", "id")->where("enabled", true);
    }

}

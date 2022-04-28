<?php

namespace Voxl\Util\Models;

use Google\AdsApi\AdWords\v201809\cm\Platform;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlatformAdAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        "credential_id",
        'account_id',
        'name',
        'reporting_timezone',
        'parent_id',
        'parent_name',
        'enabled',
        'enabled_at',
        'disabled_at'
    ];

    /**
     * The ad accounts this credential has.
     */
    public function credentials()
    {
        return $this->belongsTo(PlatformCredentials::class, "credential_id", "id");
    }

}

<?php

namespace Voxl\Util\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsyncReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'credential_id',
        'report_id',
        'status',
        'completed_at',
        "properties"
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'properties' => 'array',
    ];

    /**
     * The PlatformCredential this asyncreport belongs to
     */
    public function credential()
    {
        return $this->belongsTo(PlatformCredentials::class, "credential_id");
    }

}

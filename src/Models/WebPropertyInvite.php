<?php

namespace Voxl\Util\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebPropertyInvite extends Model
{
    use HasFactory;

    protected $fillable = [
        "property_id",
        "email",
        "role",
        "accepted"
    ];

    public function property()
    {
        return $this->belongsTo(WebProperty::class, "property_id");
    }

}

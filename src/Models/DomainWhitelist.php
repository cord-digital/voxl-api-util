<?php

namespace Voxl\Util\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DomainWhitelist extends Model
{
    use HasFactory;

    public function property() {
        return $this->belongsTo(WebProperty::class, "property_id");
    }

}

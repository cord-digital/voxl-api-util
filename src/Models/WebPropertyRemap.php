<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebPropertyRemap extends Model
{
    use HasFactory;

    protected $fillable = [
        "property_id",
        "key",
        "destination",
        "conditions",
        "overrides"
    ];

    /**
     * The property this remap is for
     */
    public function property()
    {
        return $this->belongsTo(WebProperty::class, "property_id", "id");
    }

}

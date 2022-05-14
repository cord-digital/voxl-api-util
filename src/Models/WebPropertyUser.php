<?php

namespace Voxl\Util\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebPropertyUser extends Model
{
    use HasFactory;

    protected $table = "web_property_user";

    protected $fillable = [
        "property_id",
        "user_id",
        "role",
        "settings"
    ];

    protected $casts = [
        "settings" => "array"
    ];

    /**
     * The user
     */
    public function user()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }

}

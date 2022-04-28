<?php

namespace Voxl\Util\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversion extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'event_id',
        'user_id',
        'first_touch_event_id',
        'last_touch_event_id',
        'monetary_value',
        'order_id',
        'converted_at',
        'type',
        'name',
        'uid'
    ];

    public function event() {
        return $this->belongsTo(Event::class, "event_id");
    }

    public function first_touch() {
        return $this->belongsTo(Event::class, "first_touch_event_id");
    }
    public function last_touch() {
        return $this->belongsTo(Event::class, "last_touch_event_id");
    }

    public function marketplace_order() {
        return $this->hasOne(MarketplaceOrder::class);
    }

}

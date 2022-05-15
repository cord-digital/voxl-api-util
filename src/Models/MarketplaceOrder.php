<?php

namespace Voxl\Util\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketplaceOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'marketplace_id',
        'conversion_id',
        'marketplace_number',
        'marketplace_order_id',
        'customer_email',
        'customer_id',
        'customer_first',
        'customer_last',
        'additional_properties',

    ];

    public function marketplace() {
        return $this->belongsTo(Marketplace::class, "marketplace_id");
    }

    public function conversion() {
        return $this->belongsTo(Conversion::class, "conversion_id");
    }

}

<?php

namespace Voxl\Util\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    use HasFactory;


    protected $fillable = [
        'property_id',
        'vxl_channel',
        'vxl_campaign',
        'vxl_ad',
        'vxl_set',
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'utm_content',
        'utm_term',
        'domain'
    ];
}

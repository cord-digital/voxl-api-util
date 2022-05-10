<?php

namespace Voxl\Util\Models;

use App\WebPropertyRemap;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebProperty extends Model
{
    use HasFactory;

    protected $fillable = [
        'domain',
    ];

    protected $casts = [
        'channel_groupings' => 'array',
        'settings' => 'array',
    ];

    protected $attributes = [
        'channel_groupings' => '{"ordering":["fb_ads","default"],"groupings":{"default":{"display":"Other","key":"default","type":"default","definition":[],"subgroupings":[{"key":"source","display":"Source","definition":"utm_source"},{"key":"medium","display":"Medium","definition":"utm_medium"},{"key":"campaign","display":"Campaign","definition":"utm_campaign"}]},"fb_ads":{"display":"Facebook Ads","key":"fb_ads","type":"integration","definition":[{"key":"vxl_channel","value":"fb_ads"}],"remaps":[{"key":"fbaid","dest":"vxl_ad"}],"subgroupings":[{"key":"campaign","display":"Campaign","definition":"ad.vxl_campaign"},{"key":"set","display":"Ad Set","definition":"ad.vxl_set"},{"key":"ad","display":"Ad","definition":"ad.vxl_ad"}]}}}
        ',
        'settings' => '{"reporting_timezone":"-7"}',
    ];

    /**
     * The users the property has.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, "web_property_user", "property_id", "user_id");
    }

    /**
     * The channels the property has.
     */
    public function channels()
    {
        return $this->hasMany(WebPropertyChannel::class, "property_id")->with("channel")->orderBy("order", "ASC");
    }

    /**
     * The remaps the property has.
     */
    public function remaps()
    {
        return $this->hasMany(WebPropertyRemap::class, "property_id");
    }

}

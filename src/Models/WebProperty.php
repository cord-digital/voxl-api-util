<?php

namespace Voxl\Util\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebProperty extends Model
{
    use HasFactory;

    protected $fillable = [
        'domain',
        'display_name',
        'settings'
    ];

    protected $casts = [
        'settings' => 'array',
    ];

    protected $attributes = [
        'settings' => '{"reporting_timezone":"-7"}',
    ];

    /**
     * The users the property has.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, "web_property_user", "property_id", "user_id")->withPivot(["role as role", "web_property_user.created_at as property_created_at"]);
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

    /**
     * The invites the property has.
     */
    public function invites()
    {
        return $this->hasMany(WebPropertyInvite::class, "property_id")->where("accepted", false);
    }

    /**
     * The property's marketplaces.
     */
    public function marketplaces()
    {
        return $this->hasMany(Marketplace::class, "property_id");
    }

    /**
     * The property's marketplaces.
     */
    public function marketplace()
    {
        return $this->hasOne(Marketplace::class, "property_id")->where("enabled", true);
    }


    public static function create_property($domain, User $user, $display_name = null)
    {
        if ($display_name === null)
            $display_name = $domain;

        $prop = WebProperty::create([
            'domain' => $domain,
            'display_name' => $display_name,
            'settings' => ["reporting_timezone" => "-7"],
        ]);

        WebPropertyChannel::create([
            "property_id" => $prop->id,
            "name_override" => "Other",
            "key_override" => "default",
            "order" => 0,
            "channel_groupings" => json_decode(
                '{"definition": [], "subgroupings": [{"key": "source", "display": "Source", "definition": "utm_source"}, {"key": "medium", "display": "Medium", "definition": "utm_medium"}, {"key": "campaign", "display": "Campaign", "definition": "utm_campaign"}]}',
                true
            ),
            'settings' => ["color" => ""],
        ]);

        DomainWhitelist::create([
            "property_id" => $prop->id,
            "domain" => $domain,
        ]);

        WebPropertyUser::create([
            "property_id" => $prop->id,
            "user_id" => $user->id,
            "role" => "admin",
            "settings" => ["display" => "default"]
        ]);
        return $prop;
    }
}

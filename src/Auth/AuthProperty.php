<?php

namespace Voxl\Util\Auth;

use Voxl\Util\Analytics\AnalyticsUtil;
use Voxl\Util\Models\Channel;
use Voxl\Util\Models\WebProperty;

class AuthProperty
{
    protected $property, $property_id;

    private static $instance;

    public function __construct()
    {
        self::$instance = $this;
    }

    public function get_property(): WebProperty | null {
        return $this->property;
    }

    public function set_property(WebProperty $property) {
        $this->property = $property;
        $this->property_id = $property->id;
    }

    public static function property(): WebProperty|null {
        return self::$instance->get_property();
    }

    public static function id(): string|null {
        if (self::$instance->get_property())
            return self::$instance->get_property()->id;
        else
            return null;
    }

    public static function user_profile() {
        $user = auth()->user();
        if (AuthProperty::property()) {
            $property = AuthProperty::property();
            $user->channel_groupings = AnalyticsUtil::get_channel_groupings($property, true);
            $user->settings = $property->settings;
            $user->channels = ["enabled_channels" => $property->channels, "available_channels" => Channel::whereDoesntHave('properties', function($query) {
                $query->whereIn('web_properties.id', [AuthProperty::property()->id]);
            })->get()];
        }
        $user->properties;
        foreach ($user->properties as $x => $p) {
            $p->management = ($p->id == 2);
            $user->properties[$x] = $p;

        }
        return $user;
    }

}

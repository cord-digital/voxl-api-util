<?php

namespace Voxl\Util\Auth;

use Voxl\Util\Analytics\AnalyticsUtil;
use Voxl\Util\Models\Channel;
use Voxl\Util\Models\User;
use Voxl\Util\Models\WebProperty;

class AuthProperty
{
    protected $property, $property_id;

    protected $state_user;

    private static $instance;

    public function __construct()
    {
        if (!self::$instance) {
            self::$instance = $this;
        }
    }

    public function get_property(): WebProperty | null {
        return $this->property;
    }

    public function set_property(WebProperty $property, User $state_user = null) {
        $this->property = $property;
        $this->property_id = $property->id;
        $this->state_user = $state_user;
        self::$instance = $this;
    }

    public static function state_user(): User|null {
        return self::$instance->state_user;
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
        if (self::property()) {
            $property = self::property();
            $user->channel_groupings = AnalyticsUtil::get_channel_groupings($property, true);
            $user->settings = $property->settings;
            $user->channels = ["enabled_channels" => $property->channels, "available_channels" => Channel::whereDoesntHave('properties', function($query) {
                $query->whereIn('web_properties.id', [self::property()->id]);
            })->get()];
        }
        $user->properties;
        foreach ($user->properties as $x => $p) {
            $p->management = ($p->id == -1);
            $user->properties[$x] = $p;

        }
        return $user;
    }

}

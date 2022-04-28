<?php

namespace Voxl\Util\Analytics;

use Voxl\Util\Models\WebProperty;

class AnalyticsUtil
{
    public static function get_channel_groupings(WebProperty $property, $for_display = false) {

        $channel_grouping = [
            "ordering" => [],
            "groupings" => []
        ];

        foreach ($property->channels as $channel) {
            $key = ($channel->channel ? $channel->channel->key: $channel->key_override);
            $channel_grouping['ordering'][] = $key;
            $icon = null;
            $color = null;
            if ($for_display !== false) {
                $icon = ($channel->channel ? $channel->channel->icon : $channel->icon_override);
                $color = ($channel->channel ? (array_key_exists("color", $channel->channel->properties) ? $channel->channel->properties['color'] : null) : null);
            }

            $cg = $channel->channel_groupings;
            $new = [
                "id" => $channel->id,
                "key" => $key,
                "type" => ($channel->channel ? "integration" : ($channel->key_override == "default" ? "default" : "custom")),
                "display" => ($channel->channel ? $channel->channel->name : $channel->name_override),
            ];
            if ($for_display !== false) {
                $new['icon'] = $icon;
                $new['color'] = $color;
                $new['channel_id'] = ($channel->channel?->id);
            }

            if (array_key_exists("remaps", $cg))
                $new['remaps'] = $cg['remaps'];
            if (array_key_exists("definition", $cg))
                $new['definition'] = $cg['definition'];
            if (array_key_exists("subgroupings", $cg))
                $new['subgroupings'] = $cg['subgroupings'];

            $channel_grouping['groupings'][$key] = $new;

        }
        return $channel_grouping;
    }

}
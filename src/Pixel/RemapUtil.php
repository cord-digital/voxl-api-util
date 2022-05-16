<?php

namespace Voxl\Util\Pixel;

use Voxl\Util\Auth\AuthProperty;
use Voxl\Util\Models\WebProperty;

class RemapUtil
{
    public static function pre_source($params, &$pre_source)
    {
        // start with baseline valid params
        // note: vxl_campaign and vxl_set are not here anymore
        $valid_params = [
            'vxl_channel',
            'vxl_ad',
            'utm_source',
            'utm_medium',
            'utm_campaign',
            'utm_content',
            'utm_term',
            'domain'
        ];
        // search for valid params in the data
        // count how many you find, set ones you dont find to null
        $pre_source = [];
        $valid_found = 0;
        foreach ($valid_params as $p) {
            if (array_key_exists($p, $params)) {
                $pre_source[$p] = $params[$p];
                $valid_found++;
            } else {
                $pre_source[$p] = null;
            }
        }
        return $valid_found;
    }

    public static function apply_remaps(&$pre_source, $params, $property_id = null, $remaps = null)
    {
        if ($remaps === null) {
            $remaps = self::get_remaps_for_property($property_id);
        }
        // {mapping: {key: , destination: }, definition: [ {key:, value:} ]}
        $applied = false;
        foreach ($remaps as $remap) {
            if (!array_key_exists($remap['mapping']['key'], $params)) {
                continue;
            }
            //check conditions
            $fail = false;
            foreach ($remap['mapping']['conditions'] as $condition) {
                if (!array_key_exists($condition['key'], $params)) {
                    $fail = true;
                    break;
                }
                if ($params[$condition['key']] != $condition['value']) {
                    $fail = true;
                    break;
                }
            }
            if ($fail) {
                continue;
            }

            // only remap to valid source attributes
            if ($remap['mapping']['destination'] != null && !array_key_exists(
                    $remap['mapping']['destination'],
                    $pre_source
                )) {
                continue;
            }
            $applied = true;
            // perform the remap
            if ($remap['mapping']['destination'] != null) {
                $pre_source[$remap['mapping']['destination']] = $params[$remap['mapping']['key']];
            }
            // apply the definition
            foreach ($remap['definition'] as $rule) {
                if (!array_key_exists($rule['key'], $pre_source)) {
                    continue;
                }
                $pre_source[$rule['key']] = $rule['value'];
            }
        }
        return $applied;
    }

    public static function get_remaps_for_property($property_id = null)
    {

        if ($property_id !== null) {
            $property = WebProperty::whereId($property_id)->first();
        } else {
            $property = AuthProperty::property();
        }
        $remaps = $property->remaps;
        $all_remaps = [];

        foreach ($remaps as $remap) {
            $remap = $remap->toArray();
            $compiled = [];
            $def = $remap['overrides'];
            $compiled['definition'] = $def;
            unset($remap['overrides']);
            $compiled['mapping'] = $remap;
            array_push($all_remaps, $compiled);
        }

        return $all_remaps;
    }

}

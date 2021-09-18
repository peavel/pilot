<?php

if (!function_exists('setting')) {
    function setting($key, $default = null)
    {
        return PEAVEL\Pilot\Facades\Pilot::setting($key, $default);
    }
}

if (!function_exists('menu')) {
    function menu($menuName, $type = null, array $options = [])
    {
        return PEAVEL\Pilot\Facades\Pilot::model('Menu')->display($menuName, $type, $options);
    }
}

if (!function_exists('pilot_asset')) {
    function pilot_asset($path, $secure = null)
    {
        return route('pilot.pilot_assets').'?path='.urlencode($path);
    }
}

if (!function_exists('get_file_name')) {
    function get_file_name($name)
    {
        preg_match('/(_)([0-9])+$/', $name, $matches);
        if (count($matches) == 3) {
            return Illuminate\Support\Str::replaceLast($matches[0], '', $name).'_'.(intval($matches[2]) + 1);
        } else {
            return $name.'_1';
        }
    }
}

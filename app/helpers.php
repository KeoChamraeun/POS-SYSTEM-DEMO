<?php

use App\Models\SiteSetting;

if (!function_exists('site_settings')) {
    function site_settings()
    {
        return cache()->rememberForever('site_settings', function () {
            return SiteSetting::first();
        });
    }
}

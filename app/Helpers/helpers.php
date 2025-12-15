<?php

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

if (!function_exists('isActiveMenu')) {
    function isActiveMenu($slug, $activeClass = 'active pill-trace')
    {
        // Normalize slug and current path
        $slug = trim((string) $slug, '/');  // e.g., "/" → ""
        $current = Request::path();  // e.g., "/" → "/"
        $current = $current === '/' ? '' : trim($current, '/');  // normalize home to empty
        // Case 1: Home page
        if ($slug === 'home' || $slug === '/') {
            return $current === '' ? $activeClass : '';
        }
        // Case 2: Match exact slug or nested
        return ($current === $slug || Str::startsWith($current, $slug . '/'))
            ? $activeClass
            : '';
    }
}

if (!function_exists('isSeoMeta')) {
    function isSeoMeta($slug)
    {
        return \App\Models\Menu::where('title_slug', $slug)->first();
    }
}

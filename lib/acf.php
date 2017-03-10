<?php

/**
 * ACF Pro Settings
 * @link https://www.advancedcustomfields.com/resources/including-acf-in-a-plugin-theme/
 */
add_filter('acf/settings/path', function ($path) {
    $path = get_stylesheet_directory() . '/acf/';
    return $path;
});

add_filter('acf/settings/dir', function ($dir) {
    $dir = get_stylesheet_directory_uri() . '/acf/';
    return $dir;
});

include_once( get_stylesheet_directory() . '/acf/acf.php' );

add_filter('acf/options_page/settings', function ($dir) {
    $dir = get_stylesheet_directory_uri() . '/acf/';
    return $dir;
});